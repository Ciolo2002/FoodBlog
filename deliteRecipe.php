<?php
 require_once("header.php");
if(isset($_SESSION['Category']) && $_SESSION['Category']=='Chef' && isset($_POST['deliteRecipe'])){
    $stmt= $dbh->getInstance()->prepare("UPDATE `recipes` SET `State`=false WHERE `IdRecipe`=:idrecipe ");
    $stmt->bindParam(':idrecipe', $_POST['idToDelite']);
    $stmt->execute();
   header('Location: chefPageRecipes.php');
}else{
    header("Location: index.php");
}