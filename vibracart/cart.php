<?php
// **************************************************************************************************
// Vibracart Paypal V2.1
// Copyright (c) 2010-2014 Vibralogix
// www.vibralogix.com
// sales@vibralogix.com
// You are licensed to use this product on one domain and with one Paypal account only.
// Please contact us for extra licenses if required.
// **************************************************************************************************
  @error_reporting (E_ERROR);
  // Force reload
  header('Expires: ' . gmdate('D, d M Y H:i:s') . 'GMT');
  header('Cache-control: no-cache');
  
  // Setup currencies
  
  $currencyDetails['']['prefix']="";
  $currencyDetails['']['suffix']="";
  $currencyDetails['']['code']="";
  $currencyDetails['']['decimals']=2;
  $currencyDetails['']['fraction']=".";
  $currencyDetails['']['thousands']="";
  
  $currencyDetails['USD']['prefix']="$";
  $currencyDetails['USD']['suffix']="";
  $currencyDetails['USD']['code']="USD";
  $currencyDetails['USD']['decimals']=2;
  $currencyDetails['USD']['fraction']=".";
  $currencyDetails['USD']['thousands']="";

  $currencyDetails['GBP']['prefix']="&pound;";
  $currencyDetails['GBP']['suffix']="";
  $currencyDetails['GBP']['code']="GBP";
  $currencyDetails['GBP']['decimals']=2;
  $currencyDetails['GBP']['fraction']=".";
  $currencyDetails['GBP']['thousands']="";

  $currencyDetails['EUR']['prefix']="&euro;";
  $currencyDetails['EUR']['suffix']="";
  $currencyDetails['EUR']['code']="EUR";
  $currencyDetails['EUR']['decimals']=2;
  $currencyDetails['EUR']['fraction']=".";
  $currencyDetails['EUR']['thousands']="";

  $currencyDetails['CAD']['prefix']="C$";
  $currencyDetails['CAD']['suffix']="";
  $currencyDetails['CAD']['code']="CAD";
  $currencyDetails['CAD']['decimals']=2;
  $currencyDetails['CAD']['fraction']=".";
  $currencyDetails['CAD']['thousands']="";

  $currencyDetails['AUD']['prefix']="A$";
  $currencyDetails['AUD']['suffix']="";
  $currencyDetails['AUD']['code']="AUD";
  $currencyDetails['AUD']['decimals']=2;
  $currencyDetails['AUD']['fraction']=".";
  $currencyDetails['AUD']['thousands']="";

  $currencyDetails['JPY']['prefix']="&yen;";
  $currencyDetails['JPY']['suffix']="";
  $currencyDetails['JPY']['code']="JPY";
  $currencyDetails['JPY']['decimals']=0;
  $currencyDetails['JPY']['fraction']="";
  $currencyDetails['JPY']['thousands']=",";

  $currencyDetails['NZD']['prefix']="NZ$";
  $currencyDetails['NZD']['suffix']="";
  $currencyDetails['NZD']['code']="NZD";
  $currencyDetails['NZD']['decimals']=2;
  $currencyDetails['NZD']['fraction']=".";
  $currencyDetails['NZD']['thousands']="";
  
  $currencyDetails['CHF']['prefix']="CHF";
  $currencyDetails['CHF']['suffix']="";
  $currencyDetails['CHF']['code']="CHF";
  $currencyDetails['CHF']['decimals']=2;
  $currencyDetails['CHF']['fraction']=".";
  $currencyDetails['CHF']['thousands']="";

  $currencyDetails['HKD']['prefix']="HK$";
  $currencyDetails['HKD']['suffix']="";
  $currencyDetails['HKD']['code']="HKD";
  $currencyDetails['HKD']['decimals']=2;
  $currencyDetails['HKD']['fraction']=".";
  $currencyDetails['HKD']['thousands']="";

  $currencyDetails['SGD']['prefix']="SG$";
  $currencyDetails['SGD']['suffix']="";
  $currencyDetails['SGD']['code']="SGD";
  $currencyDetails['SGD']['decimals']=2;
  $currencyDetails['SGD']['fraction']=".";
  $currencyDetails['SGD']['thousands']="";

  $currencyDetails['SEK']['prefix']="SEK";
  $currencyDetails['SEK']['suffix']="";
  $currencyDetails['SEK']['code']="SEK";
  $currencyDetails['SEK']['decimals']=2;
  $currencyDetails['SEK']['fraction']=".";
  $currencyDetails['SEK']['thousands']="";

  $currencyDetails['DKK']['prefix']="DKK";
  $currencyDetails['DKK']['suffix']="";
  $currencyDetails['DKK']['code']="DKK";
  $currencyDetails['DKK']['decimals']=2;
  $currencyDetails['DKK']['fraction']=".";
  $currencyDetails['DKK']['thousands']="";

  $currencyDetails['PLN']['prefix']="PLN";
  $currencyDetails['PLN']['suffix']="";
  $currencyDetails['PLN']['code']="PLN";
  $currencyDetails['PLN']['decimals']=2;
  $currencyDetails['PLN']['fraction']=".";
  $currencyDetails['PLN']['thousands']="";

  $currencyDetails['NOK']['prefix']="NOK";
  $currencyDetails['NOK']['suffix']="";
  $currencyDetails['NOK']['code']="NOK";
  $currencyDetails['NOK']['decimals']=2;
  $currencyDetails['NOK']['fraction']=".";
  $currencyDetails['NOK']['thousands']="";

  $currencyDetails['HUF']['prefix']="HUF";
  $currencyDetails['HUF']['suffix']="";
  $currencyDetails['HUF']['code']="HUF";
  $currencyDetails['HUF']['decimals']=2;
  $currencyDetails['HUF']['fraction']=".";
  $currencyDetails['HUF']['thousands']="";

  $currencyDetails['CZK']['prefix']="CZK";
  $currencyDetails['CZK']['suffix']="";
  $currencyDetails['CZK']['code']="CZK";
  $currencyDetails['CZK']['decimals']=2;
  $currencyDetails['CZK']['fraction']=".";
  $currencyDetails['CZK']['thousands']="";

  $currencyDetails['ILS']['prefix']="ILS";
  $currencyDetails['ILS']['suffix']="";
  $currencyDetails['ILS']['code']="ILS";
  $currencyDetails['ILS']['decimals']=2;
  $currencyDetails['ILS']['fraction']=".";
  $currencyDetails['ILS']['thousands']="";

  $currencyDetails['MXN']['prefix']="MXN";
  $currencyDetails['MXN']['suffix']="";
  $currencyDetails['MXN']['code']="MXN";
  $currencyDetails['MXN']['decimals']=2;
  $currencyDetails['MXN']['fraction']=".";
  $currencyDetails['MXN']['thousands']="";

  $currencyDetails['BRL']['prefix']="BRL";
  $currencyDetails['BRL']['suffix']="";
  $currencyDetails['BRL']['code']="BRL";
  $currencyDetails['BRL']['decimals']=2;
  $currencyDetails['BRL']['fraction']=".";
  $currencyDetails['BRL']['thousands']="";

  $currencyDetails['MYR']['prefix']="MYR";
  $currencyDetails['MYR']['suffix']="";
  $currencyDetails['MYR']['code']="MYR";
  $currencyDetails['MYR']['decimals']=2;
  $currencyDetails['MYR']['fraction']=".";
  $currencyDetails['MYR']['thousands']="";

  $currencyDetails['PHP']['prefix']="PHP";
  $currencyDetails['PHP']['suffix']="";
  $currencyDetails['PHP']['code']="PHP";
  $currencyDetails['PHP']['decimals']=2;
  $currencyDetails['PHP']['fraction']=".";
  $currencyDetails['PHP']['thousands']="";

  $currencyDetails['TWD']['prefix']="TW$";
  $currencyDetails['TWD']['suffix']="";
  $currencyDetails['TWD']['code']="TWD";
  $currencyDetails['TWD']['decimals']=2;
  $currencyDetails['TWD']['fraction']=".";
  $currencyDetails['TWD']['thousands']="";

  $currencyDetails['THB']['prefix']="THB";
  $currencyDetails['THB']['suffix']="";
  $currencyDetails['THB']['code']="THB";
  $currencyDetails['THB']['decimals']=2;
  $currencyDetails['THB']['fraction']=".";
  $currencyDetails['THB']['thousands']="";
  
  $charset="";
  
  // Normally code below this point doesn't need any adjustment. 

  $optionValueSeparator=$_REQUEST['ovspt'];
  $optionSeparator=$_REQUEST['ospt'];
  $idPrefix=$_REQUEST['idpref'];
  $idSuffix=$_REQUEST['idsuff'];
  $discountPriceSeparator=$_REQUEST['dprspt'];
  $discountQuantityOperator=$_REQUEST['dqtopt'];
  $usesandbox=$_REQUEST['sandbox'];
  $itemquantitylimit=$_REQUEST['itemlmt'];  
  $cartquantitylimit=$_REQUEST['cartlmt'];  
  $itemquantityminlimit=$_REQUEST['itemminlmt'];  
  $cartquantityminlimit=$_REQUEST['cartminlmt'];  
  $savecart=$_REQUEST['svct'];
  $productpagelink=$_REQUEST['pglink'];
  $productpagelinktarget=$_REQUEST['pglinktg'];
  $itemtoshow=-1;
  session_start();
  $errormessage="";
  

  // If cookie set and cart is empty then read cart content from cookie
  if ($savecart=="1")
  {
    if (($_COOKIE["VIBRACART"]!="") && ((!isset($_SESSION['sess_cart_numentries'])) || ($_SESSION['sess_cart_numentries']==0)))
    {
    
      $cookiestr=rawurldecode($_COOKIE["VIBRACART"]);
      $cookiestr=base64_decode($cookiestr);
      if (function_exists("bzdecompress"))
        $cookiestr=bzdecompress($cookiestr,true);
      else
      {
      if (function_exists("gzuncompress"))
        $cookiestr=gzuncompress($cookiestr,true);        
      }  
      $cookiestrarray=explode("\n",$cookiestr);
      for ($k=0;$k<count($cookiestrarray);$k++)
      {
        $pos=strpos($cookiestrarray[$k],"=");
        $var=substr($cookiestrarray[$k],0,$pos);
        $$var=substr($cookiestrarray[$k],$pos+1);
      }
      $cookieversion=$V;
      if (($cookieversion!="4") || (!is_numeric($cookieversion)))
      {
        //Cookie is earlier version or corrupted so delete it
        setcookie('VIBRACART', '', time()-42000, '/');
      }
      else
      {
        $_SESSION['sess_cart_total']=$d0;
        $_SESSION['sess_cart_numentries']=$d1;
        $_SESSION['sess_cart_numitems']=$d2;
        $_SESSION['sess_cart_currency']=$d3;
        $_SESSION['sess_cart_account']=$d4;
        $_SESSION['sess_cart_couponcode']=$d5;  
        $_SESSION['sess_cart_discount']=$d6;
        $_SESSION['sess_cart_item_id']=$d7;
        $_SESSION['sess_cart_item_image']=$d8;
        $_SESSION['sess_cart_item_description']=$d9;
        $_SESSION['sess_cart_item_quantity']=$d10;    
        $_SESSION['sess_cart_item_price']=$d11;    
        $_SESSION['sess_cart_item_total']=$d12;        
        $_SESSION['sess_cart_item_optionname_0']=$d13;
        $_SESSION['sess_cart_item_optionselection_0']=$d14;
        $_SESSION['sess_cart_item_optionname_1']=$d15;
        $_SESSION['sess_cart_item_optionselection_1']=$d16;
        $_SESSION['sess_cart_item_optionname_2']=$d17;
        $_SESSION['sess_cart_item_optionselection_2']=$d18;
        $_SESSION['sess_cart_item_optionname_3']=$d19;
        $_SESSION['sess_cart_item_optionselection_3']=$d20;
        $_SESSION['sess_cart_item_optionname_4']=$d21;
        $_SESSION['sess_cart_item_optionselection_4']=$d22;
        $_SESSION['sess_cart_item_optionname_5']=$d23;
        $_SESSION['sess_cart_item_optionselection_5']=$d24;
        $_SESSION['sess_cart_item_optionname_6']=$d25;
        $_SESSION['sess_cart_item_optionselection_6']=$d26;
        // Paypal specific
        $_SESSION['sess_cart_pp_lc']=$d27;  
        $_SESSION['sess_cart_pp_return']=$d28;
        $_SESSION['sess_cart_pp_cancel_return']=$d29;
        $_SESSION['sess_cart_pp_notify_url']=$d30;
        $_SESSION['sess_cart_pp_address_override']=$d31;
        $_SESSION['sess_cart_pp_custom']=$d32;
        $_SESSION['sess_cart_pp_handling']=$d33;
        $_SESSION['sess_cart_pp_invoice']=$d34;
        $_SESSION['sess_cart_pp_weight_cart']=$d35;
        $_SESSION['sess_cart_pp_rm']=$d36;
        $_SESSION['sess_cart_pp_page_style']=$d37;
        $_SESSION['sess_cart_pp_image_url']=$d38;
        $_SESSION['sess_cart_pp_cpp_header_image']=$d39;
        $_SESSION['sess_cart_pp_cpp_headerback_color']=$d40;
        $_SESSION['sess_cart_pp_cpp_headerborder_color']=$d41;
        $_SESSION['sess_cart_pp_cpp_payflow_color']=$d42;
        $_SESSION['sess_cart_pp_cs']=$d43;
        $_SESSION['sess_cart_pp_no_note']=$d44;
        $_SESSION['sess_cart_pp_cn']=$d45;
        $_SESSION['sess_cart_item_pp_no_shipping']=$d46;
        $_SESSION['sess_cart_pp_cbt']=$d47;
        $_SESSION['sess_cart_item_pp_tax']=$d48;
        $_SESSION['sess_cart_item_pp_tax_rate']=$d49;
        $_SESSION['sess_cart_item_pp_weight']=$d50;
        $_SESSION['sess_cart_item_pp_weight_unit']=$d51;
        $_SESSION['sess_cart_item_pp_shipping']=$d52;
        $_SESSION['sess_cart_item_pp_shipping2']=$d53;
        $_SESSION['sess_cart_item_pp_discount_amount']=$d54;
        $_SESSION['sess_cart_item_pp_discount_amount2']=$d55;
        $_SESSION['sess_cart_item_pp_discount_rate']=$d56;
        $_SESSION['sess_cart_item_pp_discount_rate2']=$d57;
        $_SESSION['sess_cart_item_pp_discount_num']=$d58;
        $_SESSION['sess_cart_item_pp_discount_total']=$d59;
        $_SESSION['sess_cart_item_maxquantity']=$d60;        
        $_SESSION['sess_cart_item_pagelink']=$d61;        
        $_SESSION['sess_cart_item_minquantity']=$d62;        
        }
    }
  }
  
  // Retrieve cart for this session
  $cart_numentries=$_SESSION['sess_cart_numentries'];
  $cart_numitems=$_SESSION['sess_cart_numitems'];
  if (!is_numeric($cart_numentries))
    $cart_numentries="0";
  $cart_currency=$_SESSION['sess_cart_currency'];
  
  $decimal_places=$currencyDetails[$cart_currency]['decimals'];
  $currency_symbol=$currencyDetails[$cart_currency]['prefix']; 
  $currency_symbol2=$currencyDetails[$cart_currency]['suffix']; 
  $decimal_separator=$currencyDetails[$cart_currency]['fraction'];
  $thousand_separator=$currencyDetails[$cart_currency]['thousands'];

  $cart_couponcode=$_SESSION['sess_cart_couponcode'];
  $cart_discount=$_SESSION['sess_cart_discount'];
  
  $cart_account=$_SESSION['sess_cart_account'];
  $cart_item_id=explode("|",$_SESSION['sess_cart_item_id']);
  $cart_item_image=explode("|",$_SESSION['sess_cart_item_image']);
  $cart_item_pagelink=explode("|",$_SESSION['sess_cart_item_pagelink']);
  $cart_item_maxquantity=explode("|",$_SESSION['sess_cart_item_maxquantity']);
  $cart_item_minquantity=explode("|",$_SESSION['sess_cart_item_minquantity']);
  $cart_item_description=explode("|",$_SESSION['sess_cart_item_description']);
  $cart_item_quantity=explode("|",$_SESSION['sess_cart_item_quantity']);
  $cart_item_price=explode("|",$_SESSION['sess_cart_item_price']);
  $cart_item_total=explode("|",$_SESSION['sess_cart_item_total']);
  $cart_item_optionname_0=explode("|",$_SESSION['sess_cart_item_optionname_0']);
  $cart_item_optionselection_0=explode("|",$_SESSION['sess_cart_item_optionselection_0']);
  $cart_item_optionname_1=explode("|",$_SESSION['sess_cart_item_optionname_1']);
  $cart_item_optionselection_1=explode("|",$_SESSION['sess_cart_item_optionselection_1']);
  $cart_item_optionname_2=explode("|",$_SESSION['sess_cart_item_optionname_2']);
  $cart_item_optionselection_2=explode("|",$_SESSION['sess_cart_item_optionselection_2']);
  $cart_item_optionname_3=explode("|",$_SESSION['sess_cart_item_optionname_3']);
  $cart_item_optionselection_3=explode("|",$_SESSION['sess_cart_item_optionselection_3']);
  $cart_item_optionname_4=explode("|",$_SESSION['sess_cart_item_optionname_4']);
  $cart_item_optionselection_4=explode("|",$_SESSION['sess_cart_item_optionselection_4']);
  $cart_item_optionname_5=explode("|",$_SESSION['sess_cart_item_optionname_5']);
  $cart_item_optionselection_5=explode("|",$_SESSION['sess_cart_item_optionselection_5']);
  $cart_item_optionname_6=explode("|",$_SESSION['sess_cart_item_optionname_6']);
  $cart_item_optionselection_6=explode("|",$_SESSION['sess_cart_item_optionselection_6']);
  // Paypal specific
  $cart_pp_lc=$_SESSION['sess_cart_pp_lc'];
  $cart_pp_return=$_SESSION['sess_cart_pp_return'];
  $cart_pp_cancel_return=$_SESSION['sess_cart_pp_cancel_return'];
  $cart_pp_notify_url=$_SESSION['sess_cart_pp_notify_url'];
  $cart_pp_address_override=$_SESSION['sess_cart_pp_address_override'];
  $cart_pp_custom=$_SESSION['sess_cart_pp_custom'];
  $cart_pp_handling=$_SESSION['sess_cart_pp_handling'];
  $cart_pp_invoice=$_SESSION['sess_cart_pp_invoice'];
