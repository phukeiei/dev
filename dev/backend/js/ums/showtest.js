function removetest(ID_TEST)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showQuestion/remove/"+QsID;
	if(confirm("คุณต้องการเปลี่ยนหน้าหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}