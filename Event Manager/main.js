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

function searchCreator(str)
{
	// Get info from the html
	var search = document.getElementById("searchCreator").value;

	var urlBase = "/DatabaseProject/Event%20Manager";
	var jsonPayload = '{"search" : "' + search + '"}';
	var url = urlBase + '/searchCreator.php?q=' + str;

	var xhr = new XMLHttpRequest();
	xhr.open("GET", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		// Send the json info to php
		xhr.send(jsonPayload);

		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				var jsonObject = JSON.parse(xhr.responseText);

				temp = 0;
				
				// clear the table
				for (var i = document.getElementById("creatorTable").rows.length; i > 1; i--)
				{
					document.getElementById("creatorTable").deleteRow(i -1);
				}
				
				while (temp < jsonObject.Name.length)
				{
					var table = document.getElementById('creatorTable');

					// add a new row to the bottom of the table, then fill with information
					var row = table.insertRow(-1);

					var cell1 =row.insertCell(0);
					var cell2 =row.insertCell(1);
					var cell3 =row.insertCell(2);
					var cell4 =row.insertCell(3);
					var cell5 =row.insertCell(4);
					var cell6 =row.insertCell(5);

					cell1.innerHTML = jsonObject.Name[temp];
					cell2.innerHTML = jsonObject.Title[temp];
					cell3.innerHTML = jsonObject.Description[temp];
					cell4.innerHTML = jsonObject.Url[temp];
					cell5.innerHTML = jsonObject.Start[temp];
					cell6.innerHTML = jsonObject.End[temp];
					temp++;
				}

			}
		};
	}
	catch(err)
	{
		document.getElementById("creatorSearchResult").innerHTML = err.message;
	}
}