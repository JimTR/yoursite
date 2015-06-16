<?php
/* editor loader
 * uses editorX.html
 * renders the user attachment text file name into the html
 * 01/06/2015
 */
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
 require DOC_ROOT.'/includes/master.inc.php'; // do login or not
 $template = new Template;
 $template->load('templates/editorx.html');
 $page['file'] = "./user".$Auth->id.".txt";
 $template->replace_vars($page);
 $template->publish();  
?>
