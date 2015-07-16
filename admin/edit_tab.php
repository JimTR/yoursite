<?php
	/* 
	 * Edit_tab.php
	 * Created 01-04-2015
	 * use -  Edit the tabbed divs
	 * requires master inc
	 */
	 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
	 
		 
     require DOC_ROOT.'/includes/master.inc.php';
     if($_REQUEST){
		 //print_r($_REQUEST);// we need to pick up the area
		 //die();
		 $area = $_REQUEST['area'];
		 
	 } 
	 else {
		 $area = 0;}
     $template = new Template;
     $select_file = $page['template_path'].'admin/edit_tab_select.html'; // set the html file
     $html_file = $page['template_path'].'admin/edit_tab.html'; // set the html file
     //die ($html_file);
     $page['header'] = $template->load($page['template_path'].'header.html', COMMENT); // load header
	 $page['footer'] = $template->load($page['template_path'].'footer.tmpl', COMMENT); // load footer
	 $page['include'] = $template->load($page['template_path'].'include.tmpl', COMMENT); // load includes
	 $page['adminstats'] = '';
	 $page['title'] = 'Tab Editor';
	 $page['login'] = $template->load($page['template_path'].'admin.html', COMMENT) ;
     if($Auth->loggedIn()) 
        {
			   if (!$Auth->level === 'admin') {
			   	  redirect  ($_SERVER['HTTP_REFERER']);
			   	  
				} 
			    
        }
			   
	  else
				{
				  	redirect  ($_SERVER['HTTP_REFERER']);
				}
      if(!$_POST)
      {
		  // run  the selector
		  $sql = 'select * from categories where area = '.$area. ' and isgroup = 1 order by disp_order ASC';
		  $tabs = $database->get_results($sql);
		  $catlist= '<form action="" method="POST"><select name="cat_id" id="groupid">';
		  foreach ($tabs as $row)
				{
					//loop the tabs
					$selector .= '';
					//echo $row['cat_name'];
					$catlist .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
				}
				$catlist .='</select><input type="submit" value ="click me"></form>';
				echo $catlist;
	  }
	  
	  else 
	  {
		  // run editor
		  if (!$_POST['save'])
		  {
			  //print_r($_POST);
			  //die();
			$sql = 'select * from categories where cat_id = '.$_POST['cat_id']; 
			$tab = $database->get_row($sql);
			$page['cat_id'] = $tab['cat_id'];
			$page['cat_description']= $tab['cat_description'];
			$template->load($html_file, COMMENT); // load header
			/*echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script src="/js/ckeditor.js"></script>
            <script>$(document).ready(
            function() {
                 
                 var editor = CKEDITOR.instances.editor1;
                 editor.execCommand(\'maximize\');
                 });
                 </script>
            <form method="POST">
            <textarea class="ckeditor" style="100%;" name="reply-content" id="editor1" >'.$tab['cat_description'].'</textarea>
            <input type ="hidden" name = "cat_id" value = "'.$tab['cat_id'].'" id= "cat_id">
            <input type ="hidden" name = "save" id="save" value="save">
            
           </form>';*/
           $template->replace_vars($page);
           $template->publish(); 
               
	     }
	     else
	     {
			 echo "hit save";
			 print_r($_POST);
			 //die();
			 $update ="'".$_POST['reply-content']."'";
			 // UPDATE `categories` SET `cat_id`=[value-1],`cat_name`=[value-2],`cat_description`=[value-3],`cat_tooltip`=[value-4],`isgroup`=[value-5],`groupid`=[value-6],`area`=[value-7],`disp_order`=[value-8],`icon`=[value-9] WHERE 1
			 $sql = 'UPDATE categories SET `cat_description` = '.$update.' WHERE `cat_id` = '.$_POST['cat_id'];
			 $database->query($sql);
			 redirect($site->settings['url'].'/admin.php');
		  }
	  }
     
?>
