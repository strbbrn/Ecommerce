<?php
require_once("../resources/config.php");
echo "<h1>Thank You</h1>";
?>

<?php 
if(isset($_GET['txn'])	&& isset($_GET['amt']) && isset($_GET['item']) && isset($_GET['st'])){

	$txn = $_GET['txn'];
	$amt = $_GET['amt'];
	$item = $_GET['item'];
	$st = $_GET['st'];

	$sql = "INSERT INTO `orders`(`order_txt`, `order_amt`, `order_product_id`, `status`) VALUES ('{$txn}',{$amt},{$item},'{$st}')";
	$result = query($sql);
	confirm($result);
	$order_id = mysqli_insert_id($connection);
	
	echo "For Shopping With Us <br>";
	report($order_id);
	echo "You have paid sum of ".$amt."";
	session_destroy();

}
else
	redirect("index.php");
?>