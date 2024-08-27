<?php
session_start();
include("connection.php");
include("function.php");

$query = "SELECT * FROM positions ORDER BY position";
$result = mysqli_query($con, $query);



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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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


        .title {
            color: grey;
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
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="#">Election Dates</a></li>
                    <li><a href="candidateslist.php">Candidates list</a></li>
                    <li><a href="candidates.php">Vote</a></li>
                    <li><a href="results.php">Results</a></li>
                    <li><a href="index.php">Logout</a></li>

                </ul>
            </div>
        </div>
    </nav>



    <div class="container-fluid" style=" width: 100%;">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
                <h2>VoteSystem</h2>
                <ul class="nav nav-pills nav-stacked">

                    <li class="active"><a href="voterdashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="#">Election Dates</a></li>
                    <li><a href="candidateslist.php">Candidates list</a></li>
                    <li><a href="candidates.php">Vote</a></li>
                    <li><a href="results.php">Results</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul><br>
            </div>
            <br>


            <div class="col-sm-9">
                <div style="text-align: center;">
                    <p style="font-weight:bolder; font-size:18px; color:darkblue;">Welcome to Chuka University
                        voting System!!! <br><span>Here is the list of all voters</span>
                    </p>
                </div>

                <!-- Add your header content here -->

                <?php
                // Database connection parameters
                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname = "votingsystem";


                if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
                    die("failed to connect!");
                }


                // SQL query to retrieve data from the students table
                $sql = "SELECT electionname,position, startdate, enddate FROM positions ";
                $result = $conn->query($sql);

                // Display data in a table
                if ($result->num_rows > 0) {
                    echo "<table>
            <tr>
                <th>#</th>
                <th>Election Name</th>
                <th>Position</th>
                <th>Start Date</th>
                <th>End Date</th>
                
            </tr>";

                    $counter = 1; // Counter variable
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                <td>{$counter}</td>
                <td>{$row['electionname']}</td>
                <td>{$row['position']}</td>
                <td>{$row['startdate']}</td>
                <td>{$row['enddate']}</td>
               

            </tr>";

                        $counter++;
                    }

                    echo "</table>";
                } else {
                    echo "No records found";
                }

                // Close connection
                $conn->close();
                ?>



                <!-- Add your footer content here -->


            </div>


        </div>
    </div>
    <style>
        .container-fluid {
            background-image: url("assets/img/scr7.png");
            background-size: cover;

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
            background-color: #f2f2f2;
        }
    </style>


</body>

</html>

<?php
// Close the database connection
mysqli_close($con);
?>