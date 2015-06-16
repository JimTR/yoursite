// **************************************************************************************************
// Vibracart Paypal V2.1
// Copyright (c) 2010-2014 Vibralogix
// www.vibralogix.com
// sales@vibralogix.com
// You are licensed to use this product on one domain and with one Paypal account only.
// Please contact us for extra licenses if required.
// **************************************************************************************************
var IE6 = (navigator.appVersion.indexOf("MSIE 6.")==-1) ? false : true;
var IE7 = (navigator.appVersion.indexOf("MSIE 7.")==-1) ? false : true;
var IE8 = (navigator.appVersion.indexOf("MSIE 8.")==-1) ? false : true;
var ANDROID = (navigator.userAgent.indexOf("Android")==-1) ? false : true;

if (cart_url.charAt(cart_url.length-1)!="/")
  cart_url=cart_url+"/"
if ((IE6) && (IE6usegif))
{
  emptyCartImage=swapTogGif(emptyCartImage)
  deleteButton=swapTogGif(deleteButton)
  closeButton=swapTogGif(closeButton)
  updateButton=swapTogGif(updateButton)
  continueButton=swapTogGif(continueButton)  
  checkoutButton=swapTogGif(checkoutButton)
  applyButton=swapTogGif(applyButton)  
  busyImage=swapTogGif(busyImage)
  widgetbackground=swapTogGif(widgetbackground)
  widgetimage=swapTogGif(widgetimage)
  animateitemimage=swapTogGif(animateitemimage)
}
// Set defaults for new variables that may not be set
if(typeof(usesandbox)=='undefined')
  var usesandbox=''
if(typeof(showTerms)=='undefined')
  var showTerms=false
if(typeof(showTerms2)=='undefined')
  var showTerms2=false
if(typeof(showTerms3)=='undefined')
  var showTerms3=false
if(typeof(showCoupon)=='undefined')
  var showCoupon=false  
if(typeof(cart_height_terms)=='undefined')
  var cart_height_terms=20
if(typeof(showItemImage)=='undefined')
  var showItemImage=false
if(typeof(usejavascriptalert)=='undefined')
  var usejavascriptalert=false
if(typeof(msg_checkout)=='undefined')
  var msg_checkout=''
if(typeof(messagedelay)=='undefined')
  var messagedelay=2000
if(typeof(errordelay)=='undefined')
  var errordelay=2000
if(typeof(itemquantitylimit)=='undefined')
  var itemquantitylimit=0
if(typeof(msg_itemquantity)=='undefined')
  var msg_itemquantity=''
if(typeof(cartquantitylimit)=='undefined')
  var cartquantitylimit=0
if(typeof(msg_cartquantity)=='undefined')
  var msg_cartquantity=''  
if(typeof(itemquantityminlimit)=='undefined')
  var itemquantityminlimit=0
if(typeof(msg_itemminquantity)=='undefined')
  var msg_itemminquantity=''
if(typeof(cartquantityminlimit)=='undefined')
  var cartquantityminlimit=0
if(typeof(msg_cartminquantity)=='undefined')
  var msg_cartminquantity=''
if(typeof(msg_cartminquantity)=='undefined')
  var msg_cartminquantity=''
if(typeof(carttotalminlimit)=='undefined')
  var carttotalminlimit=0
if(typeof(msg_cartmintotal)=='undefined')
  var msg_cartmintotal=''
if(typeof(carttotalmaxlimit)=='undefined')
  var carttotalmaxlimit=0
if(typeof(msg_cartmaxtotal)=='undefined')
  var msg_cartmaxtotal=''    
if(typeof(discounttext)=='undefined')
  var discounttext=''
if(typeof(showCoupon)=='undefined')
  var showCoupon=false
if(typeof(cart_height_coupon)=='undefined')
  var cart_height_coupon=25
if(typeof(couponinputtext)=='undefined')
  var couponinputtext=''
if(typeof(coupontext)=='undefined')
  var coupontext=''
if(typeof(msg_couponnotvalid)=='undefined')
  var msg_couponnotvalid=''
if(typeof(pageFade)=='undefined')
  var pageFade=false
if(typeof(savecart)=='undefined')
  var savecart=false
if (savecart)
  savecart=1;
else
  savecart=0;    
if(typeof(animateitem)=='undefined')
  var animateitem=false
if(typeof(animateitemimage)=='undefined')
  var animateitemimage=''
if(typeof(animateitemimage)=='')
  var animateitem=false
if(typeof(animateitemspeed)=='undefined')
  var animateitemspeed=5
if(typeof(animateitemstep)=='undefined')
  var animateitemstep=25  
if(typeof(checkoutpage)=='undefined')
  var checkoutpage=''
if(typeof(escapeclosescart)=='undefined')
  var escapeclosescart=false
if(typeof(autoProductPageLink)=='undefined')
  var autoProductPageLink=false
if(typeof(productPageTarget)=='undefined')
  var productPageTarget=""
if(typeof(cartTitle)=='undefined')
  var cartTitle=""
if(typeof(checkouttarget)=='undefined')
  var checkouttarget=""
  
  
cart_height_content=cart_height-cart_height_header-cart_height_footer
if (showTerms)
  cart_height_content=cart_height_content-cart_height_terms
if (showTerms2)
  cart_height_content=cart_height_content-cart_height_terms2
if (showTerms3)
  cart_height_content=cart_height_content-cart_height_terms3
if (showCoupon)
  cart_height_content=cart_height_content-cart_height_coupon
optionValueSeparator=optionValueSeparator.replace(/&/g, '%26')
optionSeparator=optionSeparator.replace(/&/g, '%26')
idPrefix=idPrefix.replace(/&/g, '%26')
idSuffix=idSuffix.replace(/&/g, '%26')
discountPriceSeparator=discountPriceSeparator.replace(/&/g, '%26')
discountQuantityOperator=discountQuantityOperator.replace(/&/g, '%26')
var cart_item_quantity  = new Array()
var cart_item_image  = new Array()
var cart_item_description  = new Array()
var cart_item_total  = new Array()
var cart_numentries
var cart_discount
var cart_couponitem
var cart_total
var cart_currency_symbol
var cart_busy=false
var cart_animating=false
var cart_needs_refresh=true
var cart_fulltextdata=""
var cartinline=false
if (cartposition=="static")
  cartinline=true  
if ((ANDROID) && (cartposition=="fixed"))
  cartposition="scroll"
var pageisfaded=false
  
var cartmousex=0
var cartmousey=0
var animitemcurx=0
var animitemcury=0
var animitemincx=0
var animitemincy=0
var animitemstep=0
var animitemtimerid=0
var animiteminaction=false
var animitemoffsetx=1234
var animitemoffsety=1234 

  
//if (!cartinline)
//  startcart()

function fadedPageClicked()
{
  if ((pageFade) && (pageisfaded))
    hideCart()  
}
 
function cart_escpress(e)  
{
  var vibracartdiv=document.getElementById("vibracart")
  if (vibracartdiv.style.visibility != 'visible')
    return
  e = e || event;
  key = e.which || e.keyCode;
  if(key == 27)  
  {
    hideCart()  
    cart_StopEvent(e)
  }  
} 

function cart_qtyretpressed(e)  
{
  e = e || event;
  key = e.which || e.keyCode;
  if(key == 13)  
  {
    updateQuantity()  
    cart_StopEvent(e)
  }  
} 

function cart_couponretpressed(e)  
{
  e = e || event;
  key = e.which || e.keyCode;
  if(key == 13)  
  {
    applyCoupon()  
    cart_StopEvent(e)
  }  
} 
  