//  $cart_pp_shipping=$_SESSION['sess_cart_pp_shipping'];
  $cart_pp_weight_cart=$_SESSION['sess_cart_pp_weight_cart'];
//  $cart_pp_weight_unit=$_SESSION['sess_cart_pp_weight_unit'];
  $cart_pp_rm=$_SESSION['sess_cart_pp_rm'];
  $cart_pp_page_style=$_SESSION['sess_cart_pp_page_style'];
  $cart_pp_image_url=$_SESSION['sess_cart_pp_image_url'];
  $cart_pp_cpp_header_image=$_SESSION['sess_cart_pp_cpp_header_image'];
  $cart_pp_cpp_headerback_color=$_SESSION['sess_cart_pp_cpp_headerback_color'];
  $cart_pp_cpp_headerborder_color=$_SESSION['sess_cart_pp_cpp_headerborder_color'];
  $cart_pp_cpp_payflow_color=$_SESSION['sess_cart_pp_cpp_payflow_color'];
  $cart_pp_cs=$_SESSION['sess_cart_pp_cs'];
  $cart_pp_no_note=$_SESSION['sess_cart_pp_no_note'];
  $cart_pp_cn=$_SESSION['sess_cart_pp_cn'];
  $cart_item_pp_no_shipping=explode("|",$_SESSION['sess_cart_item_pp_no_shipping']);
  $cart_pp_cbt=$_SESSION['sess_cart_pp_cbt'];

  $cart_item_pp_tax=explode("|",$_SESSION['sess_cart_item_pp_tax']);  
  $cart_item_pp_tax_rate=explode("|",$_SESSION['sess_cart_item_pp_tax_rate']);  
  $cart_item_pp_weight=explode("|",$_SESSION['sess_cart_item_pp_weight']);  
  $cart_item_pp_weight_unit=explode("|",$_SESSION['sess_cart_item_pp_weight_unit']);  
  $cart_item_pp_shipping=explode("|",$_SESSION['sess_cart_item_pp_shipping']);  
  $cart_item_pp_shipping2=explode("|",$_SESSION['sess_cart_item_pp_shipping2']);
  
  $cart_item_pp_discount_amount=explode("|",$_SESSION['sess_cart_item_pp_discount_amount']);   
  $cart_item_pp_discount_amount2=explode("|",$_SESSION['sess_cart_item_pp_discount_amount2']);   
  $cart_item_pp_discount_rate=explode("|",$_SESSION['sess_cart_item_pp_discount_rate']);   
  $cart_item_pp_discount_rate2=explode("|",$_SESSION['sess_cart_item_pp_discount_rate2']);   
  $cart_item_pp_discount_num=explode("|",$_SESSION['sess_cart_item_pp_discount_num']);   
  $cart_item_pp_discount_total=explode("|",$_SESSION['sess_cart_item_pp_discount_total']);   

  // See what function is required 
  
  if ($_GET['cart_todo']=="addurl")
  {
    // addurl is similar to additem except that it works via GET
    // First url decode the REQUEST variables
    foreach ($_REQUEST as $key => $value)
    {
      $value = urldecode($value);
      $_REQUEST[$key]=urldecode($value);
    }
    // Now handle as usual
    $_REQUEST['cart_todo']="additem";
  }
  
  if ($_REQUEST['cart_todo']=="additem")
  {
    // Get button type
    if (($_REQUEST['cmd']=="_cart") && ($_REQUEST['add']=="1"))
    {
      // Handle as Paypal add to cart button
      // Get transaction specific fields
      $currency=trim($_REQUEST['currency_code']);
      $cart_account=trim($_REQUEST['business']);
      $cart_pp_lc=trim($_REQUEST['lc']);
      $cart_pp_return=trim($_REQUEST['return']);
      $cart_pp_cancel_return=trim($_REQUEST['cancel_return']);
      $cart_pp_notify_url=trim($_REQUEST['notify_url']);
      $cart_pp_address_override=trim($_REQUEST['address_override']);
      if (isset($_REQUEST['custom']))
        $cart_pp_custom=trim($_REQUEST['custom']);
      $cart_pp_handling=trim($_REQUEST['handling']);
      $cart_pp_invoice=trim($_REQUEST['invoice']);
//      $cart_pp_shipping=trim($_REQUEST['shipping']);
      $cart_pp_weight_cart=trim($_REQUEST['weight_cart']);
//      $cart_pp_weight_unit=trim($_REQUEST['weight_unit']);
      $cart_pp_rm=trim($_REQUEST['rm']);
      $cart_pp_page_style=trim($_REQUEST['page_style']);
      $cart_pp_image_url=trim($_REQUEST['image_url']);
      $cart_pp_cpp_header_image=trim($_REQUEST['cpp_header_image']);
      $cart_pp_cpp_headerback_color=trim($_REQUEST['cpp_headerback_color']);
      $cart_pp_cpp_headerborder_color=trim($_REQUEST['cpp_headerborder_color']);
      $cart_pp_cpp_payflow_color=trim($_REQUEST['cpp_payflow_color']);
      $cart_pp_cs=trim($_REQUEST['cs']);
      $cart_pp_no_note=trim($_REQUEST['no_note']);
      $cart_pp_cn=trim($_REQUEST['cn']);
      $cart_pp_no_shipping=trim($_REQUEST['no_shipping']);
      $cart_pp_cbt=trim($_REQUEST['cbt']);      
      // Get item specific fields
      $item_number=trim($_REQUEST['item_number']);
      $item_name=trim($_REQUEST['item_name']);
      $item_image=trim($_REQUEST['vibracart_image']);
      $item_image=str_replace("\\","",$item_image);
      $item_pagelink=trim($_REQUEST['vibracart_pagelink']);
      if ($item_pagelink=="")
        $item_pagelink=$productpagelink;
      $item_maxquantity=trim($_REQUEST['vibracart_maxquantity']);           
      $item_minquantity=trim($_REQUEST['vibracart_minquantity']);           
      if (get_magic_quotes_gpc())
      {
        $item_number=stripslashes($item_number);          
        $item_name=stripslashes($item_name);          
      }
      $quantity=trim($_REQUEST['quantity']);
      if ($quantity=="")
        $quantity=1;
      $tax=trim($_REQUEST['tax']);    
      $tax_rate=trim($_REQUEST['tax_rate']);    
      $weight=trim($_REQUEST['weight']);    
      $weight_unit=trim($_REQUEST['weight_unit']);    
      $shipping=trim($_REQUEST['shipping']);    
      $shipping2=trim($_REQUEST['shipping2']);
      // Get item options
      $on0=trim($_REQUEST['on0']);    
      $os0=trim($_REQUEST['os0']);    
      $on1=trim($_REQUEST['on1']);    
      $os1=trim($_REQUEST['os1']);    
      $on2=trim($_REQUEST['on2']);    
      $os2=trim($_REQUEST['os2']);    
      $on3=trim($_REQUEST['on3']);    
      $os3=trim($_REQUEST['os3']);    
      $on4=trim($_REQUEST['on4']);    
      $os4=trim($_REQUEST['os4']);    
      $on5=trim($_REQUEST['on5']);    
      $os5=trim($_REQUEST['os5']);    
      $on6=trim($_REQUEST['on6']);    
      $os6=trim($_REQUEST['os6']);
      // Get option pricing details
      $option_index=trim($_REQUEST['option_index']);
      if ($option_index!="")
      {
        $option_select0=trim($_REQUEST['option_select0']);    
        $option_amount0=trim($_REQUEST['option_amount0']);    
        $option_select1=trim($_REQUEST['option_select1']);    
        $option_amount1=trim($_REQUEST['option_amount1']);    
        $option_select2=trim($_REQUEST['option_select2']);    
        $option_amount2=trim($_REQUEST['option_amount2']);    
        $option_select3=trim($_REQUEST['option_select3']);    
        $option_amount3=trim($_REQUEST['option_amount3']);    
        $option_select4=trim($_REQUEST['option_select4']);    
        $option_amount4=trim($_REQUEST['option_amount4']);    
        $option_select5=trim($_REQUEST['option_select5']);    
        $option_amount5=trim($_REQUEST['option_amount5']);    
        $option_select6=trim($_REQUEST['option_select6']);    
        $option_amount6=trim($_REQUEST['option_amount6']);    
        $option_select7=trim($_REQUEST['option_select7']);    
        $option_amount7=trim($_REQUEST['option_amount7']);    
        $option_select8=trim($_REQUEST['option_select8']);    
        $option_amount8=trim($_REQUEST['option_amount8']);    
        $option_select9=trim($_REQUEST['option_select9']);    
        $option_amount9=trim($_REQUEST['option_amount9']);
        $option_select10=trim($_REQUEST['option_select10']);    
        $option_amount10=trim($_REQUEST['option_amount10']);
        $option_select11=trim($_REQUEST['option_select11']);    
        $option_amount11=trim($_REQUEST['option_amount11']);
        $option_select12=trim($_REQUEST['option_select12']);    
        $option_amount12=trim($_REQUEST['option_amount12']);
        $option_select13=trim($_REQUEST['option_select13']);    
        $option_amount13=trim($_REQUEST['option_amount13']);
        $option_select14=trim($_REQUEST['option_select14']);    
        $option_amount14=trim($_REQUEST['option_amount14']);
        $option_select15=trim($_REQUEST['option_select15']);    
        $option_amount15=trim($_REQUEST['option_amount15']);
        $option_select16=trim($_REQUEST['option_select16']);    
        $option_amount16=trim($_REQUEST['option_amount16']);
        $option_select17=trim($_REQUEST['option_select17']);    
        $option_amount17=trim($_REQUEST['option_amount17']);
        $option_select18=trim($_REQUEST['option_select18']);    
        $option_amount18=trim($_REQUEST['option_amount18']);
        $option_select19=trim($_REQUEST['option_select19']);    
        $option_amount19=trim($_REQUEST['option_amount19']);
        $varpt="os".$option_index;
        $optionvaluetomatch=$$varpt;
        for ($k=0;$k<20;$k++)
        {
          $varpt="option_select".$k;
          if ($$varpt==$optionvaluetomatch)
          {
            $varpt="option_amount".$k;
            $amount=trim($$varpt);
            break;
          }         
        }
      }
      else
        $amount=trim($_REQUEST['amount']);
      $amount=str_replace(",","",$amount);  
      $amount=sprintf("%01.".$decimal_places."f",$amount);
      // Get discount details
      $discount_amount=trim($_REQUEST['discount_amount']);
      $discount_amount2=trim($_REQUEST['discount_amount2']);
      $discount_rate=trim($_REQUEST['discount_rate']);
      $discount_rate2=trim($_REQUEST['discount_rate2']);
      $discount_num=trim($_REQUEST['discount_num']);
      if (($cart_numentries>0) && ($cart_currency!="") && ($currency!=$cart_currency))
        $errormessage="2";
      if (!is_numeric($amount))
        $errormessage="1";
      if (($item_number=="") && ($item_name==""))
        $errormessage="1";
      if ($errormessage=="")
      {
        $found=false;
        // See if item exists in cart already (based on id or name first of all)
        $pos=findCartEntry($item_number,$item_name,$on0,$os0,$on1,$os1,$on2,$os2,$on3,$os3,$on4,$os4,$on5,$os5,$on6,$os6);
        if ($pos>-1)
        {
          // Check to see if cart quantity limit has been reached
          if (($cartquantitylimit!=0) && (($cart_numitems+$quantity)>$cartquantitylimit))
            $errormessage="6";
          // Check to see if item quantity limit has been reached
          if (($itemquantitylimit!=0) && ($cart_item_maxquantity[$pos]=="") && (($cart_item_quantity[$pos]+$quantity)>$itemquantitylimit))
            $errormessage="5";
          // Check if item specific quantity limit has been reached
          if (($cart_item_maxquantity[$pos]!="") && (($cart_item_quantity[$pos]+$quantity)>$cart_item_maxquantity[$pos]))
            $errormessage="5";
          if ($errormessage=="")
          {         
            // Item exists so increase quantity
            $cart_item_quantity[$pos]=$cart_item_quantity[$pos]+$quantity;
            // Update discount amounts for item only if higher than already set
            if (($cart_item_pp_discount_amount[$pos]=="") || ($discount_amount>$cart_item_pp_discount_amount[$pos]))
              $cart_item_pp_discount_amount[$pos]=$discount_amount;
            if (($cart_item_pp_discount_amount2[$pos]=="") || ($discount_amount2>$cart_item_pp_discount_amount2[$pos]))
              $cart_item_pp_discount_amount2[$pos]=$discount_amount2;
            if (($cart_item_pp_discount_rate[$pos]=="") || ($discount_rate>$cart_item_pp_discount_rate[$pos]))
              $cart_item_pp_discount_rate[$pos]=$discount_rate;
            if (($cart_item_pp_discount_rate2[$pos]=="") || ($discount_rate2>$cart_item_pp_discount_rate2[$pos]))
              $cart_item_pp_discount_rate2[$pos]=$discount_rate2;
            if (($cart_item_pp_discount_num[$pos]=="") || ($discount_num>$cart_item_pp_discount_num[$pos]))
              $cart_item_pp_discount_num[$pos]=$discount_num;
            $discarray=discount_Amount($cart_item_price[$pos],$cart_item_quantity[$pos],$cart_item_pp_discount_amount[$pos],$cart_item_pp_discount_amount2[$pos],$cart_item_pp_discount_rate[$pos],$cart_item_pp_discount_rate2[$pos],$cart_item_pp_discount_num[$pos]);  
            $cart_item_pp_discount_total[$pos]=$discarray['discounttotal'];
            $cart_item_total[$pos]=$cart_item_quantity[$pos]*$cart_item_price[$pos];
            $cart_item_total[$pos]=$cart_item_total[$pos]-$discarray['discounttotal'];
            $cart_item_total[$pos]=sprintf("%01.".$decimal_places."f",$cart_item_total[$pos]);
            $cart_item_pp_no_shipping[$pos]=$cart_pp_no_shipping;   
            $itemtoshow=$pos;
          }
        }
        else
        {
          // Check to see if cart quantity limit has been reached
          if (($cartquantitylimit!=0) && (($cart_numitems+$quantity)>$cartquantitylimit))
            $errormessage="6";
          // Check to see if item quantity limit has been reached
          if (($itemquantitylimit!=0) && ($item_maxquantity=="") && ($quantity>$itemquantitylimit))
            $errormessage="5";
          // Check if item specific quantity limit has been reached
          if (($item_maxquantity!="") && ($quantity>$item_maxquantity))
            $errormessage="5";
          if ($errormessage=="")
          {                 
            // If still not found then add new item to cart
            $cart_currency=strtoupper($currency);
            $decimal_places=$currencyDetails[$cart_currency]['decimals'];
            $currency_symbol=$currencyDetails[$cart_currency]['prefix'];          
            $currency_symbol2=$currencyDetails[$cart_currency]['suffix'];          
            $decimal_separator=$currencyDetails[$cart_currency]['fraction'];
            $thousand_separator=$currencyDetails[$cart_currency]['thousands'];
            $cart_item_id[$cart_numentries]=$item_number;
            $cart_item_image[$cart_numentries]=$item_image;
            $cart_item_pagelink[$cart_numentries]=$item_pagelink;
            $cart_item_maxquantity[$cart_numentries]=$item_maxquantity;
            $cart_item_minquantity[$cart_numentries]=$item_minquantity;
            $cart_item_description[$cart_numentries]=$item_name;
            // If quantity less than minimum then set to minimum.
            if (($itemquantityminlimit>0) && ($item_minquantity=="") && ($quantity<$itemquantityminlimit))
              $quantity=$itemquantityminlimit;
            else
            {
              if (($item_minquantity!="") && ($item_minquantity>0) && ($quantity<$item_minquantity))
                $quantity=$item_minquantity;
            }  
            $cart_item_quantity[$cart_numentries]=$quantity;
            $cart_item_price[$cart_numentries]=$amount;
            $itemtoshow=$cart_numentries;
            $cart_item_pp_tax[$cart_numentries]=$tax;
            $cart_item_pp_tax_rate[$cart_numentries]=$tax_rate;
            $cart_item_pp_weight[$cart_numentries]=$weight;
            $cart_item_pp_weight_unit[$cart_numentries]=$weight_unit;
            $cart_item_pp_shipping[$cart_numentries]=$shipping;
            $cart_item_pp_shipping2[$cart_numentries]=$shipping2;
            $cart_item_optionname_0[$cart_numentries]=$on0;
            $cart_item_optionselection_0[$cart_numentries]=$os0;
            $cart_item_optionname_1[$cart_numentries]=$on1;
            $cart_item_optionselection_1[$cart_numentries]=$os1;
            $cart_item_optionname_2[$cart_numentries]=$on2;
            $cart_item_optionselection_2[$cart_numentries]=$os2;
            $cart_item_optionname_3[$cart_numentries]=$on3;
            $cart_item_optionselection_3[$cart_numentries]=$os3;
            $cart_item_optionname_4[$cart_numentries]=$on4;
            $cart_item_optionselection_4[$cart_numentries]=$os4;
            $cart_item_optionname_5[$cart_numentries]=$on5;
            $cart_item_optionselection_5[$cart_numentries]=$os5;
            $cart_item_optionname_6[$cart_numentries]=$on6;
            $cart_item_optionselection_6[$cart_numentries]=$os6;
            // Discount amounts to be applied to product
            $cart_item_pp_discount_amount[$cart_numentries]=$discount_amount;
            $cart_item_pp_discount_amount2[$cart_numentries]=$discount_amount2;
            $cart_item_pp_discount_rate[$cart_numentries]=$discount_rate;
            $cart_item_pp_discount_rate2[$cart_numentries]=$discount_rate2;
            $cart_item_pp_discount_num[$cart_numentries]=$discount_num;
            // Calculate total discount amount                     
            $discarray=discount_Amount($cart_item_price[$cart_numentries],$cart_item_quantity[$cart_numentries],$cart_item_pp_discount_amount[$cart_numentries],$cart_item_pp_discount_amount2[$cart_numentries],$cart_item_pp_discount_rate[$cart_numentries],$cart_item_pp_discount_rate2[$cart_numentries],$cart_item_pp_discount_num[$cart_numentries]);
            $cart_item_pp_discount_total[$cart_numentries]=$discarray['discounttotal'];
            $cart_item_total[$cart_numentries]=$cart_item_quantity[$cart_numentries]*$cart_item_price[$cart_numentries];
            $cart_item_total[$cart_numentries]=$cart_item_total[$cart_numentries]-$discarray['discounttotal'];
            $cart_item_total[$cart_numentries]=sprintf("%01.".$decimal_places."f",$cart_item_total[$cart_numentries]);
            $cart_item_pp_no_shipping[$cart_numentries]=$cart_pp_no_shipping;   
            $cart_numentries++;
          }  
        }                    
      }    
    }
  }
  $couponfound=false;
  if ($_REQUEST['cart_todo']=="applycoupon")
  {
    // Apply coupon code
    // We will check later if it was valid
    $currentcouponcode=$cart_couponcode;
    $cart_couponcode=trim($_REQUEST['coupon']);
  }
  if ($_REQUEST['cart_todo']=="removeitem")
  {
    // Remove item from cart
    $num=$_REQUEST['num'];
    if ($cart_numentries>0)
    {
      removeItem($num);
    }
  }
  if ($_REQUEST['cart_todo']=="updateqty")
  {
      $itemqty=$_REQUEST['itemqty'];
      for ($pos=count($itemqty);$pos>=0;$pos--)
      {
        $itemqty[$pos]=trim($itemqty[$pos]);
        if (is_validQuantity($itemqty[$pos]))
        {
          if ($itemqty[$pos]>=0)
          {
            if ($itemqty[$pos]>0)
            {
              // Check to see if less than item quantity min (cart minimum is checked at checkout)
              if (($itemquantityminlimit!=0) && ($cart_item_minquantity[$pos]=="") && ($itemqty[$pos]<$itemquantityminlimit))
                $errormessage="8";
              // Check to see if less than item specific quantity
              if (($cart_item_minquantity[$pos]!="") && ($itemqty[$pos]<$cart_item_minquantity[$pos]))
                $errormessage="8";
            }
            // Check to see if cart quantity limit has been reached
            if (($cartquantitylimit!=0) && (($cart_numitems-$cart_item_quantity[$pos]+$itemqty[$pos])>$cartquantitylimit))
              $errormessage="6";          
            // Check to see if item quantity limit has been reached
            if (($itemquantitylimit!=0) && ($cart_item_maxquantity[$pos]=="") && ($itemqty[$pos]>$itemquantitylimit))
              $errormessage="5";
            // Check to see if item specific quantity limit has been reached
            if (($cart_item_maxquantity[$pos]!="") && ($itemqty[$pos]>$cart_item_maxquantity[$pos]))
              $errormessage="5";
            if ($errormessage=="")
            {                  
              $cart_item_quantity[$pos]=$itemqty[$pos];
              $discarray=discount_Amount($cart_item_price[$pos],$cart_item_quantity[$pos],$cart_item_pp_discount_amount[$pos],$cart_item_pp_discount_amount2[$pos],$cart_item_pp_discount_rate[$pos],$cart_item_pp_discount_rate2[$pos],$cart_item_pp_discount_num[$pos]);
              $cart_item_pp_discount_total[$pos]=$discarray['discounttotal'];
              $cart_item_total[$pos]=$cart_item_quantity[$pos]*$cart_item_price[$pos];
              $cart_item_total[$pos]=$cart_item_total[$pos]-$discarray['discounttotal'];
              $cart_item_total[$pos]=sprintf("%01.".$decimal_places."f",$cart_item_total[$pos]);
            }
          }
          if ($itemqty[$pos]==0)
          {
            removeItem($pos);
          }
        }
      }
  }

  // Get any discount and coupon settings
  // First see if currency specific file exists
  if ($cart_currency!="")
  {
    if (file_exists("discounts".$cart_currency.".php"))
      include("discounts".$cart_currency.".php");  
    else
    {
      if (file_exists("discounts.php"))
        include("discounts.php"); 
    }  
  }
  else
  {
    if (file_exists("discounts.php"))
      include("discounts.php"); 
  }  


  
  $totaldiscounts=0;
  // Calculate any item specific discounts or coupons
  $totaldiscounts=ApplyItemDiscounts();  
     
  //Calculate cart total and number of items
  $cart_total=0;
  $cart_numitems=0;
  // Keep separate totals for discount amount
  $cart_totalfordiscount=0;
  $cart_numitemsfordiscount=0;
  $totignore="";
  for ($k=0;$k<count($ordertotalignore);$k++)
  {
    if (($totignore!="") && ($ordertotalignore[$k]!=""))
      $totignore.=":";
    $totignore.=$ordertotalignore[$k]; 
  }
  $totignore=preg_replace("/\s+:\s+/",":",$totignore);
  $qtyignore="";
  for ($k=0;$k<count($orderqtyignore);$k++)
  {
    if (($qtyignore!="") && ($orderqtyignore[$k]!=""))
      $qtyignore.=":";
    $qtyignore.=$orderqtyignore[$k]; 
  }
  $qtyignore=preg_replace("/\s+:\s+/",":",$qtyignore);
  for ($k=0;$k<$cart_numentries;$k++)
  {
    $cart_total=$cart_total+$cart_item_total[$k];
    // Total excluding any items flagged to be ignored
    if (($cart_item_id[$k]=="") || (preg_match("/(^|:)".$cart_item_id[$k]."(:|$)/", $totignore)==0))
      $cart_totalfordiscount=$cart_totalfordiscount+$cart_item_total[$k];
    $cart_numitems=$cart_numitems+$cart_item_quantity[$k];  
    // Total excluding any items flagged to be ignored
    if (($cart_item_id[$k]=="") || (preg_match("/(^|:)".$cart_item_id[$k]."(:|$)/", $qtyignore)==0))
      $cart_numitemsfordiscount=$cart_numitemsfordiscount+$cart_item_quantity[$k];
  }
  // Now calculate any discounts or coupons applied to the cart total
  $cart_discount="";
  $disval=ApplyCartDiscounts();
  if (($disval>0) && ($cart_total>=$disval))
  {
    $disval=sprintf("%01.".$decimal_places."f",$disval);
    $cart_total=$cart_total-$disval;
    $cart_discount=$disval;
    $totaldiscounts=$totaldiscounts+$disval;
  }
  // If coupon just entered and not blank lets see if it was valid
  if ($_REQUEST['cart_todo']=="applycoupon")
  {
    if (($cart_couponcode!="") && (!$couponfound))
    {
      $errormessage="7";
      $cart_couponcode=$currentcouponcode;
    }
  }
  $cart_total=sprintf("%01.".$decimal_places."f",$cart_total);
  // Update session variables
  $_SESSION['sess_cart_total']=$cart_total;
  $_SESSION['sess_cart_numentries']=$cart_numentries;
  $_SESSION['sess_cart_numitems']=$cart_numitems;
  $_SESSION['sess_cart_currency']=$cart_currency;
  $_SESSION['sess_cart_account']=$cart_account;
  $_SESSION['sess_cart_couponcode']=$cart_couponcode;  
  $_SESSION['sess_cart_discount']=$cart_discount;  
  if (empty($cart_item_id))
    $_SESSION['sess_cart_item_id']="";
  else
    $_SESSION['sess_cart_item_id']=implode("|",$cart_item_id);
  if (empty($cart_item_image))
    $_SESSION['sess_cart_item_image']="";
  else
    $_SESSION['sess_cart_item_image']=implode("|",$cart_item_image);
  if (empty($cart_item_pagelink))
    $_SESSION['sess_cart_item_pagelink']="";
  else
    $_SESSION['sess_cart_item_pagelink']=implode("|",$cart_item_pagelink);
  if (empty($cart_item_maxquantity))
    $_SESSION['sess_cart_item_maxquantity']="";
  else
    $_SESSION['sess_cart_item_maxquantity']=implode("|",$cart_item_maxquantity);
  if (empty($cart_item_minquantity))
    $_SESSION['sess_cart_item_minquantity']="";
  else
    $_SESSION['sess_cart_item_minquantity']=implode("|",$cart_item_minquantity);
  if (empty($cart_item_description))
    $_SESSION['sess_cart_item_description']="";
  else
    $_SESSION['sess_cart_item_description']=implode("|",$cart_item_description);
  if (empty($cart_item_quantity))    
    $_SESSION['sess_cart_item_quantity']="";
  else  
    $_SESSION['sess_cart_item_quantity']=implode("|",$cart_item_quantity);
  if (empty($cart_item_price))    
    $_SESSION['sess_cart_item_price']="";
  else
    $_SESSION['sess_cart_item_price']=implode("|",$cart_item_price);
  if (empty($cart_item_total))        
    $_SESSION['sess_cart_item_total']="";
  else
    $_SESSION['sess_cart_item_total']=implode("|",$cart_item_total);
       
        
  if (empty($cart_item_optionname_0))
    $_SESSION['sess_cart_item_optionname_0']="";
  else       
    $_SESSION['sess_cart_item_optionname_0']=implode("|",$cart_item_optionname_0);
  if (empty($cart_item_optionselection_0))
    $_SESSION['sess_cart_item_optionselection_0']="";        
  else
    $_SESSION['sess_cart_item_optionselection_0']=implode("|",$cart_item_optionselection_0);
  if (empty($cart_item_optionname_1))
    $_SESSION['sess_cart_item_optionname_1']="";
  else       
    $_SESSION['sess_cart_item_optionname_1']=implode("|",$cart_item_optionname_1);
  if (empty($cart_item_optionselection_1))
    $_SESSION['sess_cart_item_optionselection_1']="";        
  else
    $_SESSION['sess_cart_item_optionselection_1']=implode("|",$cart_item_optionselection_1);
  if (empty($cart_item_optionname_2))
    $_SESSION['sess_cart_item_optionname_2']="";
  else       
    $_SESSION['sess_cart_item_optionname_2']=implode("|",$cart_item_optionname_2);
  if (empty($cart_item_optionselection_2))
    $_SESSION['sess_cart_item_optionselection_2']="";        
  else
    $_SESSION['sess_cart_item_optionselection_2']=implode("|",$cart_item_optionselection_2);
  if (empty($cart_item_optionname_3))
    $_SESSION['sess_cart_item_optionname_3']="";
  else       
    $_SESSION['sess_cart_item_optionname_3']=implode("|",$cart_item_optionname_3);
  if (empty($cart_item_optionselection_3))
    $_SESSION['sess_cart_item_optionselection_3']="";        
  else
    $_SESSION['sess_cart_item_optionselection_3']=implode("|",$cart_item_optionselection_3);
  if (empty($cart_item_optionname_4))
    $_SESSION['sess_cart_item_optionname_4']="";
  else       
    $_SESSION['sess_cart_item_optionname_4']=implode("|",$cart_item_optionname_4);
  if (empty($cart_item_optionselection_4))
    $_SESSION['sess_cart_item_optionselection_4']="";        
  else
    $_SESSION['sess_cart_item_optionselection_4']=implode("|",$cart_item_optionselection_4);
  if (empty($cart_item_optionname_5))
    $_SESSION['sess_cart_item_optionname_5']="";
  else       
    $_SESSION['sess_cart_item_optionname_5']=implode("|",$cart_item_optionname_5);
  if (empty($cart_item_optionselection_5))
    $_SESSION['sess_cart_item_optionselection_5']="";        
  else
    $_SESSION['sess_cart_item_optionselection_5']=implode("|",$cart_item_optionselection_5);
  if (empty($cart_item_optionname_6))
    $_SESSION['sess_cart_item_optionname_6']="";
  else       
    $_SESSION['sess_cart_item_optionname_6']=implode("|",$cart_item_optionname_6);
  if (empty($cart_item_optionselection_6))
    $_SESSION['sess_cart_item_optionselection_6']="";        
  else
    $_SESSION['sess_cart_item_optionselection_6']=implode("|",$cart_item_optionselection_6);
  
  // Paypal specific
  $_SESSION['sess_cart_pp_lc']=$cart_pp_lc;  
  $_SESSION['sess_cart_pp_return']=$cart_pp_return;
  $_SESSION['sess_cart_pp_cancel_return']=$cart_pp_cancel_return;
  $_SESSION['sess_cart_pp_notify_url']=$cart_pp_notify_url;
  $_SESSION['sess_cart_pp_address_override']=$cart_pp_address_override;
  $_SESSION['sess_cart_pp_custom']=$cart_pp_custom;
  $_SESSION['sess_cart_pp_handling']=$cart_pp_handling;
  $_SESSION['sess_cart_pp_invoice']=$cart_pp_invoice;
