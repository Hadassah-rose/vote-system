<?php
session_start();
include("connection.php");
include("function.php");

$user_data = check_login($con);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if the form is for login or password change
    if (isset($_POST['login'])) {
        // Your existing login code here
        // ...

    } elseif (isset($_POST['change_password'])) {
        // Password change logic
        $email = $_POST['email'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // Validate inputs and perform password change
        if (!empty($email) && !empty($old_password) && !empty($new_password) && !is_numeric($email)) {
            $query = "SELECT * FROM student WHERE email = '$email' AND password = '$old_password' LIMIT 1";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $updateQuery = "UPDATE admins SET password = '$new_password' WHERE email = '$email'";
                mysqli_query($con, $updateQuery);

                echo "Password changed successfully!";
            } else {
                echo "Invalid old password or username";
            }
        } else {
            echo "Invalid information";
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
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: steelblue;
            text-align: center;
            cursor: pointer;
            width: 90%;
            font-size: 18px;
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
                    <li><a href="#">Vote</a></li>
                    <li><a href="#">Results</a></li>
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
                    <li><a href="#">Vote</a></li>
                    <li><a href="#">Results</a></li>
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

                        <p class="title" style="color:darkblue; font-weight:600;">Change Your Password
                        </p>
                        <div class="row">
                            <div class="column left">

                                <h4>Edit profile</h4>
                                <form method="post" action="" enctype="multipart/form-data">

                                    <label for="email"> Email: </label>
                                    <input id="email" type="text" name="email" placeholder="Your Email" required=""
                                        autofocus="">
                                    <label for="old_password"> Old Password: </label>
                                    <input id="old_password" type="password" name="old_password"
                                        placeholder="Old Password" required="">

                                    <label for="new_password">New Password: </label>
                                    <input id="new_password" type="password" name="new_password"
                                        placeholder="New Password" required="">

                                    <button id="button" type="submit" value="Change Password">Change Password</button>


                                </form>
                                <ul>
                                    <a href="adminprofile.php" style=" font-weight:600;">Back</a>
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