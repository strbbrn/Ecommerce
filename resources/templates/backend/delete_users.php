<?php require_once("../../../resources/config.php")?>
<?php

if(isset($_GET['id'])&&!empty($_GET['id'])){
$sql = "DELETE FROM `users` WHERE user_id =".escape_string($_GET['id'])." ";
$result = query($sql);
confirm($result);
set_msg("User Id ".$_GET['id']. " Deleted");
redirect("../../../public/admin/index.php?users");
}
else
	redirect("../../../public/admin/index.php?users");
?>