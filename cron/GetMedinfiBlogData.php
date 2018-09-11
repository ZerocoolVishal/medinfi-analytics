<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "medinfi";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$res = $conn->query("SELECT * FROM `blog`");

echo "<pre>";
while($row = $res->fetch_assoc()) {
    var_dump($row);
}
echo "</pre>";