<?php

$conn = mysqli_connect('localhost', 'root', '', 'user_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
mysqli_select_db($conn, 'user_db');


return $conn;