//  $_SESSION['sess_cart_pp_shipping']=$cart_pp_shipping;
  $_SESSION['sess_cart_pp_weight_cart']=$cart_pp_weight_cart;
//  $_SESSION['sess_cart_pp_weight_unit']=$cart_pp_weight_unit;
  $_SESSION['sess_cart_pp_rm']=$cart_pp_rm;
  $_SESSION['sess_cart_pp_page_style']=$cart_pp_page_style;
  $_SESSION['sess_cart_pp_image_url']=$cart_pp_image_url;
  $_SESSION['sess_cart_pp_cpp_header_image']=$cart_pp_cpp_header_image;
  $_SESSION['sess_cart_pp_cpp_headerback_color']=$cart_pp_cpp_headerback_color;
  $_SESSION['sess_cart_pp_cpp_headerborder_color']=$cart_pp_cpp_headerborder_color;
  $_SESSION['sess_cart_pp_cpp_payflow_color']=$cart_pp_cpp_payflow_color;
  $_SESSION['sess_cart_pp_cs']=$cart_pp_cs;
  $_SESSION['sess_cart_pp_no_note']=$cart_pp_no_note;
  $_SESSION['sess_cart_pp_cn']=$cart_pp_cn;
  if (empty($cart_item_pp_no_shipping))
    $_SESSION['sess_cart_item_pp_no_shipping']="";
  else
    $_SESSION['sess_cart_item_pp_no_shipping']=implode("|",$cart_item_pp_no_shipping);
  $_SESSION['sess_cart_pp_cbt']=$cart_pp_cbt;
  if (empty($cart_item_pp_tax))
    $_SESSION['sess_cart_item_pp_tax']="";
  else
    $_SESSION['sess_cart_item_pp_tax']=implode("|",$cart_item_pp_tax);
  if (empty($cart_item_pp_tax_rate))
    $_SESSION['sess_cart_item_pp_tax_rate']="";
  else
    $_SESSION['sess_cart_item_pp_tax_rate']=implode("|",$cart_item_pp_tax_rate);
  if (empty($cart_item_pp_weight))
    $_SESSION['sess_cart_item_pp_weight']="";
  else
    $_SESSION['sess_cart_item_pp_weight']=implode("|",$cart_item_pp_weight);
  if (empty($cart_item_pp_weight_unit))
    $_SESSION['sess_cart_item_pp_weight_unit']="";
  else
    $_SESSION['sess_cart_item_pp_weight_unit']=implode("|",$cart_item_pp_weight_unit);
  if (empty($cart_item_pp_shipping))
    $_SESSION['sess_cart_item_pp_shipping']="";
  else
    $_SESSION['sess_cart_item_pp_shipping']=implode("|",$cart_item_pp_shipping);
  if (empty($cart_item_pp_shipping2))
    $_SESSION['sess_cart_item_pp_shipping2']="";
  else
    $_SESSION['sess_cart_item_pp_shipping2']=implode("|",$cart_item_pp_shipping2);
  if (empty($cart_item_pp_discount_amount))
    $_SESSION['sess_cart_item_pp_discount_amount']="";
  else
    $_SESSION['sess_cart_item_pp_discount_amount']=implode("|",$cart_item_pp_discount_amount);
  if (empty($cart_item_pp_discount_amount2))
    $_SESSION['sess_cart_item_pp_discount_amount2']="";
  else
    $_SESSION['sess_cart_item_pp_discount_amount2']=implode("|",$cart_item_pp_discount_amount2);
  if (empty($cart_item_pp_discount_rate))
    $_SESSION['sess_cart_item_pp_discount_rate']="";
  else
    $_SESSION['sess_cart_item_pp_discount_rate']=implode("|",$cart_item_pp_discount_rate);
  if (empty($cart_item_pp_discount_rate2))
    $_SESSION['sess_cart_item_pp_discount_rate2']="";
  else
    $_SESSION['sess_cart_item_pp_discount_rate2']=implode("|",$cart_item_pp_discount_rate2);
  if (empty($cart_item_pp_discount_num))
    $_SESSION['sess_cart_item_pp_discount_num']="";
  else
    $_SESSION['sess_cart_item_pp_discount_num']=implode("|",$cart_item_pp_discount_num);
  if (empty($cart_item_pp_discount_total))
    $_SESSION['sess_cart_item_pp_discount_total']="";
  else
    $_SESSION['sess_cart_item_pp_discount_total']=implode("|",$cart_item_pp_discount_total);

  if (($savecart=="1") && ($cart_numentries>0))
  {
    // Store cart data in cookie
    $cookiestr="V=3\n";    // Cookie cart storage version 1
    $cookiestr.="d0=".$_SESSION['sess_cart_total']."\n";
    $cookiestr.="d1=".$_SESSION['sess_cart_numentries']."\n";
    $cookiestr.="d2=".$_SESSION['sess_cart_numitems']."\n";
    $cookiestr.="d3=".$_SESSION['sess_cart_currency']."\n";
    $cookiestr.="d4=".$_SESSION['sess_cart_account']."\n";
    $cookiestr.="d5=".$_SESSION['sess_cart_couponcode']."\n";  
    $cookiestr.="d6=".$_SESSION['sess_cart_discount']."\n"; 
    $cookiestr.="d7=".$_SESSION['sess_cart_item_id']."\n";
    $cookiestr.="d8=".$_SESSION['sess_cart_item_image']."\n";
    $cookiestr.="d9=".$_SESSION['sess_cart_item_description']."\n";
    $cookiestr.="d10=".$_SESSION['sess_cart_item_quantity']."\n";
    $cookiestr.="d11=".$_SESSION['sess_cart_item_price']."\n";
    $cookiestr.="d12=".$_SESSION['sess_cart_item_total']."\n";
    $cookiestr.="d13=".$_SESSION['sess_cart_item_optionname_0']."\n";
    $cookiestr.="d14=".$_SESSION['sess_cart_item_optionselection_0']."\n";
    $cookiestr.="d15=".$_SESSION['sess_cart_item_optionname_1']."\n";
    $cookiestr.="d16=".$_SESSION['sess_cart_item_optionselection_1']."\n";
    $cookiestr.="d17=".$_SESSION['sess_cart_item_optionname_2']."\n";
    $cookiestr.="d18=".$_SESSION['sess_cart_item_optionselection_2']."\n";
    $cookiestr.="d19=".$_SESSION['sess_cart_item_optionname_3']."\n";
    $cookiestr.="d20=".$_SESSION['sess_cart_item_optionselection_3']."\n";
    $cookiestr.="d21=".$_SESSION['sess_cart_item_optionname_4']."\n";
    $cookiestr.="d22=".$_SESSION['sess_cart_item_optionselection_4']."\n";
    $cookiestr.="d23=".$_SESSION['sess_cart_item_optionname_5']."\n";
    $cookiestr.="d24=".$_SESSION['sess_cart_item_optionselection_5']."\n";
    $cookiestr.="d25=".$_SESSION['sess_cart_item_optionname_6']."\n";
    $cookiestr.="d26=".$_SESSION['sess_cart_item_optionselection_6']."\n";
    
    // Paypal specific
    $cookiestr.="d27=".$_SESSION['sess_cart_pp_lc']."\n";  
    $cookiestr.="d28=".$_SESSION['sess_cart_pp_return']."\n";
    $cookiestr.="d29=".$_SESSION['sess_cart_pp_cancel_return']."\n";
    $cookiestr.="d30=".$_SESSION['sess_cart_pp_notify_url']."\n";
    $cookiestr.="d31=".$_SESSION['sess_cart_pp_address_override']."\n";
    $cookiestr.="d32=".$_SESSION['sess_cart_pp_custom']."\n";
    $cookiestr.="d33=".$_SESSION['sess_cart_pp_handling']."\n";
    $cookiestr.="d34=".$_SESSION['sess_cart_pp_invoice']."\n";
    $cookiestr.="d35=".$_SESSION['sess_cart_pp_weight_cart']."\n";
    $cookiestr.="d36=".$_SESSION['sess_cart_pp_rm']."\n";
    $cookiestr.="d37=".$_SESSION['sess_cart_pp_page_style']."\n";
    $cookiestr.="d38=".$_SESSION['sess_cart_pp_image_url']."\n";
    $cookiestr.="d39=".$_SESSION['sess_cart_pp_cpp_header_image']."\n";
    $cookiestr.="d40=".$_SESSION['sess_cart_pp_cpp_headerback_color']."\n";
    $cookiestr.="d41=".$_SESSION['sess_cart_pp_cpp_headerborder_color']."\n";
    $cookiestr.="d42=".$_SESSION['sess_cart_pp_cpp_payflow_color']."\n";
    $cookiestr.="d43=".$_SESSION['sess_cart_pp_cs']."\n";
    $cookiestr.="d44=".$_SESSION['sess_cart_pp_no_note']."\n";
    $cookiestr.="d45=".$_SESSION['sess_cart_pp_cn']."\n";
    $cookiestr.="d46=".$_SESSION['sess_cart_item_pp_no_shipping']."\n";
    $cookiestr.="d47=".$_SESSION['sess_cart_pp_cbt']."\n";
    $cookiestr.="d48=".$_SESSION['sess_cart_item_pp_tax']."\n";
    $cookiestr.="d49=".$_SESSION['sess_cart_item_pp_tax_rate']."\n";
    $cookiestr.="d50=".$_SESSION['sess_cart_item_pp_weight']."\n";
    $cookiestr.="d51=".$_SESSION['sess_cart_item_pp_weight_unit']."\n";
    $cookiestr.="d52=".$_SESSION['sess_cart_item_pp_shipping']."\n";
    $cookiestr.="d53=".$_SESSION['sess_cart_item_pp_shipping2']."\n";
    $cookiestr.="d54=".$_SESSION['sess_cart_item_pp_discount_amount']."\n";
    $cookiestr.="d55=".$_SESSION['sess_cart_item_pp_discount_amount2']."\n";
    $cookiestr.="d56=".$_SESSION['sess_cart_item_pp_discount_rate']."\n";
    $cookiestr.="d57=".$_SESSION['sess_cart_item_pp_discount_rate2']."\n";
    $cookiestr.="d58=".$_SESSION['sess_cart_item_pp_discount_num']."\n";
    $cookiestr.="d59=".$_SESSION['sess_cart_item_pp_discount_total']."\n";
    $cookiestr.="d60=".$_SESSION['sess_cart_item_maxquantity']."\n";
    $cookiestr.="d61=".$_SESSION['sess_cart_item_pagelink']."\n";
    $cookiestr.="d62=".$_SESSION['sess_cart_item_minquantity']."\n";
    if (function_exists("bzcompress"))
      $cookiestr=bzcompress($cookiestr,9);
    else
    {
      if (function_exists("gzcompress"))
        $cookiestr=gzcompress($cookiestr,9);
    }  
    $cookiestr=base64_encode($cookiestr);
    $cookiestr=rawurlencode($cookiestr);
    if (strlen($cookiestr)<=4000)
      setcookie("VIBRACART",$cookiestr,2147483647,"/","");
  }
  if (($savecart=="1") && ($cart_numentries==0))
  {
    setcookie('VIBRACART', '', time()-42000, '/');
  }
  
  // If LinkKey set then we can send user IP, totaldiscount and coupon code to Linklok via custom
  if ($LinkKey!="")
  {
    // See if custom field is being used
    if ($cart_pp_custom=="")
    { 
      $custom="";
      $custom.="I=".trim(strtok($_SERVER['REMOTE_ADDR'],","));
      if ($totaldiscounts>0)  
      {
        if ($custom!="")
          $custom.=",";      
        $custom.="D=".sprintf("%01.".$decimal_places."f",$totaldiscounts);
      }  
      if ($couponfound)
      {
        if ($custom!="")
          $custom.=",";
        $custom.="C=".$cart_couponcode;          
      }  
      $custom=md5($LinkKey.$custom)."^".$custom;
      $custom=base64_encode($custom);
      $custom=rawurlencode($custom);      
      $cart_pp_custom=$custom;
    }   
    else
    {
      // If custom field used but by Linklok then we can add to it
      if (IsValidVarString($cart_pp_custom))
      {
        $custom = rawurldecode($cart_pp_custom);
        $custom = base64_decode($custom);
        $hash = strtok($custom, "^");
        $custom = strtok("^");
        if (strpos($custom,"I=")===false)
          $custom.=",I=".trim(strtok($_SERVER['REMOTE_ADDR'],","));          
        if ($totaldiscounts>0)  
          $custom.=",D=".sprintf("%01.".$decimal_places."f",$totaldiscounts);
        if ($couponfound)
          $custom.=",C=".$cart_couponcode;          
        $custom=md5($LinkKey.$custom)."^".$custom;
        $custom=base64_encode($custom);
        $custom=rawurlencode($custom);
        $cart_pp_custom=$custom;
      }      
    }
  }
  
      
  // return XML to page
  header ('Content-type: text/xml');

