<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <title>South Express </title>
    <link rel="website icon" type="png"  href="assets/img/brand/favicon-32x32.png"> 
    <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.js"></script>
    <style>
        body {
            margin-top: 20px;
        }
    </style>
</head>
</style>
<?php
$order_code = $_GET['order_code'];
$ret = "SELECT * FROM  rpos_orders WHERE order_code = '$order_code'";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($order = $res->fetch_object()) {
    $total = ($order->prod_price * $order->prod_qty);
?>
    <body>
        <div class="container">
            <div class="row">
                <div id="Receipt" class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <address>
                                <strong>South Express</strong>
                                <br>
                                Opp Devika Soc, Ashtavinayak Marg,  </br>
                                Near Sai Baba Temple, </br>
                                Thane(E) 400 603
                                <br>
                                (+91) 882-817-9455
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>
                                <em>Date: <?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></em>
                            </p>
                            <p>
                                <em class="text-success">Receipt #: <?php echo $order->customer_name; ?></em>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <h2>Receipt</h2>
                        </div>
                        </span>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9"><em> <?php echo $order->prod_name; ?> </em></h4>
                                    </td>
                                    <td class="col-md-1" style="text-align: center"> <?php echo $order->prod_qty; ?></td>
                                    <td class="col-md-1 text-center">₹<?php echo $order->prod_price; ?></td>
                                    <td class="col-md-1 text-center">₹<?php echo $total; ?></td>
                                </tr>
                                <tr>           
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td class="text-right">
                                        <h4><strong>Total: </strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h4><strong>₹<?php echo $total; ?></strong></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <button id="print" onclick="printContent('Receipt');" class="btn btn-success btn-lg text-justify btn-block">
                        Print <span class="fas fa-print"></span>
                    </button>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>
<?php } ?>
