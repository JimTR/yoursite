<?PHP
    require 'includes/master.inc.php';
    //$template = new Template;
    $Auth->loginUrl = "";
    $kill = $Auth->user->columns['nid'];
    distroy_session($kill,$database);
    $Auth->logout();
    $pms="0";	
   // die ("got here");
   $name ="Guest";
$login = file_get_contents($site->settings['url'].'/templates/guest.html') ;
$users = $database->num_rows("select * from sessions");
$header = file_get_contents($site->settings['url'].'/templates/header.html');
$footer = file_get_contents ( $site->settings['url'].'/templates/footer.tmpl');
$include = file_get_contents ($site->settings['url'].'/templates/include.tmpl');
$css = $site->settings['url'].'/css/main.css';
$css ="<style>".file_get_contents ($css)."</style>";
$template = new Template;
$template->load($site->settings['url']."/templates/page.html");
$template->replace("css",$css);
$template->replace("title", "Home");
$template->replace("header", $header);
$template->replace("include", $include);
$template->replace("login",$login);
$template->replace("footer", $footer);
$template->replace("pms",$pms);
$template->replace ("path", $site->settings['url']);
$template->replace("name",$name );
$template->replace("vari",$users);
$template->replace("stuff",$stuff);
$template->replace("reload",$rjs); // fix for ie 
$template->replace("datetime", FORMAT_TIME);
if($site->settings['showphp'] === false)
{
$template->removephp();
}

$template->publish();
//$Auth->logout();

    //$include = file_get_contents ($site->settings['url'].'/templates/include.tmpl');
    //$include = str_replace("#path#",$site->settings['url'] , $include);
    $Error='You have sucessfully logged out';
    //echo  $include; 
    //echo "<body></body>";
    //$Auth->logout();
    echo '<script type="text/javascript">alertify.alert("'.$Error.'",function(e) {window.location.replace("'.$site->settings['url'].'")});</script>';
    
    
?>
