<?php
  @error_reporting (E_ERROR);
  // Force reload
  header('Expires: ' . gmdate('D, d M Y H:i:s') . 'GMT');
  header('Cache-control: no-cache');
  if (!isset($_GET['mode']))
    $mode="all";
  else  
    $mode=strtolower(trim($_GET['mode']));
  if (($mode=="cart") || ($mode=="all"))
  {
    session_start();
    $_SESSION['test']="1234";
    reset($_SESSION);
    if (!empty($_SESSION))
    {
      while(list($namepair, $valuepair) = each($_SESSION))
      {
        if (substr($namepair,0,10)=="sess_cart_")
          unset($_SESSION[$namepair]);
      }
    }
    reset($_SESSION);
  }
  if (($mode=="stored") || ($mode=="all"))
  {
    setcookie('VIBRACART', '', time()-42000, '/');
  }  
  header('Content-type: image/gif');
  echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
?>