<?php
//topic.php
define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
require DOC_ROOT.'/includes/master.inc.php'; // load connection & user functions
$template = new Template;
	$page['header'] = $template->load($site->settings['url'].'/templates/header.html', COMMENT); // load header
	$page['footer'] = $template->load($site->settings['url'].'/templates/footer.tmpl', COMMENT);
	$page['include'] = $template->load($site->settings['url'].'/templates/include.tmpl', COMMENT);
	if ($_POST) {
echo '<img src="/vibracart/clearcart.php?mode=all" width="1" height="1"/>';	
ksort($_POST);
$test = printr($_POST,1);
echo $test;
}
else {
	echo 'the payment has been cancelled';
}

?>
