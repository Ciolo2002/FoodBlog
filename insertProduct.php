<!DOCTYPE html>
<html lang="en">>

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



</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>




        <header class="text-center logo">
            <h1 style="font-size: 65px"> Insert here the new product </h1>
        </header>


        <form action="modifyItem.php" method="post" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Title: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="title2" maxlength="255" placeholder="Insert the title" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                </div>
            </div>





            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Description: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <textarea name="description2" maxlength="65535" rows="6" style="height: 100%; width:100%; border:none;" placeholder="Insert the description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Link: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="link2" maxlength="255" placeholder="Insert the link" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Image: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="hidden nav-font" required>
                        </div>
                    </div>
                </div>
            </div>


           

            <div class="row d-flex ">
                <div class="col-6  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <input type="submit" class="btn btn-block mybtn btn-secondary logo" name="submit" value="INSERT">
                    </div>
                </div>
                <div class="col-6  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <input type="reset" class="btn btn-block mybtn btn-secondary logo" name="reset" value="RESET">
                    </div>
                </div>
            </div>

        </form>

        <div class="row d-flex justify-content-center ">
            <div class="col-12  d-flex justify-content-center ">
                <div class="myform form" style="border: none;">
                    <?php
                    $url = '#';
                    $action = '';
                    if ($_SESSION['Category'] != "User") {
                        switch ($_SESSION['Category']) {
                            case "Chef":
                                $url = "chefPageRecipes.php";
                                $action = "MANAGE RECIPES";
                                echo  '<a href="chefPageProducts.php" class="button btn btn-block mybtn btn-secondary logo">MANAGE PRODUCTS</a>';
                                break;
                            case "Administrator":
                                $url = 'adminPage.php';
                                $action = "MANAGE USERS";
                                break;
                        }
                        echo  '<a href="' . $url . '" class="button btn btn-block mybtn btn-secondary logo">' . $action . '</a>';
                    }

                    ?>

                </div>
            </div>
        </div>
        <form action="deliteItem.php" method="post">
            <input type="hidden" name="idToDelite" value="<?php echo $idProduct; ?>" />
            <div class="row d-flex ">
                <div class="col-12  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <a href="#myModal" class="button trigger-btn btn btn-block mybtn mybtnImportant btn-danger logo" data-toggle="modal">DELETE THIS PRODUCT</a>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <div class="icon-box">
                                <i class="material-icons">&#xE5CD;</i>
                            </div>
                            <h4 class="modal-title w-100 sublogo">Are you sure?</h4>
                        </div>
                        <div class="modal-body navbar-font">
                            <p>Do you really want to delete <?php echo $title; ?> ? This process cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary logo" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submitDeliteItem" class="btn btn-danger logo">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>








    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>