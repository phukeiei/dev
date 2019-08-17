function removedepartment(dpID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/department/remove/"+dpID;
	
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}