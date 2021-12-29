<?php
$servername = "localhost";
$username = "sureshroshi";
$password = "test1234";
$dbname = "mytectutor";

/*$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);*/

$distance="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $current = test_input($_POST["value"]);
        
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO SensorData (current) VALUES ('$current ')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
   
}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}