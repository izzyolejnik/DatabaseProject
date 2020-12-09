<?php
$conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');

if(isset($_POST['searchDate']))
{
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);

    $query = "SELECT * FROM Event WHERE eventStart BETWEEN '".$start."' AND '".$end."' ORDER BY eventStart";
    $search_result = mysqli_query($conn, $query);
}
else
{
    $currdate = date("Y-m-d");
    $query = "SELECT * FROM Event WHERE eventStart <= '$currdate' AND eventEnd >= '$currdate'";
    $search_result = mysqli_query($conn, $query);
} 
?>

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
<form action="home.php" method="post">
<label for="">Start:</label>
<input type="Date" name="start"/>
<label for="">End:</label>
<input type="Date" name="end"/>
<button type="submit" name="searchDate">Show events</button>
</form>
<table class="table">
  <tr>
      <th>Title</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>City</th>
      <th>URL</th>
  </tr>

  <!-- populate table from mysql database -->
  <?php while($row = mysqli_fetch_array($search_result)):?>
      <tr>
          <td><?php echo $row['eventTitle'];?></td>
          <td><?php echo $row['eventStart'];?></td>
          <td><?php echo $row['eventEnd'];?></td>
          <td><?php echo $row['eventCity'];?></td>
          <td><?php echo $row['eventURL'];?></td>
      </tr>
  <?php endwhile;?>
</table>
<h3>Search Currently Active Events</h3>
<button type="submit" onclick="showActiveEvents()">Show Active Events</button>
</body>
</html>