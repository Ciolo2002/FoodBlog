<?php
if (isset($_POST['submit'])) {
    require_once("header.php");
    $stmt = $dbh->getInstance()->prepare("DELETE FROM reviews WHERE IdReview= :IdReview");
    $stmt->bindParam(':IdReview', $_POST['IdReview']);
    $stmt->execute();
    header("Location:recipe.php?recipe=" . $_POST['IdRecipe']);
} else {
    header("Location: index.php");
}
