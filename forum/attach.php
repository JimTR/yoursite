<?php
// attach.php V1.1 
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // get all the stuff required
$dirname = "attachments/user".$Auth->id;
$filename = DOC_ROOT."/forum/user".$Auth->id.".txt";
$attchfile= "user".$Auth->id.".txt";
if(!file_exists ($dirname )) {
	//echo "no folder ".$dirname;
	mkdir($dirname, 0777);
	}
//printr($_POST);
//die ('running');
//echo $_FILES['attach']['name'];
//$files = filelength($filename); 
$handle = fopen($filename, "r");
if ($handle) {
	$stack = array();
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        
        $page['attachments'] .= $line."<br>";
        array_push($stack, $line);
        $i++;
    }
       //printr($stack);    
       fclose($handle);
       //die();
   }	
	if (isset($_POST['btnattach'])) 
	{
	
	 $target_dir = $dirname."/";
	 $base_filename = basename($_FILES["attach"]["name"]);
     $target_file = $target_dir . basename($_FILES["attach"]["name"]);
    //die ($filename);
    if ($base_filename === '') {
		echo '<script>alertify.success("File Error");</script>';
		goto done;
	}
	if (file_exists($target_file)) {
    echo "file already exists, added to list";
     $msg = "file already exists. attached ";
     goto attachto;
    }
     //echo $target_file;
     
     if (move_uploaded_file($_FILES["attach"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["attach"]["name"]). " has been uploaded.";
    } 
       else {
             echo "Sorry, there was an error uploading your file.";
          }
 attachto :         
      log_to ($filename,$_FILES['attach']['name']);
      chmod($filename, 0666);
	 $page['attachments'] .= $_FILES['attach']['name']."<br>";
     $i++;
 }
 

  elseif (isset($_POST['btnclear']))
  {
	  //clear
	  //echo "clear";
	  $old = getcwd(); // Save the current directory
	  //echo $old;
	  //echo "<br>".$dirname."<br>";
	  
      chdir(DOC_ROOT."/forum/".$dirname);
      //echo getcwd();
      //die();
      // 
      foreach ($stack as &$value) {
         //echo $value;
         $pos = strrpos($value, "\r\n");
        // echo "pos = ".$pos."<br>";
         $value = substr($value,0,$pos);   
         unlink($value);
         clearstatcache(); 
	}
	  //die();
      chdir($old); // Restore the old working directory
      unlink($attchfile);
      clearstatcache(); 
      file_put_contents($attchfile, $current);    
	   //$page['attachments']="cleared them";
	   $i = 0;
	 
  }

 /*else {
    // error opening the file.
    //echo "could not open<br>";
    $handle = fopen($filename, "r");
    fopen($filename, "w") or die("Unable to open file!");
    fclose($handle);
} */

done :
//echo "below limit files = ".$i."<br>";
//die ("i is equal to ".$i);
$template = new Template;
if ($i == 0) {
$page['attachments'] = "No Attachments";
$i === 0;
}
elseif ($i >= 2) {
	//$page['attachments'] = $_POST['attach'];
	//echo "we are full";
	$page['attrib'] = "disabled";
}

$page['include'] = $template->load($site->settings['template_path'].'include.tmpl', COMMENT);
$template->load($site->settings['template_path'].'forum/attach.html',COMMENT);
$page['total'] = $i;
$template->replace_vars($page);
$template->publish();
 
?>
