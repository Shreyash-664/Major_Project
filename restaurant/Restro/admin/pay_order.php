<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');
check_login();
if (isset($_POST['pay'])) {
  if (empty($_POST["pay_code"]) || empty($_POST["pay_amt"]) || empty($_POST['pay_method'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $pay_code = $_POST['pay_code'];
    $order_code = $_GET['order_code'];
    $pay_amt  = $_POST['pay_amt'];
    $pay_method = $_POST['pay_method'];
    $pay_id = $_POST['pay_id'];
    $order_status = $_GET['order_status']; 
    $postQuery = "INSERT INTO rpos_payments (pay_id, pay_code, order_code,  pay_amt, pay_method) VALUES(?,?,?,?,?)";
    $upQry = "UPDATE rpos_orders SET order_status =? WHERE order_code =?";
    $postStmt = $mysqli->prepare($postQuery);
    $upStmt = $mysqli->prepare($upQry);
    $rc = $postStmt->bind_param('sssss', $pay_id, $pay_code, $order_code, $pay_amt, $pay_method);
    $rc = $upStmt->bind_param('ss', $order_status, $order_code);
    $postStmt->execute();
    $upStmt->execute();
    if ($upStmt && $postStmt) {
      $success = "Paid" && header("refresh:1; url=receipts.php");
    } else {
      $err = "Please Try Again Or Try Later";
    }
  }
}
require_once('partials/_head.php');
?>
<body> 
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <div class="main-content">
    <?php
    require_once('partials/_topnav.php');
    $order_code = $_GET['order_code'];
    $ret = "SELECT * FROM  rpos_orders WHERE order_code ='$order_code' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($order = $res->fetch_object()) {
        $total = ($order->prod_price * $order->prod_qty);

    ?>
    <div style="background-image: url(assets/img/theme/restro00.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
    <span class="mask bg-gradient-dark opacity-8"></span>
      <div class="container-fluid">
        <div class="header-body">
        </div>
      </div>
    </div>
    <div class="container-fluid mt--8">  
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3>Please Fill All Fields</h3>
            </div>
            <div class="card-body">
              <form method="POST"  enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Payment ID</label>
                    <input type="text" name="pay_id" readonly value="<?php echo $payid;?>" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>Payment Code</label>
                    <input type="text" name="pay_code" value="<?php echo $mpesaCode; ?>" class="form-control" value="">
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col-md-6">
                    <label>Amount (₹)</label>
                    <input type="text" name="pay_amt" readonly value="<?php echo $total;?>" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>Payment Method</label>
                    <select class="form-control" name="pay_method">
                        <option selected>Cash</option>
                        <option>Google Pay</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="pay" value="Pay Order" class="btn botn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php
      require_once('partials/_footer.php');
      ?>
    </div>
  </div>
  <?php
  require_once('partials/_scripts.php'); }
  ?>
</body>
</html>
<style>
  .botn-success
{
    color: #fff;
    border-color: #2dce89;
    background-color: #2dce89;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}
.botn-success:hover
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #2dce89;
}
.botn-success:focus,
.botn-success.focus
{
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(45, 206, 137, .5);
}
.botn-success.disabled,
.botn-success:disabled
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #2dce89;
}
.botn-success:not(:disabled):not(.disabled):active,
.botn-success:not(:disabled):not(.disabled).active,
.show > .botn-success.dropdown-toggle
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #24a46d;
}
.botn-success:not(:disabled):not(.disabled):active:focus,
.botn-success:not(:disabled):not(.disabled).active:focus,
.show > .botn-success.dropdown-toggle:focus
{
    box-shadow: none, 0 0 0 0 rgba(45, 206, 137, .5);
}

  </style>
