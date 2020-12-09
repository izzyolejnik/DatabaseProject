<?php
$conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
if(true)
{
	$test = $_COOKIE['userID'];
    $checkUnique = "UPDATE User SET userType = '2' WHERE userID = '$test'";
	$result = mysqli_query($conn, $checkUnique);
	
	if ($result)
	{
		header('Location: ../admin/addEvent.html');
		exit;
	}
	else
	{
		?>
		<html>
		<h3 style="color: #28a745">Couldnt promote you.</h3>
		<a href="home.php">Back</a>
		</html>
		<?php
	}
}
mysqli_close($conn);
?>