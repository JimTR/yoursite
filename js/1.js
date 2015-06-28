/*
 * 1.js
 * 
 * Copyright 2014 Jim Richardson <jim@noideersoftware.co.uk>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

function loadframe(x)
{
	//alert (x.src);
	// set alert on
x.src = x.src; 

}


function Alert() {
//event.preventDefault();
var id = $('#attachbtn').attr('file-id');
//alert (id);
var data = ''; 
 message = '<iframe src ="attach.php" style="border:0;width:100%;height:220px;overflow:hidden;width:99%" scrolling="no"></iframe> ';
	
	alertify.set({
				labels : {
					ok     : "Done",
					cancel : "Cancel"
				},
				delay : 2000,
				buttonReverse : false,
				buttonFocus   : "ok"
			});
		
                   
	alertify.alert(message, function(e) {
		if (e) {
            // user clicked "ok"
            //$( "#result" ).load( "ajax/test.html" );
            $("#attach").load(id);   
                alert ("loaded " + id);
		        $.get(id, function(data) {
                     //alert (data);
                      $('#attach').html(data.replace('\r\n','<br />'));
                      
            });

           
            alertify.success("You've updated attachments.<br>they will be applied when you save the message ");
            
            
              
           
            
        } 
        
        else {
            // user clicked "cancel"
            alertify.error("You did not confirm your reservation.");
        }
								}, 'attach');
	}		
	
								
     $(document).ready(function($){
        // Get current url
        // Select an a element that has the matching href and apply a class of 'active'.
        var url = window.location.href;
	url = url.split("?")[0]; // strip the url parameters off 
	var current_file = url.split('/').pop(); // get the file name to evaluate
		// switch statement here
		switch (current_file) { 
		case "":
			// blank file name add index.php to it
                        url = url + "index.php";
			break;
		// now run through the file names that need to resolve to the index
		case "category.php":
		case "topic.php":
		case "create_topic.php":
		case "create_cat.php":
		case "editpost.php":
			url = url.replace(current_file, "index.php");
			//alert (url);
			break;	
		case "edit_tab.php":
			cut_url = url.split('/').pop();
			alert(url);
			url = 'admin.php';	 
		}
		
               
        $( "#menu" ).children().removeClass( "active" );
        $('li a[href$="' + url + '"]').parent('li').addClass("active"); 
        //var test = window.location.pathname ;
        //alert ("this is the actual file ? "+test);
			 setInterval('updateClock()', 1000);
			 //setInterval('updateServerClock()', 1000);
           
    });

function updateClock ( )
    {
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
 
    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
 
    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;
 
    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
     
     
    $("#clock").html(currentTimeString);
         
 }
								
function updateServerClock ( )
    {
    var $worked = $("#sclock"); //define the target element
    var curdate = new Date ();  // define the user date
    var $xdst = $("#dst"); //define the 'settings element'
    var dst = $xdst.html() // is the server in dst ? php suppiles the answer only works,currently with gmt/bst 
    var offset = curdate.getTimezoneOffset(); // how far from utc ?
        
    offset=offset/60;
    window.console.log('dst = '+dst);
   
   

	myStartDate = new Date ();
	if (dst=1) {offset+=1; } //if the server is in dst add an hour 
	     
	var hours = myStartDate.getHours();
	myStartDate.setHours(hours + (offset));
//window.console.log(myStartDate);

 var dt2 = new Date(myStartDate.valueOf() + 1000); // add a second
        currentHours = dt2.getHours ( );
        currentMinutes = dt2.getMinutes ( );
        currentSeconds = dt2.getSeconds ( );
        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
        currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
        var ts = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
        //alert (dt2.getDay());
        day = dt2.getDay()
        if (day > 0 && day < 6 ) { ts = ts+ '<br> this is a work day';}
        else {ts = ts+ '<br>we are closed';}
      window.console.log('Day = '+ day);
        $worked.html(ts); 
   
        
 }								

function Create_PDF(){  
// loads & excutes the PDF module requires a container with the id 'hidden'
$("#hidden").load("pdf.php"); 
return false; 
}

function Display_PDF() {
    //Displays the PDF in a new browser window/tab
    $(this).target = "_blank";
    nwin = window.open ("test5.pdf");
    nwin.focus();
    
}

function Get_Day_Of_The_Week (date){

switch (date.getDay()) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
    dow = 0;
    //return true;
    break;
    case 0:
    case 6:
        dow = 1;
      //  return false;
}
//alert (dow);
return dow;

}

