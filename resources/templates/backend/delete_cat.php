<?php require_once("../../../resources/config.php")?>
<?php

if(isset($_GET['id'])&&!empty($_GET['id'])){
$sql = "DELETE FROM `categories` WHERE cat_id =".escape_string($_GET['id'])." ";
$result = query($sql);
confirm($result);
set_msg("Category Id ".$_GET['id']. " Deleted");
redirect("../../../public/admin/index.php?categories");
}
else
	redirect("../../../public/admin/index.php?categories");
?>