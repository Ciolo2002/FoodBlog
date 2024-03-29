<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("header.php");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $_SESSION['modifyByAdmin'] = false;
    }
    ?>

    <link rel="stylesheet" href="shopStyle.css">

</head>

<body>

    <div class="container-fluid">
        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>
        <header class="text-center logo">
            <h1 style="font-size: 65px">Products</h1>
        </header>
        <?php
        $stmt = $dbh->getInstance()->prepare("SELECT `IdProduct`,`Title`,`Link`,`Description`,images.Path FROM `products` INNER JOIN images on images.IdImage=products.IdImage WHERE 1");
        $stmt->execute();

        for ($cnt = $stmt->rowCount(); $cnt > 0; --$cnt) {
            $row = $stmt->fetch();
            if (isset($row['IdProduct'])) {
                echo '  <div class="row">
            <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper box rounded text-center rss opacity ">
                    <div class="product-img rounded">
                        <a href="product.php?item=' . $row['IdProduct'] . '" data-abc="true" >';
                echo '<img src="' . $row['Path'] . '" class="img-fluid rounded" alt="' . $row['Title'] . '">
                        </a>
                        
                        <div class="product-action">
                            <div class="product-action-style">
                                <a href="' . $row['Link'] . '" class="nav-font" style="text-decoration: none;">GO TO KINDLE </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                --$cnt;
                $row = $stmt->fetch();
            }
            if (isset($row['IdProduct'])) {
                echo '   <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper box rounded text-center rss opacity">
                    <div class="product-img rounded">
                        <a href="product.php?item=' . $row['IdProduct'] . '"  data-abc="true" >
                            <img src="' . $row['Path'] . '" class="img-fluid rounded" alt="' . $row['Title'] . '">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            <a   href="' . $row['Link'] . '"class="nav-font" style="text-decoration: none;">GO TO KINDLE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                --$cnt;
                $row = $stmt->fetch();
            }
            if (isset($row['IdProduct'])) {
                echo '   <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper box rounded text-center rss opacity">
                    <div class="product-img rounded">
                        <a href="product.php?item=' . $row['IdProduct'] . '" data-abc="true" >
                            <img src="' . $row['Path'] . '" class="img-fluid rounded" alt="' . $row['Title'] . '">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            <a href="' . $row['Link'] . '"  class="nav-font" style="text-decoration: none;">GO TO KINDLE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                --$cnt;
                $row = $stmt->fetch();
            }
            if (isset($row['IdProduct'])) {
                echo '   <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper box rounded text-center rss opacity">
                    <div class="product-img rounded">
                        <a href="product.php?item=' . $row['IdProduct'] . '" data-abc="true" >
                            <img src="' . $row['Path'] . '" class="img-fluid rounded" alt="' . $row['Title'] . '">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            <a   href="' . $row['Link'] . '"  class="nav-font" style="text-decoration: none;">GO TO KINDLE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                --$cnt;
                $row = $stmt->fetch();
            }
            echo '</div>';
        }
        ?>
        <?php
        if (isset($_SESSION['Category']) && $_SESSION['Category'] =="Chef") {
            echo ' <div class="row d-flex justify-content-center">
            <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45 d-flex justify-content-center">
                <div class="product-wrapper box rounded text-center rss opacity ">
                    <div class="product-img rounded">
                        <a href="insertProduct.php" data-abc="true" title="Insert a new product">
                        <img src="Images/InsertNewProduct.jpg" class="img-fluid rounded" alt="Insert a new product">
                           </div>
                        </a>
                    </div>
                </div>
            </div>';
        }
        ?>






        <?php require_once("footer.php"); ?>
    </div>



</body>

</html>