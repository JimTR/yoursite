<?php
  
 define('IN_MYBB', 1);
 define('THIS_SCRIPT', 'st.php');
require_once "global.php";
require_once MYBB_ROOT."inc/functions_post.php";
require_once MYBB_ROOT."inc/functions_user.php";
require_once MYBB_ROOT."inc/class_parser.php";
require_once 'sc.php';
$parser = new postParser;
 global $mybb,$db,$cache,$header,$headerinclude,$footer;
 if(isset($_POST['submitMe'])) {
	 	 //echo "email address = ". $_POST["email"];
	 	 //echo "hidden entry = ". $_POST["steamid"];
	 	 $update_array = array(
     'email' => $_POST["email"]
     );
     $db->update_query("users", $update_array, "steamid = '".$_POST["steamid"]."'");
     $query = $db->query("SELECT * FROM ".TABLE_PREFIX."users u WHERE u.steamid ='".$_POST["steamid"]."'"); //steamid verify 
     $user = $db->fetch_array($query); // get user record
     require_once MYBB_ROOT."inc/datahandlers/pm.php";
		$pmhandler = new PMDataHandler();
		$pmhandler->admin_override = true;
		$message = 'Welcome to the forum and thank you for loging via steam. if you wish to login without steam the following password has been created [b]'. $_POST["pass"].'[/b]  ';
		$pm = array(
			"subject" => 'Forum Password',
			"message" => $message,
			"icon" => "-1",
			"toid" => array($user['uid']),
			"fromid" => 1,
			"do" => '',
			"pmid" => ''
		);
		$pm['options'] = array(
			"signature" => "0",
			"disablesmilies" => "0",
			"savecopy" => "0",
			"readreceipt" => "0"
		);
	
		$pmhandler->set_data($pm);
				
		if(!$pmhandler->validate_pm())
		{
			// There some problem sending the PM
		}
		else
		{
			$pminfo = $pmhandler->insert_pm();
		}
     my_setcookie("mybbuser", $user['uid']."_".$user['loginkey'], $remember, true);
	 my_setcookie("sid", $session->sid, -1, true); // login done
	 redirect("usercp.php", $lang->redirect_loggedin); // trundle into the user cp 
	 die();
	 }
$steam_login_verify = SteamSignIn::validate();
if(!empty($steam_login_verify))
{ 
// check table
if(!$db->field_exists('steamid', "users"))
	{
			// add the column
			$db->query("ALTER TABLE `".TABLE_PREFIX."users` ADD `steamid` bigint");
	}
mybblogin ($steam_login_verify); // mybb routine
}
else
{
	add_breadcrumb('Steam Login');
$steam_sign_in_url = SteamSignIn::genUrl();
$template = '<head>'.$headerinclude.'</head>'.$header;
$template .= '<table class="trow1" width="100%"><tr><td class="thead">Login via steam</td></tr><tr><td>';
$template .= '<h2 class="trow1"><center> Steam login allows you to link your Steam account to your Light Sound Studios forum account.</center></h2>'; 
$template .= '<center>If you are a new forum member, please record your forum password. This will allow you to access your forum account directly rather than using the steam option.</center></td></tr>';
$template .= "<tr><td><center><br /><a class=\"button\" href=\"$steam_sign_in_url\">Login Via Steam</a></center><br /> ";
$template .= '</td></tr></table>'.$footer;
echo $template;
 // use html to produce the steam options


}



