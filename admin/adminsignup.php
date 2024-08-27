<?php
// ... (existing code)
session_start();
include("connection.php");
include("function.php");



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // ... (existing code)
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];


    // Handle file upload
    $targetDirectory = "uploads/"; // Specify the directory where you want to save the uploaded files
    $targetFile = $targetDirectory . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
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
    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //save to database
        $query = "INSERT into admins(username,fullname,email,password,profile_image) VALUES('$username','$fullname','$email','$hashedPassword','$targetFile') ON DUPLICATE KEY UPDATE email=email";

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin signup</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/managerlogin.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Validation function for password
            function validatePassword(password) {
                // Password must contain at least one uppercase letter, one lowercase letter,
                // one special character, and be at least 8 characters long
                var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return passwordPattern.test(password);
            }

            // Form submission event handler
            document.querySelector('form').addEventListener('submit', function (event) {
                // Get values from form inputs
                var password = document.getElementById('password').value;



                // Validate password
                if (!validatePassword(password)) {
                    alert('Invalid password format.  Password must contain at least one uppercase letter, one lowercase letter, one special character, and be at least 8 characters long.');
                    event.preventDefault(); // Prevent form submission
                    return;
                }

                // Form is valid, continue with submission
            });
        });
    </script>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>VoteSystem<span>.</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="adminsignup.php">Admin</a></li>
                    <li><a href="../login.php">Voter</a></li>


                </ul>
            </nav><!-- .navbar -->

            <a class="btn-book-a-table" href="../login.php">Welcome</a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->


    <br><br><br>

    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading"> Create Account </div>
                <div class="panel-body">

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span>
                                    Username: </label>
                                <div class="input-group">
                                    <input class="form-control" id="username" type="text" name="username"
                                        placeholder="your username" required="" autofocus="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-user"
                                                aria-hidden="true"></label>
                                    </span>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="fullname"><span class="text-danger" style="margin-right: 5px;">*</span> Full
                                    Name:
                                </label>
                                <div class="input-group">
                                    <input class="form-control" id="fullname" type="text" name="fullname"
                                        placeholder="Your Full Name" required="" autofocus="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-user"
                                                aria-hidden="true"></label>
                                    </span>

                                </div>

                            </div>
                        </div>




                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="email"><span class="text-danger" style="margin-right: 5px;">*</span> Email:
                                </label>
                                <div class="input-group">
                                    <input class="form-control" id="email" type="text" name="email" placeholder="email"
                                        required="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-phone"
                                                aria-hidden="true"></span></label>
                                    </span>

                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span>
                                    Password: </label>
                                <div class="input-group">
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Password" required="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="togglePassword">
                                            <span id="toggleIcon" class="glyphicon glyphicon-eye-open"
                                                aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span>
                                    Confirm Password: </label>
                                <div class="input-group">
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Password" required="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="togglePassword">
                                            <span id="toggleIcon" class="glyphicon glyphicon-eye-open"
                                                aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Add this inside your form -->
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="profileImage">Profile Image: </label>
                                <div class="input-group">
                                    <input type="file" name="profileImage" id="profileImage" accept="image/*">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-upload"
                                                aria-hidden="true"></span></label>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-xs-4">
                                <button class="btn btn-primary" id="button" type="submit" value="signup">Submit</button>
                            </div>

                        </div>

                        <label style="margin-left: 5px;"><a href="adminlogin.php">Have an account? Login.</a></label>

                    </form>

                </div>

            </div>

        </div>
    </div>


    <style>
        body {
            background-image: url("../images/scr7.png");
            background-size: cover;
        }
    </style>


    <script>
        // Function to toggle password visibility
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('glyphicon-eye-open');
                toggleIcon.classList.add('glyphicon-eye-close');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('glyphicon-eye-close');
                toggleIcon.classList.add('glyphicon-eye-open');
            }
        }

        // Add event listener to the toggle button
        document.getElementById('togglePassword').addEventListener('click', togglePassword);

        // Function to toggle confirm password visibility

    </script>


</body>

</html>