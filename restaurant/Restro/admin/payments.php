<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
if (isset($_GET['cancel'])) {
    $id = $_GET['cancel'];
    $adn = "DELETE FROM  rpos_orders  WHERE  order_code = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=payments.php");
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
                            <a href="orders.php" class="btn btn-outline-success">
                                <i class="fas fa-plus"></i> <i class="fas fa-utensils"></i>
                                Make A New Order
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_orders WHERE order_status =''  ORDER BY `rpos_orders`.`created_at` DESC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        $total = ((int)$order->prod_price * (int)$order->prod_qty);
                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row"><?php echo $order->order_code; ?></th>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td><?php echo $order->prod_name; ?></td>
                                            <td>₹ <?php echo $total; ?></td>
                                            <td><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                            <td>
                                                <a href="pay_order.php?order_code=<?php echo $order->order_code;?>&customer_name=<?php echo $order->customer_name;?>&order_status=Paid">
                                                    <button class="btn btn-sm botn-success">
                                                        <i class="fas fa-handshake"></i>
                                                        Pay Order
                                                    </button>
                                                </a>
                                                <a href="payments.php?cancel=<?php echo $order->order_code; ?>">
                                                    <button class="btn btn-sm bton-danger">
                                                        <i class="fas fa-window-close"></i>
                                                        Cancel Order
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


.bton-danger
{
    color: #fff;
    border-color: #f5365c;
    background-color: #f5365c;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}
.bton-danger:hover
{
    color: #fff;
    border-color: #f5365c; 
    background-color: #f5365c;
}
.bton-danger:focus,
.bton-danger.focus
{
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(245, 54, 92, .5);
}
.bton-danger.disabled,
.bton-danger:disabled
{
    color: #fff;
    border-color: #f5365c; 
    background-color: #f5365c;
}
.bton-danger:not(:disabled):not(.disabled):active,
.bton-danger:not(:disabled):not(.disabled).active,
.show > .bton-danger.dropdown-toggle
{
    color: #fff;
    border-color: #f5365c; 
    background-color: #ec0c38;
}
.bton-danger:not(:disabled):not(.disabled):active:focus,
.bton-danger:not(:disabled):not(.disabled).active:focus,
.show > .bton-danger.dropdown-toggle:focus
{
    box-shadow: none, 0 0 0 0 rgba(245, 54, 92, .5);
}
</style>