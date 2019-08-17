 String.prototype.replaceAt=function(index, character) {
      return this.substr(0, index) + character + this.substr(index+character.length);
  }
$(document).ready(
	function(){
		$("input[type=checkbox]").click(
			function(){
				var name=$(this).attr('id');
				var value=$(this).is(':checked') ? "1" : "0";
				var str=document.getElementById("hidden"+name.substring(name,name.length-1)+"control").value;
				
				if(name.substr((name.length-1),1) == "x"){
					str = str.replaceAt(0,value);
				}
				else if(name.substr((name.length-1),1) == "c"){
					str = str.replaceAt(1,value);
				}
				else if(name.substr((name.length-1),1) == "r"){
					str = str.replaceAt(2,value);
				}
				else if(name.substr((name.length-1),1) == "u"){
					str = str.replaceAt(3,value);
				}
				else if(name.substr((name.length-1),1) == "d"){
					str = str.replaceAt(4,value);
				}
				$('input[name="hidden'+name.substring(name,name.length-1)+'control"]').val(str);
			}
		);
	}
);