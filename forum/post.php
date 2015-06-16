<?php
//create_cat.php
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
//
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
include 'connect.php';
include 'header.php';

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = $database->get_results($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if($database->num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.id,
						users.username
						//users.user_level
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = $database->get_results($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					$id =++ $id;
					if ($posts_row['user_level'] == 0){$level="Member"; } else {$level="Admin";}
					echo '<table border="1"><tr border="0" style="background-color:#00adff">
							<td style="width:30%;border:0px">'.date('d-m-Y H:i', strtotime($posts_row['post_date'])).'</td><td style="float:right;border:0px">Post Id #'.$id.'</td></tr><tr>
							<td class="user-post" style="width:30%;border:0px">' . $posts_row['user_name'] . '<br>'.$level.'</td><td style="float:right;border:0px">' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td></tr>
							<tr><td colspan="2" class="post-content">' . html_entity_decode(stripslashes($posts_row['post_content'])) . '</td>
						  </tr>
						  <tr><td colspan="2">butttons go here</td></tr>
						  </table><br>';
				}
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

include 'footer.php';
?>
