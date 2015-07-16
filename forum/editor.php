<?php
/* editor loader
 * uses editorX.html
 * renders the user attachment text file name into the html
 * 01/06/2015
 */
 define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
 require DOC_ROOT.'/includes/master.inc.php'; // do login or not
 $template = new Template;
 //die ($site->settings['template_path']);
 $template->load($page['template_path'].'forum/editorx.html');
 $page['file'] = "./user".$Auth->id.".txt";
 //$page['include'] = $template->load($page['template_path'].'include.tmpl', COMMENT);
 $template->replace_vars($page);
 $template->publish();  
?>
