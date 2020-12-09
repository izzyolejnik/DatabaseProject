<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Manager</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" >
	<link rel="stylesheet" href="style.css">
	<script src="main.js"></script>
</head>
<body>
<div id="content">
	<div id="loginDiv">
		<div class="container">
			<h1>Event Management System</h1>
			<label for="loginUsername"><b>Username</b></label>
			<form name = "test" method = "post" action = "">
			<input type="text" id="loginUsername" placeholder="Enter Username" /><br />
			<label for="loginPassword"><b>Password</b></label>
			<input type="password" id="loginPassword" placeholder="Enter Password"/><br />
            <button type="submit" name = "Submit" id="Submit" value = "Sumbit"> Log in </input>
            </form>
            <button type="button" id="registerButton" class="buttons" onclick="toRegister()">Sign up here!</button>
		</div>
		<span id="loginResult"></span>
	</div>
</div>

<div id="othercontent">
	<div class="container">
		<div id="registerDiv" style="display:none; visibility:hidden;">
            <span style="font-size: 2rem">Register a new user</span><br/>

            <form action= "newUser.php" method="post" style="margin-top: 2rem">
            <label for="">Username</label>
            <input type="text" name="registerUser" placeholder="Username"/><br />
            <label for="">Password</label>
			<input type="password" name="registerPassword" placeholder="Password" /><br />
            <button type="submit" name = "regLog"> Register </input>
            </form>
			<button type="button" id="logoutButton" class="buttons" onclick="mainscreen();"> Go to Login </button>

			<script>
				function mainscreen()
				{
					document.getElementById("registerDiv").style.display = "none";
					doLogout();
				}
			</script>
		</div>
	</div>
</div>
</body>
</html>

