<?php
session_start();
date_default_timezone_set('Asia/Manila'); // Replace 'Your_Timezone' with your actual timezone, e.g., 'Asia/Kolkata' or 'America/New_York'

$conn = mysqli_connect('localhost', 'root', '', 'interactive_directory');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$activity = $_POST['activity'];
$User = 'Admin' . ' (' . $_POST['name']. ')';
$timestamp = date('Y-m-d h:i A');

$sql = "INSERT INTO audit_trail (title, activity, User, timestamp) VALUES ('N/A', '$activity', '$User', '$timestamp')";

if (mysqli_query($conn, $sql)) {
    echo 'Activity logged successfully.';
} else {
    echo 'Error logging activity: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