function startcart()
{
  if ((!cartinline) || (null!=document.getElementById("insertcarthere")))
  {
    if((!IE6) && (!IE7))
      insertcartinpage()
    else
      insertcart()        
  }  
  addButtonListener("")
  // Add ESC key event if required
  if (escapeclosescart)
    cart_addEvent(document.body, 'keydown',cart_escpress , false)
  var vibracartdiv=document.getElementById("vibracart")
  if (cartposition=="fixed")
  {
    if (IE6)
    {
      vibracartdiv.style.position="absolute"
      document.getElementById("vibracartwaiting").style.position="absolute"
      document.getElementById("vibracartalert").style.position="absolute"
    }
    else
    {
      vibracartdiv.style.position="fixed"
      document.getElementById("vibracartwaiting").style.position="fixed"
      document.getElementById("vibracartalert").style.position="fixed"
    }
  }
  if (cartposition=="static")
  {
    vibracartdiv.style.position="static"
    document.getElementById("vibracartwaiting").style.position="absolute"
    document.getElementById("vibracartalert").style.position="absolute"
  }
  if (cartposition=="scroll")
  {
    vibracartdiv.style.position="absolute"
    document.getElementById("vibracartwaiting").style.position="absolute"
    document.getElementById("vibracartalert").style.position="absolute"
  }
  vibracartdiv.style.height="0px"
  vibracartdiv.style.width="0px"
  document.getElementById("vibracart_header").style.height=cart_height_header+"px"
  document.getElementById("vibracart_footer").style.height=cart_height_footer+"px"
  document.getElementById("vibracart_content").style.height=cart_height_content+"px"
  
  if ((IE7) || (IE6))
    document.getElementById("cartTable").style.width=(cart_width-20)+"px"
  
  if (use_widget)
  {
    if((!IE6) && (!IE7))
    {
      var html2dom_root = document.createElement('div');
      html2dom_root_1_div = document.createElement("div");
      html2dom_root_1_div.setAttribute("class", "vibracart_widget");
      html2dom_root_1_div.setAttribute("id", "vibracart_widget");
      html2dom_root_1_div_1_text = document.createTextNode("\n");
      html2dom_root_1_div.appendChild(html2dom_root_1_div_1_text);
      html2dom_root_1_div_2_p = document.createElement("p");
      html2dom_root_1_div_2_p.setAttribute("class", "vibracart_widget_image");
      html2dom_root_1_div_2_p_1_img = document.createElement("img");
      html2dom_root_1_div_2_p_1_img.setAttribute("class", "vibracart_widget_image");
      html2dom_root_1_div_2_p_1_img.setAttribute("src", cart_url+widgetimage);
      html2dom_root_1_div_2_p_1_img.setAttribute("onClick", "showCart();");
      html2dom_root_1_div_2_p.appendChild(html2dom_root_1_div_2_p_1_img);
      html2dom_root_1_div.appendChild(html2dom_root_1_div_2_p);
      html2dom_root_1_div_3_text = document.createTextNode("\n");
      html2dom_root_1_div.appendChild(html2dom_root_1_div_3_text);
      html2dom_root_1_div_4_p = document.createElement("p");
      html2dom_root_1_div_4_p.setAttribute("class", "vibracart_widget_items");
      html2dom_root_1_div_4_p.setAttribute("id", "vibracart_widget_items");
      html2dom_root_1_div_4_p_1_text = document.createTextNode("Updating");
      html2dom_root_1_div_4_p.appendChild(html2dom_root_1_div_4_p_1_text);
      html2dom_root_1_div.appendChild(html2dom_root_1_div_4_p);
      html2dom_root_1_div_5_text = document.createTextNode("\n");
      html2dom_root_1_div.appendChild(html2dom_root_1_div_5_text);
      html2dom_root_1_div_6_p = document.createElement("p");
      html2dom_root_1_div_6_p.setAttribute("class", "vibracart_widget_total");
      html2dom_root_1_div_6_p.setAttribute("id", "vibracart_widget_total");
      html2dom_root_1_div_6_p_1_text = document.createTextNode("&nbsp");
      html2dom_root_1_div_6_p.appendChild(html2dom_root_1_div_6_p_1_text);
      html2dom_root_1_div.appendChild(html2dom_root_1_div_6_p);
      html2dom_root_1_div_7_text = document.createTextNode("\n");
      html2dom_root_1_div.appendChild(html2dom_root_1_div_7_text);
      html2dom_root_1_div_8_p = document.createElement("p");
      html2dom_root_1_div_8_p.setAttribute("class", "vibracart_widget_view");
      html2dom_root_1_div_8_p_1_a = document.createElement("a");
      html2dom_root_1_div_8_p_1_a.setAttribute("href", "null");
      html2dom_root_1_div_8_p_1_a.setAttribute("class", "vibracart_widget_view");
      html2dom_root_1_div_8_p_1_a.setAttribute("onclick", "showCart(); return(false)");
      html2dom_root_1_div_8_p_1_a_1_text = document.createTextNode("View");
      html2dom_root_1_div_8_p_1_a.appendChild(html2dom_root_1_div_8_p_1_a_1_text);
      html2dom_root_1_div_8_p.appendChild(html2dom_root_1_div_8_p_1_a);
      html2dom_root_1_div.appendChild(html2dom_root_1_div_8_p);
      html2dom_root_1_div_9_text = document.createTextNode("\n");
      html2dom_root_1_div.appendChild(html2dom_root_1_div_9_text);
      html2dom_root_1_div_10_p = document.createElement("p");
      html2dom_root_1_div_10_p.setAttribute("class", "vibracart_widget_check");
      html2dom_root_1_div_10_p_1_a = document.createElement("a");
      html2dom_root_1_div_10_p_1_a.setAttribute("href", "null");
      html2dom_root_1_div_10_p_1_a.setAttribute("class", "vibracart_widget_check");
      html2dom_root_1_div_10_p_1_a.setAttribute("onClick", "checkOut(); return(false)");
      html2dom_root_1_div_10_p_1_a_1_text = document.createTextNode("Checkout");
      html2dom_root_1_div_10_p_1_a.appendChild(html2dom_root_1_div_10_p_1_a_1_text);
      html2dom_root_1_div_10_p.appendChild(html2dom_root_1_div_10_p_1_a);
      html2dom_root_1_div.appendChild(html2dom_root_1_div_10_p);
      html2dom_root_1_div_11_text = document.createTextNode("\n");
      html2dom_root_1_div.appendChild(html2dom_root_1_div_11_text);
      html2dom_root.appendChild(html2dom_root_1_div);
      html2dom_root_2_text = document.createTextNode("\n");
      html2dom_root.appendChild(html2dom_root_2_text);
  
      bodyobj=document.getElementsByTagName('body')[0]
      bodyobj.appendChild(html2dom_root)
    }
    else
    {
      // Old browser support
      document.write("<div class='vibracart_widget' id=\"vibracart_widget\">\n")
      document.write("<p class=\"vibracart_widget_image\"><img class=\"vibracart_widget_image\" src=\""+cart_url+widgetimage+"\" onClick=\"showCart();\"></p>\n")
      document.write("<p class=\"vibracart_widget_items\" id=\"vibracart_widget_items\">Updating</p>\n")
      document.write("<p class=\"vibracart_widget_total\" id=\"vibracart_widget_total\">&nbsp;</p>\n")
      document.write("<p class=\"vibracart_widget_view\"><a href=\"\" class=\"vibracart_widget_view\" onclick=\"showCart(); return(false)\">View</a></p>\n")
      document.write("<p class=\"vibracart_widget_check\"><a href=\"\" class=\"vibracart_widget_check\" onClick='checkOut(); return(false)'>Checkout</a></p>\n")
      document.write("</div>\n")      
    }
    var widgetdiv=document.getElementById("vibracart_widget")
    widgetdiv.style.backgroundImage="url("+cart_url+widgetbackground+")"
    if (IE6)
      widgetdiv.style.position="absolute"    
    widgetdiv.style.height=widget_height+"px"
    widgetdiv.style.width=widget_width+"px"
    var lefttouse=widget_left
    var toptouse=widget_top 
    var iebody=(document.compatMode && document.compatMode != "BackCompat")? document.documentElement : document.body
    var dsocleft=document.all? iebody.scrollLeft : pageXOffset
    var dsoctop=document.all? iebody.scrollTop : pageYOffset
    var dsocheight = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
    var dsocwidth = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth; 
  // for CSS absolute
  //  if (widget_left==-1)
  //    lefttouse=Math.floor((dsocwidth-widget_width)/2)+dsocleft
  //  if (widget_top==-1)  
  //    toptouse=Math.floor((dsocheight-widget_height)/2)+dsoctop
  // for CSS fixed
    if (widget_left==-1)
      lefttouse=Math.floor((dsocwidth-widget_width)/2)
    if (widget_left==-2)
      lefttouse=Math.floor(dsocwidth-widget_width)
    if (widget_left<-2)
      lefttouse=Math.floor(dsocwidth-widget_width+widget_left)
    if (widget_top==-1)  
      toptouse=Math.floor((dsocheight-widget_height)/2)
    if (widget_top==-2)  
      toptouse=Math.floor(dsocheight-widget_height)
    if (widget_top<-2)  
      toptouse=Math.floor(dsocheight-widget_height+widget_top)
    widgetdiv.style.left=lefttouse+"px"
    widgetdiv.style.top=toptouse+"px"
  }
//  if ((use_widget) || (document.getElementById("showitemcount"))  || (document.getElementById("showcarttotal")))
//  {
    // Refresh data from server so that we can display items qty and total in widget
    postdata="cart_todo=getcart&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
    // Update cart contents from server
    var xmlhttp = new XMLHttpRequest()
    xmlhttp.open('POST',cart_url+'cart.php',true)
    xmlhttp.onreadystatechange = function()
    {
      if (xmlhttp.readyState==4)
      {
        var cart_errormessage=""
        if (xmlhttp.status == 200)
        {
          cart_errormessage=updateFromXML(xmlhttp)
          updateCartTable()
          if ((initiallyshowemptywidget) && (use_widget))
            widgetdiv.style.visibility = 'visible'
        }
        showWaiting(false)
        cart_busy=false
        if (cart_errormessage!="")
          displayMessage(cart_errormessage)
  if ((showcartatstart) && (!hidecartifempty))
    showCart()
  if ((showcartatstart) && (hidecartifempty) && (cart_numentries>0))
    showCart()
          
      }   
    }
    cart_busy=true
    cart_needs_refresh=false;    
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.send(postdata)  
//  }
//  if ((showcartatstart) && (!hidecartifempty))
//    showCart()
//  if ((showcartatstart) && (hidecartifempty) && (cart_numentries>0))
//    showCart()
}
//cart_addEvent(window, 'load', addListeners, false);

function insertcart()
{
  // This function is for backward compatibility. insertcartinpage() is used now instead.
  document.write("<form id=\"vibracartform\" name=\"vibracartform\" action=\"\">\n")
  document.write("<div class='vibracart' id='vibracart' >\n")
  document.write("<div class='vibracart_header' id='vibracart_header'>\n")
  if (cartTitle!="")
    document.write("<div class='vibracart_title' id='vibracart_title'>"+cartTitle+"</div>\n")
  if (closeButton!="")
    document.write("<div class='vibracart_closebutton'><img src='"+cart_url+closeButton+"' alt='Close' class='vibracart_closebutton' onClick='hideCart();'></div>\n")
  document.write("</div>\n")
  document.write("<div class='vibracart_content' id='vibracart_content'>\n")
  document.write("<table class='vibracart_table' id='cartTable'>\n")
  document.write("</table>\n")
  document.write("</div>\n")
  if (showTerms)
    document.write("<div class='vibracart_terms' id='vibracart_terms'><div class='vibracart_termscheckbox'><input class='vibracart_termscheckbox' type='checkbox' name='terms' value='termsagreed'></div><div class='vibracart_termslink'><a class='vibracart_termslink' href='"+termspage+"' target='"+termstarget+"'>"+termstext+"</a></div></div>\n")
  if (showTerms2)
    document.write("<div class='vibracart_terms' id='vibracart_terms2'><div class='vibracart_termscheckbox'><input class='vibracart_termscheckbox' type='checkbox' name='terms2' value='termsagreed2'></div><div class='vibracart_termslink'><a class='vibracart_termslink' href='"+termspage2+"' target='"+termstarget2+"'>"+termstext2+"</a></div></div>\n")
  if (showTerms3)
    document.write("<div class='vibracart_terms' id='vibracart_terms3'><div class='vibracart_termscheckbox'><input class='vibracart_termscheckbox' type='checkbox' name='terms3' value='termsagreed3'></div><div class='vibracart_termslink'><a class='vibracart_termslink' href='"+termspage3+"' target='"+termstarget3+"'>"+termstext3+"</a></div></div>\n")
  if (showCoupon)
    document.write("<div class='vibracart_coupon' id='vibracart_coupon'><div class='vibracart_coupontextbox'><input class='vibracart_coupontextbox' type='text' name='coupon' value='"+couponinputtext+"' onfocus='if(this.value == couponinputtext) {this.value = \"\";}' onblur='if (this.value == \"\") {this.value = couponinputtext;}' onkeydown='cart_couponretpressed(event);' ></div><div class='vibracart_applybutton'><img src='"+cart_url+applyButton+"' alt='Apply Coupon' class='vibracart_applybutton' onClick='applyCoupon();'></div></div>\n")
  document.write("<div class='vibracart_footer' id='vibracart_footer'>")
  if (continueButton!='')
    document.write("<div class='vibracart_continuebutton'><img src='"+cart_url+continueButton+"' alt='Continue Shopping' class='vibracart_continuebutton' onClick='hideCart();'></div>")
  if (updateButton!='')
    document.write("<div class='vibracart_updatebutton'><img src='"+cart_url+updateButton+"' alt='Recalculate' class='vibracart_updatebutton' onClick='updateQuantity();'></div>")
  document.write("<div class='vibracart_checkoutbutton'><img src='"+cart_url+checkoutButton+"' alt='Checkout' class='vibracart_checkoutbutton' onClick='checkOut();'></div><div class='vibracart_total'><span id='vibracarttotal'>0.00</span></div></div>\n")
  document.write("</div>\n")
  document.write("<div class='vibracart_waiting' id='vibracartwaiting'></div>\n")
  document.write("<div class='vibracart_alert' id='vibracartalert'></div>\n")
  document.write("</form>\n")
  if (checkoutpage=="")
  {
    if (usesandbox!="")
      document.write("<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' name='paypalform' id='paypalform'>\n")
      else
      document.write("<form action='https://www.paypal.com/cgi-bin/webscr' method='post' name='paypalform' id='paypalform'>\n")  
  }  
  else
    document.write("<form action='"+checkoutpage+"' method='post' name='paypalform' id='paypalform'>\n")  
  document.write("</form>\n")
  if (animateitem)
  {  
    document.write("<div id='flyingitem' style='position:absolute; left: 0px; top: 0px;' ><img src='"+cart_url+animateitemimage+"' ></div>\n")
    document.getElementById("flyingitem").style.visibility='hidden'
  }  
//touchScroll('vibracart_content');
}

