<?php
// Establish database connection
// Establish database connection
$conn = new mysqli("localhost", "root", "", "job_connect");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the signup form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if the user is a recruiter or a seeker
    if (isset($_POST['user_role'])) {
        $role = $_POST['user_role'];

        if ($role === 'recruiter' && isset($_POST['recruiter_username'])) {
            // Recruiter form submission
            $recruiter_id = mysqli_real_escape_string($conn, $_POST['recruiter_id']);
            $recruiter_username = mysqli_real_escape_string($conn, $_POST['recruiter_username']);
            $recruiter_password = mysqli_real_escape_string($conn, $_POST['recruiter_password']);
            $recruiter_name = mysqli_real_escape_string($conn, $_POST['recruiter_name']);
            $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
            $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
            $recruiter_contact = mysqli_real_escape_string($conn, $_POST['recruiter_contact']);

            // Insert data into recruiter table
            $sql_recruiter = "INSERT INTO recruiter (recruiter_id, recruiter_username, recruiter_password, recruiter_name, job_title, job_description, recruiter_contact) 
                        VALUES ($recruiter_id, '$recruiter_username', '$recruiter_password', '$recruiter_name', '$job_title', '$job_description', '$recruiter_contact')";
        
            if ($conn->query($sql_recruiter) === TRUE) {
                echo "<script>alert('Recruiter registered successfully.');</script>";
            } else {
                // Improved error handling
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }

        } elseif ($role === 'seeker' && isset($_POST['seeker_username'])) {
            // Seeker form submission
            $seeker_id = mysqli_real_escape_string($conn, $_POST['seeker_id']);
            $seeker_username = mysqli_real_escape_string($conn, $_POST['seeker_username']);
            $seeker_password = mysqli_real_escape_string($conn, $_POST['seeker_password']);
            $seeker_name = mysqli_real_escape_string($conn, $_POST['seeker_name']);
            $seeker_role = mysqli_real_escape_string($conn, $_POST['seeker_role']);
            $seeker_skills = mysqli_real_escape_string($conn, $_POST['seeker_skills']);
            $seeker_experience = mysqli_real_escape_string($conn, $_POST['seeker_experience']);
            $seeker_description = mysqli_real_escape_string($conn, $_POST['seeker_description']);
            $seeker_contact = mysqli_real_escape_string($conn, $_POST['seeker_contact']);

            // Insert data into seeker table
            $sql_seeker = "INSERT INTO seeker (seeker_id, seeker_username, seeker_password, seeker_name, seeker_role, seeker_skills, seeker_experience, seeker_description, seeker_contact) 
                        VALUES ('$seeker_id', '$seeker_username', '$seeker_password', '$seeker_name', '$seeker_role', '$seeker_skills', '$seeker_experience', '$seeker_description', '$seeker_contact')";
        
            if ($conn->query($sql_seeker) === TRUE) {
                echo "<script>alert('Seeker registered successfully.');</script>";
            } else {
                // Improved error handling
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        }
    }
}

// Close the connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
     /* Modern variables for consistent theming */
:root {
  --primary-color: #4a90e2;
  --primary-dark: #357abd;
  --background-color: #f5f7fa;
  --text-color: #2c3e50;
  --error-color: #e74c3c;
  --success-color: #2ecc71;
  --border-radius: 8px;
  --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s ease;
}

body {
  margin: 0;
  padding: 0;
  min-height: 100vh;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.wrapper {
  background: white;
  max-width: 500px;
  width: 90%;
  padding: 30px;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
}

.title-text {
  text-align: center;
  margin-bottom: 35px;
}

.title {
  font-size: 2rem;
  font-weight: 600;
  color: var(--primary-color);
  position: relative;
  padding-bottom: 10px;
}

.title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: var(--primary-color);
  border-radius: 3px;
}

.form-container {
  width: 100%;
}

.field {
  margin-bottom: 20px;
}

select, input {
  width: 100%;
  padding: 12px 15px;
  border: 2px solid #e1e8ed;
  border-radius: var(--border-radius);
  font-size: 0.95rem;
  transition: var(--transition);
  outline: none;
  color: var(--text-color);
}

