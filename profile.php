<?php
session_start();
include ("connection.php");
include ("function.php");

$user_data = check_login($con);
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
            max-width: 500px;
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
                            background-image: url("images/scr7.png");
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


                    <div class="card" style="font-size:15px;">

                        <p class="title" style="color:darkblue; font-weight:600;">Check out your profile
                        </p>

                        <?php
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $dbname = "votingsystem";

                        // Create connection
                        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die ("Connection failed: " . $conn->connect_error);
                        }
                        if (isset ($_SESSION['email'])) {
                            $email = $_SESSION['email'];
                            // Use prepared statement to prevent SQL injection
                            $sql = "SELECT regno, fullname, email, username, faculty, profile_image FROM student WHERE email = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result) {
                                if ($result->num_rows > 0) {
                                    // Output data of the signed-in user
                                    $row = $result->fetch_assoc();
                                    // Display the profile image with width and height set to 150px
                                    $profileImage = $row["profile_image"];
                                    if ($profileImage) {
                                        echo '<img src="' . $profileImage . '" alt="not available" style="width: 200px; border-radius:50%; border:2px solid steelblue; height: 200px;"><br> <br>';
                                    } else {
                                        echo '<img src="assets/img/elec.png" alt="Default Image" style="width: 230px; height: 200px;"><br> <br>';
                                    }
                                    // Display other user information
                                    echo "regno: " . $row["regno"] . "<br>" . "<br>";
                                    echo "fullname: " . $row["fullname"] . "<br>" . "<br>";
                                    echo "email: " . $row["email"] . "<br>" . "<br>";
                                    echo "username: " . $row["username"] . "<br>" . "<br>";
                                    echo "faculty: " . $row["faculty"] . "<br>";
                                } else {
                                    echo "0 results";
                                }
                            } else {
                                echo "Error: " . $conn->error;
                            }

                            $stmt->close();
                        } else {
                            echo "User not logged in"; // Provide a meaningful message if the user is not logged in
                        }

                        $conn->close();
                        ?>


                        <ul>
                            <a href="editprofile.php" style=" font-weight:600;">Edit profile</a>
                            <br>
                            <a href="change_password.php" style=" font-weight:600;">change password</a>
                        </ul>
                    </div>
                </div>
            </div>



        </div>
    </div>




</body>

</html>