function insertcartinpage()
{
  var html2dom_root = document.createElement('div');
  html2dom_root_1_text = document.createTextNode("\n");
  html2dom_root.appendChild(html2dom_root_1_text);
  html2dom_root_2_form = document.createElement("form");
  html2dom_root_2_form.setAttribute("name", "vibracartform");
  html2dom_root_2_form.setAttribute("id", "vibracartform");
  html2dom_root_2_form.setAttribute("action", "null");
  html2dom_root_2_form_1_text = document.createTextNode("\n");
  html2dom_root_2_form.appendChild(html2dom_root_2_form_1_text);
  html2dom_root_2_form_2_div = document.createElement("div");
  html2dom_root_2_form_2_div.setAttribute("class", "vibracart");
  html2dom_root_2_form_2_div.setAttribute("id", "vibracart");
  html2dom_root_2_form_2_div_1_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_1_text);
  html2dom_root_2_form_2_div_2_div = document.createElement("div");
  html2dom_root_2_form_2_div_2_div.setAttribute("class", "vibracart_header");
  html2dom_root_2_form_2_div_2_div.setAttribute("id", "vibracart_header");
  html2dom_root_2_form_2_div_2_div_1_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div_2_div.appendChild(html2dom_root_2_form_2_div_2_div_1_text);
 
  if (cartTitle!="")
  {
    html2dom_root_2_form_2_div_2_div_1_div = document.createElement("div");
    html2dom_root_2_form_2_div_2_div_1_div.setAttribute("class", "vibracart_title");
    html2dom_root_2_form_2_div_2_div_1_div.setAttribute("id", "vibracart_title");
    html2dom_root_2_form_2_div_2_div_1_div_text = document.createTextNode(cartTitle);
    html2dom_root_2_form_2_div_2_div_1_div.appendChild(html2dom_root_2_form_2_div_2_div_1_div_text);
    html2dom_root_2_form_2_div_2_div.appendChild(html2dom_root_2_form_2_div_2_div_1_div);
  }
    
  if (closeButton!="")
  {
    html2dom_root_2_form_2_div_2_div_2_div = document.createElement("div");
    html2dom_root_2_form_2_div_2_div_2_div.setAttribute("class", "vibracart_closebutton");
    html2dom_root_2_form_2_div_2_div_2_div_1_img = document.createElement("img");
    html2dom_root_2_form_2_div_2_div_2_div_1_img.setAttribute("src", cart_url+closeButton);
    html2dom_root_2_form_2_div_2_div_2_div_1_img.setAttribute("alt", "Close");
    html2dom_root_2_form_2_div_2_div_2_div_1_img.setAttribute("class", "vibracart_closebutton");
    html2dom_root_2_form_2_div_2_div_2_div_1_img.setAttribute("onClick", "hideCart();");
    html2dom_root_2_form_2_div_2_div_2_div.appendChild(html2dom_root_2_form_2_div_2_div_2_div_1_img);
    html2dom_root_2_form_2_div_2_div.appendChild(html2dom_root_2_form_2_div_2_div_2_div);
    html2dom_root_2_form_2_div_2_div_3_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div_2_div.appendChild(html2dom_root_2_form_2_div_2_div_3_text);
  }

  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_2_div);
  html2dom_root_2_form_2_div_3_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_3_text);
 
  html2dom_root_2_form_2_div_4_div = document.createElement("div");
  html2dom_root_2_form_2_div_4_div.setAttribute("class", "vibracart_content");
  html2dom_root_2_form_2_div_4_div.setAttribute("id", "vibracart_content");
  html2dom_root_2_form_2_div_4_div_1_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div_4_div.appendChild(html2dom_root_2_form_2_div_4_div_1_text);
  html2dom_root_2_form_2_div_4_div_2_table = document.createElement("table");
  html2dom_root_2_form_2_div_4_div_2_table.setAttribute("class", "vibracart_table");
  html2dom_root_2_form_2_div_4_div_2_table.setAttribute("id", "cartTable");
  html2dom_root_2_form_2_div_4_div_2_table_1_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div_4_div_2_table.appendChild(html2dom_root_2_form_2_div_4_div_2_table_1_text);
  html2dom_root_2_form_2_div_4_div.appendChild(html2dom_root_2_form_2_div_4_div_2_table);
  html2dom_root_2_form_2_div_4_div_3_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div_4_div.appendChild(html2dom_root_2_form_2_div_4_div_3_text);
  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_4_div);
  html2dom_root_2_form_2_div_5_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_5_text);
  if (showTerms)
  {
    html2dom_root_2_form_2_div_6_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div.setAttribute("class", "vibracart_terms");
    html2dom_root_2_form_2_div_6_div.setAttribute("id", "vibracart_terms");
    html2dom_root_2_form_2_div_6_div_1_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div_1_div.setAttribute("class", "vibracart_termscheckbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input = document.createElement("input");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("class", "vibracart_termscheckbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("type", "checkbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("name", "terms");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("value", "termsagreed");
    html2dom_root_2_form_2_div_6_div_1_div.appendChild(html2dom_root_2_form_2_div_6_div_1_div_1_input);
    html2dom_root_2_form_2_div_6_div.appendChild(html2dom_root_2_form_2_div_6_div_1_div);
    html2dom_root_2_form_2_div_6_div_2_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div_2_div.setAttribute("class", "vibracart_termslink");
    html2dom_root_2_form_2_div_6_div_2_div_1_a = document.createElement("a");
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("class", "vibracart_termslink");
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("href", termspage);
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("target", termstarget);
    html2dom_root_2_form_2_div_6_div_2_div_1_a_1_text = document.createTextNode(termstext);
    html2dom_root_2_form_2_div_6_div_2_div_1_a.appendChild(html2dom_root_2_form_2_div_6_div_2_div_1_a_1_text);
    html2dom_root_2_form_2_div_6_div_2_div.appendChild(html2dom_root_2_form_2_div_6_div_2_div_1_a);
    html2dom_root_2_form_2_div_6_div.appendChild(html2dom_root_2_form_2_div_6_div_2_div);
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_6_div);
    html2dom_root_2_form_2_div_7_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_7_text);
  }
  if (showTerms2)
  {
    html2dom_root_2_form_2_div_6_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div.setAttribute("class", "vibracart_terms");
    html2dom_root_2_form_2_div_6_div.setAttribute("id", "vibracart_terms2");
    html2dom_root_2_form_2_div_6_div_1_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div_1_div.setAttribute("class", "vibracart_termscheckbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input = document.createElement("input");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("class", "vibracart_termscheckbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("type", "checkbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("name", "terms2");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("value", "termsagreed2");
    html2dom_root_2_form_2_div_6_div_1_div.appendChild(html2dom_root_2_form_2_div_6_div_1_div_1_input);
    html2dom_root_2_form_2_div_6_div.appendChild(html2dom_root_2_form_2_div_6_div_1_div);
    html2dom_root_2_form_2_div_6_div_2_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div_2_div.setAttribute("class", "vibracart_termslink");
    html2dom_root_2_form_2_div_6_div_2_div_1_a = document.createElement("a");
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("class", "vibracart_termslink");
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("href", termspage2);
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("target", termstarget2);
    html2dom_root_2_form_2_div_6_div_2_div_1_a_1_text = document.createTextNode(termstext2);
    html2dom_root_2_form_2_div_6_div_2_div_1_a.appendChild(html2dom_root_2_form_2_div_6_div_2_div_1_a_1_text);
    html2dom_root_2_form_2_div_6_div_2_div.appendChild(html2dom_root_2_form_2_div_6_div_2_div_1_a);
    html2dom_root_2_form_2_div_6_div.appendChild(html2dom_root_2_form_2_div_6_div_2_div);
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_6_div);
    html2dom_root_2_form_2_div_7_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_7_text);
  }
  if (showTerms3)
  {
    html2dom_root_2_form_2_div_6_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div.setAttribute("class", "vibracart_terms");
    html2dom_root_2_form_2_div_6_div.setAttribute("id", "vibracart_terms3");
    html2dom_root_2_form_2_div_6_div_1_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div_1_div.setAttribute("class", "vibracart_termscheckbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input = document.createElement("input");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("class", "vibracart_termscheckbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("type", "checkbox");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("name", "terms3");
    html2dom_root_2_form_2_div_6_div_1_div_1_input.setAttribute("value", "termsagreed3");
    html2dom_root_2_form_2_div_6_div_1_div.appendChild(html2dom_root_2_form_2_div_6_div_1_div_1_input);
    html2dom_root_2_form_2_div_6_div.appendChild(html2dom_root_2_form_2_div_6_div_1_div);
    html2dom_root_2_form_2_div_6_div_2_div = document.createElement("div");
    html2dom_root_2_form_2_div_6_div_2_div.setAttribute("class", "vibracart_termslink");
    html2dom_root_2_form_2_div_6_div_2_div_1_a = document.createElement("a");
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("class", "vibracart_termslink");
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("href", termspage3);
    html2dom_root_2_form_2_div_6_div_2_div_1_a.setAttribute("target", termstarget3);
    html2dom_root_2_form_2_div_6_div_2_div_1_a_1_text = document.createTextNode(termstext3);
    html2dom_root_2_form_2_div_6_div_2_div_1_a.appendChild(html2dom_root_2_form_2_div_6_div_2_div_1_a_1_text);
    html2dom_root_2_form_2_div_6_div_2_div.appendChild(html2dom_root_2_form_2_div_6_div_2_div_1_a);
    html2dom_root_2_form_2_div_6_div.appendChild(html2dom_root_2_form_2_div_6_div_2_div);
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_6_div);
    html2dom_root_2_form_2_div_7_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_7_text);
  }
  if (showCoupon)
  {
    html2dom_root_2_form_2_div_8_div = document.createElement("div");
    html2dom_root_2_form_2_div_8_div.setAttribute("class", "vibracart_coupon");
    html2dom_root_2_form_2_div_8_div.setAttribute("id", "vibracart_coupon");
    html2dom_root_2_form_2_div_8_div_1_div = document.createElement("div");
    html2dom_root_2_form_2_div_8_div_1_div.setAttribute("class", "vibracart_coupontextbox");
    html2dom_root_2_form_2_div_8_div_1_div_1_input = document.createElement("input");
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("class", "vibracart_coupontextbox");
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("type", "text");
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("name", "coupon");
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("value", couponinputtext);
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("onfocus", "if(this.value == couponinputtext) {this.value = \"\";}");
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("onblur", "if (this.value == \"\") {this.value = couponinputtext;}");
    html2dom_root_2_form_2_div_8_div_1_div_1_input.setAttribute("onkeydown", "cart_couponretpressed(event);");
    html2dom_root_2_form_2_div_8_div_1_div.appendChild(html2dom_root_2_form_2_div_8_div_1_div_1_input);
    html2dom_root_2_form_2_div_8_div.appendChild(html2dom_root_2_form_2_div_8_div_1_div);
    html2dom_root_2_form_2_div_8_div_2_div = document.createElement("div");
    html2dom_root_2_form_2_div_8_div_2_div.setAttribute("class", "vibracart_applybutton");
    html2dom_root_2_form_2_div_8_div_2_div_1_img = document.createElement("img");
    html2dom_root_2_form_2_div_8_div_2_div_1_img.setAttribute("src", cart_url+applyButton);
    html2dom_root_2_form_2_div_8_div_2_div_1_img.setAttribute("alt", "Apply Coupon");
    html2dom_root_2_form_2_div_8_div_2_div_1_img.setAttribute("class", "vibracart_applybutton");
    html2dom_root_2_form_2_div_8_div_2_div_1_img.setAttribute("onClick", "applyCoupon();");
    html2dom_root_2_form_2_div_8_div_2_div.appendChild(html2dom_root_2_form_2_div_8_div_2_div_1_img);
    html2dom_root_2_form_2_div_8_div.appendChild(html2dom_root_2_form_2_div_8_div_2_div);
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_8_div);
    html2dom_root_2_form_2_div_9_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_9_text);
  }
  html2dom_root_2_form_2_div_10_div = document.createElement("div");
  html2dom_root_2_form_2_div_10_div.setAttribute("class", "vibracart_footer");
  html2dom_root_2_form_2_div_10_div.setAttribute("id", "vibracart_footer");
  html2dom_root_2_form_2_div_10_div_1_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_1_text);
  if (continueButton!='')
  {
    html2dom_root_2_form_2_div_10_div_2_div = document.createElement("div");
    html2dom_root_2_form_2_div_10_div_2_div.setAttribute("class", "vibracart_continuebutton");
    html2dom_root_2_form_2_div_10_div_2_div_1_img = document.createElement("img");
    html2dom_root_2_form_2_div_10_div_2_div_1_img.setAttribute("src", cart_url+continueButton);
    html2dom_root_2_form_2_div_10_div_2_div_1_img.setAttribute("alt", "Continue Shopping");
    html2dom_root_2_form_2_div_10_div_2_div_1_img.setAttribute("class", "vibracart_continuebutton");
    html2dom_root_2_form_2_div_10_div_2_div_1_img.setAttribute("onClick", "hideCart();");
    html2dom_root_2_form_2_div_10_div_2_div.appendChild(html2dom_root_2_form_2_div_10_div_2_div_1_img);
    html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_2_div);
    html2dom_root_2_form_2_div_10_div_3_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_3_text);
  }
  if (updateButton!='')
  {
    html2dom_root_2_form_2_div_10_div_4_div = document.createElement("div");
    html2dom_root_2_form_2_div_10_div_4_div.setAttribute("class", "vibracart_updatebutton");
    html2dom_root_2_form_2_div_10_div_4_div_1_img = document.createElement("img");
    html2dom_root_2_form_2_div_10_div_4_div_1_img.setAttribute("src", cart_url+updateButton);
    html2dom_root_2_form_2_div_10_div_4_div_1_img.setAttribute("alt", "Recalculate");
    html2dom_root_2_form_2_div_10_div_4_div_1_img.setAttribute("class", "vibracart_updatebutton");
    html2dom_root_2_form_2_div_10_div_4_div_1_img.setAttribute("onClick", "updateQuantity();");
    html2dom_root_2_form_2_div_10_div_4_div.appendChild(html2dom_root_2_form_2_div_10_div_4_div_1_img);
    html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_4_div);
    html2dom_root_2_form_2_div_10_div_5_text = document.createTextNode("\n");
    html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_5_text);
  }
  html2dom_root_2_form_2_div_10_div_6_div = document.createElement("div");
  html2dom_root_2_form_2_div_10_div_6_div.setAttribute("class", "vibracart_checkoutbutton");
  html2dom_root_2_form_2_div_10_div_6_div_1_img = document.createElement("img");
  html2dom_root_2_form_2_div_10_div_6_div_1_img.setAttribute("src", cart_url+checkoutButton);
  html2dom_root_2_form_2_div_10_div_6_div_1_img.setAttribute("alt", "Checkout");
  html2dom_root_2_form_2_div_10_div_6_div_1_img.setAttribute("class", "vibracart_checkoutbutton");
  html2dom_root_2_form_2_div_10_div_6_div_1_img.setAttribute("onClick", "checkOut();");
  html2dom_root_2_form_2_div_10_div_6_div.appendChild(html2dom_root_2_form_2_div_10_div_6_div_1_img);
  html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_6_div);
  html2dom_root_2_form_2_div_10_div_7_div = document.createElement("div");
  html2dom_root_2_form_2_div_10_div_7_div.setAttribute("class", "vibracart_total");
  html2dom_root_2_form_2_div_10_div_7_div_1_span = document.createElement("span");
  html2dom_root_2_form_2_div_10_div_7_div_1_span.setAttribute("id", "vibracarttotal");
  html2dom_root_2_form_2_div_10_div_7_div_1_span_1_text = document.createTextNode("0.00");
  html2dom_root_2_form_2_div_10_div_7_div_1_span.appendChild(html2dom_root_2_form_2_div_10_div_7_div_1_span_1_text);
  html2dom_root_2_form_2_div_10_div_7_div.appendChild(html2dom_root_2_form_2_div_10_div_7_div_1_span);
  html2dom_root_2_form_2_div_10_div.appendChild(html2dom_root_2_form_2_div_10_div_7_div);
  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_10_div);
  html2dom_root_2_form_2_div_11_text = document.createTextNode("\n");
  html2dom_root_2_form_2_div.appendChild(html2dom_root_2_form_2_div_11_text);
  html2dom_root_2_form.appendChild(html2dom_root_2_form_2_div);
  html2dom_root_2_form_3_text = document.createTextNode("\n");
  html2dom_root_2_form.appendChild(html2dom_root_2_form_3_text);
  html2dom_root_2_form_4_div = document.createElement("div");
  html2dom_root_2_form_4_div.setAttribute("class", "vibracart_waiting");
  html2dom_root_2_form_4_div.setAttribute("id", "vibracartwaiting");
  html2dom_root_2_form.appendChild(html2dom_root_2_form_4_div);
  html2dom_root_2_form_5_text = document.createTextNode("\n");
  html2dom_root_2_form.appendChild(html2dom_root_2_form_5_text);
  html2dom_root_2_form_6_div = document.createElement("div");
  html2dom_root_2_form_6_div.setAttribute("class", "vibracart_alert");
  html2dom_root_2_form_6_div.setAttribute("id", "vibracartalert");
  html2dom_root_2_form.appendChild(html2dom_root_2_form_6_div);
  html2dom_root_2_form_7_text = document.createTextNode("\n");
  html2dom_root_2_form.appendChild(html2dom_root_2_form_7_text);
  html2dom_root.appendChild(html2dom_root_2_form);
  html2dom_root_3_text = document.createTextNode("\n");
  html2dom_root.appendChild(html2dom_root_3_text);
  if (checkoutpage=="")
  {
    if (usesandbox!="")
    {
      html2dom_root_4_form = document.createElement("form");
      html2dom_root_4_form.setAttribute("action", "https://www.sandbox.paypal.com/cgi-bin/webscr");
      html2dom_root_4_form.setAttribute("method", "post");
      html2dom_root_4_form.setAttribute("name", "paypalform");
      html2dom_root_4_form.setAttribute("id", "paypalform");
      html2dom_root_4_form_1_text = document.createTextNode("\n");
      html2dom_root_4_form.appendChild(html2dom_root_4_form_1_text);
      html2dom_root.appendChild(html2dom_root_4_form);
      html2dom_root_5_text = document.createTextNode("\n");
      html2dom_root.appendChild(html2dom_root_5_text);
    }
    else
    {
      html2dom_root_4_form = document.createElement("form");
      html2dom_root_4_form.setAttribute("action", "https://www.paypal.com/cgi-bin/webscr");
      html2dom_root_4_form.setAttribute("method", "post");
      html2dom_root_4_form.setAttribute("name", "paypalform");
      html2dom_root_4_form.setAttribute("id", "paypalform");
      html2dom_root_4_form_1_text = document.createTextNode("\n");
      html2dom_root_4_form.appendChild(html2dom_root_4_form_1_text);
      html2dom_root.appendChild(html2dom_root_4_form);
      html2dom_root_5_text = document.createTextNode("\n");
      html2dom_root.appendChild(html2dom_root_5_text);
    }
  }
  else
  {
    html2dom_root_4_form = document.createElement("form");
    html2dom_root_4_form.setAttribute("action", checkoutpage);
    html2dom_root_4_form.setAttribute("method", "post");
    html2dom_root_4_form.setAttribute("name", "paypalform");
    html2dom_root_4_form.setAttribute("id", "paypalform");
    html2dom_root_4_form_1_text = document.createTextNode("\n");
    html2dom_root_4_form.appendChild(html2dom_root_4_form_1_text);
    html2dom_root.appendChild(html2dom_root_4_form);
    html2dom_root_5_text = document.createTextNode("\n");
    html2dom_root.appendChild(html2dom_root_5_text);
  }
  if (animateitem)
  {
    html2dom_root_6_div = document.createElement("div");
    html2dom_root_6_div.setAttribute("id", "flyingitem");
    html2dom_root_6_div.setAttribute("style", "position:absolute; left: 0px; top: 0px;");
    html2dom_root_6_div_1_img = document.createElement("img");
    html2dom_root_6_div_1_img.setAttribute("src", cart_url+animateitemimage);
    html2dom_root_6_div.appendChild(html2dom_root_6_div_1_img);
    html2dom_root.appendChild(html2dom_root_6_div);
    html2dom_root_7_text = document.createTextNode("\n");
    html2dom_root.appendChild(html2dom_root_7_text);
  }
  if ((cartinline) && (null!=document.getElementById("insertcarthere")))
    bodyobj=document.getElementById("insertcarthere")
  else  
    bodyobj=document.getElementsByTagName('body')[0]
  bodyobj.appendChild(html2dom_root)
  if (animateitem)
  {  
    document.getElementById("flyingitem").style.visibility='hidden'
  }

