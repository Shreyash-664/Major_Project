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
                            Paid Orders
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col">Code</th>
                                        <th scope="col">Customer</th>
                                        <th class="text-success" scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th class="text-success" scope="col">Qty</th>
                                        <th scope="col">Total Price</th>
                                        <th class="text-success" scope="col">Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_orders WHERE order_status = 'Paid' ORDER BY `rpos_orders`.`created_at` DESC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        $total = ($order->prod_price * $order->prod_qty);
                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row"><?php echo $order->order_code; ?></th>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td class="text-success"><?php echo $order->prod_name; ?></td>
                                            <td>₹ <?php echo $order->prod_price; ?></td>
                                            <td class="text-success"><?php echo $order->prod_qty; ?></td>
                                            <td>₹ <?php echo $total; ?></td>
                                            <td><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                            <td>
                                                <a target="_blank" href="print_receipt.php?order_code=<?php echo $order->order_code; ?>">
                                                    <button class="btn btn-sm botn-primary">
                                                        <i class="fas fa-print"></i>
                                                        Print Receipt
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

    </style>