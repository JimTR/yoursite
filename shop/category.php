<?php
//category.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$per_page = $settings['per_page'];
//$per_page++;
//die($per_page);
    define ('AREA',1); // testing area grouping
    if ($site->settings['https'] == AREA)
		{
			$site->settings['url'] = preg_replace("/^http:/i", "https:", $site->settings['url']);
			//die ('setting changed to - '.$site->settings['url']);
		}	   	
    $getid = intval($_GET['id']); //stop injection 
    $template = new Template; // start the template workspace
    $page['header'] = $template->load($site->settings['template_path'].'/header.html', COMMENT); // load header
	$page['footer'] = $template->load($site->settings['template_path'].'/footer.tmpl', COMMENT);
	$page['include'] = $template->load($site->settings['template_path'].'/include.tmpl', COMMENT);
	$page['users'] = $database->num_rows("select * from sessions");
	$page['page'] = 'pagination  will go here';
	$page['poo'] = '';
	$page['path'] = $site->settings['url'];
	$activetab = $_GET['activetab'];
    if ($getid === 0) {die ("get = ".$getid);}
if($Auth->loggedIn()) 
           {
			   $level = $Auth->level;
			   $name = $Auth->username;
			   $nid = $Auth->nid;
			   if ($Auth->level === 'user') {
				  				   
			   $login = $template->load(DOC_ROOT.'/templates/member.html', COMMENT);
		   }
		   elseif ($Auth->level === 'admin') {
			   $login = $template->load(DOC_ROOT.'/templates/admin.html', COMMENT) ;
			   
		   }
			  
			   
			    
			   }
			   
	else
				{
					$name ="Guest";
					$login = $template->load( DOC_ROOT.'/templates/guest.html', COMMENT) ;
					$nid = $nid = getnid();
					$level ="guest"; 
				}

	writeid ($id,$nid,$database);
			
	
	$page['login'] = $login;
	$pmnew=0; // for later
// loop in the tabs ?
 
