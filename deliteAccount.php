<?php
require_once('header.php');
if (isset($_SESSION['Category']) && isset($_POST['submitDeliteUser']) && isset($_SESSION['IdUser'])) {
    $stmt = $dbh->getInstance()->prepare("DELETE FROM `users` WHERE `users`.`IdUser` = :idUser");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $stmt->bindParam(':idUser', $_SESSION['IDmodifyByAdmin']);
        $stmt->execute();
        header("Location: adminPage.php");
    } else {
        $stmt->bindParam(':idUser', $_SESSION['IdUser']);
        $stmt->execute();
        require_once('logout.php');
    }
} else if (isset($_SESSION['Category']) && $_SESSION['Category'] == 'Administrator' && isset($_POST['adminSubmit'])) {
    $stmt = $dbh->getInstance()->prepare("DELETE FROM `users` WHERE `users`.`IdUser` = :idUser");
    $stmt->bindParam(':idUser', $_POST['idToDelite']);
    $stmt->execute();
    header("Location: adminPage.php");
} else {
    header("Location: index.php");
}
