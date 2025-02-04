
<?php
session_start();

include 'connection.php';


if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if (empty($username)) {
        $error['admin'] = "Enter Username";
    }

    if (empty($password)) {
        $error['admin'] = "Enter Password";
    }

    if (count($error) == 0){
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) == 1) {
             echo "<script>alert('You have logged in as an admin')</script>";
            $_SESSION['admin'] = $username;
            header("Location:index_2.php");
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
    <title>Login</title>
</head>
<body style="background-image:url('pl.png');background-repeat:no-repeat;background-size: cover;">
    <?php 
    include 'header.php'; ?>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 20px;">
            <div class="col-md-1"></div>
            <div class="col-md-6 jumbotron">
                <img src="admin.png" class="col-md-5">
                <form method="post" class="my-3">
                    <div class="alert alert-danger">
                        <?php
                        $show = isset($error['admin']) ? $error['admin'] : '';
                        echo $show;
                        ?>
                    </div>
                    <div class="form-group">
                        <b><label for="uname">Username</label></b>
                        <input type="text" name="uname" id="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div>
                    <div>
                        <input type="submit" name="login" class="btn btn-success" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
