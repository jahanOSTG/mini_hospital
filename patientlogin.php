
<?php
session_start();
include 'connection.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['uname']);
    $password = trim($_POST['pass']);
    $error = array();

    if (empty($username)) {
        $error[] = "Enter Username";
    }

    if (empty($password)) {
        $error[] = "Enter Password";
    }

    if (count($error) == 0) {
        // Prepare SQL query using prepared statements
        $query = "SELECT * FROM patient WHERE username = ?";
        if ($stmt = mysqli_prepare($connect, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                
                // Verify hashed password
                if (password_verify($password, $row['password'])) {
                    $_SESSION['patient'] = $username;
                    header("Location: pindex.php");
                    exit();
                } else {
                    echo "<script>alert('Invalid Username or Password');</script>";
                }
            } else {
                echo "<script>alert('Invalid Username or Password');</script>";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Database error: Unable to prepare statement');</script>";
        }
    } else {
        foreach ($error as $err) {
            echo "<script>alert('$err');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login Page</title>
    
    
</head>
<body style="background-image: url('doctor.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php include 'header.php'; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 jumbotron my-3">
                <h5 class="text-center my-2">Patient's Login</h5>
                <form method="post">
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" id="uname" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div>

                  
                        <input type="submit" name="login" class="btn btn-success" value="Login">
                        <p> I don't have any account <a href="account.php">Apply Now.</a></p>
                
                </form>
            </div>
        </div>
    </div>
</body>
</html>