function mybblogin ($steam_login_verify)
{
		global $mybb,$db,$session,$cache,$lang,$headerinclude,$header,$footer; // global variable shit
		$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=91313FE1EEF89AD8E5ED16ADBD51DF93&steamids=".$steam_login_verify."&format=xml";
		$xml = simplexml_load_file($url); // get steam info
		$user = (string) $xml->players->player->personaname; // got the username check if in the db
		$steamid = (string) $xml->players->player->steamid; // make sure this is the correct user
		$query = $db->query("SELECT * FROM ".TABLE_PREFIX."users u WHERE u.steamid ='".$steamid."'"); //steamid verify 
        $num_rows = $db->num_rows($query); // we have ,the amount of rows
        if ($num_rows == 1)
			{
				// we have a match do the login
				 $user = $db->fetch_array($query); // get user record
				 if ($user['email'] <>  "")
				 { 
		         my_setcookie("mybbuser", $user['uid']."_".$user['loginkey'], $remember, true);
		         my_setcookie("sid", $session->sid, -1, true); // login done
		         redirect("index.php", $lang->redirect_loggedin); // trundle into the forum
				 }
			 else
				{
					// build error
				 $errorstring = '<center><b>Your user account '.$user['username'].' was incorrectly setup!</b></center><br>';
				 $errorstring .= ' <center>Log in to the forum, ';
				 $errorstring .= ' access your user control panel, and update your account with a valid email address. </b><br />';
				 $errorstring .= '<br /><b>If you have problems,</b><br>';
				 $errorstring .= 'please contact Light Sound Studios Forum Staff for assistance.';
				 				 
				 error($errorstring);
					
				}
			}	
        else {
			
			//echo $user."<br>"; u.username='".$user."'
			$query = $db->query("SELECT * FROM ".TABLE_PREFIX."users u WHERE u.username ='".$user."'"); // does this name have a forum account 
			$num_rows = $db->num_rows($query); // we have ,the amount of rows
			if ($num_rows == 1)
			{
				// we have a user match but no steamid error out  
				 $user = $db->fetch_array($query); // get user record just in case we need it
				 //76561198112017378
				 // build the error
				 $errorstring = '<center><b>The user name '.$user['username'].' is currently registered on Light Sound Studios</b></center><br>';
				 $errorstring .= ' <center>If this is your forum user name, log in to the forum directly,';
				 $errorstring .= ' and access your user control panel and update your Steam ID on the edit profile page with <b>'.$steamid.'</b><br />';
				 $errorstring .= '<br /><b>If you are a new user to the forums:</b><br>';
				 $errorstring .= 'Register on the forums. After registration, access your user control panel and update your Steam ID on the edit profile page with ';
				 $errorstring .= '<b>'.$steamid.'</b><br> After you have done this, you will be able to login to Light Sound Studios via Steam.<br>';
				 $errorstring .= 'However, you will have to use a different user name.</center>';  
				 
				 error($errorstring);
		         
		      }
		      else{	
				  // make a new user
			$usergroup = 2;
			$pass1 = random_str();
		    $pass2 = $pass1;
		    $md5pass = md5($pass1);
		    //echo $pass1;
		
    $salt= generate_salt();   
    $key = generate_loginkey(); //login key
    $email=""; // to do add email address for forum use
	$saltp=salt_password($md5pass, $salt); // salt the password .... steady not too much :)
	$now= time(); // add the reg time add as first online 
	$avatar = (string) $xml->players->player->avatarmedium; //set steam avatar
	// Set the data for the new user.
	
	$user = array(
	    "uid" => NULL, 
		"username" => $user,   // add steam screen name
		"password" => $saltp,
		"salt" => $salt,
		"loginkey" => $key,
		"email" => "",
		"postnum" => 1,
		"avatar" => $avatar,
		"avatardimensions" => "64|64",
		"avatartype" => "remote",
		"usergroup" => 2,
		"usertitle" => "Steam Player",
		"regdate" => $now,
		"lastactive" => $now,
		"lastvisit" => $now,
		"icq" => 0,
		"allownotices" => 1,
		"subscriptionmethod" => 2,
		"receivepms" => 1,
		"pmnotify" => 1,
		"pmnotice" => 1,  
		"threadmode" => "linear",
		"showsigs" => 1,
		"showavatars" => 1,
		"showquickreply" => 1,
		"showredirect" => 1,
		//"style" => 3, miss this leave as default
		"steamid" => $steamid,
		
	);
	
	 
	$db->insert_query("users", $user); // put the user in
	$cache->update_stats(); // rebuild stats to show new user 
	$query = $db->query("SELECT * FROM ".TABLE_PREFIX."users u WHERE u.steamid ='".$steamid."'"); // pull in the steam id
		$user = $db->fetch_array($query); // get user record
		         
		         //
		         $template = '<head>'.$headerinclude.'<script>function validateForm()
{
var x=document.forms["steamForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
}</script></head>'.$header;
$template .= '<table class="trow1"><tr><td class="thead">Succesfull Login via steam</td></tr ><tr><td>';
$template .= '<h2 class="trow1"><center> Congratulations! You have linked your Steam ID to your Light Sound Studios forum account!</center></h2>'; 
$template .= '<center>Please record your forum password: <b>'.$pass1.'</b><br> This will allow you to access your forum account directly rather than using the Steam option.</center></td></tr>';
$template .= "<tr><td><center>A personal message has been sent to you containing your forum password</center>";
$template .= "<tr><td><br />To enable forum functionality you must supply an email address.";
$template .= '<form name="steamForm" action="st.php" onsubmit="return validateForm();" method="post">
Email: <input type="text" size="35" name="email">
<input type="hidden" name="steamid" value="'.$user['steamid'].'">
<input type="hidden" name="pass" value="'.$pass1.'">
<input type="submit" value="Submit" name="submitMe">
</form>';
$template .= '</td></tr></table>'.$footer;
echo $template;
		         
		   }      
addemail:
			
				// do the email bit
				
				
	die ();
	      // think about this bit
			//$emailsubject = $lang->sprintf($lang->emailsubject_randompassword, $mybb->settings['bbname']);
			
			//my_mail($user_info['email'], $emailsubject, $emailmessage);

		}
		
}
?>