//touchScroll('vibracart_content');

}

function showCart()
{
  var lefttouse=cart_left
  var toptouse=cart_top 
  var dsocheight = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
  var dsocwidth = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth; 
/*
  if (window.innerWidth)
  {
    var dsocwidth=window.innerWidth
    var dsocheight=window.innerHeight
  }
  else if (document.all)
  {
    var dsocwidth=document.body.clientWidth
    var dsocheight=document.body.clientHeight
  }
*/
  // Get top left of visible screen
  var iebody=(document.compatMode && document.compatMode != "BackCompat")? document.documentElement : document.body
  var dsocleft=document.all? iebody.scrollLeft : pageXOffset
  var dsoctop=document.all? iebody.scrollTop : pageYOffset
  var vibracartdiv=document.getElementById("vibracart")
  if (!vibracartdiv)
    return
  var vibracart_waitingdiv = document.getElementById("vibracartwaiting")    
  var vibracart_alertdiv = document.getElementById("vibracartalert")    
  var vibracart_contentdiv=document.getElementById("vibracart_content")
  if (cartposition=="static")
  {
    if (cart_left==-1)
      lefttouse=Math.floor((dsocwidth-cart_width)/2)+dsocleft
    if (cart_left==-2)
      lefttouse=Math.floor(dsocwidth-cart_width)+dsocleft-20
    if (cart_top==-1)  
      toptouse=Math.floor((dsocheight-cart_height)/2)+dsoctop
    if (cart_top==-2)  
      toptouse=Math.floor(dsocheight-cart_height)+dsoctop-20
  }
  if (cartposition=="fixed")
  {
    if (cart_left==-1)
      lefttouse=Math.floor((dsocwidth-cart_width)/2)
    if (cart_left==-2)
      lefttouse=Math.floor(dsocwidth-cart_width)
    if (cart_left<-2)
      lefttouse=Math.floor(dsocwidth-cart_width+cart_left)    
    if (cart_top==-1)  
      toptouse=Math.floor((dsocheight-cart_height)/2)
    if (cart_top==-2)  
      toptouse=Math.floor(dsocheight-cart_height)
    if (cart_top<-2)  
      toptouse=Math.floor(dsocheight-cart_height+cart_top)
  }
  if (cartposition=="scroll")
  {
    if (cart_left==-1)
      lefttouse=Math.floor((dsocwidth-cart_width)/2)+dsocleft
    if (cart_left==-2)
      lefttouse=Math.floor(dsocwidth-cart_width)+dsocleft-20
    if (cart_top==-1)  
      toptouse=Math.floor((dsocheight-cart_height)/2)+dsoctop
    if (cart_top==-2)  
      toptouse=Math.floor(dsocheight-cart_height)+dsoctop-20
  }
  if (!cartinline) 
  {
    vibracartdiv.style.left=lefttouse+"px"
    vibracartdiv.style.top=toptouse+"px"
    vibracart_waitingdiv.style.left=vibracartdiv.style.left
    vibracart_waitingdiv.style.top=vibracartdiv.style.top  
    vibracart_alertdiv.style.left=vibracartdiv.style.left
    vibracart_alertdiv.style.top=vibracartdiv.style.top  
  }
  else
  {
    if ((IE7) || (IE6))
    {
      vibracart_waitingdiv.style.left=vibracartdiv.offsetParent.offsetLeft+vibracartdiv.offsetLeft+"px"
      vibracart_alertdiv.style.left=vibracartdiv.offsetParent.offsetLeft+vibracartdiv.offsetLeft+"px"
    }  
    else 
    { 
      vibracart_waitingdiv.style.left=vibracartdiv.offsetLeft+"px"
      vibracart_alertdiv.style.left=vibracartdiv.offsetLeft+"px"
    }  
    vibracart_waitingdiv.style.top=vibracartdiv.offsetTop+"px"    
    vibracart_alertdiv.style.top=vibracartdiv.offsetTop+"px"    
  }
  vibracartdiv.style.visibility = 'visible'
  if (animate_style=="none")
  {
    vibracartdiv.style.width=cart_width+"px"
    vibracartdiv.style.height=cart_height+"px"
    vibracart_waitingdiv.style.width=vibracartdiv.style.width
    vibracart_waitingdiv.style.height=vibracartdiv.style.height  
    vibracart_alertdiv.style.width=vibracartdiv.style.width
    vibracart_alertdiv.style.height=vibracartdiv.style.height  
  }   
  if (animate_style=="down")
  {
    cart_animating=true
    var curheight=parseInt(vibracartdiv.style.height)
    if (curheight!=cart_height)
    {
      vibracart_contentdiv.style.overflowY="hidden"
      vibracartdiv.style.width=cart_width+"px"
      var newheight=curheight+animate_pixels
      if (newheight>=cart_height)
        newheight=cart_height
      vibracartdiv.style.height=newheight+"px"
      vibracart_waitingdiv.style.width=vibracartdiv.style.width
      vibracart_waitingdiv.style.height=vibracartdiv.style.height  
      vibracart_alertdiv.style.width=vibracartdiv.style.width
      vibracart_alertdiv.style.height=vibracartdiv.style.height  
      if (newheight==cart_height)
      {
        vibracart_contentdiv.style.overflowY="auto"
        if ((IE7) || (IE6))
        {
          document.getElementById('cartTable').style.width="100px"
          document.getElementById('cartTable').style.width=(cart_width-20)+"px"
        }        
        cart_animating=false
      }
      if (newheight<cart_height)
        setTimeout("showCart()",animate_speed);
    }
  }
  if (animate_style=="right")
  {
    cart_animating=true
    var curwidth=parseInt(vibracartdiv.style.width)
    if (curwidth!=cart_width)
    {
      vibracart_contentdiv.style.overflowY="hidden"
      vibracartdiv.style.height=cart_height+"px"
      var newwidth=curwidth+animate_pixels
      if (newwidth>=cart_width)
        newwidth=cart_width
      vibracartdiv.style.width=newwidth+"px"
      vibracart_waitingdiv.style.width=vibracartdiv.style.width
      vibracart_waitingdiv.style.height=vibracartdiv.style.height  
      vibracart_alertdiv.style.width=vibracartdiv.style.width
      vibracart_alertdiv.style.height=vibracartdiv.style.height  
      if (newwidth==cart_width)
      {
        vibracart_contentdiv.style.overflowY="auto"
        if ((IE7) || (IE6))
        {
          document.getElementById('cartTable').style.width="100px"
          document.getElementById('cartTable').style.width=(cart_width-20)+"px"
        }
        cart_animating=false
      }
      if(newwidth<cart_width)
        setTimeout("showCart()",animate_speed);
    }
  }
  // If necessary refresh cart from server
  // Bug ridden IE always needs refresh to update scroll bars
//  cart_needs_refresh=true;
  if (cart_needs_refresh)
  {  
    postdata="cart_todo=getcart&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
    // Update cart contents from server
    var xmlhttp = new XMLHttpRequest()
    xmlhttp.open('POST',cart_url+'cart.php',true)
    xmlhttp.onreadystatechange = function()
    {
      if (xmlhttp.readyState==4)
      {
        var cart_errormessage=""
        if (xmlhttp.status == 200)
        {
          cart_errormessage=updateFromXML(xmlhttp)
          updateCartTable()
        }
        showWaiting(false)
        cart_busy=false
        if (cart_errormessage!="")
          displayMessage(cart_errormessage)
      }   
    }
    cart_busy=true
    showWaiting(true)
    cart_needs_refresh=false;    
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.send(postdata)
  }
  if ((pageFade) && (!IE6))
  {
    cartBackgroundGrayOut(true)
    pageisfaded=true
  }  
}
function showWaiting(wait)
{
  var box= document.getElementById("vibracart")
  var boxcontent = document.getElementById("vibracart_content")
  var boxwait = document.getElementById("vibracartwaiting")
  if (!wait)
  {
    boxwait.style.visibility = 'hidden'
    boxcontent.style.opacity = '1.0'
    if (IE8)
      boxcontent.style.filter="none"
  }
  else	  
  {
    if (!cartinline) 
    {
      boxwait.style.left=box.style.left
      boxwait.style.top=box.style.top
    }
    else
    {
      if ((IE7) || (IE6))  
          boxwait.style.left=box.offsetParent.offsetLeft+box.offsetLeft+"px"
      else
        boxwait.style.left=box.offsetLeft+"px"
      boxwait.style.top=box.offsetTop+"px"
    }
    boxwait.style.width=box.style.width
    boxwait.style.height=box.style.height
    boxwait.style.backgroundImage="url("+cart_url+busyImage+")"
    boxwait.style.visibility = 'visible'
    boxcontent.style.opacity = '0.3'
    if (IE8)
      boxcontent.style.filter="alpha(opacity=30)"
    if (use_widget)
    {
      // Update widget fields
      document.getElementById("vibracart_widget_items").innerHTML="Updating"
      document.getElementById("vibracart_widget_total").innerHTML="&nbsp;"
    }
    if (document.getElementById("showitemcount"))
      document.getElementById("showitemcount").innerHTML="Updating"
    if (document.getElementById("showcarttotal"))
      document.getElementById("showcarttotal").innerHTML="&nbsp;"      
    if (document.getElementById("showitemcount2"))
      document.getElementById("showitemcount2").innerHTML="Updating"
    if (document.getElementById("showcarttotal2"))
      document.getElementById("showcarttotal2").innerHTML="&nbsp;"      
  }  
}
function showAlert(show,msg,type,delay)
{
  var box= document.getElementById("vibracart")
  var boxcontent = document.getElementById("vibracart_content")
  var boxalert = document.getElementById("vibracartalert")
  if (!show)
  {
    boxalert.style.visibility = 'hidden'
    boxcontent.style.opacity = '1.0'
    if (IE8)
      boxcontent.style.filter="none"
  }
  else	  
  {
    showCart()
    if (!cartinline) 
    {
      boxalert.style.left=box.style.left
      boxalert.style.top=box.style.top
    }
    else
    {
      if ((IE7) || (IE6))  
          boxalert.style.left=box.offsetParent.offsetLeft+box.offsetLeft+"px"
      else
        boxalert.style.left=box.offsetLeft+"px"
      boxalert.style.top=box.offsetTop+"px"
    }
    boxalert.style.width=box.style.width
    boxalert.style.height=box.style.height
    if (type==0)
      document.getElementById("vibracartalert").innerHTML="<p class='vibracart_alertmessage'>"+msg+"</p>"
    if (type==1)
      document.getElementById("vibracartalert").innerHTML="<p class='vibracart_alerterror'>"+msg+"</p>"
    boxalert.style.visibility = 'visible'
    boxcontent.style.opacity = '0.2'
    if (IE8)
      boxcontent.style.filter="alpha(opacity=20)"
    if (delay>0)  
      setTimeout('showAlert(false,"")',delay);      
  }  
}
function hideCart()
{
  var vibracartdiv=document.getElementById("vibracart")
  if (!vibracartdiv)
    return
  var vibracart_contentdiv=document.getElementById("vibracart_content")
  var vibracart_waitingdiv = document.getElementById("vibracartwaiting")         
  var vibracart_alertdiv = document.getElementById("vibracartalert")         
  if (animate_style=="none")
  {
/*
      vibracartdiv.style.visibility = 'hidden'
      vibracart_waitingdiv.style.visibility = 'hidden'
      vibracart_waitingdiv.style.width=vibracartdiv.style.width
      vibracart_waitingdiv.style.height=vibracartdiv.style.height      
      vibracart_alertdiv.style.visibility = 'hidden'
      vibracart_alertdiv.style.width=vibracartdiv.style.width
      vibracart_alertdiv.style.height=vibracartdiv.style.height      
*/
      vibracartdiv.style.visibility = 'hidden'
      vibracartdiv.style.width=0
      vibracartdiv.style.height=0
      vibracart_waitingdiv.style.visibility = 'hidden'
      vibracart_waitingdiv.style.width=0
      vibracart_waitingdiv.style.height=0      
      vibracart_alertdiv.style.visibility = 'hidden'
      vibracart_alertdiv.style.width=0
      vibracart_alertdiv.style.height=0      
  }
  if (animate_style=="down")
  {
    cart_animating=true
    var curheight=parseInt(vibracartdiv.style.height)
    vibracart_contentdiv.style.overflowY="hidden"   
    var newheight=curheight-animate_pixels
    if (newheight<0)
      newheight=0
    vibracartdiv.style.height=newheight+"px";
    vibracart_waitingdiv.style.width=vibracartdiv.style.width
    vibracart_waitingdiv.style.height=vibracartdiv.style.height   
    vibracart_alertdiv.style.width=vibracartdiv.style.width
    vibracart_alertdiv.style.height=vibracartdiv.style.height   
    if(newheight>0)
      setTimeout("hideCart()",animate_speed);
    if (newheight==0)
    {
      vibracartdiv.style.visibility = 'hidden'
      vibracart_contentdiv.style.overflowY="auto"        
      cart_animating=false
    }
  }
  if (animate_style=="right")
  {
    cart_animating=true
    var curwidth=parseInt(vibracartdiv.style.width)
    vibracart_contentdiv.style.overflowY="hidden"   
    var newwidth=curwidth-animate_pixels
    if (newwidth<0)
      newwidth=0
    vibracartdiv.style.width=newwidth+"px";
    vibracart_waitingdiv.style.width=vibracartdiv.style.width
    vibracart_waitingdiv.style.height=vibracartdiv.style.height      
    vibracart_alertdiv.style.width=vibracartdiv.style.width
    vibracart_alertdiv.style.height=vibracartdiv.style.height      
    if(newwidth>0)
      setTimeout("hideCart()",animate_speed);
    if (newwidth==0)
    {
      vibracartdiv.style.visibility = 'hidden'
      vibracart_contentdiv.style.overflowY="auto"            
      cart_animating=false
    }  
  }
  if ((pageFade) && (!IE6))
  {
    cartBackgroundGrayOut(false)
    pageisfaded=false
  }  
}

