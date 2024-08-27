<?php
include ("connection.php"); // Include your database connection script

// Check if candidate_no is provided via POST request
if (isset ($_POST['candidate_no'])) {
    // Sanitize the input
    $candidateNo = mysqli_real_escape_string($con, $_POST['candidate_no']);

    // Construct the delete query
    $sql = "DELETE FROM candidates WHERE candidate_no = '$candidateNo'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Return success message if deletion is successful
        echo "Candidate deleted successfully.";
    } else {
        // Return error message if deletion fails
        echo "Error deleting candidate: " . mysqli_error($con);
    }
} else {
    // Return error message if candidate_no is not provided
    echo "Candidate number not provided.";
}

// Close the database connection
mysqli_close($con);
?>