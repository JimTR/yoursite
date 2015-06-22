<?php
/*reply.php v1
 * this version has no error reporting
 */ 

define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
 //printr($_POST);
//die ();
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
		//a real user posted a real reply take into account permissions
		$sql = "select * from permissions where cat_id = ".$pid;
		$ip = getip();
		$reply = $database->escape(htmlentities($_POST['reply-content']));
		$time_stamp = time();
		$pid = $database->escape($_POST['topic_id']);
		$sql = "select * from permissions where cat_id = ".$pid; //get permissions
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_stamp,
						  post_topic,
						  post_ip,
						  post_by) 
				VALUES ('" .$reply. "',
						NOW(),"
						. $time_stamp.",
						" . $pid . ",
						'".$ip."',
						" . $Auth->id . ")";
						
		$result = $database->query($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			echo '<head>
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
			<script>
			 $(document).ready(
                               function()
                                
                                { 
                                var stat = parent.$("#message");
                                stat.attr("fred","1");
                                //alert("set attr");
                                stat.html("message saved");
                                alert(stat.attr("fred"));
                                parent.$.colorbox.close();
							});
                                </script></head>
                                ';
			//redirect('topic.php?id=' . htmlentities($_POST['topic_id']));
			
		}
	}
}


?>
