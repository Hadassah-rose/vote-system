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

                <h2>Vote for Candidate</h2>

                <?php
                // Start the session
                session_start();

                // Database connection
                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname = "votingsystem";
                $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die ("Connection failed: " . $conn->connect_error);
                }

                // Redirect if faculty not set
                if (!isset ($_SESSION['faculty'])) {
                    header("Location: login.php");
                    exit();
                }

                // Retrieve regno from the students table based on the current user's username
                $email = $_SESSION['email']; // Assume the user's username is stored in session
                $regno_query = "SELECT regno FROM student WHERE email = '$email'";
                $regno_result = $conn->query($regno_query);

                $regno = "";
                if ($regno_result->num_rows > 0) {
                    $row = $regno_result->fetch_assoc();
                    $regno = $row['regno'];
                }

                // Close the regno query result
                $regno_result->close();
                ?>

                <form action="vote.php" method="post">
                    <label for="regno">Student Reg No:</label>
                    <!-- Autofill the regno input field with the regno retrieved -->
                    <input type="text" id="regno" name="regno" value="<?php echo htmlspecialchars($regno); ?>" required
                        readonly><br><br>

                    <table>
                        <thead>
                            <tr>
                                <th>Candidate</th>
                                <th>Username</th>
                                <th>Profile Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve candidates list for the user's faculty
                            $userFaculty = $_SESSION['faculty'];
                            $candidates_query = "SELECT candidate_no, fullname, username, profile_image FROM candidates WHERE faculty = '$userFaculty'";
                            $candidates_result = $conn->query($candidates_query);

                            if ($candidates_result->num_rows > 0) {
                                while ($row = $candidates_result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                                    echo "<td><img src='" . htmlspecialchars($row["profile_image"]) . "' alt='Profile Image' style='width:50px;height:50px;'></td>";
                                    echo "<td><button type='submit' name='vote' value='" . htmlspecialchars($row["candidate_no"]) . "'>Vote</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No candidates available</td></tr>";
                            }

                            // Close the candidates query result
                            $candidates_result->close();

                            // Close the database connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </form>

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