<?php
//category.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // do login or not
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
$per_page = $settings['per_page'];
if (isset($_GET['activetab'])) 
{
	// find out what tab to display
	$activetab = intval($_GET['activetab']);
	//echo $activetab;
}		
else {$activetab = 0;}

$i = 0;
$ul = 0;
$tab= 0;
//$per_page++;
//die($per_page);
    define ('AREA',2); // testing area grouping
    $getid = intval($_GET['id']); //stop injection 
    $template = new Template; // start the template workspace
    $page['header'] = $template->load($site->settings['template_path'].'header.html', COMMENT);
	$page['footer'] = $template->load(  $site->settings['template_path'].'footer.tmpl', COMMENT);
	$page['include'] = $template->load( $site->settings['template_path'].'include.tmpl', COMMENT);
	$page['users'] = $database->num_rows("select * from sessions");
	$page['page'] = 'pagination  will go here';
	$page['poo'] = '';
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
					$login = $template->load( $site->settings['url'].'/templates/guest.html', COMMENT) ;
					$nid = $nid = getnid();
					$level ="guest"; 
				}

	writeid ($id,$nid,$database);
			
	
	$page['login'] = $login;
	$pmnew=0; // for later
	// get the tabs
	$groupsql ="SELECT * , permissions.*
					FROM categories
					LEFT JOIN
				    permissions on permissions.pcat_id = cat_id	
					WHERE categories.isgroup <> 0
					AND categories.groupid = 0
					AND categories.area = ".AREA."
					order by disp_order asc";
// now add the tabs in 
$tabset = $database->num_rows($groupsql);
		if ($tabset < $activetab) {$activetab = 0;}
		$root = $database->get_results($groupsql);
		$tabs = new Template;
		foreach ($root as $row)
				{
					/*$priv = explode(",",$row[$level]);
					if ($priv[0] === '0')
	                 {
						 goto noview;
					} */
					$tabs->load("templates/tab.html",false); //dont show this templates remarks  
					$tab_entry['tab_id'] = $tab; 
					$tab_entry['tab_name'] = $row['cat_name']; 
					 
					if ($ul == 0 && $activetab == @$tab) //sets active tab later it will remember now does it
					{
						$tab_entry['tab_class'] = "active";
						$ul =1;
						$tab_entry['tab_title'] = "Viewing";
					 }         
					else 
					{
						$tab_entry['tab_class'] = "";
						$ul = 0;
						$tab_entry['tab_title'] = "not viewing";
					}	
						$tabs->replace_vars($tab_entry);
					    $page['tabs'].= $tabs->get_template();
					    $tab++;
					    noview:
					
				}   	
				//echo $page['tab'];
				//die();
				
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
	$page['navi']= ''.$toprow[1];
	$page['title'].= " - ".$toprow[1];
	$page['newthreads'] = '<button class="button" onclick= window.location.replace("create_topic.php?id='.$toprow[0].'")>New Thread</button>'; 
   

if(!$result)
{
	$page['rowd'] = '<tr><td>This Forum contains no threads, be the first to post one.</td></tr>'; 
	$sql ='select * from categories where cat_id = '.mysqli_real_escape_string($database->link,$getid);
	$result = $database->get_results($sql);
	$toprow = $database->get_row($sql);
	// do a worker template for the navi 14-9-14 /new sql does the whole lot ??
	$page['navi']= '<a href="index.php?activetab='.$activetab.'">Community </a> >> '.$toprow[1];
	$page['title'].= " ".$toprow[1];
	$page['newthreads'] = '<button class="button" onclick= window.location.replace("create_topic.php?id='.$toprow[0].'")>New Thread</button>'; 
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
