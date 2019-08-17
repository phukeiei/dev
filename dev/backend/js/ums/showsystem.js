function removesystem(StID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showSystem/remove/"+StID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}	