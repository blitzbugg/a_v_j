<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "job_connect");

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the query string
$str = "SELECT seeker_name, seeker_role, seeker_skills, seeker_experience, seeker_description, seeker_contact FROM seeker";

// Check if a search query is submitted
if (isset($_GET['query'])) {
    $search = mysqli_real_escape_string($con, $_GET['query']);
    $str = "SELECT seeker_name, seeker_role, seeker_skills, seeker_experience, seeker_description, seeker_contact 
            FROM seeker WHERE seeker_role LIKE '%$search%'";
}

// Execute the query
$res = mysqli_query($con, $str);

// Check for query execution errors
if (!$res) {
    die("Query failed: " . mysqli_error($con));
}

// Check if form is submitted to add a seeker
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_seeker'])) {
    // Get and sanitize form data
    $seeker_username = mysqli_real_escape_string($con, $_POST['seeker_username']);
    $seeker_password = password_hash(mysqli_real_escape_string($con, $_POST['seeker_password']), PASSWORD_DEFAULT); // Hash the password
    $seeker_name = mysqli_real_escape_string($con, $_POST['seeker_name']);
    $seeker_role = mysqli_real_escape_string($con, $_POST['seeker_role']);
    $seeker_skills = mysqli_real_escape_string($con, $_POST['seeker_skills']);
    $seeker_experience = mysqli_real_escape_string($con, $_POST['seeker_experience']);
    $seeker_description = mysqli_real_escape_string($con, $_POST['seeker_description']);
    $seeker_contact = mysqli_real_escape_string($con, $_POST['seeker_contact']);

    // Insert data into the seeker table
    $insert_query = "INSERT INTO seeker (seeker_username, seeker_password, seeker_name, seeker_role, seeker_skills, seeker_experience, seeker_description, seeker_contact) 
                     VALUES ('$seeker_username', '$seeker_password', '$seeker_name', '$seeker_role', '$seeker_skills', '$seeker_experience', '$seeker_description', '$seeker_contact')";

    if (mysqli_query($con, $insert_query)) {
        echo "<script>alert('Seeker added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// Close the connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Details</title>
    <style>
        /* Basic styling for the navigation bar and search box */
        nav {
            padding: 10px;
            background-color: #f4f4f4;
            border-bottom: 1px solid #ddd;
        }
        .search-box {
            display: flex;
            align-items: center;
        }
        .search-box input[type="text"] {
            padding: 5px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-box input[type="submit"], .post-button {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
        .search-box input[type="submit"]:hover, .post-button:hover {
            background-color: #0056b3;
        }

        /* Styling for the details */
        .details-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .details-container h2 {
            margin-top: 0;
        }
        .details-item {
            margin-bottom: 10px;
        }
        .details-item span {
            font-weight: bold;
        }

        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 400px; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <form class="search-box" action="" method="get">
            <input type="text" name="query" placeholder="Search...">
            <input type="submit" value="Search">
            <button type="button" class="post-button" onclick="document.getElementById('myModal').style.display='block'">Post</button>
        </form>
    </nav>

    <?php
    // Check if any records were found
    if (mysqli_num_rows($res) > 0) {
        // Generate the details containers
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="details-container">';
            echo '<h2>Seeker Details</h2>';
            echo '<div class="details-item"><span>Seeker Name:</span> ' . htmlspecialchars($row['seeker_name']) . '</div>';
            echo '<div class="details-item"><span>Role:</span> ' . htmlspecialchars($row['seeker_role']) . '</div>';
            echo '<div class="details-item"><span>Skills:</span> ' . htmlspecialchars($row['seeker_skills']) . '</div>';
            echo '<div class="details-item"><span>Experience:</span> ' . htmlspecialchars($row['seeker_experience']) . '</div>';
            echo '<div class="details-item"><span>Description:</span> ' . htmlspecialchars($row['seeker_description']) . '</div>';
            echo '<div class="details-item"><span>Contact:</span> ' . htmlspecialchars($row['seeker_contact']) . '</div>';
            echo '</div>';
        }
    } else {
        echo '<p style="text-align: center;">No seekers found.</p>';
    }
    ?>
    
    <!-- Modal for adding seeker -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
            <h2>Add Seeker</h2>
            <form method="POST" action="">
                <label for="seeker_username">Username:</label><br>
                <input type="text" id="seeker_username" name="seeker_username" required><br>
                <label for="seeker_password">Password:</label><br>
                <input type="password" id="seeker_password" name="seeker_password" required><br>
                <label for="seeker_name">Name:</label><br>
                <input type="text" id="seeker_name" name="seeker_name" required><br>
                <label for="seeker_role">Role:</label><br>
                <input type="text" id="seeker_role" name="seeker_role" required><br>
                <label for="seeker_skills">Skills:</label><br>
                <input type="text" id="seeker_skills" name="seeker_skills" required><br>
                <label for="seeker_experience">Experience:</label><br>
                <input type="text" id="seeker_experience" name="seeker_experience" required><br>
                <label for="seeker_description">Description:</label><br>
                <textarea id="seeker_description" name="seeker_description" required></textarea><br>
                <label for="seeker_contact">Contact:</label><br>
                <input type="text" id="seeker_contact" name="seeker_contact" required><br>
                <input type="submit" value="Add Seeker" name="add_seeker">
            </form>
        </div>
    </div>

    <script>
        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

