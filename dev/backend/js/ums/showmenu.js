function removemenu(MnID,count)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showSystem/removemenu/"+MnID;
	if(count==0){
		if(confirm("คุณต้องการลบหรือไม่?")==true){
		window.location.href=web;
		}
		else
		{
			return false;
		}
	}
	else
	{
		alert("เมนูนี้มีเมนูย่อยไม่สามารถลบได้")
		return false
	}
}	