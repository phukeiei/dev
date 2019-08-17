function newXmlHttp(){
var xmlhttp = false;

  try{
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  }catch(e){
	  try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  }catch(e){
		xmlhttp = false;
	  }
  }

  if(!xmlhttp && document.createElement){
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function check_name(title, desc, nm, Page, Mode) {
  var cancle=false;
    if (title.length==0) {
      alert('กรุณาป้อนหัวข้อก่อน');
      document.frmMain.title.focus(); 
      cancle=true;
    } else 

    if (desc.length==0) {
      alert('กรุณาป้อนรายละเอียดก่อน');
      document.frmMain.da-ex-wysiwyg.focus(); 
      cancle=true;
    } else
	
    if (nm.length==0) {
      alert('กรุณาป้อนชื่อก่อน');
      document.frmMain.name.focus(); 
      cancle=true;
    }		
  
  if (cancle==false) {
    doAdd(Page, Mode);		
  }
  return false;
}

function doAdd(Page, Mode) {

  var url = 'add_question.php';
  var pmeters = "qName=" + encodeURI( document.getElementById("name").value ) +
    "&qDetail=" + encodeURI( document.getElementById("detail").value ) +
	"&qTitle=" + encodeURI( document.getElementById("title").value ) +
    "&page=" + Page +
    "&qMode=" + Mode ;		
  xmlhttp = newXmlHttp();
  xmlhttp.open('POST',url,true);

  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.setRequestHeader("Content-length", pmeters.length);
  xmlhttp.setRequestHeader("Connection", "close");
  xmlhttp.send(pmeters);
							
  xmlhttp.onreadystatechange = function()
  {

    if(xmlhttp.readyState == 3)  // Loading Request
    {
      document.getElementById("msg").innerHTML = "Now is Loading...";
    }

    if(xmlhttp.readyState == 4) // Return Request
    {
      document.getElementById("msg").innerHTML = xmlhttp.responseText;
      document.getElementById("title").value = '';
      document.getElementById("detail").value = '';	
      document.getElementById("name").value = '';				
    }
				
  }	

}
 
 
 

function check_data(msg, nm, ID, Page, Mode) {
  var cancle=false;
    if (msg.length==0) {
      alert('กรุณาป้อนรายละเอียดก่อน');
      document.frmAns.detail.focus(); 
      cancle=true;
    } else
	
    if (nm.length==0) {
      alert('กรุณาป้อนชื่อก่อน');
      document.frmAns.name.focus(); 
      cancle=true;
    }	
  
  if (cancle==false) {
    doAddAns(ID, Page, Mode);
  }
  return false;
}

function doAddAns(ID, Page, Mode) {

  var url = 'add_answer.php';
  var pmeters = "aName=" + encodeURI( document.getElementById("name").value ) +
    "&aDetail=" + encodeURI( document.getElementById("detail").value ) +
    "&page=" + Page +	
    "&aMode=" + Mode +						
    "&tID=" + ID;
  xmlhttp = newXmlHttp();
  xmlhttp.open('POST',url,true);

  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.setRequestHeader("Content-length", pmeters.length);
  xmlhttp.setRequestHeader("Connection", "close");
  xmlhttp.send(pmeters);
			
  xmlhttp.onreadystatechange = function()
  {
    if(xmlhttp.readyState == 3)  // Loading Request
    {
      document.getElementById("msg").innerHTML = "Now is Loading...";
    }

    if(xmlhttp.readyState == 4) // Return Request
    {
      document.getElementById("msg").innerHTML = xmlhttp.responseText;
      document.getElementById("detail").value = '';	
      document.getElementById("name").value = '';				
    }
				
  }	

}