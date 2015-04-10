var pop_windows = new Array();
var g_mouse_coords;

function moveToClick(evt) {
	evt = (evt) ? evt : event;
	g_mouse_coords = getPageEventCoords(evt);
}

function getPageEventCoords(evt) {
	var coords = {left:0, top:0};
	if (evt.pageX) {
		coords.left = evt.pageX;
		coords.top = evt.pageY;
	} else if (evt.clientX) {
		coords.left = 
			evt.clientX + document.body.scrollLeft - document.body.clientLeft;
		coords.top = 
			evt.clientY + document.body.scrollTop - document.body.clientTop;
		// include html element space, if applicable
		if (document.body.parentElement && document.body.parentElement.clientLeft) {
			var bodParent = document.body.parentElement;
			coords.left += bodParent.scrollLeft - bodParent.clientLeft;
			coords.top += bodParent.scrollTop - bodParent.clientTop;
		}
	}
	return coords;
}

function keyDownHandler(e)	{
    var kC  = (window.event) ?    // MSIE or Firefox?
        event.keyCode : e.keyCode;
    var Esc = (window.event) ?   
        27 : e.DOM_VK_ESCAPE // MSIE : Firefox
    
    if(kC==Esc) {
       closePop();
    }
}

function findPosX(obj) {
	var curleft = 0;
	if (document.getElementById || document.all) {
		while (obj.offsetParent) {
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (document.layers)
		curleft += obj.x;
	return curleft;
}

function findPosY(obj) {
	var curtop = 0;
	if (document.getElementById || document.all) {
		while (obj.offsetParent) {
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (document.layers)
		curtop += obj.y;
	return curtop;
}

function toggleDisplay(id) {
	if (document.getElementById) 
		var elem = document.getElementById(id); 
	else {
		if (document.all ) 
			var elem = document.all[ id ]; 
		else 
			var elem = new Object();
	}
	if (!elem )  
		return; 
	if (elem.style ) 
		elem = elem.style;
	if (typeof( elem.display ) == 'undefined' && !(window.ScriptEngine && ScriptEngine().indexOf( 'InScript' ) + 1)) { 
		window.alert( 'Hidden does not work in this browser.' ); 
		return; 
	}

	if (elem.display == 'none') 
		elem.display = 'block';
	else 
		elem.display = 'none';
}

function toggleDisabled(id) {
	if ($('#'+id).attr('disabled')) {
		$('#'+id).removeAttr('disabled');
		$('#'+id).removeAttr('class');
		$('#'+id).focus();
	}
	else {
		$('#'+id).attr('disabled',true);
		$('#'+id).attr('class','disabled');
	}
}

function showBlock(block_id) {
	$("#"+block_id).show();
}

function hideBlock(block_id) {
	$("#"+block_id).hide();
}

function parseAjaxVal(ret) {
	sep1 = '_##_';
	sep2 = '__|__';
	sep3 = '::';

	pairs = ret.split(sep1);
	for (i=0;i<pairs.length;i++) {
		pair = pairs[i].split(sep3);
		
		if (pair[0] && pair[1]) {
			val = pair[1].split(sep2);
			typeVal = val[0];
			inputVal = val[1];
			if (typeVal == 'HTML')
				$("#"+pair[0]).html(inputVal);
			else if (typeVal == 'VAL')
				$("#"+pair[0]).val(inputVal);
			else if (typeVal == 'CHK') {
				if (inputVal == '1')
					$("#"+pair[0]).attr('checked',true);
				else
					$("#"+pair[0]).attr('checked',false);
			}
			else if (typeVal == 'JS') {
				eval(inputVal);				
			}
		}		
	}
}

function changeRowChecked(rowid, chkid, alt) {
	if ($("#"+chkid).attr('checked')) {
		$("#"+rowid).attr('class','checked');
	}
	else 
		$("#"+rowid).attr('class',alt);
}
 
function closePop() {
	block_id = pop_windows.pop();
	if (block_id)
		$("#"+block_id).hide();
}

var dtCh= "-";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("Format tanggal harus : dd-mm-yyyy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Format tanggal: nilai bulan salah")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Format tanggal: nilai tanggal salah")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Format tanggal: tahun harus di antara "+minYear+" dan "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Format tanggal salah")
		return false
	}
return true
}

function cfHighlight(csv) {
	var i, err = false;
	var aid = csv.split(",");
	
	if(aid.length > 1) {
		for(i=0;i<aid.length;i++) {
			e = document.getElementById(aid[i]);
			if (e != null && e.value == "") {
				e.className = "control_err";
				e.onfocus = function () {
					this.className = "control_style";
				}
				
				err = true;
			}
		}
	}
	else {
		e = document.getElementById(aid);
		if(e != null && e.value == "") {
			e.className = "control_err";
			e.onfocus = function () {
				this.className = "control_style";
				}
			err = true;
		}
	}
	if (err)
		return false;
	
	return true;
}

function pushPopWindow(block_id) {
	//if ($("#"+block_id).css('display') != 'block') {
		pop_windows.push(block_id);
		zindex = pop_windows.length;
		$("#"+block_id).css('z-index',100+zindex);
	//}
}

$(document).ready(function() {
    document.onkeydown = keyDownHandler;
    document.onmousedown = moveToClick;
});

function goSubmit(act, key) {
	$('#main_form').submit(function(){});
	if (act)
		$('#act').val(act);
	if (key)
		$('#key').val(key);
//alert(act  + key);
	$('#main_form').submit();	
	return true;
}

function goEdit(key) {
	if (key) {
		$('#key').val(key);
		$('#act').val('edit_mode');
	}
	else
		$('#act').val('add_mode');
	return goSubmit();
}

function goDelete(key) {
	if (key) {
		if (!confirm('Are you sure to delete this data?'))
			return false;
		$('#key').val(key);
		$('#act').val('delete_mode');
		return goSubmit();
	}
	return false;
}

function goSave(key) {
	if (key)
		$('#key').val(key);
	$('#act').val('save');
	return goSubmit();	
}

function goBatal(key) {
	if (key)
		$('#key').val(key);
	$('#act').val('detail_mode');
	// menggunakan index utk skip validasi
	$('#main_form')[0].submit();
}

function goList() {
	$('#act').val('list');
	// menggunakan index utk skip validasi
	$('#main_form')[0].submit();
}

function goSearchList() {
	keyword = $('#search_list').val();
	field_search = $('#filter_field_search_list').val();
	$('#act').val('do_filter');
	$('#filter_string').val(field_search+':'+keyword+':C');
	return goSubmit();	
}

function goNumRecord() {
	$('#act').val('num_record');
	$('#filter_num_record').val($('#num_record').val());
	// menggunakan index utk skip validasi
	$('#main_form')[0].submit();
}

function etrSave(e, editkey) {
	var ev= (window.event) ? window.event : e;
	var key = (ev.keyCode) ? ev.keyCode : ev.which;
	if (key == 13)
		goSave(editkey);
}

function addAfterAutocomplete(id, stat) {
	if (stat == 'suc')
		$('#'+id).after('<img id="after_autocomplete_'+id+'" src="'+g_abs_url+'application/assets/images/check.png" />');
	else if (stat == 'err')
		$('#'+id).after('<img id="after_autocomplete_'+id+'" src="'+g_abs_url+'application/assets/images/check.png" />');
	else if (stat == 'open')
		$('#after_autocomplete_'+id).remove();
}

function enterEvent(e, button_id) {
	var ev= (window.event) ? window.event : e;
	var key = (ev.keyCode) ? ev.keyCode : ev.which;
	if (key == 13) {
		$('#'+button_id).click();
		return false;
	}
	return true;
}
