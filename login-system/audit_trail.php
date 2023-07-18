<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'interactive_directory');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT *, 
        CASE 
            WHEN activity = 'Search' THEN 'Guest' 
            WHEN activity = 'Login' OR activity = 'Logout' THEN CONCAT('Admin (', SUBSTRING_INDEX(User, '(', -1), ')')
            ELSE 'Admin' 
        END AS User 
        FROM audit_trail 
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Audit Trail</title>
    <style>
        .audit-container {
            position: relative;
            z-index: 1; /* Adjust the z-index as needed */
            height: 700px; /* Set the height of the table container */
            width: 50%;
            overflow-y: auto; /* Add a vertical scroll bar */
            
        }
        table {
            border-collapse: collapse;
            
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Audit Trail</h1>
    
    <div class="audit-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Activity</th>
                <th>User</th>
                <th>Date and Time</th>
            </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['activity']; ?></td>
                <td><?php echo $row['User']; ?></td>
                <td><?php echo $row['timestamp']; ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>