function addButtonListener(e)
{
  if (!supportsAjax())
  {
    // Browser does not support AJAX
    return;
  }
  for( i=0; i < document.forms.length; i++)
  {
    // See if form is Paypal add to cart button
    if (typeof document.forms[i].action=='string')
    {
      formaction=document.forms[i].action.toLowerCase()
      if ((formaction.indexOf("https://www.paypal.",0)>-1) || (formaction.indexOf("https://paypal.",0)>-1) || (formaction.indexOf("https://www.sandbox.paypal.",0)>-1) || (formaction.indexOf("https://sandbox.paypal.",0)>-1))
      {
        if (document.forms[i].cmd)
        {
          if (document.forms[i].cmd.value=="_cart")
          {
            if (document.forms[i].display)
            {
              if (document.forms[i].display.value=="1")
              {
                // View cart button          
                cart_addEvent(document.forms[i], 'submit', viewCart, false)
                document.forms[i].target=""
                document.forms[i].action=""
              }  
            }
            else
            {
              // Add to cart button
              cart_addEvent(document.forms[i], 'submit', addToCart, false)
              cart_addEvent(document.forms[i], 'mousedown', vc_getmousecoords, false)
              document.forms[i].target=""
              document.forms[i].action=""          
            }  
          }
        }
      } 
    } 
  }
}

