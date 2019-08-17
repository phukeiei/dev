function removeuser(UsID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showUser/remove/"+UsID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}	