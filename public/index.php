<?php

$host = 'db';
$user = 'root';
$pass = 'cod31gn1t3';
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL successfully!";
