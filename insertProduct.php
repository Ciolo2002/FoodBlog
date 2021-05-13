<!DOCTYPE html>
<html lang="en">

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
    ?>



</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php");




        if (isset($_POST["submit"])) {
            $image['IdImage'] = null;
            if (is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
                $target_dir = "Images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }



                    $pdoStatement = $dbh->getInstance()->prepare("INSERT INTO images(Path) VALUES( :photopath)");
                    $pdoStatement->bindValue(":photopath", $target_file, PDO::PARAM_STR);
                    $pdoStatement->execute();
                    $stmtIdImg = $dbh->getInstance()->prepare("SELECT MAX(IdImage), Path FROM `images` WHERE `Path`= :photopath");
                    $stmtIdImg->bindValue(":photopath", $target_file, PDO::PARAM_STR);
                    $stmtIdImg->execute();
                    $rowImg = $stmtIdImg->fetch();
                    $image['Path'] = $rowImg['Path'];
                    $image['IdImage'] = $rowImg['MAX(IdImage)'];
                }
            }
            $stmt2 = $dbh->getInstance()->prepare("INSERT INTO `products`( `Title`, `Link`, `Description`, `IdImage`) VALUES (:title, :link ,:description, :idImage )");
            $stmt2->bindParam(':title', $_POST['title2']);
            $stmt2->bindParam(':link', $_POST['link2']);
            $stmt2->bindParam(':description', $_POST['description2']);
            $stmt2->bindParam(':idImage', $image['IdImage']);
            $stmt2->execute();
            header("Refresh:0");
        }

        ?>




        <header class="text-center logo">
            <h1 style="font-size: 65px"> Insert the new product </h1>
        </header>


        <form action="insertProduct.php" method="post" enctype="multipart/form-data">
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





    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>