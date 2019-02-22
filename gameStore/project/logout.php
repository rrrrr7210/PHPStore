
<?php include "../core/init.php"; ?>
<?php include "includes/header.php";?>
<?php
$getFromU->logout();
if ($getFromU->loggedIn() != true){
    header("Location:index.php");
}
?>
<?php include "includes/footer.php"; ?>

