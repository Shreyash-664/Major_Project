<?php
session_start();
include('config/config.php');

if (isset($_POST['login'])) {
  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password']; 
  $stmt = $mysqli->prepare("SELECT admin_email, admin_password, admin_id  FROM   rpos_admin WHERE (admin_email =? AND admin_password =?)"); 
  $stmt->bind_param('ss',  $admin_email, $admin_password); 
  $stmt->execute(); 
  $stmt->bind_result($admin_email, $admin_password, $admin_id); 
  $rs = $stmt->fetch();
  $_SESSION['admin_id'] = $admin_id;
  if ($rs) {
    header("location:dashboard.php");
  } else {
    $err = "Incorrect Email or Password ";
  }
}
require_once('partials/_head.php');
?>
<body  class="bg-dark">
  <div class="main-content">
    <div class="header bg-gradient-primar py-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Restaurant Billing System</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form method="post" role="form">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" required name="admin_email" placeholder="Email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" required name="admin_password" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                </div>
              </form>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once('partials/_footer.php');
  ?>
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>
</html>