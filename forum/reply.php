<?php
//create_cat.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
//include 'connect.php';
//include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$Auth->loggedIn())
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		//a real user posted a real reply
		$ip = getip();
		$reply= htmlentities( $_POST['reply-content'], ENT_QUOTES, "UTF-8");
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_ip,
						  post_by) 
				VALUES ('" .$reply. "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						'".$ip."',
						" . $Auth->id . ")";
						echo $sql;
		$result = $database->query($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			redirect('topic.php?id=' . htmlentities($_GET['id']));
			//echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
		}
	}
}

//include 'footer.php';
?>
