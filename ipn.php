<?php

/*
The IPN handler... set server logs up etc
*/
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

require 'includes/master.inc.php'; 
require 'includes/functions_ipn.php'; //the functions will go here
require 'ipnlistener.php';

$listener = new IpnListener();

/*
When you are testing your IPN script you should be using a PayPal "Sandbox"
account: https://developer.paypal.com
When you are ready to go live change use_sandbox to false.
*/
$listener->use_sandbox = true; // setting to be added

try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}
ksort($_POST); // used for the debugging email 
if ($verified) {
  	$date = correct_time_date ($_POST['payment_date']);
    $headers = "MIME-Version: 1.0" . "\r\n"; // set html
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; //set html
    $from = $settings['sitename'].'<'.$settings['paypal_email'].'>';
    $to = "KB Rcacing <jim@noideersoftware.co.uk>";
    $subject = $settings['sitename']." Order - #".$_POST['txn_id'];
    $message .= '<body style="color:#999;background:#2D3538;">';  
	$message .= '<img src = "'.$settings['logo'].'" style="max-width:442px" /><br style="clear:both;">';
	$items= $_POST['num_cart_items'];
	if(is_null($items)) {$items='1';}
	$message .= format_address();
	$message .= '<br>Transaction Status - '.$_POST['payment_status'].'<br>';
	$message .= printr($_POST, 1).'<br>Cart items '.$items.'<br><table style="width:600">';
	$message .= fillitems($items).'</table><br>Adjusted date is '.$date.'</body>';
    $headers .= "From:" . $from;
    mail($to,$subject,$message, $headers);
    } 
else {
	    // invalid
			build_email(5);
			build_email(6);
   }
function fillitems ($items)
	    //global $site;
	{
		$item_row = new Template;
		$footer = new Template;
		// item loop
		$currency = '&pound';
		$itemid = "item_name";
		$qtyid = "quantity";
		$valueid = "mc_gross_";
		$shipid = "mc_shipping";
		$handling = "mc_handling";
	for ($x=1; $x<=$items; $x++)
   { 
    $qtyl = $qtyid.$x; 
    $iteml = $itemid.$x;
    $valuel = $valueid.$x;
    $shipl = $shipid.$x; 
    $handlingl = $handling.$x;
    $item = $_POST[$iteml];
    $qty = $_POST[$qtyl]; 
    $value = $_POST[$valuel];
    $ship = $_POST[$shipl];
    $unit = number_format($value/$qty,2,'.','');
    $net = number_format($value-$ship, 2, '.', '');
    if ($qty > 1) 
		{
			// add text
			
			
			$unitprice =$currency.number_format($net/$qty,2,'.','');
			$item .= ' @ '.$unitprice.' each';
		}
	
    $total = $total+$net;
    $rows .= '<tr><td>'.$qty.'</td><td>'.$item.'</td><td style="text-align:right;min-width:200;">'.$currency.$net.'</td></tr>';  
    
   } 
   
    $rows .= '<tr><td></td><td>Shipping</td><td style="text-align:right;">'.$currency.$_POST['mc_shipping'].'</td></tr>';
    $rows .= '<tr><td></td><td>Handling</td><td style="text-align:right;">'.$currency.$_POST['mc_handling'].'</td></tr>';
	$rows .= '<tr><td></td><td>Total</td><td style="text-align:right;">'.$currency.$_POST['mc_gross'].'</td></tr>';
		return $rows;
	}
	
function build_email ($message_type)

	{
		/* email builder
		 * build the message on type
			 * 1 = customer success
			 * 2 = site owner success
			 * 3 = new customer welcome email
			 * 4 = customer failure email
			 * 5 = site owner failure
			 * 6 = developer email
			 */
		global  $site; // required stuff could be passed to the function rather than global
		$email = new Template; //open a template object
		$date = correct_time_date ($_POST['payment_date']); 
		$headers = "MIME-Version: 1.0" . "\r\n"; // set html
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; //set html
		$from = $settings['sitename'].'<'.$settings['paypal_email'].'>';
		$headers .= "From:" . $from;
		$items= $_POST['num_cart_items'];
		$page['delivery_address'] = format_address(); //page is set on start up
		$page['logo'] = $site->settings['logo'];
		if(is_null($items)) {$items='1';} // set the item count to 1 if paypal does not return it (single item in a cart or single item payment
		switch ($message_type) {
			
			 case 1:
			// success send the customer a mail giving them instruction
			$subject = $settings['sitename']." Order - #".$_POST['txn_id'];
			$to = $_POST['payer_email'];
			$message = $lang->ipn_fail; 
			$message .= $lang->ipn_failemail;
			break; 
			
			case 2:
			// success send the site owner a mail even tho paypal does
			$subject = $settings['sitename']." Order - #".$_POST['txn_id'];
			$to = $from; //sounds odd but just send the mail to the registerd pp mail address 
			break;
		}
		 mail($to,$subject,$message, $headers);
	}

		
function format_address()
		{
			// returns delivery address
			$postuser = $_POST['address_name']; //delivery name this is different to who paid sometimes !
			$postal = $postuser."<br/>".$_POST['address_street']."<br/>".$_POST['address_city']."<br/>".$_POST['address_state']."<br/>".$_POST['address_zip']; // where the product(s) went
			$postal .= ' ('.ucfirst($_POST ['address_status']).')';
			return $postal;	
		}

function register_user ()
		{
			//global $page;
			// if new user register them
			//$nid = getnid();
			//$page['password'] = generateStrongPassword();
			//$passwordhash = md5($page['password'].SALT);
			//$newuser['nid'] = $nid;
			//$page['user_name'] = $newuser['username'] = $_POST['first_name'].'_'.$_POST['last_name'];
			//$newuser['password'] = $passwordhash;
			//$newuser['email'] = $_POST['payer_email']; 
			//$newuser['ip'] = $_POST['custom'];	
			//$newuser['regdate'] = time();
			//$database->insert ("users",$newuser);
			//build_email(3);
		}

?>
