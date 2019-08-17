function removeshowwgroup(WgID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showWGroup/remove/"+WgID;
	
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}