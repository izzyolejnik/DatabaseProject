<?php
$conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['eventInfo']))
{
	
    $title = $_POST['title'];
    $des = $_POST['description'];
    $URL = $_POST['link'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $address = $_POST['address'];
    $city = $_POST['city'];
	$userID = $_COOKIE['userID'];
	
    $checkUnique = "INSERT INTO Event (userID, eventTitle, eventDesc, eventURL, eventStart, eventEnd, eventAddress, eventCity) VALUES ('$userID','$title','$des','$URL','$start','$end','$address','$city')";
	$result = mysqli_query($conn, $checkUnique);
	
	if ($result)
	{
		header('Location: home.html');
		exit;
	}
	else
	{
		?>
		<html>
		<h3 style="color: #28a745">Event creation failed. Try again.</h3>
		<a href="home.html">Back</a>
		</html>
		<?php
	}
}
mysqli_close($conn);
?>