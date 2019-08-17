function removequestion(QsID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showQuestion/remove/"+QsID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}