<?php

    $inData = getRequestInfo();
    $verified = $inData["Verified"];
    $search = $inData["search"];

    $conn = new mysqli("localhost", "USERNAME", "PASSWORD", "APP NAME");
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
    $sql = "SELECT * FROM Events WHERE (Verified = $verified AND (Name LIKE '%$search%')) ORDER BY Start";
    
    $result = $conn->query($sql);
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
          $Name .= '"' . $row["Name"] . '"';
          $Title .= '"' . $row["Title"] . '"';
          $Description .= '"' . $row["Description"] . '"';
          $Url .= '"' . $row["Url"] . '"';
          $Start .= '"' . $row["Start"] . '"';
          $End .= '"' . $row["End"] . '"';
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