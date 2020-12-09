<?php
$conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['loginVal']))
{
	echo ("here");
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    if($username != "" && $password != "")
    {
        $checkUnique = "SELECT * FROM User WHERE userName='$username' AND userPass ='$password'";
        $result = mysqli_query($conn, $checkUnique);
        if (mysqli_num_rows($result) > 0)
        {
			$row = $result->fetch_assoc();
			
            setcookie('userID', $row['userID']);
			
			if ($row['userType'] == 1)
			{
				header('Location: participant/home.html');
				exit;
			}
			else if ($row['userType'] == 2)
			{
				header('Location: admin/home.html');
				exit;
            }
            else if ($row['userType'] == 3)
			{
				header('Location: super-admin/home.html');
				exit;
			}	
        }
        else
        {
			?>
			<html>
			<h3 style="color: #28a745">Login Fail! Go back to login.</h3>
			<a href="index.php">Back</a>
			</html>
			<?php
			
        }

    }
    else
    {
        echo("Please enter a username and password before submitting");
    }
}
mysqli_close($conn);
?>