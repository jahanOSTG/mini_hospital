<?php include 'connection.php';
if (isset($_POST['create'])) { 
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];
    $error = array();
    if (empty($firstname)) {
        $error['ac'] = "Enter Firstname";
    } elseif (empty($surname)) {
        $error['ac'] = "Enter Surname";
    } elseif (empty($username)) {
        $error['ac'] = "Enter Username";
    } elseif (empty($email)) {
        $error['ac'] = "Enter Email Address";
    } elseif (empty($phone)) {
        $error['ac'] = "Enter Phone Number";
    } elseif (empty($gender)) {
        $error['ac'] = "Select Your Gender";
    } elseif (empty($country)) {
        $error['ac'] = "Select Country";
    } elseif (empty($password)) {
        $error['ac'] = "Enter Password";
    } elseif ($confirm_password != $password) {
        $error['ac'] = "Both Passwords do not match";
    }

    // If no errors, proceed with database insertion
    if (count($error) == 0) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query with placeholders
        $query = "INSERT INTO patient (firstname, surname, username, email, phone, gender, country, password, date_reg, profile) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'doctor.jpg')";

        // Initialize prepared statement
        if ($stmt = mysqli_prepare($connect, $query)) {
            // Bind parameters to the placeholders
            mysqli_stmt_bind_param($stmt, 'ssssssss', $firstname, $surname, $username, $email, $phone, $gender, $country, $hashed_password);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("Location: patientlogin.php");
                exit();
            } else {
                echo "<script>alert('Failed to insert data: " . mysqli_stmt_error($stmt) . "')</script>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Failed to prepare the SQL statement: " . mysqli_error($connect) . "')</script>";
        }
    } else {
        // Display error message if any
        foreach ($error as $err) {
            echo "<h5 class='text-center alert alert-danger'>$err</h5>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-image:url('9.webp');background-repeat:no-repeat;background-size: cover;">
<?php include 'header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 my-2 jumbotron">
            <h5 class="text-center text-info my-2">Create Account</h5>
            <form method="post">
                <div class="form-group">
                    <label for="firstname" ><b>Firstname</b></label>
                    <input type="text" id="firstname" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname">
                </div>
                <div class="form-group">
                    <label for="surname" ><b>Surname</b></label>
                    <input type="text" id="surname" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname">
                </div>
                <div class="form-group">
                    <label for="username" ><b>Username</b></label>
                    <input type="text" id="username" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="email" ><b>Email</b></label>
                    <input type="email" id="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="phone"><b>Phone No</b></label>
                    <input type="tel" id="phone" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number">
                </div>
                <div class="form-group">
                    <label for="gender" ><b>Gender</b></label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="">Select Your Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country" ><b>Country</b></label>
                    <select id="country" name="country" class="form-control">
                        <option value="">Select Your Country</option>
                        <option value="asia">Asia</option>
                        <option value="russia">Russia</option>
                        <option value="Europe">Europe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password" ><b>Password</b></label>
                    <input type="password" id="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="con_pass" ><b>Confirm Password</b></label>
                    <input type="password" id="con_pass" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
                </div>
                <input type="submit" name="create" value="Create Account" class="btn btn-info">
                <p style="color: black;">I already have an account <a href="patient.php">Click here</a></p>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>
</html>