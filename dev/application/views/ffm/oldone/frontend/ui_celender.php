<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>core/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>daygrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>timegrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>list/main.css' rel='stylesheet' />
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>core/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>interaction/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>daygrid/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>timegrid/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>list/main.js'></script>
<script>
$(document).ready(function() {
	callselect()
	$("#ff_select").on("change",function(){
		var word = $(this).val()
		$(".card-title").html("ปฏิทิน"+$('#ff_select option[value='+word+']').text())
		calldata() 
	});
});
function addZero(num){
    if(num<10){
        return "0"+num
    }
    else{
        return num;
    }
}
function callselect(){
	$.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo site_url('/ffm/frontend/C_test/get_all'); ?>",
        data: {},
		success:function(data){
			$("#ff_select").empty()
			data.forEach((row) => {
				$("#ff_select").append("<option value='"+row.ff_id+"'>"+row.ff_name+"</option>")
			})
			$("#ff_select").val($("#ff_select option:first").val());
			$('#ff_select').selectpicker('val', $("#ff_select option:first").val());
			$('#ff_select').selectpicker('refresh');
			$('#ff_select').change();
			calldata()
		}
	})
}
function calldata() {
	$("#calendar").empty()
	var value = $("#ff_select").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo site_url('/ffm/frontend/C_test/get'); ?>",
        data: {fr_ff_id:value},
        success: function(data) {
            var obj = [];
            console.log(data)
            data.forEach(function(row) {
                var date1 = new Date(row.fr_start_date)
                var date2 = new Date(row.fr_end_date)
                var diffTime = Math.abs(date2.getTime() - date1.getTime())
                var diffDay = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
                for(var i=0;i<=diffDay;i++) {
                    obj.push({ 
                        title: row.pf_name + row.fr_first_name + " " + row.fr_last_name,
                        start: date1.getFullYear()+"-"+addZero(date1.getMonth())+"-"+date1.getDate()+"T"+row.fr_start_time,
                        end: date1.getFullYear()+"-"+addZero(date1.getMonth())+"-"+date1.getDate()+"T"+row.fr_end_time,
                         color: "rgb(198,239,206)",
                         textColor:"#ff0000",


                         
                        ad_start: date1.getFullYear()+"-"+addZero(date1.getMonth())+"-"+date1.getDate(),
                        ad_end: date1.getFullYear()+"-"+addZero(date1.getMonth())+"-"+date1.getDate(),
                        at_start: row.fr_start_time,
                        at_end: row.fr_end_time
                    });
                    console.log(date1.getFullYear()+"-"+date1.getMonth()+"-"+date1.getDate()+"T"+row.fr_start_time);
                    console.log(date1.getFullYear()+"-"+date1.getMonth()+"-"+date1.getDate()+"T"+row.fr_end_time);
                    date1.setDate(date1.getDate() + 1);
                }
            })
            obj.sort(function(a, b) {
                var dateA = new Date(a.ad_start), dateB = new Date(b.ad_start);
                return dateA - dateB;
            });
            var hour = 0;
            var DateNow = "";
            obj.forEach((row) => {
                if(DateNow == row.ad_start){
                    var result_one = row.at_start.split(":")
                    var result_two = row.at_end.split(":")
                    var hour_one = 0;
                    var hour_two = 0;
                    if(parseInt(result_one[0])<9){
                        hour_one = 9
                    }
                    else if(parseInt(result_one[0])>21){
                        hour_one = 21
                    }
                    else{
                        hour_one = result_one[0]
                    }
                    if(parseInt(result_two[0])<9){
                        hour_two = 9
                    }
                    else if(parseInt(result_two[0])>21){
                        hour_two = 21
                    }
                    else{
                        hour_two = result_two[0]
                    }
                    hour += hour_two-hour_one
                }
                else{
                    console.log(DateNow,hour)
                    if(hour<12){
                        obj.push({
                            start: DateNow,
                            end: DateNow,
                            rendering: 'background',
                             color: "rgb(198,239,206)"
                        })
                    }
                    else{
                        obj.push({
                            start: DateNow,
                            end: DateNow, 
                            rendering: 'background',
                            color: "red"
                        })
                    }
                    hour = 0
                    DateNow = row.ad_start
                    var result_one = row.at_start.split(":")
                    var result_two = row.at_end.split(":")
                    var hour_one = 0;
                    var hour_two = 0;
                    if(parseInt(result_one[0])<9){
                        hour_one = 9
                    }
                    else if(parseInt(result_one[0])>21){
                        hour_one = 21
                    }
                    else{
                        hour_one = result_one[0]
                    }
                    if(parseInt(result_two[0])<9){
                        hour_two = 9
                    }
                    else if(parseInt(result_two[0])>21){
                        hour_two = 21
                    }
                    else{
                        hour_two = result_two[0]
                    }
                    hour += hour_two-hour_one
                }
            })

            console.log(DateNow,hour)
            if(hour<12){
                obj.push({
                    start: DateNow,
                    end: DateNow,
                    rendering: 'background',
                     color: "rgb(198,239,206)"
                })
            }
            else{
                obj.push({
                    start: DateNow,
                    end: DateNow, 
                    rendering: 'background',
                    color: "red"
                })
            }
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th', // the initial locale. of not specified, uses the first one
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                defaultDate: new Date(),
                minTime: '09:00:00',
                maxTime: '22:00:00',
                navLinks: true, // can click day/week names to navigate views
                businessHours: false, // display business hours
                editable: false,
                events: obj
            });
            calendar.render();
        }
    })
}
document.addEventListener('DOMContentLoaded', function() {});
</script>
<style>
body {
    margin: 40px 10px;
    padding: 0;
    font-size: 14px;
}

#calendar {
    max-width: 1000px;
    margin: 0 auto;
	font-size : 20px;
}

.fc-center h2 {
    color: black;
}
</style>











<div class="row">
<div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-content">

  

   <div class="form-group">
	        <label class="col-sm-3 control-label">กรุณาเลือกสนามที่ต้องการทราบ  :</label>
	        <div class="col-sm-3">
             <select  data-style="select-with-transition" id="ff_select" title="Single Select" data-size="7"  tabindex="-98"></select>
                    
               </select>
	        </div>
        </div>
                <h2 class="card-title" style="text-align: center;">
                    ปฏิทินสนามฟุตบอลบางปลา
                </h2>
            </div><br>
            <div id='calendar'></div>
        </div>

    </div>
</div>