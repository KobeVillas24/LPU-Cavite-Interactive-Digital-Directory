<?php
date_default_timezone_set('Asia/Manila');
@include 'config.php';
session_start();

// Log the logout activity in the audit_trail table of the interactive_directory database
$auditDbHost = 'localhost';
$auditDbUser = 'root';
$auditDbPassword = '';
$auditDbName = 'interactive_directory';

$auditConn = mysqli_connect($auditDbHost, $auditDbUser, $auditDbPassword, $auditDbName);

if (!$auditConn) {
    die("Connection to audit database failed: " . mysqli_connect_error());
}

$name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : "";

$title = 'N/A';
$activity = 'Logout (Admin)';
$timestamp = date('Y-m-d h:i A');
$User = 'Admin' . ' (' . $name . ')';

$logSql = "INSERT INTO audit_trail (title, activity, User, timestamp) VALUES ('$title', '$activity', '$User', '$timestamp')";
if (mysqli_query($auditConn, $logSql)) {
    echo 'Logout activity logged successfully.';
} else {
    echo 'Error logging logout activity: ' . mysqli_error($auditConn);
}

// Close the connection
mysqli_close($auditConn);

session_unset();
session_destroy();
header('location:./login_form.php');
exit();
?>
