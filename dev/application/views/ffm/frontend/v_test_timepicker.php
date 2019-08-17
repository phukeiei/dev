<link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/ffm/frontend/for_test2/dist/bootstrap-clockpicker.min.css");?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/ffm/frontend/for_test2/assets/css/github.min.css");?>">
<script type="text/javascript" src="<?php echo base_url("application/views/ffm/frontend/for_test2/dist/bootstrap-clockpicker.min.js");?>"></script>
    
    
    
    <input class="clockpicker form-control"  value="20:48" data-default="20:48">
<script type="text/javascript">

var hours = ["9","10","11","12","13","14","15","16","17","18","19","20","21"];
var choices = ["00","30"];

$('.clockpicker').clockpicker({
  autoclose: true,
  afterShow: function() {
    $(".clockpicker-minutes").find(".clockpicker-tick").filter(function(index,element){
      return !($.inArray($(element).text(), choices)!=-1)
    }).remove();
	$(".clockpicker-hours").find(".clockpicker-tick").filter(function(index,element){
      return !($.inArray($(element).text(), hours)!=-1)
    }).remove();
  }
});
</script>