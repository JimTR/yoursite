<?php
echo'
<style>::-webkit-datetime-edit { padding: 1em; }
::-webkit-datetime-edit-fields-wrapper { background: silver; }
::-webkit-datetime-edit-text { color: red; padding: 0 0.3em; }
::-webkit-datetime-edit-month-field { color: blue; }
::-webkit-datetime-edit-day-field { color: green; }
::-webkit-datetime-edit-year-field { color: purple; }
::-webkit-inner-spin-button { display: none; }
::-webkit-calendar-picker-indicator { background: orange; } </style>';
$jim = time();
$gmtime = (int)gmdate('U');
echo 'stamp is '.$jim.'<br>';
//die();
 if (!$_POST)
 {
    $item = $_GET['item'];
    $qty = $_GET['qty'];
    $net = '1.00';
    
    $currency ='&euro;';
    $currency ='£';
    if ($currency === '£'){$currency ='&pound';}
    //$currency = '$';
    print_r ($_GET);
    define ('SALT','random text');
	/*$date = '23:02:35 Mar 19, 2015 PDT' ;
    $sd = new DateTime(); //get the server time
    $tz = $sd->getTimeZone(); // get the server time zone 
    $sz = $tz->getName(); // get the time zone name
    $pd = date_parse_from_format('H:i:s M d, Y', $date); // get the date from the string
    $paypal_time = $pd['year'].'-'.$pd['month'].'-'.$pd['day'].' '.str_pad($pd['hour'],2,"0",STR_PAD_LEFT).':'.str_pad($pd['minute'],2,"0",STR_PAD_LEFT).':'.str_pad($pd['second'],2,"0",STR_PAD_LEFT);
    echo $paypal_time.'<br>';
    $pp = new DateTime($paypal_time, new DateTimeZone("America/Los_Angeles"));
    echo 'the pp datetime object = ';
    print_r($pp);
	$pp->setTimeZone(new DateTimeZone($sz));
	$date = $pp->format('d-m-Y H:i:s');
	echo '<br>Translated date '.$date.'<br>';
	print_r($pp);
	echo '<br>server time zone = '.$sz;
	//echo $tz->getName();
	*/ 
	
	if ($qty > 1){
			// add text
			$item .= ' @ '.$currency.$net.' each';
			//echo $item;
		}
	echo ' Item is '.$item .' you orderd '.$qty. ' of the fuckers<br>' ;
	echo generateRandomString(40).'<br>';
	$np = generateStrongPassword(40).'<br>';
	echo $np;
	$a = $password = md5(generateStrongPassword().SALT);
	echo $password;
	echo '<br>'.$a.'<br>';
	echo date('I');
	echo '<form action="" method="post">
	  <input name="id[]" type="text" value="i"\>
     <input name="id[]" type="text" value="f"\>
     <input name="id[]" type="text" value="jim"\>
     <input name="date" type="date"  value=""/>
     <input type = "submit" value="press me" \>
     </form>';
	$ippack = ip2long($_SERVER['HTTP_X_REAL_IP']);
    echo '<br> packed Ip = '.$ippack;
    echo '<br> Decoded to = '.long2ip($ippack);
}
else {
	//
	echo 'we got here<br>';
	$id = implode(',',$_POST['id']);
    //echo $id.'<br>';
    print_r($_POST);
    $ippack = ip2long($_SERVER['HTTP_X_REAL_IP']);
    echo '<br> packed Ip = '.$ippack;
    print_r($_SERVER).long2ip($ippack);

}
function generateRandomString($length = 10) 
		{
			$characters = '_@#%0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) 
			{
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
    return $randomString;
}		

 function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
        {
            $sets = array();
            if(strpos($available_sets, 'l') !== false)
                $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            if(strpos($available_sets, 'u') !== false)
                $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
            if(strpos($available_sets, 'd') !== false)
                $sets[] = '23456789';
            if(strpos($available_sets, 's') !== false)
                $sets[] = '!@#$%&*?';

            $all = '';
            $password = '';
            foreach($sets as $set)
            {
                $password .= $set[array_rand(str_split($set))];
                $all .= $set;
            }

            $all = str_split($all);
            for($i = 0; $i < $length - count($sets); $i++)
                $password .= $all[array_rand($all)];

            $password = str_shuffle($password);

            if(!$add_dashes)
                return $password;

            $dash_len = floor(sqrt($length));
            $dash_str = '';
            while(strlen($password) > $dash_len)
            {
                $dash_str .= substr($password, 0, $dash_len) . '-';
                $password = substr($password, $dash_len);
            }
            $dash_str .= $password;
            return $dash_str;
        }
?>