function is_validQuantity($n)
{
  return ( $n == strval(intval($n)) )? true : false;
}

function removeItem($num)
{
  global $cart_item_id,$cart_item_description,$cart_item_image,$cart_item_pagelink,$cart_item_maxquantity,$cart_item_minquantity,$cart_item_quantity,$cart_item_price,$cart_item_total,$cart_numentries;
  global $cart_item_optionname_0,$cart_item_optionselection_0,$cart_item_optionname_1,$cart_item_optionselection_1;
  global $cart_item_optionname_2,$cart_item_optionselection_2,$cart_item_optionname_3,$cart_item_optionselection_3;
  global $cart_item_optionname_4,$cart_item_optionselection_4,$cart_item_optionname_5,$cart_item_optionselection_5;
  global $cart_item_optionname_6,$cart_item_optionselection_6;
  global $cart_item_pp_weight,$cart_item_pp_weight_unit,$cart_item_pp_tax,$cart_item_pp_tax_rate;
  global $cart_item_pp_shipping,$cart_item_pp_shipping2,$cart_item_pp_discount_amount,$cart_item_pp_discount_amount2;
  global $cart_item_pp_discount_rate,$cart_item_pp_discount_rate2,$cart_item_pp_discount_num,$cart_item_pp_discount_total,$cart_item_pp_no_shipping;
  $cart_item_id=removeArrayElement($cart_item_id,$num);
  $cart_item_image=removeArrayElement($cart_item_image,$num);
  $cart_item_pagelink=removeArrayElement($cart_item_pagelink,$num);
  $cart_item_maxquantity=removeArrayElement($cart_item_maxquantity,$num);
  $cart_item_minquantity=removeArrayElement($cart_item_minquantity,$num);
  $cart_item_description=removeArrayElement($cart_item_description,$num);
  $cart_item_quantity=removeArrayElement($cart_item_quantity,$num);
  $cart_item_price=removeArrayElement($cart_item_price,$num);
  $cart_item_total=removeArrayElement($cart_item_total,$num);
  $cart_item_optionname_0=removeArrayElement($cart_item_optionname_0,$num);
  $cart_item_optionselection_0=removeArrayElement($cart_item_optionselection_0,$num);
  $cart_item_optionname_1=removeArrayElement($cart_item_optionname_1,$num);
  $cart_item_optionselection_1=removeArrayElement($cart_item_optionselection_1,$num);
  $cart_item_optionname_2=removeArrayElement($cart_item_optionname_2,$num);
  $cart_item_optionselection_2=removeArrayElement($cart_item_optionselection_2,$num);
  $cart_item_optionname_3=removeArrayElement($cart_item_optionname_3,$num);
  $cart_item_optionselection_3=removeArrayElement($cart_item_optionselection_3,$num);
  $cart_item_optionname_4=removeArrayElement($cart_item_optionname_4,$num);
  $cart_item_optionselection_4=removeArrayElement($cart_item_optionselection_4,$num);
  $cart_item_optionname_5=removeArrayElement($cart_item_optionname_5,$num);
  $cart_item_optionselection_5=removeArrayElement($cart_item_optionselection_5,$num);
  $cart_item_optionname_6=removeArrayElement($cart_item_optionname_6,$num);
  $cart_item_optionselection_6=removeArrayElement($cart_item_optionselection_6,$num);
  $cart_item_pp_tax=removeArrayElement($cart_item_pp_tax,$num);
  $cart_item_pp_tax_rate=removeArrayElement($cart_item_pp_tax_rate,$num);
  $cart_item_pp_weight=removeArrayElement($cart_item_pp_weight,$num);
  $cart_item_pp_weight_unit=removeArrayElement($cart_item_pp_weight_unit,$num);
  $cart_item_pp_shipping=removeArrayElement($cart_item_pp_shipping,$num);
  $cart_item_pp_shipping2=removeArrayElement($cart_item_pp_shipping2,$num);
  $cart_item_pp_discount_amount=removeArrayElement($cart_item_pp_discount_amount,$num);
  $cart_item_pp_discount_amount2=removeArrayElement($cart_item_pp_discount_amount2,$num);
  $cart_item_pp_discount_rate=removeArrayElement($cart_item_pp_discount_rate,$num);
  $cart_item_pp_discount_rate2=removeArrayElement($cart_item_pp_discount_rate2,$num);
  $cart_item_pp_discount_num=removeArrayElement($cart_item_pp_discount_num,$num);
  $cart_item_pp_discount_total=removeArrayElement($cart_item_pp_discount_total,$num);
  $cart_item_pp_no_shipping=removeArrayElement($cart_item_pp_no_shipping,$num);
  $cart_numentries--;
}
 
