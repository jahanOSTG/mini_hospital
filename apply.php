<?php
include 'connection.php';
if (isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];
    $error = array();
    if (empty($firstname)) {
        $error['apply'] = "Enter Firstname";
    } elseif (empty($surname)) {
        $error['apply'] = "Enter Surname";
    } elseif (empty($username)) {
        $error['apply'] = "Enter Username";
    } elseif (empty($email)) {
        $error['apply'] = "Enter Email Address";
    } elseif (empty($phone)) {
        $error['apply'] = "Enter Phone Number";
    } elseif ($gender == "") {
        $error['apply'] = "Select Your Gender";
    } elseif ($country == "") {
        $error['apply'] = "Select Country";
    } elseif (empty($password)) {
        $error['apply'] = "Enter Password";
    } elseif ($confirm_password != $password) {
        $error['apply'] = "Both Passwords do not match";
    }
    if (count($error) == 0) {
      
        $query = "INSERT INTO doctor (firstname, surname, username, email, gender, phone, country, pass, salary, date_reg, statu, profile)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, '0', NOW(), 'pending', 'doctor.jpg')";
        if ($stmt = mysqli_prepare($connect, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssssss', $firstname, $surname, $username, $email, $gender, $phone, $country, $password);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('You have successfully applied')</script>";
                header("Location: doctorlogin.php");
                exit();
            } else {
                echo "<script>alert('Failed to insert data: " . mysqli_stmt_error($stmt) . "')</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Failed to prepare the SQL statement: " . mysqli_error($connect) . "')</script>";
        }
    }
}
if (isset($error['apply'])) {
    $s = $error['apply'];
    $show = "<h5 class='text-center alert alert-danger'>$s</h5>";
} else {
    $show = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Now</title>
</head>
<body style="background-image: url('9.webp'); background-repeat: no-repeat; background-size: cover;">
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 my-3 jumpbotron">
                    <h5 class="text-center" style="color: cyan;">Apply Now</h5>
                    <div>
                        <?php echo $show; ?>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label for="firstname" style="color: cyan;"><b>Firstname</b></label>
                            <input type="text" id="firstname" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label for="surname" style="color: cyan;"><b>Surname</b></label>
                            <input type="text" id="surname" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname">
                        </div>
                        <div class="form-group">
                            <label for="username" style="color: cyan;"><b>Username</b></label>
                            <input type="text" id="username" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="email" style="color: cyan;"><b>Email</b></label>
                            <input type="email" id="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="phone" style="color: cyan;"><b>Phone No</b></label>
                            <input type="tel" id="phone" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="gender" style="color: cyan;"><b>Gender</b></label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="">Select Your Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country" style="color: cyan;"><b>Country</b></label>
                            <select id="country" name="country" class="form-control">
                                <option value="">Select Your Country</option>
                                <option value="asia">Asia</option>
                                <option value="russia">Russia</option>
                                <option value="Europe">Europe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password" style="color: cyan;"><b>Password</b></label>
                            <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="con_pass" style="color: cyan;"><b>Confirm Password</b></label>
                            <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
                        </div>
                        <input type="submit" name="apply" value="Create Account" class="btn btn-info">
                        <p style="color: cyan;">I already have an account <a href="doctorlogin.php">Click here</a></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>