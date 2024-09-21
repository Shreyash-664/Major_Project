<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $adn = "DELETE FROM  rpos_products  WHERE  prod_id = ?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $stmt->close();
  if ($stmt) {
    $success = "Deleted" && header("refresh:1; url=products.php");
  } else {
    $err = "Try Again Later";
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
              <a href="add_product.php" class="btn btn-outline-success">
                <i class="fas fa-utensils"></i>
                Add New Product
              </a>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
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
                      <td> ₹<?php echo $prod->prod_price; ?></td>
                      <td>
                        <a href="update_product.php?update=<?php echo $prod->prod_id; ?>">
                        <style>
                          .button{}
                          </style>
                          <button   class="btn btn-sm botn-primary">
                            <i class="fas fa-edit"></i>
                            Update
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
 .botn-primary
{
    color: #fff;
    border-color: #e4845e;
    background-color: #5e72e4;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}
.botn-primary:hover
{
    color: #fff;
    border-color: #e4945e; 
    background-color: #5e72e4;
}
.botn-primary:focus,
.botn-primary.focus
{
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(228, 132, 94, 0.5);
}
.botn-primary.disabled,
.botn-primary:disabled
{
    color: #fff;
    border-color: #e4d45e; 
    background-color: #e4e45e;
}
.botn-primary:not(:disabled):not(.disabled):active,
.botn-primary:not(:disabled):not(.disabled).active,
.show > .botn-primary.dropdown-toggle
{
    color: #fff;
    border-color: #e4c55e; 
    background-color: #ddc332;
}
.botn-primary:not(:disabled):not(.disabled):active:focus,
.botn-primary:not(:disabled):not(.disabled).active:focus,
.show > .botn-primary.dropdown-toggle:focus
{
    box-shadow: none, 0 0 0 0 rgba(228, 215, 94, 0.5);
}


.btn-outline-success
{
    color: #2dce89;
    border-color: #2dce89; 
    background-color: transparent;
    background-image: none;
}
.btn-outline-success:hover
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #2dce89;
}
.btn-outline-success:focus,
.btn-outline-success.focus
{
    box-shadow: 0 0 0 0 rgba(45, 206, 137, .5);
}
.btn-outline-success.disabled,
.btn-outline-success:disabled
{
    color: #2dce89;
    background-color: transparent;
}
.btn-outline-success:not(:disabled):not(.disabled):active,
.btn-outline-success:not(:disabled):not(.disabled).active,
.show > .btn-outline-success.dropdown-toggle
{
    color: #fff;
    border-color: #2dce89; 
    background-color: #2dce89;
}
.btn-outline-success:not(:disabled):not(.disabled):active:focus,
.btn-outline-success:not(:disabled):not(.disabled).active:focus,
.show > .btn-outline-success.dropdown-toggle:focus
{
    box-shadow: 0 0 0 0 rgba(45, 206, 137, .5);
}

  </style>