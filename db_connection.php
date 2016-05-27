<?php
/**
 * Created by PhpStorm.
 * User: Bas de Ruiter
 * Date: 27-5-2016
 * Time: 10:51
 */

$servername = "localhost";
$username = "root";
$password = "";
$database = "funda_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>