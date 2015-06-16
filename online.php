<?php
/* SELECT *,(select count(*) from sessions where usertype =2) as bots, (select count(*) from sessions where usertype >100) as staff, (select count(*) from sessions where usertype >0 and usertype <100 and usertype <> 2) as users FROM `sessions`
 * this module needs to read the session table to get the most up to date info ... in fact it should be a class...?
 */ 
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
 require DOC_ROOT.'/includes/master.inc.php'; //load functions ! & db connection
 //$db = new Database;
  $sql = "SELECT *,(select count(*) from sessions where usertype =2) as bots, (select count(*) from sessions where usertype >100) as staff, (select count(*) from sessions where usertype >0 and usertype <100 and usertype <> 2) as users FROM `sessions`";
  $wol = $database->get_results($sql);
  if (!$wol) { 
	  // no one online do we include ourselves ?
	  }
  else {
	  // read the rows from the table !
	  }
?>
