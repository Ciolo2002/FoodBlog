<?php
require_once('header.php'); 
if(isset($_POST['submitDeliteUser'])&& isset($_SESSION['IdUser'])){
    $stmt = $dbh->getInstance()->prepare("DELETE FROM `users` WHERE `users`.`IdUser` = :idUser");
    $stmt->bindParam(':idUser', $_SESSION['IdUser']);
    $stmt->execute();
    require_once('logout.php');
}else{
    header("Location: index.php" );
}
?>