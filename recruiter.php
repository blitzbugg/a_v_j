<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "job_connect");

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the query string to fetch all recruiters
$str = "SELECT recruiter_name, job_title, job_description, recruiter_contact FROM recruiter";

// Check if a search query is submitted for job_title
if (isset($_GET['query'])) {
    $search = mysqli_real_escape_string($con, $_GET['query']);
    // Modify the query to search for job_title that matches the search term
    $str .= " WHERE job_title LIKE '%$search%'";
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
    <title>Recruiter Details</title>
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
        .search-box input[type="submit"], .your-posts-button {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
        .search-box input[type="submit"]:hover, .your-posts-button:hover {
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
    </style>
</head>
<body>
    <nav>
        <form class="search-box" action="" method="get">
            <input type="text" name="query" placeholder="Search job title...">
            <input type="submit" value="Search">
        </form>
    </nav>

    <?php
    // Check if any records were found
    if (mysqli_num_rows($res) > 0) {
        // Generate the details containers for each recruiter
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="details-container">';
            echo '<h2>Recruiter Details</h2>';
            echo '<div class="details-item"><span>Recruiter Name:</span> ' . htmlspecialchars($row['recruiter_name']) . '</div>';
            echo '<div class="details-item"><span>Job Title:</span> ' . htmlspecialchars($row['job_title']) . '</div>';
            echo '<div class="details-item"><span>Job Description:</span> ' . htmlspecialchars($row['job_description']) . '</div>';
            echo '<div class="details-item"><span>Recruiter Contact:</span> ' . htmlspecialchars($row['recruiter_contact']) . '</div>';
            echo '</div>';
        }
    } else {
        // Display message if no recruiters match the search query
        echo '<p style="text-align: center;">No recruiters found for the specified job title.</p>';
    }
    ?>

</body>
</html>



