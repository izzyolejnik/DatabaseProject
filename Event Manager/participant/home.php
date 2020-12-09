<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Manager</title>
	<script type="text/javascript" src="code.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" >
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
  	<nav>
  	  <ul>
  	  	<li><a href="home.html">Home</a></li>
  	  </ul>
  	</nav>
  </header>
  <h1>Participant Event Management</h1>
</body>
<p> 
	Welcome to the <b>Event Management System</b>. <br>
	You have made it to this page because you have been authenticated as a participant! <br>
  Here you can search for events in the following ways... <br>
  <ul>
    <li>By event <b>start</b> and <b>end</b> date</li>
    <li>By <b>currently active</b> events</li>
  </ul>
</p>
<h3>Search by Start and End Date</h3>
<input type="Date" id="start">
<input type="Date" id="end">
<h3>Search Currently Active Events</h3>
<button type="button" onclick="showActiveEvents()">Show Active Events</button>
</html>