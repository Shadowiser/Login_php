<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection échouée " . $conn->connect_error);
}
