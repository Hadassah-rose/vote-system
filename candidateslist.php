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

                    <p style="font-weight:550;">Here is the list of leaders from your faculty</p>
                </div>

                <?php
                // Connect to the database (replace with your database credentials)
                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname = "votingsystem";

                if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
                    die ("failed to connect!");
                }

                // Start the session
                session_start();

                // Check if the user is logged in
                if (!isset ($_SESSION['faculty'])) {
                    // Redirect to the login page or handle unauthorized access
                    header("Location: login.php");
                    exit();
                }
                // Retrieve the logged-in user's faculty
                $userFaculty = $_SESSION['faculty'];
                // Query to retrieve candidate details based on faculty
                $sql = "SELECT * FROM candidates WHERE faculty = '$userFaculty' 
                UNION ALL
                SELECT *
                FROM residentreps";
                $result = $conn->query($sql);
                // Display the candidate details in a table
                echo "<table border='1'>";
                echo "<tr><th>No.</th><th>Candidate No</th><th>Full Name</th><th>Username</th><th>Email</th><th>Faculty</th><th>Profile Image</th></tr>";
                // Initialize counter
                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td>" . $row['candidate_no'] . "</td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['faculty'] . "</td>";

                    // Check if the profile image field is not empty
                    if (!empty ($row['profile_image'])) {
                        // Assuming 'profile_image' is the field where the image filename or path is stored
                        $profileImage = $row['profile_image'];
                        // Display the image using an HTML img tag
                        echo "<td><img src='..admin/uploads/$profileImage' alt='Profile Image' width='50'></td>";
                    } else {
                        // Display a placeholder if no profile image is available
                        echo "<td>No Image</td>";
                    }
                    echo "</tr>";
                    // Increment the counter
                    $counter++;
                }
                echo "</table>";
                // Close the database connection
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

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: lavender;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</body>

</html>