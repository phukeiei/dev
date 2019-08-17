function removeservice(SvID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showService/remove/"+SvID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}