<?php
session_start();
include ("connection.php");
include ("function.php");
$user_data = check_login($con);
// Check if the candidate number is provided in the URL
if (isset ($_GET['candidate_no'])) {
    $candidate_no = $_GET['candidate_no'];
    // Fetch candidate details from the database
    $sql = "SELECT * FROM candidates WHERE candidate_no = '$candidate_no'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $candidate_details = mysqli_fetch_assoc($result);
    } else {
        echo "Candidate not found!";
        exit();
    }
} else {
    echo "Candidate number not provided!";
    exit();
}
// Handle form submission for updating candidate details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $new_fullname = $_POST["new_fullname"];
    $new_username = $_POST["new_username"];
    $new_email = $_POST["new_email"];
    // Handle file upload (profile image)
    if ($_FILES["new_profileImage"]["name"]) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["new_profileImage"]["name"]);
        move_uploaded_file($_FILES["new_profileImage"]["tmp_name"], $targetFile);
        // Update candidate details in the database, including the new profile image path
        $update_sql = "UPDATE candidates SET fullname = '$new_fullname', username = '$new_username', email = '$new_email', profile_image = '$targetFile' WHERE candidate_no = '$candidate_no'";
    } else {
        // Update candidate details in the database without changing the profile image
        $update_sql = "UPDATE candidates SET fullname = '$new_fullname', username = '$new_username', email = '$new_email' WHERE candidate_no = '$candidate_no'";
    }
    if (mysqli_query($con, $update_sql)) {
        echo "Candidate details updated successfully";
        // Redirect back to the main admin dashboard or any other desired page
        header("Location: addcandidate.php");
        exit();
    } else {
        echo "Error updating candidate details: " . mysqli_error($con);
    }
}
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <title>Voter Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 700px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: lavender;
            height: 100%;
        }






        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }

        .card {
            background-color: lavender;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 400px;
            height: 530px;
            margin: auto;
            text-align: center;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }



        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-inverse visible-xs">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">VoteSystem</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="voterdashboard.php">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="electiondates.php">Election Dates</a></li>
                    <li><a href="candidateslist.php">Candidates list</a></li>
                    <li><a href="candidates.php">Vote</a></li>
                    <li><a href="results.php">Results</a></li>
                    <li><a href="index.php">Logout</a></li>

                </ul>
            </div>
        </div>
    </nav>



    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
                <h2>VoteSystem</h2>
                <ul class="nav nav-pills nav-stacked">

                    <li class="active"><a href="voterdashboard.php">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="electiondates.php">Election Dates</a></li>
                    <li><a href="candidateslist.php">Candidates list</a></li>
                    <li><a href="candidates.php">Vote</a></li>
                    <li><a href="results.php">Results</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul><br>
            </div>
            <br>


            <div class="col-sm-9">

                <div class="well">
                    <style>
                        .well {
                            background-image: url("assets/img/scr7.png");
                            background-size: cover;
                        }
                    </style>


                    <div style="text-align: center;">

                        <p style="font-size:30px;font-weight:bolder; color:darkblue;">Hello
                            <?php echo $user_data['username']; ?>
                        </p>
                        </p>

                        <p style="font-weight:bolder; font-size:18px; color:darkblue;">Welcome to Chuka University
                            voting System!!! <br><span>Vote the leader of your
                                choice</span> </p>

                    </div>


                    <div class="card" style="font-size:15px; ">

                        <p class="title" style="color:darkblue; font-weight:600;">Edit your profile
                        </p>
                        <div class="row">
                            <div class="column left">

                                <h4>Edit profile</h4>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <label for="new_fullname">New Fullname:</label>
                                    <input type="text" id="new_fullname" name="new_fullname"
                                        value="<?php echo $candidate_details['fullname']; ?>" required>

                                    <label for="new_username">New Username:</label>
                                    <input type="text" id="new_username" name="new_username"
                                        value="<?php echo $candidate_details['username']; ?>" required>

                                    <label for="new_email">New Email:</label>
                                    <input type="email" id="new_email" name="new_email"
                                        value="<?php echo $candidate_details['email']; ?>" required>

                                    <label for="new_profileImage">New Profile Image:</label>
                                    <input type="file" name="new_profileImage" id="new_profileImage" accept="image/*">



                                    <input type="submit" value="Update Profile">
                                </form>
                                <ul>
                                    <a href="editcandidates.php" style=" font-weight:600;">BACK</a>
                                    <br>
                                </ul>
                            </div>
                        </div>

                        <!-- Add a form for users to edit their profile including image upload -->


                    </div>
                </div>
            </div>



        </div>
    </div>

    <style>
        .row.content {
            height: 675px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: lavender;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }

        .column left {
            background-color: lavender;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 90%;
            padding: 4px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>


</body>

</html>