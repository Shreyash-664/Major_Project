<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');
check_login();
if (isset($_POST['make'])) {
  if (empty($_POST["order_code"]) || empty($_POST["customer_name"]) || empty($_GET['prod_price'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $order_id = $_POST['order_id'];
    $order_code  = $_POST['order_code'];
    $customer_name = $_POST['customer_name'];
    $prod_id  = $_GET['prod_id'];
    $prod_name = $_GET['prod_name'];
    $prod_price = $_GET['prod_price'];
    $prod_qty = $_POST['prod_qty'];
    $postQuery = "INSERT INTO rpos_orders (prod_qty, order_id, order_code,  customer_name, prod_id, prod_name, prod_price) VALUES(?,?,?,?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);
    $rc = $postStmt->bind_param('sssssss', $prod_qty, $order_id, $order_code,  $customer_name, $prod_id, $prod_name, $prod_price);
    $postStmt->execute();
    if ($postStmt) {
      $success = "Order Submitted" && header("refresh:1; url=payments.php");
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
              <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-4">
                    <label>Customer Name</label>
                    <input type="text "class="form-control" name="customer_name" id="custName" >
                    </select>
                    <input type="hidden" name="order_id" value="<?php echo $orderid; ?>" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label>Order Code</label>
                    <input type="text" name="order_code" value="<?php echo $alpha; ?>-<?php echo $beta; ?>" class="form-control" value="">
                  </div>
                </div>
                <hr>
                <?php
                $prod_id = $_GET['prod_id'];
                $ret = "SELECT * FROM  rpos_products WHERE prod_id = '$prod_id'";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($prod = $res->fetch_object()) {
                ?>
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Product Price (₹)</label>
                      <input type="text" readonly name="prod_price" value= ₹<?php echo $prod->prod_price; ?> class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label>Product Quantity</label>
                      <input type="text" name="prod_qty" class="form-control" value="">
                    </div>
                  </div>
                <?php } ?>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="make" value="Make Order" class="btn bton-success" value="">
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
  require_once('partials/_scripts.php');
  ?>
</body>
</html>
<style>
.bton-success
{
    color: #fff;
    border-color: #2dce89;
    background-color: #2dce89;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}
.bton-success:hover
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #2dce89;
}
.bton-success:focus,
.bton-success.focus
{
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(45, 206, 137, .5);
}
.bton-success.disabled,
.bton-success:disabled
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #2dce89;
}
.bton-success:not(:disabled):not(.disabled):active,
.bton-success:not(:disabled):not(.disabled).active,
.show > .bton-success.dropdown-toggle
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #24a46d;
}
.bton-success:not(:disabled):not(.disabled):active:focus,
.bton-success:not(:disabled):not(.disabled).active:focus,
.show > .bton-success.dropdown-toggle:focus
{
    box-shadow: none, 0 0 0 0 rgba(45, 206, 137, .5);
}

  </style>