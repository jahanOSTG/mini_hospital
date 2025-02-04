
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <a class="navbar-brand text-white" href="#">Hospital Management System</a>
        <div class="mr-auto"></div>
            <ul class="navbar-nav">
            <?php



if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
    echo '
    <li class="nav-item"><a href="#" class="nav-link text-white">user</a></li>
    <li class="nav-item"><a href="alogout.php" class="nav-link text-white">Logout</a></li>';
} 

else if (isset($_SESSION['doctor'])) {
    $user = $_SESSION['doctor'];
    echo '
    <li class="nav-item"><a href="#" class="nav-link text-white">user</a></li>
    <li class="nav-item"><a href="dlogout.php" class="nav-link text-white">Logout</a></li>';
} 
else if (isset($_SESSION['patient'])) {
    $user = $_SESSION['patient'];
    echo '
    <li class="nav-item"><a href="#" class="nav-link text-white">user</a></li>
    <li class="nav-item"><a href="dlogout.php" class="nav-link text-white">Logout</a></li>';
} 


else {
    echo '
    <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
    <li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>
    <li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>
    <li class="nav-item"><a href="patientlogin.php" class="nav-link text-white">Patient</a></li>';
}
?>
            </ul>
        </div>
    </nav>
</body>
</html>
