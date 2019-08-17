<!doctype html>
<html lang="en">
<?		
		$host="localhost";
		$username="root";
		$password="root";
		$db="mydb";
			$connect=mysql_connect($host,$username,$password) or die ("�������ö�������Ͱҹ��������");
			mysql_db_query($db,"SET NAMES utf8");

		
		$sql = "select name from member";
		$result = mysql_query($sql);
		$num =  mysql_num_rows($result);
		$i = 1;
		echo $num;
		
		while($cate = mysql_fetch_array($result)){
		$yo = $cate['name'];
		echo '"'.$yo.'"' ;
		if($i < $num ){
		echo ",";
		$i++;
		}
		} 
		
	?>
<head>
	<meta charset="utf-8">
	<title>jQuery UI Autocomplete - Default functionality</title>
	<link rel="stylesheet" href="file:///F|/jquery/themes/base/jquery.ui.all.css">
	<script src="file:///F|/jquery/jquery-1.8.3.js"></script>
	<script src="file:///F|/jquery/ui/jquery.ui.core.js"></script>
	<script src="file:///F|/jquery/ui/jquery.ui.widget.js"></script>
	<script src="file:///F|/jquery/ui/jquery.ui.position.js"></script>
	<script src="file:///F|/jquery/ui/jquery.ui.menu.js"></script>
	<script src="file:///F|/jquery/ui/jquery.ui.autocomplete.js"></script>
	<link rel="stylesheet" href="file:///F|/jquery/work/demos.css">
	<script>
	
	$(function() {
		var availableTags = [
		<? while($cate = mysql_fetch_array($result)){
		$yo = $cate['name'];
		echo '"'.$yo.'"' ;
		if($i < $num ){
		echo ",";
		$i++;
		}
		} ?>
		];
		
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});
	</script>
</head>
<body>

<div class="ui-widget">
	<label for="tags">Tags: </label>
	<input id="tags">
</div>

<div class="demo-description">
<p>The Autocomplete widgets provides suggestions while you type into the field. Here the suggestions are tags for programming languages, give "ja" (for Java or JavaScript) a try.</p>
<p>The datasource is a simple JavaScript array, provided to the widget using the source-option.</p>
</div>
</body>
</html>
