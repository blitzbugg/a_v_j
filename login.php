<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
    
        <div class="form-inner">
          <!-- Login Form -->
          <form action="" method="POST" class="login">
            <div class="field">
              <input type="text" name="user_name" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="btn" value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="signup.php">Signup now</a></div>
          </form>
        </div>
      </div>
    </div>

    <?php
    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "job_connect");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the login form has been submitted
    if (isset($_POST['btn'])) {
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to check recruiter table
        $sql_recruiter = "SELECT * FROM recruiter WHERE recruiter_username = '$user_name' AND recruiter_password = '$pass'";
        $result_recruiter = mysqli_query($conn, $sql_recruiter);

        if (mysqli_num_rows($result_recruiter) == 1) {
            $usern = $user_name;
            header("Location: recruiterlog.php?u=$usern");
            exit();
        } else {
            // Query to check seeker table
            $sql_seeker = "SELECT * FROM seeker WHERE seeker_username = '$user_name' AND seeker_password = '$pass'";
            $result_seeker = mysqli_query($conn, $sql_seeker);

            if (mysqli_num_rows($result_seeker) == 1) {
                $usern = $user_name;
                header("Location: seekerlog.php?u=$usern");
                exit();
            } else {
                echo "<script>alert('Invalid username or password.');</script>";
            }
        } 
    }

    // Close the connection
    $conn->close();
    ?>
    <script src="js/login.js"></script>
</body>
</html>