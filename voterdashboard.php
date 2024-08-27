<!DOCTYPE html>
<html lang="en">

<head>
    <title>Voter Dashboard</title>
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
                    <li class="active"><a href="#">Dashboard</a></li>
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
                    <h3 style="font-weight:bolder;">Dashboard</h3>
                    <p style="font-weight:bolder;">Welcome to Chuka University Voting system</p>
                    <p style="font-weight:550;">
                        Your commitment to exercising your right to vote is a cornerstone of our vibrant and dynamic
                        society.

                        In participating in this electoral journey, you are not only casting a ballot but actively
                        shaping the future of our community, region, and nation. Your voice matters, and we are grateful
                        for your dedication to making it heard.
                    </p>
                    <p style="font-weight:550;">Vote the leader of your choice</p>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>User profile</h4>
                            <a href="profile.php">More</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Election Dates</h4>
                            <a href="electiondates.php">More</a>
                        </div>
                    </div>
                    <div class=" col-sm-3">
                        <div class="well">
                            <h4>Candidates list</h4>
                            <a href="candidateslist.php">More</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Vote</h4>
                            <a href="vote.php">More</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Results</h4>
                            <a href="results.php">More</a>
                        </div>
                    </div>
                </div>

                <style>
                    .container-fluid {
                        background-image: url("assets/img/scr7.png");
                        background-size: cover;
                    }
                </style>
            </div>
        </div>
    </div>

</body>

</html>