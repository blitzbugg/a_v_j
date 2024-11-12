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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Details</title>
    <link rel="stylesheet" href="css/recruiter.css">
</head>
<body>

<nav>
    <form class="search-box" action="" method="get">
        <input type="text" name="query" placeholder="Search job title...">
        <input type="submit" value="Search">
    </form>
</nav>

<div class="container">
    <?php
    // Check if any records were found
    if (mysqli_num_rows($res) > 0) {
        // Generate the details containers for each recruiter
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<div class='recruiter-card'>";
            echo "<h3>" . htmlspecialchars($row['recruiter_name']) . "</h3>";
            echo "<p><span>Job Title:</span> " . htmlspecialchars($row['job_title']) . "</p>";
            echo "<p><span>Job Description:</span> " . htmlspecialchars($row['job_description']) . "</p>";
            echo "<p><span>Contact:</span> " . htmlspecialchars($row['recruiter_contact']) . "</p>";
            echo "</div>";
        }
    } else {
        // Display message if no recruiters match the search query
        echo '<p style="text-align: center; color: #333;">No recruiters found for the specified job title.</p>';
    }

    // Close the connection
    mysqli_close($con);
    ?>
</div>

</body>
</html>
