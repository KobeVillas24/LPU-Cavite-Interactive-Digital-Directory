<?php
date_default_timezone_set('Asia/Manila'); // Replace 'Your_Timezone' with your actual timezone, e.g., 'Asia/Kolkata' or 'America/New_York'

@include './login/login-system/config.php';

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'interactive_directory');



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form is submitted
if (isset($_POST['submit'])) {
  $username = $_POST['username']; // Retrieve the user name from the form
  
  // Perform any necessary validations or checks on the user name
  
  

}
if (isset($_POST['clickHistory'])) {
  $activity = 'Checked search history';
  $timestamp = date ('Y-m-d h:i A');
  $title = 'N/A';
  $User = 'Admin' . ' (' . $_SESSION['user_name']. ')';
  $logSql = "INSERT INTO interactive_directory.audit_trail (title, activity, User, timestamp) VALUES ('$title', '$activity', '$User', '$timestamp')";

  $result = mysqli_query($conn, $logSql);
  
  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }
}


// Check if the search form is submitted
if(isset($_POST['search'])) {
  $searchKeyword = $_POST['searchKeyword'];
  
  // Query to search for the keyword in the audit trail table
  $sql = "SELECT *
          FROM audit_trail 
          WHERE title LIKE '%$searchKeyword%'
          OR activity LIKE '%$searchKeyword%'
          OR id LIKE '%$searchKeyword%'
          OR User LIKE '%$searchKeyword%'
          OR timestamp LIKE '%$searchKeyword%'
          ORDER BY id DESC";
} else {
  // Query to fetch all records from the audit trail table
  $sql = "SELECT *
          FROM audit_trail 
          ORDER BY id DESC";
}
if (isset($_POST['reset'])) {
  // Query to fetch all records from the audit trail table
  $sql = "SELECT *
          FROM audit_trail 
          ORDER BY id DESC";
  $result = mysqli_query($conn, $sql);
  
  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="refresh" content="180">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="icon" type="image/svg+xml" href="/vite.svg" /> -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LPU Cavite Interactive Digital Directory Aministrator</title>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
    
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="../../style.css"/>
   
  </head>

  <body>
    
  
    </div>
      <nav>
        <img class="nav-logo" src="lpulogosana.jpg"onclick="window.location.reload();" />
  
        <a class="supertitle" onclick="window.location.reload();">LPU CAVITE INTERACTIVE DIGITAL DIRECTORY ADMINISTRATOR</a>
        
        
        <div class="nav-btns">
          <?php
          if(isset($_SESSION["user_name"]) || isset($_SESSION["admin_name"])) {
          ?>
            <a href="./logout.php" class="btnz">Logout</a>
          <?php
          } else {
          ?>
           
            <a href="./login_form.php" class="btnz" >Login</a>
            
          <?php
          }    
          ?>
        </div>
      </nav>

    <div id="dashboard" class="<?php if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] != "admin") { echo 'hide-el'; } ?>">
      <h2>Search History</h2>
      <h3>Number of Searches of the Day</h3>
      <h4>Top 5 Most Searched Locations</h4>
      

      <ul id="search-history"></ul>

      <div id="search-history-chart-wrapper">
        <div class="chart-line-container"><canvas id="chart-line"></canvas></div>
        <div class="chart-pie-container"><canvas id="chart-pie"></canvas></div>
      </div>

      

      <div class="audit-container">
        <h1>Audit Trail</h1>
        <div class="search-form">
          <form method="post">
            <input type="text" name="searchKeyword" placeholder="Search..." />
            <input type="submit" name="search" value="Search" />
          </form>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="reset" value="Reset/Refresh Table" />
          </form>
        </div>

        <table>
    <tr>
        <th>ID</th>
        <th>Location</th>
        <th>Activity</th>
        <th>User</th>
        <th>Date and Time</th>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
          // $user = $row['User'];
          // if ($user == 'Admin') {
          //     if (!empty($row['admin_name'])) {
          //         $adminName = $row['admin_name'];
          //     } else {
          //         $adminName = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : '';
          //     }
          //     $userName = $adminName ? 'Admin (' . $adminName . ')' : 'Admin';
          // } else {
          //     $userName = $user;
          // }
          // ?>
          <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['activity']; ?></td>
              <td><?php echo $row['User']; ?></td>
              <td><?php echo $row['timestamp']; ?></td>
          </tr>
      <?php
      }
    ?>
</table>


      </div>

      
      <div class="dashboard-btns">
        <button id="clear-storage" class="btn-primary">Clear Storage</button>
        <button id="btn-search-history" class="btn-primary" data-admin-name="<?= $_SESSION['admin_name'];?>">Search History</button>

        <button id="btn-charts" class="btn-primary" data-admin-name="<?= $_SESSION['admin_name'];?>">Charts</button >

        <button id="btn-audittrail" class="btn-primary"data-admin-name="<?= $_SESSION['admin_name'];?>">Audit Trail</button >


        <a class="btn-primary" href="./register_form.php" style="margin-left: 0px; display: none;">Register now</a>
        <!-- <button id="homes" onclick="location.reload()">Home</button> -->
      </div>
    </div>
    <script>
      function preventFormSubmit(event) {
        event.preventDefault();
        // Additional JavaScript logic here
        // You can perform AJAX requests or modify the DOM using JavaScript
      }
</script>
    <script type="module" src="../../js/admin_side.js"></script>
  </body>
</html>