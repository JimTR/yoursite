<?php
$file = "http://www.avatarmovie.com/assets/images/photo-1.jpg";
$DOC_ROOT = realpath(dirname(__FILE__));
echo $DOC_ROOT;
$root = __DIR__;
echo "<br>root = ".$root."<br>";

$filePath = realpath(dirname(__FILE__));
$rootPath = realpath($_SERVER['DOCUMENT_ROOT']);
$htmlPath = str_replace($root, '', $filePath);
echo "rp = ".$rootPath;
echo $htmlPath."<br>";
$fabove = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
echo "dir above = ".$fabove; 

die();
copy($file,DOC_ROOT.'/images/xx.png');
$imagesize = filesize(DOC_ROOT.'/images/xx.png');
echo "file size = ".$imagesize."<br>"; 
//$content = file_get_contents("http://example.com/image.jpg");
echo "done<br>base dir ".BASE_URL;
echo '<img src="xx.png"></img>';
?>
