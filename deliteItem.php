<?php
require_once('header.php');
if (isset($_SESSION['Category']) && $_SESSION['Category'] == 'Chef'  &&  (isset($_POST['adminSubmit']) || isset($_POST['submitDeliteItem']))) {
    $stmt = $dbh->getInstance()->prepare("DELETE FROM `products` WHERE `products`.`IdProduct` = :idProduct");
    $stmt->bindParam(':idProduct', $_POST['idToDelite']);
    $stmt->execute();
    header("Location: chefPageProducts.php");
} else {
    header("Location: index.php");
}
