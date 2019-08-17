$(document).ready(function(){
	setTimeout(close_message_wrap,5000);
	$(".system_messages").on("click",close_message_wrap);
	
	// Function
	function close_message_wrap(){
		$('body').find(".message_wrap").fadeOut("slow",function(){$(this).remove()});
	}
});