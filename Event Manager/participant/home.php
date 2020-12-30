<?php
$conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');

if(isset($_POST['searchDate']))
{
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);

    $query = "SELECT * FROM Event WHERE eventStart BETWEEN '".$start."' AND '".$end."' ORDER BY eventStart";
    $search_result = mysqli_query($conn, $query);
}

else if(isset($_POST['searchCity']))
{
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $city = strtolower($city);

    $query = "SELECT * FROM Event WHERE eventCity='$city'";
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
	<script type="text/javascript" src="../main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" >
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
  	<nav>
  	  <ul>
  	  	<li><a href="home.php">Home</a></li>
        <li><a href="host.php">Host An Event</a></li>
        <?php
          $conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
          if ($conn->connect_error)
          {
              die("Connection failed: " . $conn->connect_error);
          }
          if(isset($_COOKIE['userID']))
          {
            $userID = $_COOKIE['userID'];
            
            $userCheck = "select * from User where userID = '$userID'";
            $result = mysqli_query($conn, $userCheck);
            
            if ($result)
            {
              $row = $result->fetch_assoc();
              if ($row['userType'] == 2)
              {
                ?>
                <li><a href="../admin/home.html">Admin View</a></li>
                <?php
              }
            }
          }
          mysqli_close($conn);
        ?>
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
      <th>Join</th>
  </tr>

  <!-- populate table from mysql database -->
  <?php while($row = mysqli_fetch_array($search_result)):?>
      <tr>
          <td><?php echo $row['eventTitle'];?></td>
          <td><?php echo $row['eventStart'];?></td>
          <td><?php echo $row['eventEnd'];?></td>
          <td><?php echo $row['eventCity'];?></td>
          <td><?php echo $row['eventURL'];?></td>
          <td><button type="button" id="registerButton" class="buttons" onclick="joinEvent(<?php echo $row['eventID'];?>)">Join</button></td>
      </tr>
  <?php endwhile;?>
</table>

<h3>Search by City</h3>
<form action="home.php" method="post">
<label for="">City:</label>
<input type="text" name="city"/>
<button type="submit" name="searchCity">Show events</button>
</form>
</body>
</html>