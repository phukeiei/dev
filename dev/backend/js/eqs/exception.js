function assay_value(key,data_ary,all_field){
	var data_determine = document.getElementById(key);
	var check;
	var message ="";
	data_determine.value = (data_determine.value).trim();
		if(data_determine.value){
			check = validation(data_ary,key,data_determine.value)
			if(!check){
				message = wrong_message();
				document.getElementById(key+"_log").value = false;
			}else{
				message = correct_message()
				document.getElementById(key+"_log").value = true;
			}
		}else{
				message = " ";
				document.getElementById(key+"_log").value = false;
		}			
			document.getElementById('assert_'+key).innerHTML = message;
			assert_submit(all_field);
}

function correct_message(){
	return "<img src='https://10.16.64.86/pisite/images/EQS/picture/correct.png'> <font color='green'>ชื่อนี้สามารถใช้ได้</font>";
}

function wrong_message(){
	return "<img src='https://10.16.64.86/pisite/images/EQS/picture/wrong.png'> <font color='red'>ชื่อนี้มีอยู่ในระบบแล้ว</font>";
}

function validation(ary,key,data){
	var check = true;
	for(var i = 0;ary[i];i++){
		if(ary[i][key] == data){
			check = false;
			break;
		}
	}
	return check;
}

function assert_submit(field){
	var check = true;
	var temp;
	for(var i=0;field[i];i++){
		temp = document.getElementById(field[i]+"_log");
		if(temp.value=="false"){
		check = false;break;
		}
	}
	if(check)
		document.getElementById("btnSubmit").disabled = false;
	else
		document.getElementById("btnSubmit").disabled = true;
}