select:focus, input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
}

select {
  cursor: pointer;
  background-color: white;
  appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 1em;
}

.btn {
  margin-top: 30px;
}

.btn input[type="submit"] {
  background: var(--primary-color);
  color: white;
  border: none;
  padding: 14px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition);
}

.btn input[type="submit"]:hover {
  background: var(--primary-dark);
  transform: translateY(-1px);
}

/* Role form transitions */
.role-form {
  opacity: 0;
  height: 0;
  overflow: hidden;
  transition: var(--transition);
}

.role-form[style*="display: block"] {
  opacity: 1;
  height: auto;
  margin-top: 20px;
}

/* Responsive design */
@media (max-width: 480px) {
  .wrapper {
    padding: 20px;
  }
  
  .title {
    font-size: 1.75rem;
  }
  
  select, input {
    padding: 10px 12px;
  }
}

/* Success and error states */
.field input:valid {
  border-color: var(--success-color);
}

.field input:invalid:not(:placeholder-shown) {
  border-color: var(--error-color);
}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title signup">Signup Form</div>
        </div>
        <div class="form-container">
            <!-- Signup Form -->
            <form action="" method="POST" class="signup">
                <div class="field">
                    <select name="user_role" id="user_role" required>
                        <option value="">Select Role</option>
                        <option value="recruiter">Recruiter</option>
                        <option value="seeker">Seeker</option>
                    </select>
                </div>
                
                <!-- Recruiter Form Fields (Hidden Initially) -->
                <div id="recruiterForm" class="role-form" style="display:none;">
                    <div class="field">
                        <input type="text" name="recruiter_id" placeholder="Recruiter ID" required>
                    </div>
                    <div class="field">
                        <input type="text" name="recruiter_username" placeholder="Username" required>
                    </div>
                    <div class="field">
                        <input type="password" name="recruiter_password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input type="text" name="recruiter_name" placeholder="Name" required>
                    </div>
                    <div class="field">
                        <input type="text" name="job_title" placeholder="Job Title" required>
                    </div>
                    <div class="field">
                        <input type="text" name="job_description" placeholder="Job Description" required>
                    </div>
                    <div class="field">
                        <input type="email" name="recruiter_contact" placeholder="Contact Email" required>
                    </div>
                </div>

                <!-- Seeker Form Fields (Hidden Initially) -->
                <div id="seekerForm" class="role-form" style="display:none;">
                    <div class="field">
                        <input type="text" name="seeker_id" placeholder="Seeker ID" required>
                    </div>
                    <div class="field">
                        <input type="text" name="seeker_username" placeholder="Username" required>
                    </div>
                    <div class="field">
                        <input type="password" name="seeker_password" placeholder="Password" required>
                    </div>
                    <div class="field">
                        <input type="text" name="seeker_name" placeholder="Name" required>
                    </div>
                    <div class="field">
                        <input type="text" name="seeker_role" placeholder="Role (e.g. Developer, Designer)" required>
                    </div>
                    <div class="field">
                        <input type="text" name="seeker_skills" placeholder="Skills (comma separated)" required>
                    </div>
                    <div class="field">
                        <input type="text" name="seeker_experience" placeholder="Experience (years)" required>
                    </div>
                    <div class="field">
                        <input type="text" name="seeker_description" placeholder="Description" required>
                    </div>
                    <div class="field">
                        <input type="email" name="seeker_contact" placeholder="Contact Email" required>
                    </div>
                </div>

                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to handle showing the appropriate form fields based on role selection
        document.getElementById('user_role').addEventListener('change', function() {
            var role = this.value;
            if (role === 'recruiter') {
                document.getElementById('recruiterForm').style.display = 'block';
                document.getElementById('seekerForm').style.display = 'none';
            } else if (role === 'seeker') {
                document.getElementById('seekerForm').style.display = 'block';
                document.getElementById('recruiterForm').style.display = 'none';
            } else {
                document.getElementById('recruiterForm').style.display = 'none';
                document.getElementById('seekerForm').style.display = 'none';
            }
        });
    </script>
</body>
</html>
