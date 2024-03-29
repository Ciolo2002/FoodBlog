<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("header.php");
    if(isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin'])==true){
        $_SESSION['modifyByAdmin']=false;
    }
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
        <header class="text-center logo">
            <h1 style="font-size: 65px"><?php echo strtoupper(htmlentities($row['Title'])); ?></h1>
        </header>
        <div style="margin: 3%"></div>
        <div class="row" style="margin-bottom:3%">

            <div class="col-12 col-sm-12 col-lg-4 col-md-6 d-flex justify-content-center">
                <a href="<?php echo $row['Link'] ?>" class="box rounded">
                    <?php echo ' <img src="' . $row['Path'] . '" class="img-fluid rounded" alt="' .$row['Title'] . '" style="margin-botom:3%;  box-shadow: 0 0 11px rgba(33, 33, 33, 0.534);">'  ?>
                </a>
            </div>

            <div class="col-12 col-sm-12 col-lg-8 col-md-6 d-flex justify-content-center">
                <h4 style="font-size: 35px" class="navbar-font position-absolute" style="margin-top:10%">YOU WILL FIND</h4>
                <div class="position-relative" style="margin-top:10%;">

                    <p class="navbar-font" style="font-size:25px"><?php echo  $row['Description'] ?> </p>
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo $row['Link'] ?>" ><img src="Images/amazon-kindle-logo_16.png" class="box" style="border-radius: 20px; width: 250px; height: 110px; background-color:none"></a>
                    </div>

                </div>
                <div style="margin-top:10%">
                </div>
            </div>

        </div>







    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>