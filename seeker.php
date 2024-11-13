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
    

</body>
</html>

