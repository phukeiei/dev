function removeIcon(sid)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showIcon/remove/"+sid;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}