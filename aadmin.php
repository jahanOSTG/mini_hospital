<?php
session_start();
include 'connection.php';
if (isset($_POST['add'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $image = $_FILES['img']['name'];
    $imageTmpName = $_FILES['img']['tmp_name'];
    $imageError = $_FILES['img']['error'];
    $error = array();
    if (empty($uname)) {
        $error['u'] = "Enter Admin Username";}
    if (empty($pass)) {
        $error['p'] = "Enter Admin Password";}
    if (empty($image)) {
        $error['i'] = "Add Admin Picture"; }
    if ($imageError !== UPLOAD_ERR_OK) {
        $error['img'] = "File upload error: " . $imageError;
    } else { if ($_FILES['img']['size'] > 5242880) {
            $error['img'] = "File size exceeds the maximum limit of 5MB.";}
        $allowedTypes = array('image/jpeg', 'image/png');
        if (!in_array($_FILES['img']['type'], $allowedTypes)) {
            $error['img'] = "Invalid file type. Only JPG and PNG files are allowed."; }}
         if (count($error) == 0) {
         $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        $q = "INSERT INTO admin (username, password, profile) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($connect, $q)) {
            mysqli_stmt_bind_param($stmt, 'sss', $uname, $hashed_pass, $image);
            if (mysqli_stmt_execute($stmt)) {
             $uploadDir = 'img/4.jpg';
                $uploadFile = $uploadDir . basename($image);
                if (move_uploaded_file($imageTmpName, $uploadFile)) {
                    $message = "<div class='alert alert-success'>Admin added successfully!</div>";
                } else {
                    $message = "<div class='alert alert-warning'>Failed to move uploaded file. Check directory permissions.</div>";
                }
            } else {
                $message = "<div class='alert alert-danger'>Failed to add admin. Database error: " . mysqli_stmt_error($stmt) . "</div>";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "<div class='alert alert-danger'>Failed to prepare the SQL statement: " . mysqli_error($connect) . "</div>";
        }
    } else {
        // Display errors
        $message = "<div class='alert alert-danger'>";
        foreach ($error as $err) {
            $message .= "$err<br>";
        }
        $message .= "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function removeAdmin(id) {
            if (confirm("Are you sure you want to remove this admin?")) {
                window.location.href = `remove_admin.php?id=${id}`;
            }
        }
    </script>
</head>
<body style="background-image: url('10.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php include 'asidenav.php'; ?>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-center">All Admins</h5>
                        <?php
                        $admin = $_SESSION['admin'];
                        $query = "SELECT * FROM admin WHERE username != '$admin'";
                        $res = mysqli_query($connect, $query);

                        if (!$res) {
                            die("Query failed: " . mysqli_error($connect));
                        }

                        $output = "<table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                        if (mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td colspan='3' class='text-center'>No Admins Found</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_array($res)) {
                                $id = $row['id'];
                                $username = $row['username'];
                                $output .= "<tr>
                                                <td>$id</td>
                                                <td>$username</td>
                                                <td>
                                                    <button class='btn btn-danger' onclick='removeAdmin($id)'>Remove</button>
                                                </td>
                                            </tr>";
                            }
                        }

                        $output .= "</tbody></table>";
                        echo $output;
                        ?>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center">Add Admin</h5>
                        <?php if (isset($message)) echo $message; ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="uname">Username</label>
                                <input type="text" id="uname" name="uname" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" id="pass" name="pass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="img">Add Admin Picture</label>
                                <input type="file" id="img" name="img" class="form-control" required>
                            </div>
                            <button type="submit" name="add" class="btn btn-success">Add New Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

