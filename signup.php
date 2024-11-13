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
                        VALUES ('$recruiter_id', '$recruiter_username', '$recruiter_password', '$recruiter_name', '$job_title', '$job_description', '$recruiter_contact')";
        
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
        .form-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
        }
        .field {
            margin: 10px 0;
        }
        .popup-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
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
