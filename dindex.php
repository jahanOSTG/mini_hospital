<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
   
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">
      <?php include 'asidenav.php'; ?> </div>
    <div class="col-md-10">
      <h4 class="my-2">Doctors Dashboard</h4>
      <div class="row">
      <div class="col-md-4 my-2">
          <div class="card bg-success text-white" style="height: 130px;">
            <div class="card-body d-flex align-items-center justify-content-between"><div>
               <h5 class="my-2" style="font-size: 30px;"></h5>
                <h5>My Profile</h5>
              </div>
              <a href="dprofile.php" class="text-white">
                <i class="fa fa-user-circle card-icon fa-3x my-4"></i>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Doctors Card -->
        <div class="col-md-4 my-2">
          <div class="card bg-info text-white" style="height: 130px;">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
          
                
                <h5 class="my-2" style="font-size: 30px;"></h5>
                
                <h5>Total Patient</h5>
              </div>
              <a href="#" class="text-white">
                <i class="fa fa-stethoscope fa-3x"></i>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Patient Card -->
        <div class="col-md-4 my-2">
          <div class="card bg-warning text-white" style="height: 130px;">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
               
            
                
                <h5 class="my-2" style="font-size: 30px;"></h5>
                <h5>0</h5>
                <h5>Total Appointment</h5>
              </div>
              <a href="#" class="text-white">
                <i class="fa fa-calendar fa-3x my-4"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Add Bootstrap JS and dependencies (jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