function addToCart(e)
{
  if (showcartonadd)
    showCart()
  // Get form
  var el;
  if (window.event && window.event.srcElement)
    el = window.event.srcElement;
  if (e && e.target)
    el = e.target;
    
  // Get item details
  var postdata=""
  for (k=0;k<el.elements.length;k++)
  {
    if ((el.elements[k].type=='radio') && (!el.elements[k].checked))
      continue;
    if (postdata!="")
      postdata=postdata+"&"
    postdata=postdata+encodeURIComponent(el.elements[k].name)+"="+encodeURIComponent(el.elements[k].value)
  }
  postdata=postdata+"&cart_todo=additem&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  if (autoProductPageLink)
    postdata=postdata+"&pglink="+document.URL
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
      }
      showWaiting(false)
      cart_busy=false
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
  cart_busy=true
  showWaiting(true)
  cart_needs_refresh=false;
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
//  el.action=""
//  el.target=""
  cart_StopEvent(e)
  
  
  // If required animate item moving to cart
  if (animateitem)
  {
  
    if (animitemtimerid!=0)
      clearTimeout(animitemtimerid);
    var fstartx=cartmousex
    var fstarty=cartmousey

    if (!showcartonadd)
    {
      if (document.getElementById("showcarttotal"))
        obj=document.getElementById("showcarttotal")
      else
        obj=document.getElementById("vibracart")    
    }
    else
      obj=document.getElementById("vibracart")
    var  pos = vc_getElementAbsolutePos(obj);
    var fendx=pos.x
    var fendy=pos.y
    obj=document.getElementById("flyingitem")    
    if ((animitemoffsetx==1234) && (animitemoffsety==1234))
    {
      pos = vc_getElementAbsolutePos(obj);
      animitemoffsetx=pos.x
      animitemoffsety=pos.y
    }
    fstartx=fstartx-animitemoffsetx
    fstarty=fstarty-animitemoffsety
    fendx=fendx-animitemoffsetx
    fendy=fendy-animitemoffsety
    animitemincx=(fendx-fstartx)/animateitemstep
    animitemincy=(fendy-fstarty)/animateitemstep
    animitemcurx=fstartx;
    animitemcury=fstarty;
    animitemstep=animateitemstep;
    animiteminaction=true   
    obj.style.left=parseInt(animitemcurx,10)+"px"
    obj.style.top=parseInt(animitemcury,10)+"px"
    obj.style.visibility="visible"
    setTimeout(AnimateCartItem,animateitemspeed)
  }
}

function vc_getmousecoords(e)
{
   e = e || window.event;
   var cursor = {x:0, y:0};
    if (e.pageX || e.pageY) {
        cursor.x = e.pageX;
        cursor.y = e.pageY;
    }
    else {
        cursor.x = e.clientX +
            (document.documentElement.scrollLeft ||
            document.body.scrollLeft) -
            document.documentElement.clientLeft;
        cursor.y = e.clientY +
            (document.documentElement.scrollTop ||
            document.body.scrollTop) -
            document.documentElement.clientTop;
    }
  cartmousex=cursor.x
  cartmousey=cursor.y;
}

// http://blogs.korzh.com/progtips/2008/05/28/absolute-coordinates-of-dom-element-within-document.html
function vc_getIEVersion() {  
    var rv = -1; // Return value assumes failure.  
    if (navigator.appName == 'Microsoft Internet Explorer') {  
        var ua = navigator.userAgent;  
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");  
        if (re.exec(ua) != null)  
            rv = parseFloat(RegExp.$1);  
    }  
    return rv;  
}  
  
function vc_getOperaVersion() {  
    var rv = 0; // Default value  
    if (window.opera) {  
        var sver = window.opera.version();  
        rv = parseFloat(sver);  
    }  
    return rv;  
}  
  
var __userAgent = navigator.userAgent;  
var __isIE =  navigator.appVersion.match(/MSIE/) != null;  
var __IEVersion = vc_getIEVersion();  
var __isIENew = __isIE && __IEVersion >= 8;  
var __isIEOld = __isIE && !__isIENew;  
  
var __isFireFox = __userAgent.match(/firefox/i) != null;  
var __isFireFoxOld = __isFireFox && ((__userAgent.match(/firefox\/2./i) != null) || (__userAgent.match(/firefox\/1./i) != null));  
var __isFireFoxNew = __isFireFox && !__isFireFoxOld;  
  
var __isWebKit =  navigator.appVersion.match(/WebKit/) != null;  
var __isChrome =  navigator.appVersion.match(/Chrome/) != null;  
var __isOpera =  window.opera != null;  
var __operaVersion = vc_getOperaVersion();  
var __isOperaOld = __isOpera && (__operaVersion < 10);  
  
function vc_parseBorderWidth(width) {  
    var res = 0;  
    if (typeof(width) == "string" && width != null && width != "" ) {  
        var p = width.indexOf("px");  
        if (p >= 0) {  
            res = parseInt(width.substring(0, p));  
        }  
        else {  
            //do not know how to calculate other values (such as 0.5em or 0.1cm) correctly now  
            //so just set the width to 1 pixel  
            res = 1;   
        }  
    }  
    return res;  
}  
  
  
//returns border width for some element  
function vc_getBorderWidth(element) {  
    var res = new Object();  
    res.left = 0; res.top = 0; res.right = 0; res.bottom = 0;  
    if (window.getComputedStyle) {  
        //for Firefox  
        var elStyle = window.getComputedStyle(element, null);  
        res.left = parseInt(elStyle.borderLeftWidth.slice(0, -2));    
        res.top = parseInt(elStyle.borderTopWidth.slice(0, -2));    
        res.right = parseInt(elStyle.borderRightWidth.slice(0, -2));    
        res.bottom = parseInt(elStyle.borderBottomWidth.slice(0, -2));    
    }  
    else {  
        //for other browsers  
        res.left = vc_parseBorderWidth(element.style.borderLeftWidth);  
        res.top = vc_parseBorderWidth(element.style.borderTopWidth);  
        res.right = vc_parseBorderWidth(element.style.borderRightWidth);  
        res.bottom = vc_parseBorderWidth(element.style.borderBottomWidth);  
    }  
     
    return res;  
}  
  
  
//returns the absolute position of some element within document  
function vc_getElementAbsolutePos(elemID) {  
    var element;  
    if (typeof(elemID) == "string") {  
        element = document.getElementById(elemID);  
    }  
    else {  
        element = elemID;  
    }  
  
    var res = new Object();  
    res.x = 0; res.y = 0;  
    if (element !== null) {  
        res.x = element.offsetLeft;  
  
        var offsetParent = element.offsetParent;  
        var offsetParentTagName = offsetParent != null ? offsetParent.tagName.toLowerCase() : "";  
  
        if (__isIENew  && offsetParentTagName == 'td') {  
            res.y = element.scrollTop;  
        }  
        else {  
            res.y = element.offsetTop;  
        }  
          
        var parentNode = element.parentNode;  
        var borderWidth = null;  
  
        while (offsetParent != null) {  
            res.x += offsetParent.offsetLeft;  
            res.y += offsetParent.offsetTop;  
              
            var parentTagName = offsetParent.tagName.toLowerCase();   
  
            if ((__isIEOld && parentTagName != "table") || (__isFireFoxNew && parentTagName == "td")  || __isChrome) {            
                borderWidth = vc_getBorderWidth(offsetParent);  
                res.x += borderWidth.left;  
                res.y += borderWidth.top;  
            }  
              
            if (offsetParent != document.body && offsetParent != document.documentElement) {  
                res.x -= offsetParent.scrollLeft;  
                res.y -= offsetParent.scrollTop;  
            }  
  
  
            //next lines are necessary to fix the problem with offsetParent  
            if (!__isIE && !__isOperaOld || __isIENew) {  
                while (offsetParent != parentNode && parentNode !== null) {  
                    res.x -= parentNode.scrollLeft;  
                    res.y -= parentNode.scrollTop;  
                    if (__isFireFoxOld || __isWebKit) {  
                        borderWidth = vc_getBorderWidth(parentNode);  
                        res.x += borderWidth.left;  
                        res.y += borderWidth.top;  
                    }  
                    parentNode = parentNode.parentNode;  
                }      
            }  
  
            parentNode = offsetParent.parentNode;  
            offsetParent = offsetParent.offsetParent;  
        }  
    }  
    return res;  
}  





function AnimateCartItem()
{
  animitemcurx=animitemcurx+animitemincx
  animitemcury=animitemcury+animitemincy
  document.getElementById("flyingitem").style.left=parseInt(animitemcurx,10)+"px"
  document.getElementById("flyingitem").style.top=parseInt(animitemcury,10)+"px"
  animitemstep=animitemstep-1
  if (animitemstep<=0)
  {
    document.getElementById("flyingitem").style.visibility="hidden"
    animiteminaction=false
    animitemtimerid=0
    return       
  }
  animitemtimerid=setTimeout(AnimateCartItem,animateitemspeed)  
}

  
function viewCart(e)
{
  showCart()
  cart_StopEvent(e)
}

function removeFromCart(num)
{
  postdata="cart_todo=removeitem&num="+num+"&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
      }
      showWaiting(false)
      cart_busy=false
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
  cart_busy=true  
  showWaiting(true)
  cart_needs_refresh=false;
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
}

function updateQuantity()
{
  if (cart_busy)
    return
  var el=document.getElementById('vibracartform')
  // Get item details
  var postdata=""
  for (k=0;k<el.elements.length;k++)
  {
    if ((el.elements[k].type=='radio') && (!el.elements[k].checked))
      continue;
    if (postdata!="")
      postdata=postdata+"&"
    postdata=postdata+el.elements[k].name+"="+el.elements[k].value
  }
  postdata=postdata+"&cart_todo=updateqty&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
      }
      showWaiting(false)
      cart_busy=false
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
  cart_busy=true
  showWaiting(true)
  cart_needs_refresh=false;
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
}

function applyCoupon()
{
  var el=document.getElementById('vibracartform')
  var cc=el.coupon.value
  if (cc==couponinputtext)
    return
  postdata="cart_todo=applycoupon&coupon="+cc+"&num=0&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
      }
      showWaiting(false)
      cart_busy=false
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
  cart_busy=true  
  showWaiting(true)
  cart_needs_refresh=false;
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
}

function clearCoupon()
{
  var el=document.getElementById('vibracartform')
  var cc=el.coupon.value
  if (cc==couponinputtext)
    return
  postdata="cart_todo=applycoupon&coupon="+""+"&num=0&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
      }
      showWaiting(false)
      cart_busy=false
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
  cart_busy=true  
  showWaiting(true)
  cart_needs_refresh=false;
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
}

