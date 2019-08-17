function removegroup(StID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showWorkGroup/remove/"+StID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}
				