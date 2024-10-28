<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_ordering";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
	die("connection Failed:" . $conn->connect_error);
}