function removeArrayElement($arr,$num)
{
  $index=0;
  for ($k=0;$k<count($arr);$k++)
  {
    if ($k!=$num)
    { 
      $newarr[$index]=$arr[$k];
      $index++;
    }
  }
  return($newarr); 
}

function makeXmlFriendly($s)
{
  $s=str_replace("&","&amp;",$s);
  $s=str_replace("<","&lt;",$s);
  $s=str_replace(">","&gt;",$s);
  $s=str_replace("\"","&quot;",$s);
  $s=str_replace("'","&apos;",$s);
  return($s);
}
function findCartEntry($id,$name,$on0,$os0,$on1,$os1,$on2,$os2,$on3,$os3,$on4,$os4,$on5,$os5,$on6,$os6)
{
  global $cart_item_id,$cart_item_description;
  global $cart_item_optionname_0,$cart_item_optionselection_0,$cart_item_optionname_1,$cart_item_optionselection_1;
  global $cart_item_optionname_2,$cart_item_optionselection_2,$cart_item_optionname_3,$cart_item_optionselection_3;
  global $cart_item_optionname_4,$cart_item_optionselection_4,$cart_item_optionname_5,$cart_item_optionselection_5;
  global $cart_item_optionname_6,$cart_item_optionselection_6;
  if ($id!="")
    $keysarray=array_keys($cart_item_id,$id);
  else  
    $keysarray=array_keys($cart_item_description,$name);
  if (!empty($keysarray))
  { 
    for ($k=0;$k<count($keysarray);$k++)
    { 
      $pos=$keysarray[$k];  
      // Now check that any options match as well if not handle a separate product
      if (($cart_item_optionname_0[$pos]==$on0) &&
      ($cart_item_optionselection_0[$pos]==$os0) &&
      ($cart_item_optionname_1[$pos]==$on1) &&
      ($cart_item_optionselection_1[$pos]==$os1) &&
      ($cart_item_optionname_2[$pos]==$on2) &&
      ($cart_item_optionselection_2[$pos]==$os2) &&
      ($cart_item_optionname_3[$pos]==$on3) &&
      ($cart_item_optionselection_3[$pos]==$os3) &&
      ($cart_item_optionname_4[$pos]==$on4) &&
      ($cart_item_optionselection_4[$pos]==$os4) &&
      ($cart_item_optionname_5[$pos]==$on5) &&
      ($cart_item_optionselection_5[$pos]==$os5) &&
      ($cart_item_optionname_6[$pos]==$on6) &&
      ($cart_item_optionselection_6[$pos]==$os6))
      {
        return($pos);
      }
    }
  }
  return(-1);
}

