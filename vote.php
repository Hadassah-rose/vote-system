<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vote Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
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
                    <li><a href="profile.php">Profile</a></li>
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
                    <li><a href="profile.php">Profile</a></li>
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

                    <p style="font-weight:bolder;">Welcome to Chuka University Voting system</p>

                    <p style="font-weight:550;">Vote the leader of your choice</p>
                </div>

                <?php
                session_start();

                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname = "votingsystem";

                if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
                    die ("Failed to connect!");
                }

                if (!isset ($_SESSION['faculty'])) {
                    header("Location: login.php");
                    exit();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $regno = $_POST['regno'];
                    $candidate_no = $_POST['vote'];

                    // Validate and sanitize the input data if necessary
                
                    // Check if the user has already voted (you may want to adjust this based on your system)
                    $check_vote_query = "SELECT * FROM votes WHERE regno = '$regno'";
                    $check_vote_result = $conn->query($check_vote_query);

                    if ($check_vote_result->num_rows > 0) {
                        // User has already voted, handle accordingly (e.g., show an error message)
                        echo "You have already voted!";
                    } else {
                        // Insert the vote into the votes table
                        $insert_vote_query = "INSERT INTO votes (regno, candidate_no) VALUES ('$regno', '$candidate_no')";
                        if ($conn->query($insert_vote_query) === TRUE) {
                            echo "Vote successfully casted!";
                        } else {
                            // Handle the case where the vote insertion fails
                            echo "Error: " . $conn->error;
                        }
                    }
                } else {
                    // Handle the case where the form was not submitted properly
                    echo "Invalid request!";
                }

                $conn->close();
                ?>




            </div>
        </div>
    </div>
    <style>
        .container-fluid {
            background-image: url("assets/img/scr7.png");
            background-size: cover;
        }
    </style>
</body>

</html>