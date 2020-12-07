function hideOrShow( elementId, showState )
{
	var vis = "visible";
	var dis = "block";
	if( !showState )
	{
		vis = "hidden";
		dis = "none";
	}
	document.getElementById( elementId ).style.visibility = vis;
	document.getElementById( elementId ).style.display = dis;
}

function toRegister()
{
	hideOrShow("registerDiv", true);
	hideOrShow("loginDiv", false);
}

function doRegister()
{
	hideOrShow("loginDiv", true);
	hideOrShow("registerDiv", false);
}

function doLogout()
{
	/*userId = 0;
	firstName = "";
	lastName = "";

	hideOrShow("loggedInDiv", false);
	hideOrShow("accessUIDiv", false);
	hideOrShow("editDiv", false);*/
	hideOrShow("loginDiv", true);
}