function discount_Amount($amount,$quantity,$discount_amount,$discount_amount2,$discount_rate,$discount_rate2,$discount_num)
{
  global $decimal_places,$decimal_separator,$thousand_separator;
  $discounttotal=0;
  $returnarray['discounttotal']=0;
  $returnarray['price']=sprintf("%01.".$decimal_places."f",round($amount,$decimal_places));
  $returnarray['quantity']=$quantity;
  $returnarray['pricedisc1']=0;
  $returnarray['quantitydisc1']=0;
  $returnarray['pricedisc2']=0;
  $returnarray['quantitydisc2']=0;
  if ($discount_amount!="")
  {
    $discounttotal=sprintf("%01.".$decimal_places."f",round($discount_amount,$decimal_places));
    $returnarray['pricedisc1']=sprintf("%01.".$decimal_places."f",round($amount-$discount_amount,$decimal_places));
    $returnarray['quantitydisc1']=1;
    $returnarray['quantity']=$returnarray['quantity']-1;       
    if (($discount_amount2!="") && ($discount_amount2>0) && ($quantity>1))
    {
      $disc2qty=$quantity-1;
      if ($discount_num!="")
      {
       if ($disc2qty>$discount_num)
         $disc2qty=$discount_num;              
      }
      $discountitem=sprintf("%01.".$decimal_places."f",round($discount_amount2*$disc2qty,$decimal_places));
      $discounttotal=$discounttotal+$discountitem;            
      $returnarray['pricedisc2']=sprintf("%01.".$decimal_places."f",round($amount-$discount_amount2,$decimal_places));
      $returnarray['quantitydisc2']=$disc2qty;
      $returnarray['quantity']=$returnarray['quantity']-$disc2qty;               
    }
  }
  if ($discount_rate!="")
  {
    $discounttotal=sprintf("%01.".$decimal_places."f",round(($discount_rate/100)*$amount,$decimal_places));
    $returnarray['pricedisc1']=sprintf("%01.".$decimal_places."f",round($amount-$discounttotal,$decimal_places));
    $returnarray['quantitydisc1']=1;
    $returnarray['quantity']=$returnarray['quantity']-1;       
    if (($discount_rate2!="") && ($discount_rate2>0) && ($quantity>1))
    {
      $disc2qty=$quantity-1;
      if ($discount_num!="")
      {
       if ($disc2qty>$discount_num)
         $disc2qty=$discount_num;              
      }
      $discountitem=round(($discount_rate2/100)*$amount,$decimal_places);
      $discountitem=round($discountitem*$disc2qty,$decimal_places);      
      $discounttotal=$discounttotal+$discountitem;
      $returnarray['pricedisc2']=sprintf("%01.".$decimal_places."f",round($amount-round(($discount_rate2/100)*$amount,$decimal_places),$decimal_places));
      $returnarray['quantitydisc2']=$disc2qty;
      $returnarray['quantity']=$returnarray['quantity']-$disc2qty;               
    }          
  }
  $discounttotal=sprintf("%01.".$decimal_places."f",$discounttotal);
  $returnarray['discounttotal']=$discounttotal; 
  return($returnarray);                             
}

function ApplyCartDiscounts()
{
 global $cart_total,$cart_numitems,$cart_couponcode;
 global $ordertotaldiscountpercent,$ordertotaldiscountamount,$orderqtydiscountpercent,$orderqtydiscountamount;
 global $couponfound,$cart_totalfordiscount,$cart_numitemsfordiscount,$ordertotaldiscountpercentlimit;
 $disval=0;
 $ctotal=$carttotal;
 $enteredccode=strtolower(trim($cart_couponcode));
 // Process ordertotaldiscountpercent
 for ($k=0;$k<count($ordertotaldiscountpercent);$k++)
 {
   // Split discount settings into parts   
   $parts=explode(",",$ordertotaldiscountpercent[$k]);
   $percent=trim($parts[0]);
   $minval=trim($parts[1]);
   $ccode=str_replace(" ","",$parts[2]);
   if ($ccode!="")
   {
     if (!CheckCoupon($enteredccode,$ccode))
       continue;  
     $couponfound=true;  
   }  
   if ($cart_totalfordiscount>=$minval)
   {
     $dis=$cart_totalfordiscount*($percent/100);
     if ($dis>$disval)
       $disval=$dis;
   }
 }

 // Process ordertotaldiscountamount
 for ($k=0;$k<count($ordertotaldiscountamount);$k++)
 {
   // Split discount settings into parts   
   $parts=explode(",",$ordertotaldiscountamount[$k]);
   $amount=trim($parts[0]);
   $minval=trim($parts[1]);
   $ccode=str_replace(" ","",$parts[2]);
   if ($ccode!="")
   {
     if (!CheckCoupon($enteredccode,$ccode))
       continue;  
     $couponfound=true;  
   }  
   if ($cart_totalfordiscount>=$minval)
   {
     $dis=$amount;
     if ($dis>$disval)
       $disval=$dis;
   }
 }

 // Process orderqtydiscountpercent
 for ($k=0;$k<count($orderqtydiscountpercent);$k++)
 {
   // Split discount settings into parts   
   $parts=explode(",",$orderqtydiscountpercent[$k]);
   $percent=trim($parts[0]);
   $minval=trim($parts[1]);
   $ccode=str_replace(" ","",$parts[2]);
   if ($ccode!="")
   {
     if (!CheckCoupon($enteredccode,$ccode))
       continue;  
     $couponfound=true;  
   }  
   if ($cart_numitemsfordiscount>=$minval)
   {
     $dis=$cart_totalfordiscount*($percent/100);
     if ($dis>$disval)
       $disval=$dis;
   }
 }

 // Process orderqtydiscountamount
 for ($k=0;$k<count($orderqtydiscountamount);$k++)
 {
   // Split discount settings into parts   
   $parts=explode(",",$orderqtydiscountamount[$k]);
   $amount=trim($parts[0]);
   $minval=trim($parts[1]);
   $ccode=str_replace(" ","",$parts[2]);
   if ($ccode!="")
   {
     if (!CheckCoupon($enteredccode,$ccode))
       continue;  
     $couponfound=true;  
   }  
   if ($cart_numitemsfordiscount>=$minval)
   {
     $dis=$amount;
     if ($dis>$disval)
       $disval=$dis;
   }
 }
  
 // Process ordertotaldiscountpercentlimit
 for ($k=0;$k<count($ordertotaldiscountpercentlimit);$k++)
 {
   // Split discount settings into parts   
   $parts=explode(",",$ordertotaldiscountpercentlimit[$k]);
   $percent=trim($parts[0]);
   $minval=trim($parts[1]);
   $maxval=trim($parts[2]);
   $ccode=str_replace(" ","",$parts[3]);
   if ($ccode!="")
   {
     if (!CheckCoupon($enteredccode,$ccode))
       continue;  
     $couponfound=true;  
   }  
   if ($cart_totalfordiscount>=$minval)
   {
     $dis=$cart_totalfordiscount*($percent/100);
     if ($dis>$maxval)
       $dis=$maxval;
     if ($dis>$disval)
       $disval=$dis;
   }
 }

 return($disval);
}

