<?php

$conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['regLog']))
{
    $username = mysqli_real_escape_string($conn, $_POST['registerUser']);
    $password = mysqli_real_escape_string($conn, $_POST['registerPassword']);

    if($username != "" && $password != "")
    {
        $checkUnique = "SELECT userName FROM User WHERE userName='$username'";
        $result = mysqli_query($conn, $checkUnique);
        if (mysqli_num_rows($result) > 0)
        {
           echo("Sorry...username was already taken");
        }
        else
        {
            $insertion = "INSERT INTO User (userName, userPass, userType) VALUES ('$username','$password', '1')";
            if (mysqli_query($conn, $insertion))
            {
                echo("Success");
            }
            else
            {
                echo("failed");
            }
        }

    }
    else
    {
        echo("Please enter a username and password before submitting");
    }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
    <h3 style="color: #28a745">Registration Successful! Go back to login.</h3>
    <a href="index.php">Back</a>
</html>