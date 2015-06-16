if(typeof(vcwimpyid)=='undefined')
  var vcwimpyid="myPlayerID";
if(typeof(vcpaypalextra)=='undefined')
  var vcpaypalextra="";
if(typeof(vccurrency)=='undefined')
  var vccurrency="USD";
if(typeof(vcprice)=='undefined')
  var vcprice="0.99";
  
function vcLinkHandler(trackInfo)
{
  var paypallink 	= "https://www.paypal.com/cgi-bin/webscr?cmd=_cart&add=1&business="+escape(vcpaypal);
	if (vcpaypalextra)
		paypallink +="&"+vcpaypalextra;
	var vcitemid 	= trackInfo.vcitemid || trackInfo.file.replace(/^.*\/|\.[^.]*$/g, ''); // extracts the base file name.
  paypallink += "&item_number=" + escape(vcitemid)
	var vcitemname 	= trackInfo.vcitemname || trackInfo.title || trackInfo.file.replace(/^.*\/|\.[^.]*$/g, ''); // extracts the base file name.;
  paypallink += "&item_name=" + escape(vcitemname)
	var vcitemprice = trackInfo.vcitemprice || vcprice;
  paypallink += "&amount=" + vcitemprice;
  if (showItemImage)
  {
    vcitemimage=trackInfo.vcitemimage || trackInfo.image;
    if (vcitemimage)
      paypallink += "&vibracart_image=" + vcitemimage;
  }    
	var vcitemcurrency = trackInfo.vcitemcurrency || vccurrency;
	  paypallink +="&currency_code="+vcitemcurrency;
  vcitemprice=trackInfo.vcitemprice || vcprice;
	var vcitemmaxqty = trackInfo.vcitemmaxqty;			
  if (vcitemmaxqty)
    paypallink += "&vibracart_maxquantity=" + vcitemmaxqty;    		     	  	
	var vcitemminqty = trackInfo.vcitemminqty;			
  if (vcitemminqty)
    paypallink += "&vibracart_minquantity=" + vcitemminqty;
	if (vcitemid && vcitemprice)
		cart_addItemLink(paypallink); 
}

// Set up the "myPlayer" variable on the window scope
var myPlayer;
// Create a function to send to wimpy, which will get pinged when all players are set up
function vcsetupLinkHandler(){
  var players = vcwimpyid.split(",");
  var k;
  for (k=0; k< players.length; k++)
  {
    players[k]=players[k].trim()
  	// Get a handle to the player instance.
    myPlayer = wimpy.getPlayer(players[k]);	
    // And finally set up the link handler on the player
    myPlayer.setLinkHandler(vcLinkHandler);
  }  
}

// We need to wait until the player is set up before we can apply the link handler.
wimpy.onReady(vcsetupLinkHandler);

