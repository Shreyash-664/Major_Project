<?php
include('config/config.php');

$ret = "SELECT * FROM  LAMCorp_waterTariffs";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); 
$res = $stmt->get_result();
$cnt = 1;
while ($row = $res->fetch_object()) {
    $tariffCost = $row->cost_per_litre;

    if (!empty($_POST["purchasedLitres"])) {
        $litresPurchased = $_POST['purchasedLitres'];
        $payableAmt = $tariffCost * $litresPurchased;
        echo htmlentities($payableAmt);
    }
}
