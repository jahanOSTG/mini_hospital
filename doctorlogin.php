<?php
session_start();
include 'connection.php';
if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if (empty($username)) {
        $error['doctor'] = "Enter Username";
    }

    if (empty($password)) {
        $error['doctor'] = "Enter Password";
    }

    if (count($error) == 0){
        $query = "SELECT * FROM doctor WHERE username='$username' AND pass='$password'";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) == 1) {
             echo "<script>alert('You have logged in as a doctor')</script>";
            $_SESSION['doctor'] = $username;
            header("Location:dindex.php");
            exit();
           
        } else {
            echo "<script>alert('Invalid Username or Password')</script>";
        }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login Page</title>
    </head>
<body style="background-image: url('doctor.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php include 'header.php'; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 jumbotron my-3">
                <h5 class="text-center my-2">Doctors Login</h5>
                <form method="post">
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" id="uname" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div><input type="submit" name="login" class="btn btn-success" value="Login">
                        <p> I don't have any account <a href="apply.php">Apply Now.</a></p>
                 </form>
            </div>
        </div>
    </div>
</body>
</html>

