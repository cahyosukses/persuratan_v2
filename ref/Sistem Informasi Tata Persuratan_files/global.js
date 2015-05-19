function LogOut() 
{
	if (confirm('You are about to log out from Administrator Page.\nClick OK to confirm.')) { window.top.location.href='logout.php?' }
}

function PopUp(theURL,winName,features) { //v2.0
	window.open(theURL,winName,features);
}

function Cancel(sRedir) 
{
	if (confirm('Batalkan dan kembali ke halaman sebelumnya?')) { document.location.href = sRedir}
}

function Back(sRedir) 
{
	document.location.href = sRedir
}

function Btn_Submit(FormName)
{
	document.forms[FormName].submit();
}