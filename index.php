<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT nome 
    FROM artisti
    where nazionalita='spagnola'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        echo $result;
} else {
    echo "0 results";
}
$conn->close();
?>