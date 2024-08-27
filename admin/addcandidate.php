<?php
session_start();
include ("connection.php");
include ("function.php");

$query = "SELECT * FROM candidates ORDER BY faculty, faculty";
$result = mysqli_query($con, $query);


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
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 890px;
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
                    <?php
                    // Database connection details
                    $dbhost = "localhost";
                    $dbuser = "root";
                    $dbpass = "";
                    $dbname = "votingsystem";


                    if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
                        die ("failed to connect!");
                    }

                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Retrieve form data
                        $candidate_no = $_POST["candidate_no"];
                        $regno = $_POST["regno"];
                        $fullname = $_POST["fullname"];
                        $username = $_POST["username"];
                        $email = $_POST["email"];
                        $position = $_POST["faculty"];

                        // Handle file upload (profile image)
                        $targetDir = "uploads/"; // Create a folder named "uploads" in the same directory as this PHP file
                        $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);

                        // Move uploaded file to the specified directory
                        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile);

                        // Insert data into the database
                        $sql = "INSERT INTO candidates (candidate_no, regno,fullname, username, email, faculty, profile_image) 
                                    VALUES ('$candidate_no','$regno','$fullname', '$username', '$email', '$position', '$targetFile')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Record added successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // Close the database connection
                    $conn->close();
                    ?>



                    <div class="row">
                        <div class="column left">
                            <div class="signup-container">
                                <h2>Add Candidate</h2>
                                <form action="" method="POST" enctype="multipart/form-data">

                                    <label for="candidate_no">Candidate No:</label>
                                    <input type="text" id="candidate_no" name="candidate_no" required>

                                    <label for="regno">Reg No:</label>
                                    <input type="text" id="regno" name="regno" required>

                                    <label for="fullname">Fullname:</label>
                                    <input type="text" id="fullname" name="fullname" required>

                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" required>

                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" required>

                                    <label for="position">Position:</label>
                                    <select id="faculty" name="faculty" required="">
                                        <option value="AGED">AGED</option>
                                        <option value="FST">FST</option>
                                        <option value="BCOM">BCOM</option>
                                        <option value="BED">BED</option>
                                        <option value="Engineering">Engineering</option>
                                        <!-- Add more options as needed -->
                                    </select>


                                    <label for="profileImage">Profile Image: </label>
                                    <input type="file" name="profileImage" id="profileImage" accept="image/*">


                                    <button type="submit">Submit</button>
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
    <script>
        $(document).ready(function () {
            $('.edit-btn').click(function () {
                var candidateNo = $(this).data('candidate-no');
                window.location.href = 'editcandidate.php?candidate_no=' + candidateNo; // Replace 'edit_candidate.php' with the actual edit page URL
            });
        });


        $(document).ready(function () {
            $('.edit-btn').click(function () {
                var candidateNo = $(this).data('candidate-no');
                window.location.href = 'editcandidate.php?candidate_no=' + candidateNo; // Replace 'edit_candidate.php' with the actual edit page URL
            });

            $('.delete-btn').click(function () {
                if (confirm('Are you sure you want to delete this candidate?')) {
                    var candidateNo = $(this).data('candidate-no');
                    $.post('deletecandidate.php', { candidate_no: candidateNo }, function (data) {
                        // Reload the page after successful deletion
                        location.reload();
                    });
                }
            });
        });
    </script>




</body>

</html>

<?php
// Close the database connection
mysqli_close($con);
?>