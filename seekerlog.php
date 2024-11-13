<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "job_connect");

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the query string for seekers
$str = "SELECT seeker_name, seeker_role, seeker_skills, seeker_experience, seeker_description, seeker_contact FROM seeker";

// Check if a search query is submitted
if (isset($_GET['query'])) {
    $search = mysqli_real_escape_string($con, $_GET['query']);
    $str = "SELECT seeker_name, seeker_role, seeker_skills, seeker_experience, seeker_description, seeker_contact 
            FROM seeker WHERE seeker_role LIKE '%$search%'";
}

// Execute the seeker query
$res = mysqli_query($con, $str);

// Initialize variable for recruiter posts
$recruiter_posts = [];

// Check if the "Your Posts" button was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view_your_posts'])) {
    // Get the recruiter username from the hidden form field
    $username = mysqli_real_escape_string($con, $_POST['u']);
    
    // Fetch recruiter posts based on the username
    $recruiter_query = "SELECT recruiter_name, job_title, job_description, recruiter_contact 
                        FROM recruiter WHERE recruiter_username = '$username'";

    // Execute the recruiter query
    $recruiter_res = mysqli_query($con, $recruiter_query);

    // Check for query execution errors
    if ($recruiter_res) {
        // Fetch all matching recruiter posts
        $recruiter_posts = mysqli_fetch_all($recruiter_res, MYSQLI_ASSOC);
    } else {
        echo "<script>alert('Error fetching recruiter posts: " . mysqli_error($con) . "');</script>";
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
    <title>Seeker and Recruiter Details</title>
    <link rel="stylesheet" href="css/seekerlog.css">
</head>
<body>
    <nav>
        <form class="search-box" action="" method="get">
            <input type="text" name="query" placeholder="Search...">
            <input type="submit" value="Search">
            <button type="button" class="post-button">New Post</button>
        </form>

        <!-- Form for "Your Posts" button to view recruiter posts -->
        <form action="" method="post" style="display: inline;">
            <input type="hidden" name="u" value="<?php echo htmlspecialchars($_GET['u'] ?? ''); ?>">
            <button type="submit" name="view_your_posts" class="your-posts-button">Your Posts</button>
        </form>
    </nav>

    <h2>Seeker Details</h2>
    <?php
    // Display seeker details if any records were found
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="details-container">';
            echo '<h3>Seeker Details</h3>';
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

    
    <?php
    // Display recruiter posts if the button was clicked and posts were found
    if (!empty($recruiter_posts)) {
        echo '<h2>Recruiter Posts</h2>';
        foreach ($recruiter_posts as $post) {
            echo '<div class="details-container">';
            echo '<h3>Recruiter Post</h3>';
            echo '<div class="details-item"><span>Recruiter Name:</span> ' . htmlspecialchars($post['recruiter_name']) . '</div>';
            echo '<div class="details-item"><span>Job Title:</span> ' . htmlspecialchars($post['job_title']) . '</div>';
            echo '<div class="details-item"><span>Job Description:</span> ' . htmlspecialchars($post['job_description']) . '</div>';
            echo '<div class="details-item"><span>Contact:</span> ' . htmlspecialchars($post['recruiter_contact']) . '</div>';
            echo '</div>';
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view_your_posts'])) {
        // Display "No posts found" only if the button was clicked but no posts are available
        echo '<p style="text-align: center;">No posts found for this recruiter.</p>';
    }
    ?>
    </body>
    </html>





