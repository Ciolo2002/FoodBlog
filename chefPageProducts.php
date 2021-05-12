<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $_SESSION['modifyByAdmin'] = false;
    }
    if (!isset($_SESSION['Category']) || $_SESSION['Category'] != 'Chef') {
        header("Location: index.php");
    }
    ?>

    <link rel="stylesheet" href="shopStyle.css">

</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>

        <header class="text-center logo">
            <h1 style="font-size: 65px">Here are your products</h1>
        </header>
        <?php
        $stmt = $dbh->getInstance()->prepare("SELECT `IdProduct`,`Title`,`Link`,`Description`,images.Path FROM `products` INNER JOIN images on images.IdImage=products.IdImage WHERE 1");
        $stmt->execute();

        for ($cnt = $stmt->rowCount(); $cnt > 0; --$cnt) {
            echo '  <div class="row">';
            for ($cnt2 = 0; $cnt2 < 4; $cnt2++) {
                $row = $stmt->fetch();
                if (isset($row['IdProduct'])) {

                    echo ' <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                         <div class="product-wrapper box rounded text-center rss opacity ">
                             <div class="product-img rounded">
                                 <a href="product.php?item=' . $row['IdProduct'] . '" data-abc="true" >';
                    echo '<img src="' . $row['Path'] . '" class="img-fluid rounded" alt="' . $row['Title'] . '">
                                 </a>
                                 
                                 <div class="product-action">
                                     <div class="product-action-style">
                                          <div class="float-child"><form action="modifyItem.php" method="POST">
                                         <input type="hidden" name="IdProductToModify" value="' . $row['IdProduct'] . '">
                                         <button type="submit" class="btn btn-link" name="modifyItem"><i class="fas fa-cog  fa-lg trashBin"></i></button>
                                         </form></div>
                                         <div class="float-child"><form action="deliteItem.php" method="POST"><input type="hidden" name="idToDelite" value="' . $row['IdProduct'], '"><button type="submit" name="adminSubmit"  class="btn btn-link"><i class="fas fa-trash-alt fa-lg trashBin"></i></button></form></div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>';
                }
            }
            echo '</div>';
        }
        ?>



        <div class="row">
            <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45">
                <div class="product-wrapper box rounded text-center rss opacity ">
                    <div class="product-img rounded">
                        <a href="insertProduct.php" data-abc="true">
                        <img src="Images/InsertNewProduct.jpg" class="img-fluid rounded" alt="Insert a new product">
                           </div>
                        </a>
                        
                    </div>
                </div>
            </div>



        </div>







    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>