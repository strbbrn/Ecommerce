<?php require_once("../../../resources/config.php")?>
<?php

if(isset($_GET['id'])&&!empty($_GET['id'])){
$sql = "DELETE FROM `products` WHERE product_id =".escape_string($_GET['id'])." ";
$result = query($sql);
confirm($result);
set_msg("Product Id ".$_GET['id']. " Deleted");
redirect("../../../public/admin/index.php?view_products");
}
else
	redirect("../../../public/admin/index.php?view_products");
?>