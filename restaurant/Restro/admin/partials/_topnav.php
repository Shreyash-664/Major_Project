<?php
$admin_id = $_SESSION['admin_id'];
$ret = "SELECT * FROM  rpos_admin  WHERE admin_id = '$admin_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($admin = $res->fetch_object()) {

?>
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="dashboard.php"><?php echo $admin->admin_name; ?> Dashboard</a>
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="assets/img/theme/user-a-min.png">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold"><?php echo $admin->admin_name; ?></span>
                            </div>
                        </div>
                    </a>
                   
                </li>
            </ul>
        </div>
    </nav>
<?php } ?>