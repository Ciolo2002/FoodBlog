<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    /* if (isset($_GET['item'])) {
        $stmt = $dbh->getInstance()->prepare("SELECT `IdProduct`,`Title`,`Link`,`Description`,images.Path FROM `products` INNER JOIN images on images.IdImage=products.IdImage WHERE IdProduct=:idProduct ");
        $stmt->bindParam(':idProduct', $_GET['item']);
        $stmt->execute();
        $row = $stmt->fetch();
        if (!isset($row['IdProduct'])) {
            header('Location: index.php');
        }
    } else {
        header('Location: index.php');
    } */


    /* 
     if (isset($_GET['item']) && is_numeric($_GET['item'])) {
            $stmt = $dbh->getInstance()->prepare("SELECT `IdProduct`,`Title`,`Link`,`Description`,images.Path FROM `products` INNER JOIN images on images.IdImage=products.IdImage WHERE IdProduct=:idProduct ");
        $stmt->bindParam(':idProduct', $_GET['item']);
        $stmt->execute();
        $row = $stmt->fetch();
            if (!isset($row) || $row['IdRecipe'] != $_GET['recipe']) {
                header('Location: blog.php');
            }

           
        } else {
            header('Location: blog.php');
        }
        */
    ?>



</head>

<body>

    <div class="container-fluid ">

        <?php
         if (isset($_GET['item']) && is_numeric($_GET['item'])) {
            $stmt = $dbh->getInstance()->prepare("SELECT `IdProduct`,`Title`,`Link`,`Description`,images.Path FROM `products` INNER JOIN images on images.IdImage=products.IdImage WHERE IdProduct=:idProduct ");
            $stmt->bindParam(':idProduct', $_GET['item']);
            $stmt->execute();
            $row = $stmt->fetch();
            if (!isset($row) || $row['IdProduct'] != $_GET['item']) {
                header('Location: shop.php');
            }
        } else {
            header('Location: shop.php');
        }
        require_once("callingLogin.php");
        require_once("navbar.php");

       
        ?>





        <div class="row">



        </div>







    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>