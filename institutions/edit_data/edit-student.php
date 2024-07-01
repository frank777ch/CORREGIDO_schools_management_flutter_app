<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}

// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$student_id = $name = $address = $grade = $date_of_birth = "";
$name_err = $address_err = $grade_err = $date_of_birth_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate student_id (it should be received as hidden input)
    $student_id = $_POST["student_id"];

    // Validate Name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please insert a Name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate Grade
    if (empty(trim($_POST["grade"]))) {
        $grade_err = "Please insert student grade.";
    } elseif (!is_numeric(trim($_POST["grade"]))) {
        $grade_err = "Grade must be a number.";
    } else {
        $grade = trim($_POST["grade"]);
    }

    // Validate date_of_birth
    if (empty(trim($_POST["date_of_birth"]))) {
        $date_of_birth_err = "Please insert student date of birth.";
    } else {
        $date_of_birth = trim($_POST["date_of_birth"]);
        // Validate date format (YYYY-MM-DD)
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_of_birth)) {
            $date_of_birth_err = "Invalid date format. Use YYYY-MM-DD.";
        }
    }

    // Validate Address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please insert student address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Check input errors before updating in database
    if (empty($name_err) && empty($address_err) && empty($grade_err) && empty($date_of_birth_err)) {
        // Prepare an update statement
        $sql = "UPDATE students SET name=?, grade=?, address=?, date_of_birth=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_grade, $param_address, $param_date_of_birth, $param_id);

            // Set parameters
            $param_name = $name;
            $param_grade = $grade;
            $param_address = $address;
            $param_date_of_birth = $date_of_birth;
            $param_id = $student_id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to search-students page
                echo "<script>
                    alert('Student updated successfully.');
                    window.location.href='../show_data/search-students.php';
                </script>";
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
} else {
    // Fetch existing student data from database before form submission
    if (isset($_GET['student_id']) && !empty(trim($_GET['student_id']))) {
        $student_id = trim($_GET['student_id']);

        // Retrieve student details from database
        $sql = "SELECT * FROM students WHERE id = ? AND school_id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $student_id, $_SESSION['id']);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    // Assign retrieved values to variables
                    $name = $row['name'];
                    $grade = $row['grade'];
                    $date_of_birth = $row['date_of_birth'];
                    $address = $row['address'];
                } else {
                    echo "<script>
                        alert('Student not found or access denied.');
                        window.location.href='../show_data/main-search.php';
                    </script>";
                    exit;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        // Redirect to main-search.php if student_id parameter is missing
        header("location: ../show_data/main-search.php");
        exit;
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("../images/back22.jpg");
            background-size: cover;
        }

        .navtitle {
            font-family: 'Lato', sans-serif;
        }

        .heads {
            font-family: 'Coustard', serif;
            font-size: 50px;
            color: #ffffff;
            padding-top: 1%;
        }

        .navbar {
            box-shadow: 0 3px 4px rgba(0, 0, 0, 0.16), 0 3px 4px;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../welcome.php">
                <h1 class="navtitle">Schools Management</h1>
            </a>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="navbar-toggler-icon" href="#" id="navbardrop" data-toggle="dropdown"></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../welcome.php">Home</a>
                        <a class="dropdown-item" href="../reset-password.php">Reset Password</a>
                        <a class="dropdown-item" href="../logout.php">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Edit Student Form -->
    <div class="container py-5">
        <div class="row">
            <div class="col-10 col-sm-6 col-md-5 mx-auto">
                <div class="box">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>"/>

                                <!-- Input Fields -->
                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter Student Full Name">
                                    <span class="help-block" style="color:red"><?php echo $name_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($grade_err)) ? 'has-error' : ''; ?>">
                                    <label>Grade</label>
                                    <input type="text" name="grade" class="form-control" value="<?php echo htmlspecialchars($grade); ?>" placeholder="Enter Student Grade">
                                    <span class="help-block" style="color:red"><?php echo $grade_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($date_of_birth_err)) ? 'has-error' : ''; ?>">
                                    <label>Date Of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control" value="<?php echo htmlspecialchars($date_of_birth); ?>" placeholder="Enter Student Date Of Birth">
                                    <span class="help-block" style="color:red"><?php echo $date_of_birth_err; ?></span>
                                </div>

                                <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($address); ?>" placeholder="Enter School Address">
                                    <span class="help-block" style="color:red"><?php echo $address_err; ?></span>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
