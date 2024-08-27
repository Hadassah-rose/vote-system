<?php
session_start();
include ("connection.php");
include ("function.php");
$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $regno = $_POST['regno'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $faculty = $_POST['faculty'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Handle file upload
    $targetDirectory = "uploads/"; // Specify the directory where you want to save the uploaded files
    $targetFile = $targetDirectory . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset ($_POST["submit"])) {
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check file size
    if ($_FILES["profileImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["profileImage"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (!empty ($regno) && !empty ($password) && !is_numeric($regno)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //save to database
        $query = "INSERT into student(regno,fullname,username,faculty,email,password,profile_image) VALUES('$regno','$fullname','$username','$faculty','$email','$password','$targetFile') ON DUPLICATE KEY UPDATE regno=regno";

        mysqli_query($con, $query);

        echo "Registration successful";
    } else {
        echo "invalid information";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 810px;
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

        .signup-container {
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
            width: 100%;
            padding: 4px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: steelblue;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: steelblue;
        }

        .signup-link {
            text-align: center;
            margin-top: 16px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            background-color: lavender;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: steelblue;
            color: black;
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
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="adminprofile.php">Profile</a></li>
                    <li><a href="addvoters.php">Add voters</a></li>
                    <li><a href="addelection.php">Add Faculties </a></li>
                    <li><a href="addcandidate.php">Add Candidate</a></li>

                    <li><a href="voterslist.php">Voters lists</a></li>
                    <li><a href="editcandidates.php">Candidates</a></li>
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
                    <li class="active"><a href="admindashboard.php">Dashboard</a></li>
                    <li><a href="adminprofile.php">Profile</a></li>
                    <li><a href="addvoters.php">Add voters</a></li>
                    <li><a href="addelection.php">Add Faculties </a></li>
                    <li><a href="addcandidate.php">Add Candidate</a></li>

                    <li><a href="voterslist.php">Voters lists</a></li>
                    <li><a href="editcandidates.php">Candidates</a></li>
                    <li><a href="results.php">Results</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul><br>
            </div>
            <br>

            <div class="col-sm-9">
                <div class="well" style="width:100%;">
                    <p style="font-size:30px;font-weight:bolder; color:darkblue;">Hello Admin
                        <?php echo $user_data['username']; ?>
                    </p>

                    <p style="font-weight:bolder;">Welcome to Chuka University Voting system</p>
                    <p style="font-weight:550;">
                        Your commitment to participate in managing elections is highly appreciated. Welcome to
                        the Administrators dashboard.

                    </p>



                    <div class="row">
                        <div class="column left">
                            <div class="signup-container">
                                <h2>Add voters</h2>
                                <form action="" method="POST" enctype="multipart/form-data">

                                    <label for="regno">Reg No:</label>
                                    <input type="text" id="regno" name="regno" required>

                                    <label for="fullname">Fullname:</label>
                                    <input type="text" id="fullname" name="fullname" required>

                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" required>

                                    <label for="faculty">Faculty:</label>
                                    <select id="faculty" name="faculty" required="">
                                        <option value="AGED">- - - - - - - -</option>
                                        <option value="AGED">AGED</option>
                                        <option value="FST">FST</option>
                                        <option value="BCOM">BCOM</option>
                                        <option value="BED">BED</option>
                                        <option value="Engineering">Engineering</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" required>

                                    <label for="password"> ID Number: </label>
                                    <input id="password" type="text" name="password" placeholder="ID Number"
                                        required="">

                                    <label for="profileImage">Profile Image: </label>
                                    <input type="file" name="profileImage" id="profileImage" accept="image/*">

                                    <button value="signup" type="submit">Submit</button>
                                </form>

                            </div>
                        </div>

                        <div class="column right">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .container-fluid {
            background-image: url("assets/img/scr7.png");
            background-size: cover;
        }

        * {
            box-sizing: border-box;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
            float: left;
            padding: 10px;
            /* Should be removed. Only for demonstration */
        }

        .left {
            width: 35%;
        }

        .right {
            width: 65%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Add this script section at the end of the HTML body -->

</body>

</html>