function ApplyItemDiscounts()
{
  global $cart_numentries,$cart_item_id,$cart_item_quantity,$cart_item_total,$cart_item_price,$decimal_places,$decimal_separator,$thousand_separator;
  global $cart_item_pp_discount_amount,$cart_item_pp_discount_amount2,$cart_item_pp_discount_rate,$cart_item_pp_discount_rate2;
  global $cart_item_pp_discount_total,$cart_couponcode;
  global $itemqtydiscountpercent,$itemqtydiscountamount,$multiqtydiscountpercent,$multiqtydiscountamount,$combiqtydiscountpercent,$combiqtydiscountamount;
  global $multitotaldiscountpercent,$multitotaldiscountamount,$bogodiscountpercent,$bogodiscountamount;
  global $couponfound;
  $enteredccode=strtolower(trim($cart_couponcode));
  // First we need to get quantity and total of each item id (we ignore options) and also set a discount amount for each.
  // As options are used in the cart there may be several entries with the same item_number but different options.
  $itemdisval=array();
  $itemcount=array();
  $itemprice=array();  
  $itemtotal=array();
  for ($k=0;$k<$cart_numentries;$k++)
  {
    $itemdisval[$k]=0.00;  // This is entry based rather than item id based
    if ($cart_item_id[$k]!="")
    {
      if (!isset($itemcount[$cart_item_id[$k]]))
      {
        $itemcount[$cart_item_id[$k]]=$cart_item_quantity[$k];
        $itemtotal[$cart_item_id[$k]]=$cart_item_total[$k];
        $itemprice[$cart_item_id[$k]]=$cart_item_price[$k];
      }  
      else
      {
        $itemcount[$cart_item_id[$k]]+=$cart_item_quantity[$k];
        $itemtotal[$cart_item_id[$k]]+=$cart_item_total[$k];
        $itemprice[$cart_item_id[$k]]+=$cart_item_price[$k];
      }  
    }
  }
  
  // Process itemqtydiscountpercent
  for ($k=0;$k<count($itemqtydiscountpercent);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$itemqtydiscountpercent[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $percent=trim($parts[1]);
    $minqty=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    for ($j=0;$j<count($prodids);$j++)
    {
      if ($itemcount[$prodids[$j]]>=$minqty)
      {
        SetItemDiscountPercent($prodids[$j],$percent,$itemdisval);
      }
    }
  }

  // Process itemqtydiscountamount
  for ($k=0;$k<count($itemqtydiscountamount);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$itemqtydiscountamount[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $amount=trim($parts[1]);
    $minqty=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    for ($j=0;$j<count($prodids);$j++)
    {
      if ($itemcount[$prodids[$j]]>=$minqty)
      {
        SetItemDiscountAmount($prodids[$j],$amount,$itemdisval);
      }
    }
  }

  // Process multiqtydiscountpercent
  for ($k=0;$k<count($multiqtydiscountpercent);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$multiqtydiscountpercent[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $percent=trim($parts[1]);
    $minqty=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",$parts[3]);
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    $totqty=0;
    for ($j=0;$j<count($prodids);$j++)
    {
      $totqty+=$itemcount[$prodids[$j]];
    }
    if ($totqty>=$minqty)
    {
      for ($j=0;$j<count($prodids);$j++)
      {
        SetItemDiscountPercent($prodids[$j],$percent,$itemdisval);
      }  
    }
  }

  // Process multiqtydiscountamount
  for ($k=0;$k<count($multiqtydiscountamount);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$multiqtydiscountamount[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $amount=trim($parts[1]);
    $minqty=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    $totqty=0;
    for ($j=0;$j<count($prodids);$j++)
    {
      $totqty+=$itemcount[$prodids[$j]];
    }
    if ($totqty>=$minqty)
    {
      for ($j=0;$j<count($prodids);$j++)
      {
        SetItemDiscountAmount($prodids[$j],$amount,$itemdisval);
      }  
    }
  } 
  
  // Process multitotaldiscountpercent
  for ($k=0;$k<count($multitotaldiscountpercent);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$multitotaldiscountpercent[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $percent=trim($parts[1]);
    $minamount=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    $tot=0;
    for ($j=0;$j<count($prodids);$j++)
    {
      $tot+=$itemtotal[$prodids[$j]];
    }
    if ($tot>=$minamount)
    {
      for ($j=0;$j<count($prodids);$j++)
      {
        SetItemDiscountPercent($prodids[$j],$percent,$itemdisval);
      }  
    }
  }

  // Process multitotaldiscountamount
  for ($k=0;$k<count($multitotaldiscountamount);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$multitotaldiscountamount[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $amount=trim($parts[1]);
    $minamount=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    $tot=0;
    for ($j=0;$j<count($prodids);$j++)
    {
      $tot+=$itemtotal[$prodids[$j]];
    }
    if ($tot>=$minamount)
    {
      for ($j=0;$j<count($prodids);$j++)
      {
        SetItemDiscountAmount($prodids[$j],$amount,$itemdisval);
      }  
    }
  }
  
  // Process combiqtydiscountpercent
  for ($k=0;$k<count($combiqtydiscountpercent);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$combiqtydiscountpercent[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $percent=trim($parts[1]);
    $minqty=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    $match=true;
    for ($j=0;$j<count($prodids);$j++)
    {
      if ($itemcount[$prodids[$j]]<$minqty)
      {
        $match=false;
        break;
      }
    }
    if ($match)
    {
      for ($j=0;$j<count($prodids);$j++)
      {
        SetItemDiscountPercent($prodids[$j],$percent,$itemdisval);
      }  
    }
  }

  // Process combiqtydiscountamount
  for ($k=0;$k<count($combiqtydiscountamount);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$combiqtydiscountamount[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $amount=trim($parts[1]);
    $minqty=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    $match=true;
    for ($j=0;$j<count($prodids);$j++)
    {
      if ($itemcount[$prodids[$j]]<$minqty)
      {
        $match=false;
        break;
      }
    }
    if ($match)
    {
      for ($j=0;$j<count($prodids);$j++)
      {
        SetItemDiscountAmount($prodids[$j],$amount,$itemdisval);
      }  
    }
  }

  // Process bogodiscountpercent
  for ($k=0;$k<count($bogodiscountpercent);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$bogodiscountpercent[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $number=trim($parts[1]);
    $number++;
    $percent=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    // See how many matching items purchased and put them in price order with lowest first.
    $tot=0;
    $prodprices=array();
    $prodid=array();
    $prodindex=array();
    for ($j=0;$j<$cart_numentries;$j++)
    {
      if (false===array_search($cart_item_id[$j],$prodids))
        continue;          
      $prodprices[]=$cart_item_price[$j];
      $prodid[]=$cart_item_id[$j];
      $prodindex[]=$j;
      $tot=$tot+$cart_item_quantity[$j];
    }
    array_multisort($prodprices,$prodid,$prodindex);
    // See how many discounts applicable
    $numdisc=intval($tot/$number);
    if ($numdisc>0)
    {
      // loop around each matching cart entry
      for ($j=0;$j<count($prodindex);$j++)
      {
        $i=$prodindex[$j];
        $discprice=$cart_item_price[$i]-($cart_item_price[$i]*($percent/100));
        if ($numdisc>=$cart_item_quantity[$i])
        {
          $newitemprice=sprintf("%01.".$decimal_places."f",$discprice);
          $amount=$cart_item_price[$i]-$newitemprice;
          if ($amount>$itemdisval[$i])
            $itemdisval[$i]=$amount;
          $numdisc=$numdisc-$cart_item_quantity[$i]; 
        }
        else
        {
          $newitemtotal=($numdisc*$discprice)+(($cart_item_quantity[$i]-$numdisc)*$cart_item_price[$i]);
          $newitemprice=$newitemtotal/$cart_item_quantity[$i];
          $amount=$cart_item_price[$i]-$newitemprice;
          if ($amount>$itemdisval[$i])
            $itemdisval[$i]=$amount;
          $numdisc=0;
        }
        if ($numdisc<=0)
          break;
      }
//      if ($numdisc<=0)
//      break;
    }
  }    

  // Process bogodiscountamount
  for ($k=0;$k<count($bogodiscountamount);$k++)
  {
    // Split discount settings into parts   
    $parts=explode(",",$bogodiscountamount[$k]);
    $prodid=preg_replace("/\s+:\s+/",":",trim($parts[0]));
    $number=trim($parts[1]);
    $number++;
    $discamount=trim($parts[2]);
    $ccode=preg_replace("/\s+:\s+/",":",trim($parts[3]));
    // Split coupon codes
    if ($ccode!="")
    {
      if (!CheckCoupon($enteredccode,$ccode))
        continue;  
      $couponfound=true;  
    }
    $prodids=explode(":",$prodid);
    // See how many matching items purchased and put them in price order with lowest first.
    $tot=0;
    $prodprices=array();
    $prodid=array();
    $prodindex=array();
    for ($j=0;$j<$cart_numentries;$j++)
    {
      if (false===array_search($cart_item_id[$j],$prodids))
        continue;          
      $prodprices[]=$cart_item_price[$j];
      $prodid[]=$cart_item_id[$j];
      $prodindex[]=$j;
      $tot=$tot+$cart_item_quantity[$j];
    }
    array_multisort($prodprices,$prodid,$prodindex);
    // See how many discounts applicable
    $numdisc=intval($tot/$number);
    if ($numdisc>0)
    {
      // loop around each matching cart entry
      for ($j=0;$j<count($prodindex);$j++)
      {
        $i=$prodindex[$j];
        $discprice=$cart_item_price[$i]-$discamount;
        if ($numdisc>=$cart_item_quantity[$i])
        {
          $newitemprice=sprintf("%01.".$decimal_places."f",$discprice);
          $amount=$cart_item_price[$i]-$newitemprice;
          if ($amount>$itemdisval[$i])
            $itemdisval[$i]=$amount;
          $numdisc=$numdisc-$cart_item_quantity[$i]; 
        }
        else
        {
          $newitemtotal=($numdisc*$discprice)+(($cart_item_quantity[$i]-$numdisc)*$cart_item_price[$i]);
          $newitemprice=$newitemtotal/$cart_item_quantity[$i];
          $amount=$cart_item_price[$i]-$newitemprice;
          if ($amount>$itemdisval[$i])
            $itemdisval[$i]=$amount;
          $numdisc=0;
        }
        if ($numdisc<=0)
          break;
      }
//      if ($numdisc<=0)
//        break;
    }
  }    


  $totaldiscounts=0;
  // Apply the discounts for each product entry
  for ($k=0;$k<$cart_numentries;$k++)
  {
    if ($itemdisval[$k]>0)
    {
      $cart_item_pp_discount_amount[$k]=sprintf("%01.".$decimal_places."f",$itemdisval[$k]);
      $cart_item_pp_discount_amount2[$k]=sprintf("%01.".$decimal_places."f",$itemdisval[$k]);;
      $cart_item_pp_discount_rate[$k]=="";      
      $cart_item_pp_discount_rate2[$k]=="";
    }
    else
    {
      $cart_item_pp_discount_amount[$k]="";
      $cart_item_pp_discount_amount2[$k]="";
      $cart_item_pp_discount_rate[$k]=="";      
      $cart_item_pp_discount_rate2[$k]=="";    
    }        
    $discarray=discount_Amount($cart_item_price[$k],$cart_item_quantity[$k],$cart_item_pp_discount_amount[$k],$cart_item_pp_discount_amount2[$k],$cart_item_pp_discount_rate[$k],$cart_item_pp_discount_rate2[$k],$cart_item_pp_discount_num[$k]);
    $cart_item_pp_discount_total[$k]=$discarray['discounttotal'];
    $cart_item_total[$k]=$cart_item_quantity[$k]*$cart_item_price[$k];
    $cart_item_total[$k]=$cart_item_total[$k]-$discarray['discounttotal'];
    $cart_item_total[$k]=sprintf("%01.".$decimal_places."f",$cart_item_total[$k]);
    $totaldiscounts=$totaldiscounts+$discarray['discounttotal']; 
  }
  return($totaldiscounts);
}

function CheckCoupon($enteredccode,$ccode)
{
  $ccode=trim($ccode);
  $ccode=preg_replace("/\s+:\s+/",":",$ccode);
  $ccode=strtolower($ccode);
  $ccodes=explode(":",$ccode);  
  if (false===array_search($enteredccode, $ccodes))
    return(false);
  return(true);  
}

function SetItemDiscountPercent($prodid,$rate,&$itemdisval)
{
  global $cart_numentries,$cart_item_id,$cart_item_price;
  for ($k=0;$k<$cart_numentries;$k++)
  {
    if ($cart_item_id[$k]==$prodid)
    {
      $dis=$cart_item_price[$k]*($rate/100);
      if ($dis>$itemdisval[$k])
        $itemdisval[$k]=$dis;
    }  
  }
}

function SetItemDiscountAmount($prodid,$amount,&$itemdisval)
{
  global $cart_numentries,$cart_item_id,$cart_item_price;
  for ($k=0;$k<$cart_numentries;$k++)
  {
    if ($cart_item_id[$k]==$prodid)
    {
      $dis=$amount;
      if ($dis>$itemdisval[$k])
        $itemdisval[$k]=$dis;
    }  
  }
}

function IsValidVarString($s)
{
  global $LinkKey;
  $s = rawurldecode($s);
  $s = base64_decode($s);
  $hash = strtok($s, "^");
  $s = strtok("^");
  if ($hash != md5($LinkKey . $s))
    return(false);
  return(true);
}

if ($cart_couponcode=="")
  $cart_couponcode="no coupon";

$cart_discount_amount=$cart_discount;  
if ($cart_discount=="")
  $cart_discount="0";
else
  $cart_discount="-".$currency_symbol.number_format($cart_discount,$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2;
  
// See if orderupdate.php exists whch can contain shipping calculations etc.
if (file_exists("orderupdate.php"))
  require_once("orderupdate.php");         
?>
<cart>
  <errormessage><?php echo $errormessage; ?></errormessage>
  <numentries><?php echo $cart_numentries; ?></numentries>
  <numitems><?php echo $cart_numitems; ?></numitems>
  <cartdiscount><?php echo makeXmlFriendly($cart_discount); ?></cartdiscount>
  <couponitem><?php echo makeXmlFriendly($cart_couponcode); ?></couponitem>
  <carttotal><?php echo makeXmlFriendly($currency_symbol.number_format($cart_total,$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2); ?></carttotal>
  <carttotalnumeric><?php echo makeXmlFriendly(number_format($cart_total,$decimal_places,$decimal_separator,$thousand_separator)); ?></carttotalnumeric>
  <itemtoshow><?php echo $itemtoshow; ?></itemtoshow>
<?php for ($k=0;$k<$cart_numentries;$k++) {
$itempricestr="";
$discarray=discount_Amount($cart_item_price[$k],$cart_item_quantity[$k],$cart_item_pp_discount_amount[$k],$cart_item_pp_discount_amount2[$k],$cart_item_pp_discount_rate[$k],$cart_item_pp_discount_rate2[$k],$cart_item_pp_discount_num[$k]);    
if ($discarray['quantity']>0)
  $itempricestr.=$discarray['quantity'].$discountQuantityOperator.$currency_symbol.number_format($discarray['price'],$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2;
if ($discarray['pricedisc1']==$discarray['pricedisc2'])
{
  if (($discarray['quantitydisc1']+$discarray['quantitydisc2'])>0)
  {
    if ($itempricestr!="")
      $itempricestr.=$discountPriceSeparator;
    $itempricestr.=($discarray['quantitydisc1']+$discarray['quantitydisc2']).$discountQuantityOperator.$currency_symbol.number_format($discarray['pricedisc1'],$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2;
  }      
}
else
{  
  if ($discarray['quantitydisc1']>0)
  {
    if ($itempricestr!="")
      $itempricestr.=$discountPriceSeparator;
    $itempricestr.=$discarray['quantitydisc1'].$discountQuantityOperator.$currency_symbol.number_format($discarray['pricedisc1'],$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2;
  }      
  if ($discarray['quantitydisc2']>0)
  {
    if ($itempricestr!="")
      $itempricestr.=$discountPriceSeparator;
    $itempricestr.=$discarray['quantitydisc2'].$discountQuantityOperator.$currency_symbol.number_format($discarray['pricedisc2'],$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2;
  }
}
?>
  <item>
    <id><?php echo makeXmlFriendly($cart_item_id[$k]); ?></id>
    <description><?php echo makeXmlFriendly("<p class=\"vibracart_itemdescription\">".$cart_item_description[$k]."</p>"); ?>
<?php if ($cart_item_id[$k]!="") 
{
if ($cart_item_pagelink[$k]!="")
{
  if ($productpagelinktarget!="")
    echo makeXmlFriendly("<div class=\"vibracart_itemidclear\"></div><p class=\"vibracart_itemid\"><a class=\"vibracart_itemid\" href=\"".$cart_item_pagelink[$k]."\" target=\"".$productpagelinktarget."\">".$idPrefix.$cart_item_id[$k].$idSuffix."</a></p>");
  else
    echo makeXmlFriendly("<div class=\"vibracart_itemidclear\"></div><p class=\"vibracart_itemid\"><a class=\"vibracart_itemid\" href=\"".$cart_item_pagelink[$k]."\">".$idPrefix.$cart_item_id[$k].$idSuffix."</a></p>");
}  
else
  echo makeXmlFriendly("<div class=\"vibracart_itemidclear\"></div><p class=\"vibracart_itemid\">".$idPrefix.$cart_item_id[$k].$idSuffix."</p>"); 
}?>
<?php if ($cart_item_optionname_0[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$cart_item_optionname_0[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_0[$k]."</p>");  ?>
<?php if ($cart_item_optionname_1[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear2\"></div><p class=\"vibracart_itemoptionname2\">".$optionSeparator.$cart_item_optionname_1[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection2\"> ".$cart_item_optionselection_1[$k]."</p>");  ?>
<?php if ($cart_item_optionname_2[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear3\"></div><p class=\"vibracart_itemoptionname3\">".$optionSeparator.$cart_item_optionname_2[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection3\"> ".$cart_item_optionselection_2[$k]."</p>");  ?>
<?php if ($cart_item_optionname_3[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear4\"></div><p class=\"vibracart_itemoptionname4\">".$optionSeparator.$cart_item_optionname_3[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection4\"> ".$cart_item_optionselection_3[$k]."</p>");  ?>
<?php if ($cart_item_optionname_4[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear5\"></div><p class=\"vibracart_itemoptionname5\">".$optionSeparator.$cart_item_optionname_4[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection5\"> ".$cart_item_optionselection_4[$k]."</p>");  ?>
<?php if ($cart_item_optionname_5[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear6\"></div><p class=\"vibracart_itemoptionname6\">".$optionSeparator.$cart_item_optionname_5[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection6\"> ".$cart_item_optionselection_5[$k]."</p>");  ?>
<?php if ($cart_item_optionname_6[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear7\"></div><p class=\"vibracart_itemoptionname7\">".$optionSeparator.$cart_item_optionname_6[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection7\"> ".$cart_item_optionselection_6[$k]."</p>");  ?>
<?php if ($cart_item_optionname_7[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_7[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_7[$k]."</p>");  ?>
<?php if ($cart_item_optionname_8[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_8[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_8[$k]."</p>");  ?>
<?php if ($cart_item_optionname_9[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_9[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_9[$k]."</p>");  ?>
<?php if ($cart_item_optionname_10[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_10[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_10[$k]."</p>");  ?>
<?php if ($cart_item_optionname_11[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_11[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_11[$k]."</p>");  ?>
<?php if ($cart_item_optionname_12[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_12[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_12[$k]."</p>");  ?>
<?php if ($cart_item_optionname_13[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_13[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_13[$k]."</p>");  ?>
<?php if ($cart_item_optionname_14[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_14[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_14[$k]."</p>");  ?>
<?php if ($cart_item_optionname_15[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_15[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_15[$k]."</p>");  ?>
<?php if ($cart_item_optionname_16[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_16[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_16[$k]."</p>");  ?>
<?php if ($cart_item_optionname_17[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_17[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_17[$k]."</p>");  ?>
<?php if ($cart_item_optionname_18[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_18[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_18[$k]."</p>");  ?>
<?php if ($cart_item_optionname_19[$k]!="") echo makeXmlFriendly("<div class=\"vibracart_itemoptionclear1\"></div><p class=\"vibracart_itemoptionname1\">".$optionSeparator.$cart_item_optionname_19[$k].$optionValueSeparator."</p><p class=\"vibracart_itemoptionselection1\"> ".$cart_item_optionselection_19[$k]."</p>");  ?>
<?php if ($itempricestr!="") echo makeXmlFriendly("<div class=\"vibracart_itempriceclear\"></div><p class=\"vibracart_itemprice\">".$itempricestr."</p>");  ?>
    </description>
    <quantity><?php echo $cart_item_quantity[$k]; ?></quantity>   
    <price><?php echo makeXmlFriendly($itempricestr); ?></price>
    <total><?php echo makeXmlFriendly($currency_symbol.number_format($cart_item_total[$k],$decimal_places,$decimal_separator,$thousand_separator).$currency_symbol2); ?></total>
    <image><?php if ($cart_item_image[$k]!="") echo $cart_item_image[$k]; else echo "null"; ?></image>  
  </item>
<?php } ?>
<checkoutform>
<![CDATA[
<?php
    print "<input type=\"hidden\" name=\"cmd\" value=\"_cart\">\n"; 
    print "<input type=\"hidden\" name=\"upload\" value=\"1\">\n";
    if ($charset!="")
      print "<input type=\"hidden\" name=\"charset\" value=\"".$charset."\">\n"; 
    if ($usesandbox!="") 
      print "<input type=\"hidden\" name=\"business\" value=\"".$usesandbox."\">\n";
    else
      print "<input type=\"hidden\" name=\"business\" value=\"".$cart_account."\">\n";    
    print "<input type=\"hidden\" name=\"currency_code\" value=\"".$cart_currency."\">\n";
    if ($cart_pp_lc!="")
      print "<input type=\"hidden\" name=\"lc\" value=\"".$cart_pp_lc."\">\n";
    if ($cart_pp_return!="")
      print "<input type=\"hidden\" name=\"return\" value=\"".$cart_pp_return."\">\n";
    if ($cart_pp_cancel_return!="")
      print "<input type=\"hidden\" name=\"cancel_return\" value=\"".$cart_pp_cancel_return."\">\n";
    if ($cart_pp_notify_url!="")
      print "<input type=\"hidden\" name=\"notify_url\" value=\"".$cart_pp_notify_url."\">\n";
    if ($cart_pp_address_override!="")
      print "<input type=\"hidden\" name=\"address_override\" value=\"".$cart_pp_address_override."\">\n";
    if ($cart_pp_custom!="")
      print "<input type=\"hidden\" name=\"custom\" value=\"".$cart_pp_custom."\">\n";
    if ($cart_pp_handling!="")
      print "<input type=\"hidden\" name=\"handling_cart\" value=\"".$cart_pp_handling."\">\n";
    if ($cart_pp_invoice!="")
      print "<input type=\"hidden\" name=\"invoice\" value=\"".$cart_pp_invoice."\">\n";
//    if ($cart_pp_shipping!="")
//      print "<input type=\"hidden\" name=\"shipping\" value=\"".$cart_pp_shipping."\">\n"; 

    if ((isset($shippingcharge)) && ($shippingcharge>0))
      print "<input type=\"hidden\" name=\"handling_cart\" value=\"".$shippingcharge."\">\n";

    if ($cart_pp_weight_cart!="")
      print "<input type=\"hidden\" name=\"weight_cart\" value=\"".$cart_pp_weight_cart."\">\n";
//    if ($cart_pp_weight_unit!="")
//      print "<input type=\"hidden\" name=\"weight_unit\" value=\"".$cart_pp_weight_unit."\">\n";
    if ($cart_pp_rm!="")
      print "<input type=\"hidden\" name=\"rm\" value=\"".$cart_pp_rm."\">\n";
    if ($cart_pp_page_style!="")
      print "<input type=\"hidden\" name=\"page_style\" value=\"".$cart_pp_page_style."\">\n";
    if ($cart_pp_image_url!="")
      print "<input type=\"hidden\" name=\"image_url\" value=\"".$cart_pp_image_url."\">\n";
    if ($cart_pp_cpp_header_image!="")
      print "<input type=\"hidden\" name=\"cpp_header_image\" value=\"".$cart_pp_cpp_header_image."\">\n";
    if ($cart_pp_cpp_headerback_color!="")
      print "<input type=\"hidden\" name=\"cpp_headerback_color\" value=\"".$cart_pp_cpp_headerback_color."\">\n";
    if ($cart_pp_cpp_headerborder_color!="")
      print "<input type=\"hidden\" name=\"cpp_headerborder_color\" value=\"".$cart_pp_headerborder_color."\">\n";
    if ($cart_pp_cpp_payflow_color!="")
      print "<input type=\"hidden\" name=\"cpp_payflow_color\" value=\"".$cart_pp_cpp_payflow_color."\">\n";
    if ($cart_pp_cs!="")
      print "<input type=\"hidden\" name=\"cs\" value=\"".$cart_pp_cs."\">\n";
    if ($cart_pp_no_note!="")
      print "<input type=\"hidden\" name=\"no_note\" value=\"".$cart_pp_no_note."\">\n";
    if ($cart_pp_cn!="")
      print "<input type=\"hidden\" name=\"cn\" value=\"".$cart_pp_cn."\">\n";
      
    // no_shipping is item based but needs to be sent to Paypal once for the order
    // If any has 2 then use 2. If not then if any item has 0 then use 0. If not if any item has 1 then use 1.
    $noshippingtouse="";
    for ($k=0;$k<$cart_numentries;$k++)
    {
      if ($cart_item_pp_no_shipping[$k]=="2")
        $noshippingtouse="2";    
      if (($cart_item_pp_no_shipping[$k]=="0") && (($noshippingtouse=="") || ($noshippingtouse=="1")))
        $noshippingtouse="0";    
      if (($cart_item_pp_no_shipping[$k]=="1") && ($noshippingtouse==""))
        $noshippingtouse="1";    
    }  
    if ($noshippingtouse!="")
      print "<input type=\"hidden\" name=\"no_shipping\" value=\"".$noshippingtouse."\">\n";
    if ($cart_pp_cbt!="")
      print "<input type=\"hidden\" name=\"cbt\" value=\"".$cart_pp_cbt."\">\n";
    if ($cart_discount_amount!="")
      print "<input type=\"hidden\" name=\"discount_amount_cart\" value=\"".sprintf("%01.".$decimal_places."f",$cart_discount_amount)."\">\n";
    for ($k=0;$k<$cart_numentries;$k++)
    {
      if ($cart_item_pp_discount_total[$k]==0)
        $cart_item_pp_discount_total[$k]="";
      if ($cart_item_id[$k]!="")   
        print "<input type=\"hidden\" name=\"item_number_".($k+1)."\" value=\"".$cart_item_id[$k]."\">\n";
      print "<input type=\"hidden\" name=\"item_name_".($k+1)."\" value=\"".$cart_item_description[$k]."\">\n";
      if ($cart_discount_amount=="")
      {
        if ($cart_item_pp_discount_total[$k]=="")
        { 
          print "<input type=\"hidden\" name=\"amount_".($k+1)."\" value=\"".sprintf("%01.".$decimal_places."f",$cart_item_price[$k])."\">\n";
        }
        if (($cart_item_pp_discount_total[$k]!="") && ($cart_item_pp_discount_total[$k]<($cart_item_price[$k]*$cart_item_quantity[$k])))
        {   
          print "<input type=\"hidden\" name=\"amount_".($k+1)."\" value=\"".sprintf("%01.".$decimal_places."f",$cart_item_price[$k])."\">\n";
          print "<input type=\"hidden\" name=\"discount_amount_".($k+1)."\" value=\"".sprintf("%01.".$decimal_places."f",$cart_item_pp_discount_total[$k])."\">\n";
        }
        if (($cart_item_pp_discount_total[$k]!="") && ($cart_item_pp_discount_total[$k]>=($cart_item_price[$k]*$cart_item_quantity[$k])))
        {   
          print "<input type=\"hidden\" name=\"amount_".($k+1)."\" value=\"".sprintf("%01.".$decimal_places."f",0)."\">\n";
        }
        
      }
      else
      {
        $newitemprice=$cart_item_price[$k];
        if ($cart_item_pp_discount_total[$k]!="")
        {
          $newitemprice=$cart_item_price[$k]-($cart_item_pp_discount_total[$k]/$cart_item_quantity[$k]);
        }
        print "<input type=\"hidden\" name=\"amount_".($k+1)."\" value=\"".sprintf("%01.".$decimal_places."f",$newitemprice)."\">\n";      
      }  
      print "<input type=\"hidden\" name=\"quantity_".($k+1)."\" value=\"".$cart_item_quantity[$k]."\">\n";
      if (($cart_item_pp_tax[$k]!="") && ($cart_item_pp_tax[$k]>0))   
        print "<input type=\"hidden\" name=\"tax_".($k+1)."\" value=\"".$cart_item_pp_tax[$k]."\">\n";
      if (($cart_item_pp_tax_rate[$k]!="") &&  ($cart_item_pp_tax_rate[$k]>0))
        print "<input type=\"hidden\" name=\"tax_rate_".($k+1)."\" value=\"".$cart_item_pp_tax_rate[$k]."\">\n";
 
      if ($cart_item_pp_weight[$k]!="")   
        print "<input type=\"hidden\" name=\"weight_".($k+1)."\" value=\"".$cart_item_pp_weight[$k]."\">\n";
      if ($cart_item_pp_weight_unit[$k]!="")   
        print "<input type=\"hidden\" name=\"weight_unit_".($k+1)."\" value=\"".$cart_item_pp_weight_unit[$k]."\">\n";
      if ($cart_item_pp_shipping[$k]!="")   
        print "<input type=\"hidden\" name=\"shipping_".($k+1)."\" value=\"".$cart_item_pp_shipping[$k]."\">\n";
      if ($cart_item_pp_shipping2[$k]!="")   
        print "<input type=\"hidden\" name=\"shipping2_".($k+1)."\" value=\"".$cart_item_pp_shipping2[$k]."\">\n";
      if ($cart_item_optionname_0[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on0_".($k+1)."\" value=\"".$cart_item_optionname_0[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os0_".($k+1)."\" value=\"".$cart_item_optionselection_0[$k]."\">\n";
      }
      if ($cart_item_optionname_1[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on1_".($k+1)."\" value=\"".$cart_item_optionname_1[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os1_".($k+1)."\" value=\"".$cart_item_optionselection_1[$k]."\">\n";
      }
      if ($cart_item_optionname_2[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on2_".($k+1)."\" value=\"".$cart_item_optionname_2[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os2_".($k+1)."\" value=\"".$cart_item_optionselection_2[$k]."\">\n";
      }
      if ($cart_item_optionname_3[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on3_".($k+1)."\" value=\"".$cart_item_optionname_3[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os3_".($k+1)."\" value=\"".$cart_item_optionselection_3[$k]."\">\n";
      }
      if ($cart_item_optionname_4[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on4_".($k+1)."\" value=\"".$cart_item_optionname_4[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os4_".($k+1)."\" value=\"".$cart_item_optionselection_4[$k]."\">\n";
      }
      if ($cart_item_optionname_5[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on5_".($k+1)."\" value=\"".$cart_item_optionname_5[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os5_".($k+1)."\" value=\"".$cart_item_optionselection_5[$k]."\">\n";
      }
      if ($cart_item_optionname_6[$k]!="")
      {   
        print "<input type=\"hidden\" name=\"on6_".($k+1)."\" value=\"".$cart_item_optionname_6[$k]."\">\n";
        print "<input type=\"hidden\" name=\"os6_".($k+1)."\" value=\"".$cart_item_optionselection_6[$k]."\">\n";
      }
    }
?>
]]>
</checkoutform>
</cart>