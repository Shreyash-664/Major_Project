<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
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
              Select On Any Product To Make An Order
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><b>Image</b></th>
                    <th scope="col"><b>Product Code</b></th>
                    <th scope="col"><b>Name</b></th>
                    <th scope="col"><b>Price</b></th>
                    <th scope="col"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_products ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td>
                        <?php
                        if ($prod->prod_img) {
                          echo "<img src='assets/img/products/$prod->prod_img' height='60' width='60 class='img-thumbnail'>";
                        } else {
                          echo "<img src='assets/img/products/default.jpg' height='60' width='60 class='img-thumbnail'>";
                        }
                        ?>
                      </td>
                      <td><?php echo $prod->prod_code; ?></td>
                      <td><?php echo $prod->prod_name; ?></td>
                      <td>₹ <?php echo $prod->prod_price; ?></td>
                      <td>
                        <a href="make_oder.php?prod_id=<?php echo $prod->prod_id; ?>&prod_name=<?php echo $prod->prod_name; ?>&prod_price=<?php echo $prod->prod_price; ?>">
                          <button class= "btn btn-sm bton-warning">
                            <i class="fas fa-cart-plus"></i>
                            Place Order
                          </button>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
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
.bton-warning
{
    color: #fff;
    border-color: #fb6340;
    background-color: #fb6340;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}
.bton-warning:hover
{
    color: #fff;
    border-color: #fb6340; 
    background-color: #fb6340;
}
.bton-warning:focus,
.bton-warning.focus
{
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(251, 99, 64, .5);
}
.bton-warning.disabled,
.bton-warning:disabled
{
    color: #fff;
    border-color: #fb6340; 
    background-color: #fb6340;
}
.bton-warning:not(:disabled):not(.disabled):active,
.bton-warning:not(:disabled):not(.disabled).active,
.show > .bton-warning.dropdown-toggle
{
    color: #fff;
    border-color: #fb6340; 
    background-color: #fa3a0e;
}
.bton-warning:not(:disabled):not(.disabled):active:focus,
.bton-warning:not(:disabled):not(.disabled).active:focus,
.show > .bton-warning.dropdown-toggle:focus
{
    box-shadow: none, 0 0 0 0 rgba(251, 99, 64, .5);
}


  </style>