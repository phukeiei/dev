/*
* removeComma
* @input: value number that has comma
* @output: remove comma from number for process
* @author: Jiranun
* @Create Date: 2559-06-18
* @using : removeComma(2,000) or removeComma(number)--> number has comma
*/
function removeComma(val){
	var val_string_comma = val;
	var val_clear_comma = val_string_comma.replace(/\,/g,'');
	return val_clear_comma;
} 	

/*
* currencyFormat
* @input: value number that has not comma
* @output: put comma to number for display on js.
* @author: Jiranun
* @Create Date: 2559-06-18
* @using : currencyFormat(2000) or currencyFormat(number)--> number has not comma
*/
function currencyFormat (amount) {
	//return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "0,")
	var delimiter = ","; // replace comma if desired
	var a = amount.split('.',2)
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3) {
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}

/*
* Numbers
* @input: value is number only And Decimal
* @output: if !number it can't input.
* @author: Jiranun
* @Create Date: 2559-06-18
* @using : onKeyPress="return Numbers(event) "
*/

function Numbers(e){
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) {// IE
	  keynum = e.keyCode;
	}
	else if(e.which) {// Netscape/Firefox/Opera
	  keynum = e.which;
	}
	if(keynum == 13 || keynum == 8 || typeof(keynum) == "undefined"){
			return true;
	}
	keychar= String.fromCharCode(keynum);
	numcheck =  /^[0-9]*(\.?)[0-9]*$/; // อยากจะพิมพ์อะไรได้มั่ง เติม regular expression ได้ที่ line นี้เลยคับ
	//calc(); //ทำการคำนวนงบประมาณอัตโนมัติ

	return numcheck.test(keychar);
}

/*
* isNumberKey
* @input: value is number only
* @output: if !number it can't input.
* @author Krittanat
* @Create Date 2559-07-04
*/
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}