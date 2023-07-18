<?php
date_default_timezone_set('Asia/Manila'); // Replace 'Your_Timezone' with your actual timezone, e.g., 'Asia/Kolkata' or 'America/New_York'


@include 'config.php';

session_start();
// Check if the user has been inactive for 5 minutes and redirect to index.php
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
   session_unset(); // Clear all session variables
   session_destroy(); // Destroy the session
   header('Location: ./admin_side.php'); // Redirect to index.php
   exit();
}

$_SESSION['last_activity'] = time(); // Update last activity time

if(isset($_POST['submit'])){

   $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : "";
   // $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : "";
   $pass = isset($_POST['password']) ? md5($_POST['password']) : "";
   $cpass = isset($_POST['cpassword']) ? md5($_POST['cpassword']) : "";
   $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : "";

   if(isset($_SESSION['login_timeout']) && $_SESSION['login_timeout'] > time()){
      // If login timeout has not expired yet, show error message
      $time_left = $_SESSION['login_timeout'] - time();
      $error[] = 'Too many failed attempts. Please try again in ' . $time_left . ' seconds.';
   }else{

      $select = " SELECT * FROM user_form WHERE name = '$name' && password = '$pass' ";

      $result = mysqli_query($conn, $select);

      if(mysqli_num_rows($result) > 0){

         $row = mysqli_fetch_array($result);
         $_SESSION['user_type'] = $row['user_type'];

         if($row['user_type'] == 'admin'){
            
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['login_attempts'] = 0; // Reset login attempts

             // Log the login activity in the audit trail
             $activity = 'Login (Admin)';
             $timestamp = date('Y-m-d h:i A');
             $title = 'N/A';
             $User = 'Admin' . ' (' . $name. ')';
             $logSql = "INSERT INTO interactive_directory.audit_trail (title, activity, User, timestamp) VALUES ('$title', '$activity', '$User', '$timestamp')";
             mysqli_query($conn, $logSql);
            header('location:admin_page.php');

         }else if($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['login_attempts'] = 0; // Reset login attempts

             // Log the login activity in the audit trail
             $activity = 'Login (User)';
             $timestamp = date('Y-m-d h:i A');
             $title = 'N/A';
             $User = 'Admin' . ' (' . $name. ')';
             $logSql = "INSERT INTO interactive_directory.audit_trail (title, activity, User, timestamp) VALUES ('$title', '$activity', '$User', '$timestamp')";
             mysqli_query($conn, $logSql);
            header('location:user_page.php');

         }
        
      }else{
         if(isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 4){
            // If user has reached max attempts, set login timeout and reset login attempts
            $_SESSION['login_timeout'] = time() + 300; // 5 minutes
            $_SESSION['login_attempts'] = 0;
            $error[] = 'Too many failed attempts. Please try again in 5 minutes.';
         }else{
            // If user has not reached max attempts, increment login attempts
            $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
            $error[] = 'Incorrect email or password! You have ' . (5 - $_SESSION['login_attempts']) . ' attempts left.';
         }
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <script>
      // Function to redirect the user to index.php after 5 minutes of inactivity
      function redirectToIndex() {
         window.location.href = "./admin_side.php";
      }

      // Set a timer to redirect after 5 minutes of inactivity
      setTimeout(redirectToIndex, 300000); // 300000 milliseconds = 5 minutes
   </script>
</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your username">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <!-- <p>Don't have an account? <a href="register_form.php">Register now</a></p> -->
      <a href="./admin_side.php" class="btn">Home</a>

   </form>

</div>

</body>
</html>