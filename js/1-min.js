function loadframe(x)
{x.src=x.src;}
function Alert(){var id=$('#attachbtn').attr('file-id');var data='';message='<iframe src ="attach.php" style="border:0;width:100%;height:220px;overflow:hidden;width:99%" scrolling="no"></iframe> ';alertify.set({labels:{ok:"Done",cancel:"Cancel"},delay:2000,buttonReverse:false,buttonFocus:"ok"});alertify.alert(message,function(e){if(e){$("#attach").load(id);alert("loaded "+id);$.get(id,function(data){$('#attach').html(data.replace('\r\n','<br />'));});alertify.success("You've updated attachments.<br>they will be applied when you save the message ");}
else{alertify.error("You did not confirm your reservation.");}},'attach');}
$(document).ready(function($){var url=window.location.href;url=url.split("?")[0];var current_file=url.split('/').pop();switch(current_file){case"":url=url+"index.php";break;case"category.php":case"topic.php":case"create_topic.php":case"create_cat.php":case"editpost.php":url=url.replace(current_file,"index.php");break;case"edit_tab.php":cut_url=url.split('/').pop();url='admin.php';}
$("#menu").children().removeClass("active");$('li a[href$="'+url+'"]').parent('li').addClass("active");setInterval('updateClock()',1000);});function updateClock()
{var currentTime=new Date();var currentHours=currentTime.getHours();var currentMinutes=currentTime.getMinutes();var currentSeconds=currentTime.getSeconds();currentMinutes=(currentMinutes<10?"0":"")+currentMinutes;currentSeconds=(currentSeconds<10?"0":"")+currentSeconds;var timeOfDay=(currentHours<12)?"AM":"PM";currentHours=(currentHours>12)?currentHours-12:currentHours;currentHours=(currentHours==0)?12:currentHours;var currentTimeString=currentHours+":"+currentMinutes+":"+currentSeconds+" "+timeOfDay;$("#clock").html(currentTimeString);}
function updateServerClock()
{var $worked=$("#sclock");var curdate=new Date();var $xdst=$("#dst");var dst=$xdst.html()
var offset=curdate.getTimezoneOffset();offset=offset/60;window.console.log('dst = '+dst);myStartDate=new Date();if(dst=1){offset+=1;}
var hours=myStartDate.getHours();myStartDate.setHours(hours+(offset));var dt2=new Date(myStartDate.valueOf()+1000);currentHours=dt2.getHours();currentMinutes=dt2.getMinutes();currentSeconds=dt2.getSeconds();var timeOfDay=(currentHours<12)?"AM":"PM";currentHours=(currentHours>12)?currentHours-12:currentHours;currentMinutes=(currentMinutes<10?"0":"")+currentMinutes;currentSeconds=(currentSeconds<10?"0":"")+currentSeconds;var ts=currentHours+":"+currentMinutes+":"+currentSeconds+" "+timeOfDay;day=dt2.getDay()
if(day>0&&day<6){ts=ts+'<br> this is a work day';}
else{ts=ts+'<br>we are closed';}
window.console.log('Day = '+day);$worked.html(ts);}
function Create_PDF(){$("#hidden").load("pdf.php");return false;}
function Display_PDF(){$(this).target="_blank";nwin=window.open("test5.pdf");nwin.focus();}
function Get_Day_Of_The_Week(date){switch(date.getDay()){case 1:case 2:case 3:case 4:case 5:dow=0;break;case 0:case 6:dow=1;}
return dow;}
function loadPopupBox(pname,top){var ele='#'+pname
$(".popup_box").hide("slow");$(ele).css("position","absolute");$(ele).css("top",top);$(ele).css("left",Math.max(0,(($(window).width()-$(ele).outerWidth())/ 2)+
$(window).scrollLeft())+"px");$('#'+pname).fadeIn("slow");$("#container").css({"opacity":"0.3"});}
function unloadPopupBox(pname){$('#'+pname).fadeOut("slow");$("#container").css({"opacity":"1"});}