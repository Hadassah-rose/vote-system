<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);

// Process form submission for updating profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["new_username"];
    $newEmail = $_POST["new_email"];

    // Handle profile image upload
    $targetDir = "uploads/"; // Specify the directory where uploaded images will be stored
    $targetFile = $targetDir . basename($_FILES["new_profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image or a fake image
    $check = getimagesize($_FILES["new_profile_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<script>alert("File is not an image. Please upload a valid image file.");</script>';
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo '<script>alert("Sorry, the file already exists. Please choose a different file.");</script>';
        $uploadOk = 0;
    }

    // Check file size (you can customize the size limit)
    if ($_FILES["new_profile_image"]["size"] > 500000) {
        echo '<script>alert("Sorry, your file is too large. Please choose a smaller file.");</script>';
        $uploadOk = 0;
    }

    // Allow certain file formats (you can customize the allowed formats)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed. Please choose a different file.");</script>';
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $targetFile)) {
            // Update user details in the database, including the new profile image path
            $updateSql = "UPDATE student SET username=?, email=?, profile_image=? WHERE email=?";
            $updateStmt = $con->prepare($updateSql);
            $updateStmt->bind_param("ssss", $newUsername, $newEmail, $targetFile, $user_data['email']);

            if ($updateStmt->execute()) {
                // Update successful, refresh user_data
                $user_data = check_login($con);
                echo '<script>alert("Profile updated successfully!");</script>';
            } else {
                echo '<script>alert("Error updating profile. Please try again.");</script>';
            }

            $updateStmt->close();
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file. Please try again.");</script>';
        }
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
                                    <label for="new_username">New Username:</label>
                                    <input type="text" name="new_username" value="<?php echo $user_data['username']; ?>"
                                        required>

                                    <label for="new_email">New Email:</label>
                                    <input type="text" name="new_email" value="<?php echo $user_data['email']; ?>"
                                        required>

                                    <label for="new_profile_image">New Profile Image:</label>
                                    <input type="file" name="new_profile_image" accept="image/*">

                                    <input type="submit" value="Update Profile">
                                </form>
                                <ul>
                                    <a href="profile.php" style=" font-weight:600;">View profile</a>
                                    <br>
                                    <a href="change_password.php" style=" font-weight:600;">change password</a>
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