<?php require_once("../../../resources/config.php")?>
<?php

if(isset($_GET['id'])&&!empty($_GET['id'])){
$sql = "DELETE FROM `reports` WHERE report_id =".escape_string($_GET['id'])." ";
$result = query($sql);
confirm($result);
set_msg("Report Id ".$_GET['id']. " Deleted");
redirect("../../../public/admin/index.php?reports");
}
else
	redirect("../../../public/admin/index.php?reports");
?>