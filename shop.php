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

        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper text-center">
                    <div class="product-img rounded">
                        <a href="#" data-abc="true">
                            <img src="https://i.imgur.com/tL7ZE46.jpg" class="rounded" alt="">
                        </a>
                        
                        <div class="product-action">
                            <div class="product-action-style">
                                <a href="#" class="nav-font">QUICK VIEW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper  text-center">
                    <div class="product-img rounded">
                        <a href="#" data-abc="true">
                            <img src="https://i.imgur.com/lAQxXCK.jpg" class="rounded" alt="">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper  text-center">
                    <div class="product-img rounded">
                        <a href="#" data-abc="true">
                            <img src="https://i.imgur.com/HxEEu5g.jpg" class="rounded" alt="">
                        </a>

                        <div class="product-action">
                            <div class="product-action-style">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>









        <?php require_once("footer.php"); ?>
    </div>



</body>

</html>