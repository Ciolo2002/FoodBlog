<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    ?>

    <link rel="stylesheet" href="shopStyle.css">

</head>

<body>

    <div class="container-fluid ">
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
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper text-center">
                    <div class="product-img rounded">
                        <a href="' . $row['Link'] . '" data-abc="true">';
                echo '<img src="' . $row['Path'] . '" class="rounded" alt="' . $row['Title'] . '">
                        </a>
                        
                        <div class="product-action">
                            <div class="product-action-style">
                                <a href="#" class="nav-font">QUICK VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';



                --$cnt;
                $row = $stmt->fetch();
            }


            if (isset($row['IdProduct'])) {
                echo '   <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper  text-center">
                    <div class="product-img rounded">
                        <a href="' . $row['Link'] . '" data-abc="true">
                            <img src="' . $row['Path'] . '" class="rounded" alt="' . $row['Title'] . '">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            <a href="#" class="nav-font">QUICK VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                --$cnt;
                $row = $stmt->fetch();
            }
            if (isset($row['IdProduct'])) {
                echo '   <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper  text-center">
                    <div class="product-img rounded">
                        <a href="' . $row['Link'] . '" data-abc="true">
                            <img src="' . $row['Path'] . '" class="rounded" alt="' . $row['Title'] . '">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            <a href="#" class="nav-font">QUICK VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>';
                --$cnt;
                $row = $stmt->fetch();
            }
        }
        ?>






        <?php require_once("footer.php"); ?>
    </div>



</body>

</html>