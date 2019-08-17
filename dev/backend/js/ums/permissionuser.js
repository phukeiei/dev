$(document).ready(
	function(){
		$("input[type=checkbox]").click(
			function(){
				var name=$(this).attr('id');
				var value=$(this).is(':checked') ? 1 : 0;
				$('input[name="hidden'+name+'"]').val(value);
			}
		);
	}
);