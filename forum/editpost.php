<?php
/*
 * editpost.php
 * 
 * Copyright 2014 Jim Richardson <jim@noideersoftware.co.uk>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // required
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
//echo $_SERVER['HTTP_REFERER'];
printr($_GET);
$page['return'] = $_SERVER['HTTP_REFERER'];
if (isset($_POST['post_content'])) {goto postdata;}
  $template = new Template;
  $getid = intval($_GET['pid']);
  //$page = array();
  $page['editor_opts'] = "<script>CKEDITOR.replace( 'editor1', {uiColor: '#2D3538', height: '600px', removePlugins: 'elementspath',toolbar: [
					[ 'Bold', 'Italic','Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat', '-', 'NumberedList', 'BulletedList' ],
					[ 'FontSize', 'TextColor', 'Scayt' ], ['JustifyLeft', 'JustifyCenter', 'JustifyRight' ], ['CodeSnippet', 'Blockquote', 'Link', 'Image','Smiley','oembed','Youtube'],['TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher','Menu'] 
				]
			});</script>"; 
  if (empty ($_SERVER['HTTP_REFERER'])) {
	  //redirect($site->settings['url']."/error.php?action=201"); // naughty bots or users get returned to the error page
	 }
  if ($getid === 0) {
	  redirect($site->settings['url']."/error.php?action=202"); // this internal error
     }
     
    $page['header'] = $template->load('templates/header.html', COMMENT); //load header template
    $page['include'] = $template->load ($site->settings['url'].'/templates/include.tmpl',COMMENT); // load includes
	$page['footer'] = $template->load ( $site->settings['url'].'/templates/footer.tmpl', COMMENT); //load footer
	$page['title'] = "Edit a Post";
	$page['adminstats'] = "";
	$page['datetime'] = FORMAT_TIME;
	$page['path'] = $site->settings['url'];
	$page['id'] = $getid;
	$sql = "SELECT * FROM posts WHERE post_id = '".$getid."'";   
	$root = $database->get_results($sql);
	$page['edit_text'] = $root[0]['post_content'];
	$page['returnid'] = $root[0]['post_topic'];
	//print_r ($page);
	//printr($root);
	//die();
	$template->load ("templates/edit_post.html", COMMENT);
	
	$template->replace_vars($page);
	$adminstats= "Page generated in ".$test['time']." seconds. &nbsp;
     PHP ".$test['php']."% SQL ".$test['sql']."% 
     SQL Queries  ". $test['query']; 
      
     if ($Auth->level === 'admin')
    { 
		$template->replace("adminstats", $adminstats);
	}
	else { $template->replace("adminstats", ""); }	    
     $template->replace("adminstats", $adminstats);    
	$template->publish();
	//printr ($root);
	die(); 
		  
	postdata:
	
	//post the data then return to the orginal thread
	//printr($_POST);
	//die();
	$sql = "update posts set post_content ='".htmlspecialchars($_POST['post_content'])."' where post_id ='".$_POST['id']."'";
	$database->query($sql);
	//echo $sql.'<br>'; 
	$url = "topic.php?id=".$_POST['returnid'];
	//echo $url;
	redirect ($url);
?>
