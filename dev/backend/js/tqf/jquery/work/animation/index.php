<!DOCTYPE html>
<html>
<head>
<style>
div {
position:absolute;
background-color:#abc;
left:50px;
width:90px;
height:90px;
margin:5px;
}
</style>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script>

$(function(){

	$("body").keydown(function(e) {
		var a;
		var b;
	  if(e.keyCode == 37) { // left
			$(".block").animate({
			  left: "-=50"
			}, 100);

	  }
	  else if(e.keyCode == 39) { // right
			$(".block").animate({
			  left: "+=50"
			}, 100);
	  }
	   else if(e.keyCode == 40) { // right
			$(".block").animate({
			  bottom: "-=50"
			}, 100);
	  }
	  else if(e.keyCode == 38) { // right
			$(".block").animate({
			  bottom: "+=50"
			}, 100);
	  }
	});
});
</script>
</head>
<body>
<button id="left">&laquo;</button> <button id="right">&raquo;</button>
<div class="block"></div>

</body>
</html>