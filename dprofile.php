<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connection.php';

// Redirect if the doctor is not logged in
if (!isset($_SESSION['doctor'])) {
    header("Location: login.php");
    exit();
}

$doc = mysqli_real_escape_string($connect, $_SESSION['doctor']);
$query = "SELECT * FROM doctor WHERE username='$doc'";
$res = mysqli_query($connect, $query);

if (!$res) {
    die('Query failed: ' . mysqli_error($connect));
}

$row = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-image: url('4.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php include 'dsidenav.php'; ?>
            </div>
            <div class="col-md-10">
                <div class="container">
                    <div class="row">
                        <!-- Profile Image and Details -->
                        <div class="col-md-6">
                            <form method="post" enctype="multipart/form-data">
                                <?php
                                $profileImage = !empty($row['profile']) ? 'img/' . htmlspecialchars($row['profile']) : 'img/default-profile.png';
                                echo "<img src='$profileImage' class='img-fluid my-3' style='height: 250px;' alt='Profile Image'>";
                                ?>
                                <input type="file" name="img" class="form-control my-1">
                                <input type="submit" name="upload" class="btn btn-success" value="Update Profile">
                            </form>

                            <div class="my-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Firstname</td><td><?php echo htmlspecialchars($row['firstname'] ?? ''); ?></td></tr>
                                        <tr><td>Username</td><td><?php echo htmlspecialchars($row['username']); ?></td></tr>
                                        <tr><td>Email</td><td><?php echo htmlspecialchars($row['email']); ?></td></tr>
                                        <tr><td>Gender</td><td><?php echo htmlspecialchars($row['gender'] ?? ''); ?></td></tr>
                                        <tr><td>Phone</td><td><?php echo htmlspecialchars($row['phone'] ?? ''); ?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Change Username and Password Forms -->
                        <div class="col-md-6">
                            <!-- Change Username -->
                            <h5 class="text-center my-2">Change Username</h5>
                            <?php
                            if (isset($_POST['change_uname'])) {
                                $new_uname = mysqli_real_escape_string($connect, $_POST['uname']);
                                if (!empty($new_uname)) {
                                    $updateQuery = "UPDATE doctor SET username='$new_uname' WHERE username='$doc'";
                                    if (mysqli_query($connect, $updateQuery)) {
                                        $_SESSION['doctor'] = $new_uname;
                                        echo '<div class="alert alert-success">Username updated successfully.</div>';
                                        header("Refresh:0");
                                    } else {
                                        echo '<div class="alert alert-danger">Username update failed.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-warning">Username cannot be empty.</div>';
                                }
                            }
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label for="uname">New Username</label>
                                    <input type="text" id="uname" name="uname" class="form-control" autocomplete="off" placeholder="Enter New Username">
                                </div>
                                <input type="submit" name="change_uname" class="btn btn-success" value="Change Username">
                            </form>

                            <!-- Change Password -->
                            <h5 class="text-center my-4">Change Password</h5>
                            <?php
                            if (isset($_POST['change_pass'])) {
                                $old_pass = $_POST['old_pass'];
                                $new_pass = $_POST['new_pass'];
                                $con_pass = $_POST['con_pass'];

                                $query = "SELECT password FROM doctor WHERE username='$doc'";
                                $result = mysqli_query($connect, $query);
                                $user = mysqli_fetch_assoc($result);

                                if (password_verify($old_pass, $user['password'])) {
                                    if ($new_pass === $con_pass) {
                                        $hashed_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                                        $updateQuery = "UPDATE doctor SET password='$hashed_new_pass' WHERE username='$doc'";
                                        if (mysqli_query($connect, $updateQuery)) {
                                            echo '<div class="alert alert-success">Password updated successfully.</div>';
                                        } else {
                                            echo '<div class="alert alert-danger">Password update failed.</div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-warning">New passwords do not match.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">Old password is incorrect.</div>';
                                }
                            }
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label for="old_pass">Old Password</label>
                                    <input type="password" id="old_pass" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">
                                </div>
                                <div class="form-group">
                                    <label for="new_pass">New Password</label>
                                    <input type="password" id="new_pass" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                    <label for="con_pass">Confirm Password</label>
                                    <input type="password" id="con_pass" name="con_pass" class="form-control" autocomplete="off" placeholder="Confirm New Password">
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="change_pass" class="btn btn-info" value="Change Password">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
