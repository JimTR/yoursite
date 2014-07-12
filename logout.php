<?PHP
    require 'includes/master.inc.php';
    $Auth->loginUrl = $_SERVER['HTTP_REFERER'];
    $kill = $Auth->user->columns['nid'];
    //die ("kill = ".$kill);
    //echo "<br>Return to ".$Auth->loginUrl; 
    //die();
    //die ("kill = ".$kill);
    distroy_session($kill,$database);
    $Auth->logout();
    
    
    
