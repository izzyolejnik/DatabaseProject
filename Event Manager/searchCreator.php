<?php

    $search = $_REQUEST["q"];

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
    $unameSQL = "SELECT * FROM User WHERE userName = '$search'";
    $first = $conn->query($unameSQL);
    $uID = "";
    $uname = "";
    $rowNumOne = $first->num_rows;
    if($rowNumOne > 0)
    {
      while($row = $first->fetch_assoc())
      {
        $uname = $row["userName"];
        $uID = $row["userID"];
      }
    }
    else
    {
      returnWithError("ADMIN NOT FOUND.");
    }
    $eventSQL = "SELECT * FROM Event WHERE userID = '$uID'";

    
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
          $Name .= '"' . $uname . '"';
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