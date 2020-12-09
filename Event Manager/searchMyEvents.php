<?php

    $active = $_REQUEST["active"];

    $conn = mysqli_connect('classdb.coxzu7nvqfji.us-east-2.rds.amazonaws.com', 'admin', 'SecurePassword123', 'mydb');
    if ($conn->connect_error)
    {
        returnWithError( $conn->connect_error );
    }
    $Name = "";
    $Title = "";
    $Description = "";
    $Url= "";
    $Start = "";
    $End = "";

    $searchCount = 0;

    $eventSQL = "";
    $uID = $_COOKIE['userID'];

    if($active == '1')
    {
        $eventSQL = "SELECT * FROM Event WHERE userID = '$uID' AND eventEnd >= CURDATE() AND eventStart <= CURDATE()";
    }
    else
    {
        $eventSQL = "SELECT * FROM Event WHERE userID = '$uID'";
    }

    $result = $conn->query($eventSQL);
    $rowNumber = $result->num_rows;
    
    if($rowNumber > 0)
    {
      while($row = $result->fetch_assoc())
      {
        if( $searchCount > 0 )
        {
            $Name .=",";
            $Title .=",";
            $Description .=",";
            $Url .=",";
            $Start .=",";
            $End .=",";
          }
          $searchCount++;
          $Name .= '"' . $row["userID"] . '"';
          $Title .= '"' . $row["eventTitle"] . '"';
          $Description .= '"' . $row["eventDesc"] . '"';
          $Url .= '"' . $row["eventURL"] . '"';
          $Start .= '"' . $row["eventStart"] . '"';
          $End .= '"' . $row["eventEnd"] . '"';
      }
      
      $conn->close();
      returnWithInfo( $Name, $Title, $Description, $Url, $Start, $End);
  }
  else
  {
      returnWithError("No events by this Admin");
      $conn->close();
      exit();
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