function checkOut()
{
  if (cart_busy)
    return
  if (cart_numentries==0)
    return
  // if less than cartquantityminlimit items in cart then block
  if ((cartquantityminlimit>0) && (cart_numitems<cartquantityminlimit))
  {
    displayMessage("9")
    return
  }  
  // if less than carttotalminlimit total then block
  if ((carttotalminlimit>0) && (cart_totalnumeric<carttotalminlimit))
  {
    displayMessage("10")
    return
  }  
  // if less than carttotalminlimit total then block
  if ((carttotalmaxlimit>0) && (cart_totalnumeric>carttotalmaxlimit))
  {
    displayMessage("11")
    return
  }  
  var el=document.getElementById('vibracartform')
  if (showTerms)
  {

    if(!el.terms.checked)
    {
      el.terms.focus()
      displayMessage("3")
      return
    }  
  }
  if (showTerms2)
  {

    if(!el.terms2.checked)
    {
      el.terms2.focus()
      displayMessage("12")
      return
    }  
  }
  if (showTerms3)
  {

    if(!el.terms3.checked)
    {
      el.terms3.focus()
      displayMessage("13")
      return
    }  
  }
  if (showCoupon)
    applyCoupon()      
  // Get item details
  var postdata=""
  for (k=0;k<el.elements.length;k++)
  {
    if ((el.elements[k].type=='radio') && (!el.elements[k].checked))
      continue;
    if (postdata!="")
      postdata=postdata+"&"
    postdata=postdata+el.elements[k].name+"="+el.elements[k].value
  }
  postdata=postdata+"&cart_todo=updateqty&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
        var pos1=cart_fulltextdata.indexOf("<checkoutform>",0)
        var pos2=cart_fulltextdata.indexOf("</checkoutform>",pos2)
        pos1=cart_fulltextdata.indexOf("<![CDATA[",pos1)
        pos2=cart_fulltextdata.indexOf("]]>",pos1)
        var formhtml=cart_fulltextdata.substring(pos1+10,pos2)
        checkoutform=document.getElementById('paypalform')
        checkoutform.innerHTML=formhtml
        if (checkouttarget!="")
          checkoutform.target=checkouttarget
        checkoutform.submit()
      }
//      showWaiting(false)
//      cart_busy=false      
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
//  cart_busy=true
//  showWaiting(true)
  if (msg_checkout!="")
    displayMessage("4")  
  cart_needs_refresh=false;
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
}

function updateFromXML(xmlhttp)
{
  // Get cart contents back from server for display
  var cart_errormessage=""
  if (null!=xmlhttp.responseXML.getElementsByTagName('errormessage')[0].firstChild)
    cart_errormessage=xmlhttp.responseXML.getElementsByTagName('errormessage')[0].firstChild.data
  cart_numentries=xmlhttp.responseXML.getElementsByTagName('numentries')[0].firstChild.data
  cart_numentries=Number(cart_numentries)
  cart_numitems=xmlhttp.responseXML.getElementsByTagName('numitems')[0].firstChild.data
  cart_numitems=Number(cart_numitems)
  cart_discount=xmlhttp.responseXML.getElementsByTagName('cartdiscount')[0].firstChild.data
  cart_couponitem=xmlhttp.responseXML.getElementsByTagName('couponitem')[0].firstChild.data
  cart_total=xmlhttp.responseXML.getElementsByTagName('carttotal')[0].firstChild.data
  cart_totalnumeric=xmlhttp.responseXML.getElementsByTagName('carttotalnumeric')[0].firstChild.data
  cart_itemtoshow=xmlhttp.responseXML.getElementsByTagName('itemtoshow')[0].firstChild.data
  cart_itemtoshow=Number(cart_itemtoshow)
  for (k=0;k<cart_numentries;k++)
  {
    cart_item_quantity[k]=xmlhttp.responseXML.getElementsByTagName('quantity')[k].firstChild.data
    cart_item_image[k]=xmlhttp.responseXML.getElementsByTagName('image')[k].firstChild.data
    cart_item_description[k]=xmlhttp.responseXML.getElementsByTagName('description')[k].firstChild.data
    cart_item_total[k]=xmlhttp.responseXML.getElementsByTagName('total')[k].firstChild.data  
  }
  cart_fulltextdata=xmlhttp.responseText
//  alert(cart_fulltextdata)
  return(cart_errormessage)     
}

function updateCartTable()
{
  objectContent=document.getElementById("vibracart_content")
  objectTable=document.getElementById('cartTable')
  // Get number of rows in table currently
  var oRows = objectTable.getElementsByTagName('tr');
  var existingrowcount = oRows.length;
  // for each item update or create row
  var col0, col1, col2, col3, col4, row, colcount
  if (cart_numentries>0)
    objectContent.style.backgroundImage="none"
  for (var k=0;k<cart_numentries;k++)
  {
    // If row already exists in table then update cell contents
    if (k<existingrowcount)
    {
      row=objectTable.rows[k].cells
      row.id="item"+k
      colcount=0
      if (showItemRemove)
      {
        row[colcount].innerHTML='<p class="vibracart_itemdelete"><img src="'+cart_url+deleteButton+'" alt="Remove Item" class="vibracart_itemdelete" onClick="removeFromCart('+k+');"></p>'
        colcount++
      }
      if (showItemQuantity)
      {
        row[colcount].innerHTML='<p class="vibracart_itemquantity"><input type="text" name="itemqty[]" value="'+cart_item_quantity[k]+'" size="2" class="vibracart_itemquantity" onchange="updateQuantity()" onkeydown="cart_qtyretpressed(event)" ></p>'
        colcount++
      }
      if (showItemImage)
      {
        if (cart_item_image[k]!="null")
          row[colcount].innerHTML='<p class="vibracart_itemimage"><img src="'+cart_item_image[k]+'" class="vibracart_itemimage"></p>'
        else  
          row[colcount].innerHTML='<p class="vibracart_itemimage">&nbsp;</p>'
        colcount++
      }      
      if (showItemDescription)
      {
//        row[colcount].innerHTML='<p class="vibracart_itemdescription">'+cart_item_description[k]+'</p>'
        row[colcount].innerHTML=cart_item_description[k]
        colcount++
      }
      if (showItemTotal)
      {              
        row[colcount].innerHTML='<p class="vibracart_itemtotal">'+cart_item_total[k]+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'          
      }
    }
    else
    {
      // If not then add row
      row=objectTable.insertRow(-1)
      row.id="item"+k
      if (k%2 == 0)
        row.className='vibracart_item_even'
      else
        row.className='vibracart_item_odd'
      colcount=0  
      if (showItemRemove)
      {            
        col0=row.insertCell(colcount)
        col0.className='vibracart_itemdelete'
        colcount++     
      }  
      if (showItemQuantity)
      {
        col1=row.insertCell(colcount)
        col1.className='vibracart_itemquantity'
        colcount++
      } 
      if (showItemImage)
      {
        col2=row.insertCell(colcount)
        col2.className='vibracart_itemimage'
        colcount++
      }       
      if (showItemDescription)
      {
        col3=row.insertCell(colcount)
        col3.className='vibracart_itemdescription'
        colcount++
      }  
      if (showItemTotal)
      {
        col4=row.insertCell(colcount)
        col4.className='vibracart_itemtotal'        
      }  
      if (showItemRemove)        
        col0.innerHTML='<p class="vibracart_itemdelete"><img src="'+cart_url+deleteButton+'" alt="Remove Item" class="vibracart_itemdelete" onClick="removeFromCart('+k+');"></p>'
      if (showItemQuantity)
        col1.innerHTML='<p class="vibracart_itemquantity"><input type="text" name="itemqty[]" value="'+cart_item_quantity[k]+'" size="2" class="vibracart_itemquantity" onchange="updateQuantity()" onkeydown="cart_qtyretpressed(event)"></p>'
      if (showItemImage)
      {
        if (cart_item_image[k]!="null")
          col2.innerHTML='<p class="vibracart_itemimage"><img src="'+cart_item_image[k]+'" class="vibracart_itemimage"></p>'
        else
          col2.innerHTML='<p class="vibracart_itemimage">&nbsp;</p>'          
      }  
      if (showItemDescription)
        col3.innerHTML=cart_item_description[k]
//        col3.innerHTML='<p class="vibracart_itemdescription">'+cart_item_description[k]+'</p>'
      if (showItemTotal)
        col4.innerHTML='<p class="vibracart_itemtotal">'+cart_item_total[k]+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'          
    }
  }

  var disfield=0
  var coupfield=0
  
  // Get number of rows in table now
  oRows = objectTable.getElementsByTagName('tr');
  existingrowcount = oRows.length;
  // If coupon needs to be displayed
  if (cart_couponitem!="no coupon")
  {
    coupfield=1
    k=cart_numentries
    // If row already exists in table then update cell contents    
    if (k<existingrowcount)
    {
      row=objectTable.rows[k].cells
      row.id="item"+k
      colcount=0
      if (showItemRemove)
      {
        row[colcount].innerHTML='<p class="vibracart_itemdelete">&nbsp;</p>'
        colcount++
      }
      if (showItemQuantity)
      {
        row[colcount].innerHTML='<p class="vibracart_itemquantity">&nbsp;</p>'
        colcount++
      }
      if (showItemImage)
      {
        row[colcount].innerHTML='<p class="vibracart_itemimage">&nbsp;</p>'
        colcount++
      }      
      if (showItemDescription)
      {
        row[colcount].innerHTML='<p class="vibracart_itemcoupon">'+coupontext+cart_couponitem+'</p>'
        colcount++
      }
      if (showItemTotal)
      {              
        row[colcount].innerHTML='<p class="vibracart_itemtotal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'          
      }
    }
    else
    {
      // If not then add row
      row=objectTable.insertRow(-1)
      row.id="item"+k
      if (k%2 == 0)
        row.className='vibracart_item_even'
      else
        row.className='vibracart_item_odd'
      colcount=0  
      if (showItemRemove)
      {            
        col0=row.insertCell(colcount)
        col0.className='vibracart_itemdelete'
        colcount++     
      }  
      if (showItemQuantity)
      {
        col1=row.insertCell(colcount)
        col1.className='vibracart_itemquantity'
        colcount++
      } 
      if (showItemImage)
      {
        col2=row.insertCell(colcount)
        col2.className='vibracart_itemimage'
        colcount++
      }       
      if (showItemDescription)
      {
        col3=row.insertCell(colcount)
        col3.className='vibracart_itemdescription'
        colcount++
      }  
      if (showItemTotal)
      {
        col4=row.insertCell(colcount)
        col4.className='vibracart_itemtotal'        
      }  
      if (showItemRemove)        
        col0.innerHTML='<p class="vibracart_itemdelete">&nbsp;</p>'
      if (showItemQuantity)
        col1.innerHTML='<p class="vibracart_itemquantity">&nbsp;</p>'
      if (showItemImage)
      {
        col2.innerHTML='<p class="vibracart_itemimage">&nbsp;</p>'          
      } 
      if (showItemDescription)
        col3.innerHTML='<p class="vibracart_itemcoupon">'+coupontext+cart_couponitem+'</p>'
      if (showItemTotal)
        col4.innerHTML='<p class="vibracart_itemtotal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'          
    }
  } 


  // Get number of rows in table now
  oRows = objectTable.getElementsByTagName('tr');
  existingrowcount = oRows.length;
  // If discount needs to be displayed
  if ((cart_discount!="0") && (cart_numentries>0))
  {
    disfield=1;
    k=cart_numentries+coupfield;
    // If row already exists in table then update cell contents    
    if (k<existingrowcount)
    {
      row=objectTable.rows[k].cells
      row.id="item"+k
      colcount=0
      if (showItemRemove)
      {
        row[colcount].innerHTML='<p class="vibracart_itemdelete">&nbsp;</p>'
        colcount++
      }
      if (showItemQuantity)
      {
        row[colcount].innerHTML='<p class="vibracart_itemquantity">&nbsp;</p>'
        colcount++
      }
      if (showItemImage)
      {
        row[colcount].innerHTML='<p class="vibracart_itemimage">&nbsp;</p>'
        colcount++
      }      
      if (showItemDescription)
      {
        row[colcount].innerHTML='<p class="vibracart_itemdiscount">'+discounttext+'</p>'
        colcount++
      }
      if (showItemTotal)
      {              
        row[colcount].innerHTML='<p class="vibracart_itemtotal">'+cart_discount+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'          
      }
    }
    else
    {
      // If not then add row
      row=objectTable.insertRow(-1)
      row.id="item"+k
      if (k%2 == 0)
        row.className='vibracart_item_even'
      else
        row.className='vibracart_item_odd'
      colcount=0  
      if (showItemRemove)
      {            
        col0=row.insertCell(colcount)
        col0.className='vibracart_itemdelete'
        colcount++     
      }  
      if (showItemQuantity)
      {
        col1=row.insertCell(colcount)
        col1.className='vibracart_itemquantity'
        colcount++
      } 
      if (showItemImage)
      {
        col2=row.insertCell(colcount)
        col2.className='vibracart_itemimage'
        colcount++
      }       
      if (showItemDescription)
      {
        col3=row.insertCell(colcount)
        col3.className='vibracart_itemdescription'
        colcount++
      }  
      if (showItemTotal)
      {
        col4=row.insertCell(colcount)
        col4.className='vibracart_itemtotal'        
      }  
      if (showItemRemove)        
        col0.innerHTML='<p class="vibracart_itemdelete">&nbsp;</p>'
      if (showItemQuantity)
        col1.innerHTML='<p class="vibracart_itemquantity">&nbsp;</p>'
      if (showItemImage)
      {
        col2.innerHTML='<p class="vibracart_itemimage">&nbsp;</p>'          
      }  
      if (showItemDescription)
        col3.innerHTML='<p class="vibracart_itemdiscount">'+discounttext+'</p>'
      if (showItemTotal)
        col4.innerHTML='<p class="vibracart_itemtotal"><nobr>'+cart_discount+'</nobr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'          
    }
  } 

  
  // If there are rows not used anymore then remove them
  // See if we need to include discount item
  // Get number of rows in table now
  oRows = objectTable.getElementsByTagName('tr');
  existingrowcount = oRows.length;
  if (existingrowcount>(cart_numentries+disfield+coupfield))
  {
    for (k=(cart_numentries+disfield+coupfield);k<existingrowcount;k++)
    {
      objectTable.deleteRow(cart_numentries+disfield+coupfield)    
    }
  }
  if (cart_numentries==0)
  {
    // Cart is empty
    objectContent.style.backgroundImage="url("+cart_url+emptyCartImage+")"
    if (hidecartifempty)
    {
      hideCart()
    }  
  }
  // Update total on cart
  var carttotaltext = document.getElementById("vibracarttotal")
  carttotaltext.innerHTML=cart_total
  if (cart_itemtoshow>-1)
  {
    obj=document.getElementById("item"+cart_itemtoshow)
    objectContent.scrollTop = obj.offsetTop
  }
  if (use_widget)
  {
    // Update widget fields
    document.getElementById("vibracart_widget_items").innerHTML=cart_numitems+" "+msg_items
    document.getElementById("vibracart_widget_total").innerHTML=cart_total
    // If cart empty then hide widget if required
    if ((hidewidgetifempty) && (cart_numentries==0) && (use_widget))
      document.getElementById("vibracart_widget").style.visibility = 'hidden'
    else
      document.getElementById("vibracart_widget").style.visibility = 'visible'  
  }
  if (document.getElementById("showitemcount"))
    document.getElementById("showitemcount").innerHTML=cart_numitems
  if (document.getElementById("showcarttotal"))
    document.getElementById("showcarttotal").innerHTML=cart_total       
  if (document.getElementById("showitemcount2"))
    document.getElementById("showitemcount2").innerHTML=cart_numitems
  if (document.getElementById("showcarttotal2"))
    document.getElementById("showcarttotal2").innerHTML=cart_total       
}

