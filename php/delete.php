<?php
include_once 'dbManagement.php';
$management = new dbManagement();
$management->deleteItem($_GET['id']);
$management->deleteRelatednumbers($_GET['id']);
header("location: ../index.php");
?>
