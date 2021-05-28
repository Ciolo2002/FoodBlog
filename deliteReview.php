<?php
if (isset($_POST['submit'])) {
    require_once("header.php");

    $stmtControll = $dbh->getInstance()->prepare("SELECT users.IdUser, reviews.IdReview FROM `reviews` inner join users on users.IdUser=reviews.IdUser WHERE reviews.IdReview=:IdReview");
    $stmtControll->bindParam(':IdReview', $_POST['IdReview']);
    $stmtControll->execute();
    $row=$stmtControll->fetch();


if((isset($row['IdUser'])&& $row['IdUser']==$_SESSION['IdUser']) || ($_SESSION['Category']=='Administrator')){

    $stmt = $dbh->getInstance()->prepare("DELETE FROM reviews WHERE IdReview= :IdReview");
    $stmt->bindParam(':IdReview', $_POST['IdReview']);
    $stmt->execute();
    header("Location:recipe.php?recipe=" . $_POST['IdRecipe']);
}
else {
    header("Location: index.php");
}

} else {
    header("Location: index.php");
}