function cart_addEvent(elm, evType, fn, useCapture)
// cross-browser event handling for IE5+, NS6+ and Mozilla/Gecko
// By Scott Andrew
{
  if (elm.addEventListener) {
    elm.addEventListener(evType, fn, useCapture); 
    return true; 
  } else if (elm.attachEvent) {
    var r = elm.attachEvent('on' + evType, fn); 
    return r; 
  } else {
    elm['on' + evType] = fn;
  }
}

function cart_StopEvent(pE)
{
   if (!pE)
     if (window.event)
	pE = window.event;
     else
	return;
   if (pE.cancelBubble != null)
      pE.cancelBubble = true;
   if (pE.stopPropagation)
      pE.stopPropagation();
   if (pE.preventDefault)
      pE.preventDefault();
   if (window.event)
      pE.returnValue = false;
   if (pE.cancel != null)
      pE.cancel = true;
}

function supportsAjax()
{
  var xhr = null
  try { xhr = new XMLHttpRequest(); } catch (e) {}
  try { xhr = new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}
  try { xhr = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
  return (xhr!=null)
}

function displayMessage(msg)
{
  if (msg=="1")
  {
    msgtxt=msg_button
    type=1
    delay=errordelay
  }  
  if (msg=="2")
  {
    msgtxt=msg_currency
    type=1
    delay=errordelay
  }  
  if (msg=="3")
  {
    msgtxt=msg_terms
    type=1
    delay=errordelay
  }    
  if (msg=="4")
  {
    msgtxt=msg_checkout
    type=0
    delay=messagedelay
  }  
  if (msg=="5")
  {
    msgtxt=msg_itemquantity
    type=1
    delay=errordelay
  }  
  if (msg=="6")
  {
    msgtxt=msg_cartquantity
    type=1
    delay=errordelay
  }  
  if (msg=="7")
  {
    msgtxt=msg_couponnotvalid
    type=1
    delay=errordelay
  }  
  if (msg=="8")
  {
    msgtxt=msg_itemminquantity
    type=1
    delay=errordelay
  }  
  if (msg=="9")
  {
    msgtxt=msg_cartminquantity
    type=1
    delay=errordelay
  }  
  if (msg=="10")
  {
    msgtxt=msg_cartmintotal
    type=1
    delay=errordelay
  }  
  if (msg=="11")
  {
    msgtxt=msg_cartmaxtotal
    type=1
    delay=errordelay
  }  
  if (msg=="12")
  {
    msgtxt=msg_terms2
    type=1
    delay=errordelay
  }  
  if (msg=="13")
  {
    msgtxt=msg_terms3
    type=1
    delay=errordelay
  }  
  if (msgtxt=="")
    return
  if (usejavascriptalert)       
    alert (msgtxt)
  else
    showAlert(true,msgtxt,type,delay)
}

function swapTogGif(fn)
{
  return (fn.replace (/\.[^\.]*$/, '.gif'))
}

function cart_addItemLink(lnk)
{
  lnk=lnk.substring(lnk.indexOf('?')+1, lnk.length)
  if (showcartonadd)
    showCart()
  postdata=lnk+"&cart_todo=additem&ovspt="+optionValueSeparator+"&ospt="+optionSeparator+"&idpref="+idPrefix+"&idsuff="+idSuffix+"&dprspt="+discountPriceSeparator+"&dqtopt="+discountQuantityOperator+"&sandbox="+usesandbox+"&itemlmt="+itemquantitylimit+"&cartlmt="+cartquantitylimit+"&itemminlmt="+itemquantityminlimit+"&cartminlmt="+cartquantityminlimit+"&svct="+savecart+"&pglinktg="+productPageTarget
  if (autoProductPageLink)
    postdata=postdata+"&pglink="+document.URL
  //Send item details to server
  var xmlhttp = new XMLHttpRequest()
  xmlhttp.open('POST',cart_url+'cart.php',true)
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4)
    {
      var cart_errormessage=""
      if (xmlhttp.status == 200)
      {
        cart_errormessage=updateFromXML(xmlhttp)
        updateCartTable()
      }
      showWaiting(false)
      cart_busy=false
      if (cart_errormessage!="")
        displayMessage(cart_errormessage)
    }   
  }
  cart_busy=true
  showWaiting(true)
  cart_needs_refresh=false
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xmlhttp.send(postdata)
}

function cart_deleteSaved()
{
  // Delete cookie by setting the date of expiry to yesterday
  var expdate=new Date()
  expdate.setTime(expdate.getTime()-(1*24*60*60*1000))
  cart_cookieSet("VIBRACART","",expdate,"/","",false)
}

function cart_cookieSet (name,data,expires,path,domain,secure)
{
  document.cookie = name + "=" + escape (data) + 
      ((expires) ? "; expires=" + expires.toGMTString() : "") +
      ((path) ? "; path=" + path : "") +
      ((domain) ? "; domain=" + domain : "") +
      ((secure) ? "; secure" : "")
}

function cartBackgroundGrayOut(vis, options) {
  // Pass true to gray out screen, false to ungray
  // options are optional.  This is a JSON object with the following (optional) properties
  // opacity:0-100         // Lower number = less grayout higher = more of a blackout 
  // zindex: #             // HTML elements with a higher zindex appear on top of the gray out
  // bgcolor: (#xxxxxx)    // Standard RGB Hex color code
  // grayOut(true, {'zindex':'50', 'bgcolor':'#0000FF', 'opacity':'70'});
  // Because options is JSON opacity/zindex/bgcolor are all optional and can appear
  // in any order.  Pass only the properties you need to set.
  var options = options || {}; 
  var zindex = options.zindex || 50;
  var opacity = options.opacity || 70;
  var opaque = (opacity / 100);
  var bgcolor = options.bgcolor || '#000000';
  var dark=document.getElementById('darkenScreenObject');
  if (!dark) {
    // The dark layer doesn't exist, it's never been created.  So we'll
    // create it here and apply some basic styles.
    // If you are getting errors in IE see: http://support.microsoft.com/default.aspx/kb/927917
    var tbody = document.getElementsByTagName("body")[0];
    var tnode = document.createElement('div');           // Create the layer.
        tnode.style.position='absolute';                 // Position absolutely
        tnode.style.top='0px';                           // In the top
        tnode.style.left='0px';                          // Left corner of the page
        tnode.style.overflow='hidden';                   // Try to avoid making scroll bars            
        tnode.style.display='none';                      // Start out Hidden
        tnode.id='darkenScreenObject';                   // Name it so we can find it later
    tbody.appendChild(tnode);                            // Add it to the web page
    dark=document.getElementById('darkenScreenObject');  // Get the object.
    dark.onclick=fadedPageClicked
  }
  if (vis) {
    // Calculate the page width and height 
    if( document.body && ( document.body.scrollWidth || document.body.scrollHeight ) ) {
        var pageWidth = document.body.scrollWidth+'px';
        var pageHeight = document.body.scrollHeight+'px';
    } else if( document.body.offsetWidth ) {
      var pageWidth = document.body.offsetWidth+'px';
      var pageHeight = document.body.offsetHeight+'px';
    } else {
       var pageWidth='100%';
       var pageHeight='100%';
    }   
    //set the shader to cover the entire page and make it visible.
    dark.style.opacity=opaque;                      
    dark.style.MozOpacity=opaque;                   
    dark.style.filter='alpha(opacity='+opacity+')'; 
    dark.style.zIndex=zindex;        
    dark.style.backgroundColor=bgcolor;  
    dark.style.width= pageWidth;
    dark.style.height= pageHeight;
    dark.style.display='block';                          
  } else {
     dark.style.display='none';
  }
}

function vc_itemmenu(form)
{
  var selIndex = form.vibracart_itemmenu.selectedIndex;
  var selValue = form.vibracart_itemmenu.options[selIndex].value; 
  var data=selValue.split('|')
  form.item_number.value=data[0]
  form.item_name.value=data[1]
  if (typeof data[2] != 'undefined')
  {
    if (data[2]!='')
      form.amount.value=data[2]
  }  
  if (typeof data[3] != 'undefined')
  {
    if (data[3]!='')
      form.vibracart_image.value=data[3]
  }  
  if (typeof data[4] != 'undefined')
  {
    if (data[4]!='')
      form.currency_code.value=data[3]
  }  
}
