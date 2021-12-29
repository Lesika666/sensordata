<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="5" >
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>

	<title> Sensor Data </title>

</head>

<body>

    <h1>SENSOR DATA</h1>
<?php

$servername = "localhost";
$username = "sureshroshi";
$password = "test1234";
$dbname = "mytectutor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT current FROM sensordata"; /*select items to display from the sensordata table in the data base*/

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <th>Current (AMPS)</th>        
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_current = $row["current"];
        
      
        echo '<tr> 
                <td>' . $row_current . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>

</body>
</html>

	</body>
</html>