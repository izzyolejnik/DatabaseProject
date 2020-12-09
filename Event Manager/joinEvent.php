<?php

    $id = $_REQUEST["id"];
    $uID = $_COOKIE['userID'];


    $conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
    if ($conn->connect_error)
    {
        returnWithError( $conn->connect_error );
    }

    $check = "SELECT * FROM User_Signup_Event WHERE User_userID = '$uID' AND Event_eventID = '$id'";
    $checkRes = $conn->query($check);
    if(checkRes->num_rows > 0)
    {
        // already joined
        echo "already joined";
    }
    else
    {
        // join event
        $sql = "INSERT INTO User_Signup_Event (User_userID, Event_eventID) VALUES ('$uID', '$id')";
        $result = $conn->query($sql);
    }

  // Decode json file received
  function getRequestInfo()
  {
    return json_decode(file_get_contents('php://input'), true);
  }
  
  // Send off json
  function sendResultInfoAsJson($obj)
  {
    header('Content-type: application/json');
    echo $obj;
  }
  // Return error in json file
  function returnWithError($err)
  {
    $retVal = '{"Id":0,"error":"' . $err . '"}';
       sendResultInfoAsJson($retVal);
  }
  
  // Format return into json
  function returnWithInfo($Name, $Title, $Description, $Url, $Start, $End)
    {
      $retVal = '{"Name":[' . $Name . '], "Title":[' . $Title . '], "Description":[' . $Description . '], "Url":[' . $Url . '], "Start":[' . $Start . '], "End":[' . $End . '],"error":""}';
      sendResultInfoAsJson($retVal);
    }
?>