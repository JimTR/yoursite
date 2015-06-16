$('#input').submit(function() {
						
							title= $('#username').val().length ;	
                                                          						
						if (title = 0)
								{
								message = 'You must signed in to reply';
								alertify.alert(message);
								return false;
								}
						var editor = CKEDITOR.instances.editor1;
						var html = editor.getData();
						title= html.length ;
						if (title < 15)
							{
								message = 'Your post is too short !<br>add some more text';
								alertify.alert(message);
								return false;
							}
							
							var stat = parent.$("#message");
							stat.attr("msg_style","1");

							});
							
					
function quote(post,user,postdate) {
//alert (postdate);
	var dateline = postdate; 
	//var editor = CKEDITOR.instances.editor3;
	var value =  '<p style="padding:2%;"><b>On '+postdate+' &nbsp; '+user+' Wrote :</b></p>'+ '<blockquote>'+ $('#'+post).html()+'</blockquote><br><br>';
	var input = $('#editor3');
	var value = input.val()+value;
	input.val(value);
	alertify.success("Message Quoted");
}


