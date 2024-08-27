<?php
session_start();
include ("connection.php");
include ("function.php");

$user_data = check_login($con);
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
        body {
            width: auto;
        }

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
                <div class="well">

                    <p style="font-size:30px;font-weight:bolder; color:darkblue;">Hello Admin
                        <?php echo $user_data['username']; ?>
                    </p>
                    <p style="font-weight:bolder;">Welcome to Chuka University Voting system</p>
                    <p style="font-weight:550;">
                        Your commitment to participate in managing elections is highly appreciated. Welcome to
                        the Administrators dashboard.

                    </p>

                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>User profile</h4>
                            <a href="adminprofile.php">More</a>
                        </div>
                    </div><br>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Add Voter</h4>
                            <a href="addvoters.php">More</a>
                        </div>
                    </div><br>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Add Faculties</h4>
                            <a href="addelection.php">More</a>
                        </div>
                    </div><br>
                    <div class=" col-sm-3">
                        <div class="well">
                            <h4>Add Candidates</h4>
                            <a href="addcandidate.php">More</a>
                        </div>

                    </div><br>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Add Election</h4>
                            <a href="addelection.php">More</a>
                        </div>
                    </div><br>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Voters List</h4>
                            <a href="voterslist.php">More</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Candidates</h4>
                            <a href="editcandidates.php">More</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Results</h4>
                            <a href="results.php">More</a>
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
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>

</html>