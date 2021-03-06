/*
 * 3.js for the editor
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
				delay : 3000,
				buttonReverse : false,
				buttonFocus   : "ok"
			});
		
                   
	alertify.alert(message, function(e) {
		if (e) {
            // user clicked "ok"
            //$( "#result" ).load( "ajax/test.html" );
            $("#attach").load(id);  
            var file_data  = ajax_test (id);
            //alert('file data is '+file_data);
                //alert ("loaded " + id);
		        $.get(id, function(data) {
                     //alert (data);
                     if (data) {
                      $('#attach').html(data.replace('\r\n','<br />'));
                      }
                     else {
                     $('#attach').html('None');
                     } 
                      
            });

          
           
            alertify.success("You've updated attachments.<br>they will be applied when you save the message ");
                  
              
           
            
        } 
        
        else {
            // user clicked "cancel"
            alertify.error("You did not confirm your reservation.");
        }
								}, 'attach');
	}
function checkatt(id){
            //alert ('before id is set '+ id);   
	    $("#attach").load(id);   
                //alert ("loaded " + id);
		      $.get(id, function(data) {
                     //alert (data);
                     if (data) {
                      $('#attach').html(data.replace('\r\n','<br />'));}
                     else {$('#attach').html('None');} 
                      
            });    
		}
								
 function resizeEditor() {

  var defaultHeight = 175;
  var newHeight = window.innerHeight-120; 
  var height = defaultHeight > newHeight ? defaultHeight: newHeight;
  //alert ('going to resize to '+ height); 
  CKEDITOR.instances.editor1.resize('100%',height);
  //alert('resize done');
  }
  
  window.onresize = function() {
  //resizeEditor();
}
								
								
function ajax_test(id)
 {  $.ajax(id, {
    dataType: 'text',
    success: function (data) {
        testing = data;
        //alert('Ajax '+testing);
        //return testing;  
    }
  
}); 

}
function closeup() 
{
var msg = $('#message').html();
var msg2 = $('#message').attr("msg_style");
	if (msg2 === "0" ){
		alertify.set({delay : 1500});
		alertify.error(msg);
	}
	else{
		alertify.set({delay : 1500});
		alertify.success(msg);
		timeoutID = window.setTimeout(slowAlert, 1300);
	}
}

function slowAlert(){
	window.location.reload();
	}
	  
function windowclose() 
{
	var editor = CKEDITOR.instances.editor1;
	editdata = editor.getData();
	rp_len= editdata.length;
	var input1 = parent.$('#editor3');
	input1.val(editdata);
	var stat = parent.$("#message");
	stat.attr("msg_style","1");
	if (rp_len > 15) {
		stat.html("message not posted, but remains in the editor");
	}
	
	else {
		stat.attr("msg_style","0");
		stat.html("Message to short to save")
	}
parent.$.colorbox.close();
}

     