//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description,
			topics.topic_date,
			topics.topic_subject,
			topics.topic_id,
			posts.post_date,
			permissions.*,
			topics.topic_views,
			(SELECT posts.post_date FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_Action,
			COUNT( posts.post_id ) AS totalp,
			(SELECT posts.post_by FROM posts WHERE posts.post_topic = topics.topic_id ORDER BY posts.post_date DESC limit 1) AS Latest_User,
			(SELECT users.username FROM users WHERE users.id = Latest_User ORDER BY users.id DESC limit 1) as Last_Username  
		FROM
			categories
		LEFT JOIN 
			topics ON topics.topic_cat = cat_id
		JOIN 
			posts on topics.topic_id = posts.post_topic
		JOIN
		    permissions on permissions.pcat_id = cat_id				
		WHERE
			cat_id = " . mysqli_real_escape_string($database->link,$getid).
			" 
		AND area = ".AREA." 	
		GROUP BY 
			topics.topic_subject 
		ORDER BY 
			Latest_Action DESC"
			;
		

	$result = $database->get_results($sql);
	$toprow = $database->get_row($sql);
	$rowstuff = $database->num_rows($sql);
	//echo $rowstuff."<br>";
	$priv = explode(",",$toprow[$level]);
	// do a worker template for the navi 14-9-14 /new sql does the whole lot
	$page['navi']= '<a href="index.php?activetab='.$activetab.'">Shop</a> >> '.$toprow[1];
	$page['title'].= " - ".$toprow[1];
	
	
	if ($Auth->level === 'admin') {
	$page['newthreads'] = '<button class="button" onclick= window.location.replace("create_topic.php?id='.$getid.'")>Add New Item</button>'; 
   }
   else {$page['newthreads'] = '';}

if(!$result)
{
	$page['rowd'] = '<tr><td>This area contains no items.</td></tr>'; 
	$sql ='select * from categories where cat_id = '.mysqli_real_escape_string($database->link,$getid);
	$result = $database->get_results($sql);
	$toprow = $database->get_row($sql);
	// do a worker template for the navi 14-9-14 /new sql does the whole lot ??
	$page['navi']= '<a href="index.php?activetab='.$activetab.'">Shop </a> >> '.$toprow[1];
	$page['title'].= " ".$toprow[1];
	//$page['newthreads'] = '<button class="button" onclick= window.location.replace("create_topic.php?id='.$toprow[0].'")>New Thread</button>'; 
}
 

else
{
			//display category data
		$pageno++;
		if ($rowstuff > $per_page)
		{
		$page['rowd'].= '<div id ="'.$pageno.'" class="cell pag">';
		$page['poo'].= '<li class ="dummy" href="#p'.$pageno.'"><a href="#'.$pageno.'">'.$pageno.'</a></li>';
		}
		else
		{
			$page['rowd'].= '<div id ="'.$pageno.'" class="cell pag">';
			$page['poo']="";
		}	 
		$subtemplate = new Template;
		$pagegroup = 0;
		$pg = 1;
		foreach ($result as $row)
		{
				
					// lets get the stats
					//run a template ! to do pagination
					//run worker template to add pagination
					$pagegroup++; // set the page thingy
					//do function here to paginate within the $page array
					$subtemplate->load("templates/testit.html",COMMENT);
					
				    //$pg = $pagegroup % $per_page; // check page length
				    //echo $pg."<br>";
				    if ($pg <> 0 ) { 
						//$sub['id'] = $pageno;
						$sub['activetab'] = $activetab;
						$sub['topic_id'] = $row['topic_id'];
						$sub['topic_subject'] = $row['topic_subject'];
						$sub['stats'] = $row['totalp'];
						$sub['replies'] = $row['topic_views'];
					    $sub['username']  = $row['Last_Username'];
					    $sub['last_time'] =  time2str($row['Latest_Action']);
					    $subtemplate->replace_vars($sub);
					    $page['rowd'] .= $subtemplate->get_template(); //add the row
				    
				    }
				   else {
					   $pageno++;
					    $page['rowd'] .= '</div><div id ="'.$pageno.'" class ="cell hidden-tab pag">'; 
					    $page['poo'].= '<li class="dummy" href = "#p'.$pageno.'"><a href="#'.$pageno.'">'.$pageno.'</a></li>';
					   //$sub['id'] = $pageno;
						$sub['activetab'] = $activetab;
						$sub['topic_id'] = $row['topic_id'];
						$sub['topic_subject'] = $row['topic_subject'];
						$sub['stats'] = $row['totalp'];
						$sub['replies'] = $row['topic_views'];
					    $sub['username']  = $row['Last_Username'];
					    $sub['last_time'] =  time2str($row['Latest_Action']);
					    $subtemplate->replace_vars($sub);
					    $page['rowd'] .= $subtemplate->get_template(); //add the row
					   //$page['rowd'] .= "<div>next page</div>";
					   //echo " in page ".$pageno."<br>";
					   //add the sub template here
				   }
				   //$pagegroup++;
				   $pg = $pagegroup % $per_page; // check page length
			}
		$page['rowd'] .= "</div></div>";
	}
 
// do main template

$template->load("templates/category.html", COMMENT);
$page['query'] = $database->total_queries();
	  
	//echo 'There were '. $database->total_queries() . ' queries performed';
     
     if (@$Auth->level === 'admin')
    { 
		$linecount = filelength($_SERVER['SCRIPT_FILENAME']);
     $test =page_stats($linecount,$page['query'],$start);
     $page['adminstats']= "Page generated in ".$test['time']." seconds. &nbsp;
     PHP ".$test['php']."%  &nbsp;SQL ".$test['sql']."% &nbsp; 
     SQL Queries  ". $test['query'];
    
	}
	else { $page['adminstats'] = ""; }
	
$template->replace_vars($page);

if($site->settings['showphp'] === false)
{
$template->removephp();
}
$template->publish();
?>
