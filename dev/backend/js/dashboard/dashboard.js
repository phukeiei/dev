$(document).ready(function() {
		
	$('.demo-options').hide('slow/400/fast', function() {
		//$('.layout-boxed').css('background','url(assets/img/patterns/rockywall.png)');
		
	});
	$('.sidebar-default').hide('slow/400/fast', function() {
		
	});
	$('.main-panel').css('border','0px');
	$('.main-panel').css('box-shadow','0px');
	$('.panel.panel-default').css('border','0px');
	// $('.cpicker').colorpicker().on('changeColor' , function(e){
		// console.log(e.color.toHex());
		// $('.layout-boxed,.main-panel,.panel.panel-default,.row.no-gutter,.static-content-wrapper,.row.child,.panel-body').css('background-color', $(this).val());
	// });
	$('.navbar-brand').css('width','60px');
	$('.username').css('font-size','16px');
	$('.logo-area').on('click', function (){
		if($('.static-sidebar').is(":visible")){
			$('.sidebar-default').hide('fast');

			$('.static-sidebar').css('z-index','0');
		}else{
			$('.sidebar-default').show('fast');
			$('.static-sidebar').css('z-index','2');
		}
	});
	$('#myModal').on('hidden.bs.modal', function () {
	   $(this).find('.modal-body').html('');
	   $(this).find('.modal-title').html(' ');
	});
	$("body").on('click','.custom-menu>li>a',function(event){
		event.preventDefault();
		var href = $(this).attr('href');
		href = href.substring(1);
		
		var parent = $(this).parents().eq(4);//closest('.row');
		console.log(parent);
		parent.find('table').hide();
		parent.find('table#'+href).fadeIn(1000);
		//parent.find('table#'+href).show();
	});

	
	//$("#startEle").trigger('click');
});