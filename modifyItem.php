<!DOCTYPE html>
<html>

<head>
    <?php ob_start();
    ?>
    <?php
    require_once("header.php");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $_SESSION['modifyByAdmin'] = false;
    }
    if (!isset($_SESSION['Category']) || $_SESSION['Category'] != 'Chef') {
        header("Location: index.php");
    }

    /* if (!isset($_POST['modifyItem'])) {
        header("Location: index.php");
    } */

    ?>


    <link rel=stylesheet href="userPage.css">
    <link rel=stylesheet href="shopStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script>
        $(function() {
            $('#item-image').on('click', function() {
                $('#item-image-upload').click();
            });
        });
    </script>
</head>


<body>

    <div class="container-fluid ">

        <?php
        require_once("navbar.php");
        if (isset($_POST['modifyItem'])) {
            $_SESSION['IdProductToModify'] = $_POST['IdProductToModify'];
        }
        $stmt = $dbh->getInstance()->prepare("SELECT `IdProduct`, `Title`, `Link`, `Description`, images.Path, images.IdImage FROM `products` INNER join images on products.IdImage=images.IdImage WHERE IdProduct=:idProduct");
        $stmt->bindParam(':idProduct', $_SESSION['IdProductToModify']);
        $stmt->execute();
        $row = $stmt->fetch();
        $idProduct = $row['IdProduct'];
        $title = $row['Title'];
        $link = $row['Link'];
        $description = $row['Description'];
        $image['Path'] = $row['Path'];
        $image['IdImage'] = $row['IdImage'];


        if (isset($_POST["submit"])) {
            if (isset($_FILES["fileToUpload"]["tmp_name"])) {
                $target_dir = "Images/";
                // $target_file is the new file name including the extension
                // $_FILES["fileToUpload"] contains an entry corresponding to the file uploaded
                // by pushing the button with name fileToUpload
                // $_FILES["fileToUpload"]["name"] return the full name of the file (including the path)
                // e.g. c:/user/ccapuzzo/desktop/myrtle.jpg
                // basename($_FILES["fileToUpload"]["name"]) returns myrtle.jpg
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                // get information about the extension
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image

                // getimagesize returns false if its argument is not an image else
                // it returns an array conatining info about the image. $check["mime"] is the extension
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    //  echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    //  echo "File is not an image.";
                    $uploadOk = 0;
                }


                // Check if file already exists
                if (file_exists($target_file)) {
                    // echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000000) {
                    // echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    // echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    } else {
                        // echo "Sorry, there was an error uploading your file.";
                    }
                }

                $pdoStatement = $dbh->getDatabase()->prepare("INSERT INTO images(Path) VALUES( :photopath)");
                $pdoStatement->bindValue(":photopath", $target_file, PDO::PARAM_STR);
                $pdoStatement->execute();
                $stmtIdImg = $dbh->getDatabase()->prepare("SELECT MAX(IdImage), Path FROM `images` WHERE `Path`= :photopath");
                $stmtIdImg->bindValue(":photopath", $target_file, PDO::PARAM_STR);
                $stmtIdImg->execute();
                $rowImg = $stmtIdImg->fetch();
                $image['Path'] = $rowImg['Path'];
                $image['IdImage'] = $rowImg['MAX(IdImage)'];
            }

            $stmt2 = $dbh->getInstance()->prepare("UPDATE `products` SET `Title`=:title,`Description`=:description,`Link`=:link,`IdImage`=:idImage WHERE `IdProduct`=:idProduct");
            $stmt2->bindParam(':idProduct', $idProduct);
            if ((isset($_POST['title2']) && $_POST['title2'] != '') && ($_POST['title2'] != $row['Title'])) {
                $stmt2->bindParam(':title', $_POST['title2']);
                $title = $_POST['title2'];
            } else {
                $stmt2->bindParam(':title', $title);
            }
            if ((isset($_POST['link2']) && $_POST['link2'] != '') && ($_POST['link2'] != $row['Link'])) {
                $stmt2->bindParam(':link', $_POST['link2']);
                $link = $_POST['link'];
            } else {
                $stmt2->bindParam(':link', $link);
            }
            $stmt2->bindParam(':description', $_POST['description2']);
            $description = $_POST['description2'];


            $stmt2->bindParam(':idImage', $image['IdImage']);
            $stmt2->execute();
            header("Refresh:0");
        }


        ?>


        <header class="text-center logo">
            <h1 style="font-size: 65px"> <?php echo htmlentities($title); ?></h1>
        </header>


        <form action="modifyItem.php" method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Title: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="title2" maxlength="255" placeholder="<?php echo htmlentities($title); ?>" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>





            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Description: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <textarea name="description2" maxlength="65535" rows="6" style="height: 100%; width:100%; border:none;"><?php echo htmlentities($description); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Link: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="link2" maxlength="255" placeholder="<?php echo htmlentities($link); ?>" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>


            <div class="row d-flex justify-content-center">

                <div class=" col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-45 d-flex justify-content-center">

                    <div class="product-wrapper box rounded text-center rss opacity">
                        <div class="product-img rounded">
                            <a href="product.php?item='.$row['IdProduct'].'" data-abc="true">
                                <img src="<?php echo $image['Path']; ?>" class="img-fluid rounded" alt="<?php echo $title; ?>">
                            </a>

                            <div class="product-action">
                                <div class="product-action-style">
                                    <input id="item-image-upload" name="fileToUpload" id="fileToUpload" class="hidden nav-font" type="file">
                                    <div id="item-image" clas="nav-font" style="text-decoration: none;">Click here to change product image</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex ">
                <div class="col-6  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <input type="submit" class="btn btn-block mybtn btn-secondary logo" name="submit" value="UPDATE">
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