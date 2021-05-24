<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("header.php");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $_SESSION['modifyByAdmin'] = false;
    }
    if (!isset($_SESSION['Category']) || $_SESSION['Category'] != 'Chef') {
        header("Location: index.php");
    }
    if (!isset($_POST['modifyItem']) && isset($_SESSION['IdRecipeToModify'])) { //PROBELMI QUI E NELLA MODIFICA DEGLI INGREDIENTI
        header("Location: index.php");
    } else {
        if(isset($_POST['IdRecipeToModify'])){
            $_SESSION['IdRecipeToModify']=$_POST['IdRecipeToModify'];
        }
        
       
        $stmtRecipeToModify = $dbh->getInstance()->prepare("SELECT * FROM `recipes` INNER JOIN recipesimages on recipesimages.IdRecipe=recipes.IdRecipe INNER JOIN images on images.IdImage=recipesimages.IdImage INNER JOIN recipesingredients on recipesingredients.IdRecipe=recipes.IdRecipe INNER JOIN ingredients on ingredients.IdIngredient=recipesingredients.IdIngredient INNER JOIN measureunits on measureunits.IdMeasureUnit=ingredients.IdMeasureUnit WHERE recipes.IdRecipe=:idRecipe");
        $stmtRecipeToModify->bindParam(':idRecipe', $_SESSION['IdRecipeToModify']);
        $stmtRecipeToModify->execute();
        $rowRecipeToModify = $stmtRecipeToModify->fetch();
        $explode = explode(';', $rowRecipeToModify['Title'], 2);
        $title = $explode[0];
        $subtitle = $explode[1];
        $prepation = explode(';', $rowRecipeToModify['Preparation'], 2);
    }
    ?>

    <script>
        $(document).ready(function() {
            $("#addIngredient").click(function() {
                $("#ingredient").clone().insertAfter("#preparation");
            });
            var myInput = document.getElementById("alternative");
            if (myInput && myInput.value) {
                $('#measureUnitAlternative').attr('required', true);
                $('#quantityAlternative').attr('required', true);
            }
        });
    </script>

    <link rel=stylesheet href="userPage.css">
    <link rel=stylesheet href="shopStyle.css">
    <link rel=stylesheet href="blog.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>





        <header class="text-center logo">
            <h1 style="font-size: 65px"><?php echo $title ?></h1>
        </header>
        <?php
        $stmt = $dbh->getInstance()->prepare("SELECT * FROM `ingredients` WHERE 1");
        $stmt->execute();
        $row;
        echo '<datalist id="ingredients">';
        while ($row = $stmt->fetch()) {
            echo '<option value="' . $row['Ingredient'] . '">';
        }
        echo '</datalist>';
        $stmt2 = $dbh->getInstance()->prepare("SELECT * FROM `measureunits` WHERE 1");
        $stmt2->execute();
        $row2;
        echo '<datalist id="measureunits">';
        while ($row2 = $stmt2->fetch()) {
            echo '<option value="' . $row2['MeasureUnit'] . '">';
        }
        echo '</datalist>';





        if (isset($_POST['submit'])) {
            $title = htmlspecialchars(strtoupper($_POST['title2']) . ';' . strtolower($_POST['subtitle2']));

            $preparation = htmlspecialchars(strtoupper($_POST['time2']) . '; ' . $_POST['preparation2']);
            $target_file;
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
                if ($_FILES["fileToUpload"]["size"] > 50000000) {
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
                }
            }


            $stmtTitle = $dbh->getInstance()->prepare("UPDATE `recipes` SET `Title`=:title,`Preparation`=:preparation WHERE `IdRecipe`=:idrecipe");

            $stmtTitle->bindParam(':title', htmlspecialchars($title));
            $stmtTitle->bindParam(':idrecipe', htmlspecialchars($_SESSION['IdRecipeToModify']));
            $stmtTitle->bindParam(':preparation', htmlspecialchars($preparation));
            $stmtTitle->execute();
            $IdNewRecipe = $dbh->getInstance()->lastInsertId();

            $stmtImage = $dbh->getInstance()->prepare("INSERT INTO `images`( `Path`) VALUES (:path)");
            $stmtImage->bindParam(':path', $target_file);
            $stmtImage->execute();
            $IdNewImage = $dbh->getInstance()->lastInsertId();


            $stmtImageRecipe = $dbh->getInstance()->prepare("UPDATE `recipesimages` SET `IdImage`=:idImage WHERE `IdRecipe`=:idRecipe");
            $stmtImageRecipe->bindParam(':idRecipe',htmlspecialchars($_SESSION['IdRecipeToModify'])); //////////////////////////
            $stmtImageRecipe->bindParam(':idImage',  htmlspecialchars($IdNewImage));
            $stmtImageRecipe->execute();
            
            $stmtDelitreRecipesIngredients = $dbh->getInstance()->prepare("DELETE FROM `recipesingredients` WHERE `IdRecipe`=:idRecipe");
            $stmtDelitreRecipesIngredients->bindParam(':idRecipe',htmlspecialchars($_SESSION['IdRecipeToModify'])); //////////////////////////
         
            $stmtDelitreRecipesIngredients->execute();


            for ($i = 0; $i < count($_POST['ingredient']); $i++) {
                if ($_POST['alternative'][$i] != null) {
                    $stmtIngredients = $dbh->getInstance()->prepare("SELECT a.IdIngredient as aId,  a.IdMeasureUnit as aMu, b.IdIngredient as bId, b.IdMeasureUnit as bMu FROM ingredients a , ingredients b  WHERE a.Ingredient= :ingredient AND b.Ingredient=:alternative");
                    $stmtIngredients->bindParam(':ingredient', htmlspecialchars($_POST['ingredient'][$i]));
                    $stmtIngredients->bindParam(':alternative', htmlspecialchars($_POST['alternative'][$i]));
                    $stmtIngredients->execute();
                    $rowIngredients = $stmtIngredients->fetch();
                    if (isset($rowIngredients['aId']) && $rowIngredients['aId'] != null &&  isset($rowIngredients['aMu']) && $rowIngredients['aMu'] != null && isset($rowIngredients['bId']) && $rowIngredients['bId'] != null &&  isset($rowIngredients['bMu']) && $rowIngredients['bMu'] != null) {
                        $stmtInsertRecipeIngrediet = $dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idRecipe,:idIngredient,:quantity)");
                        $stmtInsertRecipeIngrediet->bindParam(':idRecipe',$_SESSION['IdRecipeToModify']);
                        $stmtInsertRecipeIngrediet->bindParam(':idIngredient', htmlspecialchars($rowIngredients['aId']));
                        $stmtInsertRecipeIngrediet->bindParam(':quantity', htmlspecialchars($_POST['quantity'][$i]));
                        $stmtInsertRecipeIngrediet->execute();
                        $stmtInsertRecipeIngrediet2 = $dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idRecipe,:idIngredient,:quantity)");
                        $stmtInsertRecipeIngrediet2->bindParam(':idRecipe',$_SESSION['IdRecipeToModify']);
                        $stmtInsertRecipeIngrediet2->bindParam(':idIngredient', htmlspecialchars($rowIngredients['bId']));
                        $stmtInsertRecipeIngrediet2->bindParam(':quantity', htmlspecialchars($_POST['quantityAlternative'][$i]));
                        $stmtInsertRecipeIngrediet2->execute();
                    } else {
                        $stmtUnit = $dbh->getInstance()->prepare("SELECT IdMeasureUnit FROM `measureunits` WHERE `MeasureUnit`=:mu");
                        $stmtUnit->bindParam(':mu', htmlspecialchars($_POST['measureUnit'][$i]));
                        $stmtUnit->execute();
                        $rowUnit = $stmtUnit->fetch();
                        $stmtUnitAlt = $dbh->getInstance()->prepare("SELECT IdMeasureUnit FROM `measureunits` WHERE `MeasureUnit`=:mu");
                        $stmtUnitAlt->bindParam(':mu', htmlspecialchars($_POST['measureUnitAlternative'][$i]));
                        $stmtUnitAlt->execute();
                        $rowUnitAlt = $stmtUnitAlt->fetch();
                        if ($rowUnit['IdMeasureUnit'] == null || !isset($rowUnit['IdMeasureUnit']) || $rowUnit['IdMeasureUnit'] == 0) {
                            $stmtInsertMeasure = $dbh->getInstance()->prepare("INSERT INTO `measureunits`(`MeasureUnit`) VALUES (:mu)"); //inserire la nuova unità di misura
                            $stmtInsertMeasure->bindParam(':mu', htmlspecialchars($_POST['measureUnit'][$i]));
                            $stmtInsertMeasure->execute();
                            $rowUnit['IdMeasureUnit'] = $dbh->getInstance()->lastInsertId();
                        }
                        if ($rowUnitAlt['IdMeasureUnit'] == null || !isset($rowUnitAlt['IdMeasureUnit']) || $rowUnitAlt['IdMeasureUnit'] == 0) {
                            $stmtInsertMeasureA = $dbh->getInstance()->prepare("INSERT INTO `measureunits`(`MeasureUnit`) VALUES (:mu)"); //inserire la nuova unità di misura
                            $stmtInsertMeasureA->bindParam(':mu', htmlspecialchars($_POST['measureUnitAlternative'][$i]));
                            $stmtInsertMeasureA->execute();
                            $rowUnitAlt['IdMeasureUnit'] = $dbh->getInstance()->lastInsertId();
                        }
                        $stmtInsertIngrediet = $dbh->getInstance()->prepare("INSERT INTO `ingredients`( `Ingredient`, `IdMeasureUnit`, `IdAlternative`) VALUES (:ingredient,:mu,null)");
                        $stmtInsertIngrediet->bindParam(':mu', htmlspecialchars($rowUnit['IdMeasureUnit']));
                        $stmtInsertIngrediet->bindParam('ingredient', htmlspecialchars($_POST['ingredient'][$i]));
                        $stmtInsertIngrediet->execute();
                        $idNewIngredient = $dbh->getInstance()->lastInsertId();
                        $stmtInsertAlternative = $dbh->getInstance()->prepare("INSERT INTO `ingredients`( `Ingredient`, `IdMeasureUnit`, `IdAlternative`) VALUES (:ingredient,:mu,null)");
                        $stmtInsertAlternative->bindParam(':mu', htmlspecialchars($rowUnitAlt['IdMeasureUnit']));
                        $stmtInsertAlternative->bindParam('ingredient', htmlspecialchars($_POST['alternative'][$i]));
                        $stmtInsertAlternative->execute();
                        $idNewAlternative = $dbh->getInstance()->lastInsertId();
                        $stmtModifyIngredient = $dbh->getInstance()->prepare("UPDATE `ingredients` SET`IdAlternative`=:idAlt WHERE `IdIngredient`=:idIng");
                        $stmtModifyIngredient->bindParam(':idAlt', htmlspecialchars($idNewAlternative));
                        $stmtModifyIngredient->bindParam(':idIng',  htmlspecialchars($idNewIngredient));
                        $stmtModifyIngredient->execute();
                        $stmtModifyAlternative = $dbh->getInstance()->prepare("UPDATE `ingredients` SET`IdAlternative`=:idAlt WHERE `IdIngredient`=:idIng");
                        $stmtModifyAlternative->bindParam(':idAlt',  htmlspecialchars($idNewIngredient));
                        $stmtModifyAlternative->bindParam(':idIng', htmlspecialchars($idNewAlternative));
                        $stmtModifyAlternative->execute();
                        $stmtInserIngredientRecipe = $dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idrecipe,:idngredient,:quantity)");
                        $stmtInserIngredientRecipe->bindParam(':idrecipe',$_SESSION['IdRecipeToModify']);
                        $stmtInserIngredientRecipe->bindParam(':idngredient', htmlspecialchars($idNewIngredient));
                        $stmtInserIngredientRecipe->bindParam(':quantity',  htmlspecialchars($_POST['quantity'][$i]));
                        $stmtInserIngredientRecipe->execute();
                        $stmtInserAlternativeRecipe = $dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idrecipe,:idngredient,:quantity)");
                        $stmtInserAlternativeRecipe->bindParam(':idrecipe', $_SESSION['IdRecipeToModify']);
                        $stmtInserAlternativeRecipe->bindParam(':idngredient', htmlspecialchars($idNewAlternative));
                        $stmtInserAlternativeRecipe->bindParam(':quantity', htmlspecialchars($_POST['quantityAlternative'][$i]));
                        $stmtInserAlternativeRecipe->execute();
                    }
                } else {
                    $stmtSearchIngredient = $dbh->getInstance()->prepare("SELECT `IdIngredient`, `Ingredient`, `IdMeasureUnit`, `IdAlternative` FROM `ingredients` WHERE `Ingredient`=:ingredient AND `IdAlternative`IS NULL");
                    $stmtSearchIngredient->bindParam(':ingredient', htmlspecialchars($_POST['ingredient'][$i]));
                    $stmtSearchIngredient->execute();
                    $row = $stmtSearchIngredient->fetch();
                    if (isset($row['IdIngredient']) && $row['IdIngredient'] != null) {
                        $stmtInsertRecipeIngrediet = $dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idRecipe,:idIngredient,:quantity)");
                        $stmtInsertRecipeIngrediet->bindParam(':idRecipe',$_SESSION['IdRecipeToModify']);
                        $stmtInsertRecipeIngrediet->bindParam(':idIngredient', htmlspecialchars($row['IdIngredient']));
                        $stmtInsertRecipeIngrediet->bindParam(':quantity', htmlspecialchars($_POST['quantity'][$i]));
                        $stmtInsertRecipeIngrediet->execute();
                    } else {
                        $stmtUnit = $dbh->getInstance()->prepare("SELECT IdMeasureUnit FROM `measureunits` WHERE `MeasureUnit`=:mu");
                        $stmtUnit->bindParam(':mu', htmlspecialchars($_POST['measureUnit'][$i]));
                        $stmtUnit->execute();
                        $rowUnit = $stmtUnit->fetch();
                        if ($rowUnit['IdMeasureUnit'] == null || !isset($rowUnit['IdMeasureUnit']) || $rowUnit['IdMeasureUnit'] == 0) {
                            $stmtInsertMeasure = $dbh->getInstance()->prepare("INSERT INTO `measureunits`(`MeasureUnit`) VALUES (:mu)"); //inserire la nuova unità di misura
                            $stmtInsertMeasure->bindParam(':mu', htmlspecialchars($_POST['measureUnit'][$i]));
                            $stmtInsertMeasure->execute();
                            $rowUnit = $dbh->getInstance()->lastInsertId();
                        }
                        $stmtInsertIngrediet = $dbh->getInstance()->prepare("INSERT INTO `ingredients`( `Ingredient`, `IdMeasureUnit`, `IdAlternative`) VALUES (:ingredient,:mu,null)");
                        $stmtInsertIngrediet->bindParam(':mu', htmlspecialchars($rowUnit['IdMeasureUnit']));
                        $stmtInsertIngrediet->bindParam('ingredient', htmlspecialchars($_POST['ingredient'][$i]));
                        $stmtInsertIngrediet->execute();
                        $idNewIngredient = $dbh->getInstance()->lastInsertId();
                        $stmtInserIngredientRecipe = $dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idrecipe,:idngredient,:quantity)");
                        $stmtInserIngredientRecipe->bindParam(':idrecipe',$_SESSION['IdRecipeToModify']);
                        $stmtInserIngredientRecipe->bindParam(':idngredient', htmlspecialchars($idNewIngredient));
                        $stmtInserIngredientRecipe->bindParam(':quantity',  htmlspecialchars($_POST['quantity'][$i]));
                        $stmtInserIngredientRecipe->execute();
                    }
                }
            }
        }
        ?>

        <form action="modifyRecipe.php" method="post" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Title: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="title2" maxlength="255" placeholder="Insert the title" style="height: 100%; width:100%; border:none;" required value="<?php echo $title ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Subtitle: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="subtitle2" maxlength="255" placeholder="Insert the subtitle" style="height: 100%; width:100%; border:none;" required value="<?php echo $subtitle ?>">
                        </div>
                    </div>
                </div>
            </div>


            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Time: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="time2" maxlength="255" placeholder="Insert PREP | COOKING | REST | TOTAL | SERVES" style="height: 100%; width:100%; border:none;" required value="<?php echo $prepation[0] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" id="preparation">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Preparation: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <textarea name="preparation2" maxlength="65535" rows="6" style="height: 100%; width:100%; border:none;" placeholder="Enter the preparation by separating each step by a ; and remember to write the number (2 digits) before each step." required><?php echo $prepation[1] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <?php while ($rowRecipeToModify = $stmtRecipeToModify->fetch()) {
                echo ' <div class="row d-flex justify-content-center" id="ingredient">
                <div class="col-xl-6 fluid d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Ingredient: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="ingredients" name="ingredient[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required value="' . $rowRecipeToModify['Ingredient'] . '">


                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Quantity: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="number" min="0" name="quantity[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required value="' . $rowRecipeToModify['Quantity'] . '">
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Measure unit: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="measureunits" name="measureUnit[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required value="' . $rowRecipeToModify['MeasureUnit'] . '">
                        </div>
                    </div>
                </div>';
                if (isset($rowRecipeToModify['IdAlternative']) && $rowRecipeToModify['IdAlternative'] != null) {
                    $rowRecipeToModify = $stmtRecipeToModify->fetch();
                    echo '  <div class="col-xl-6 fluid d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Alternative: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="alternative[]" id="alternative" list="ingredients" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" value="' . $rowRecipeToModify['Ingredient'] . '">
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> A. quantity: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="number" min="0" name="quantityAlternative[]" id="quantityAlternative" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" value="' . $rowRecipeToModify['Quantity'] . '">
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> A. m. unit: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="measureunits" name="measureUnitAlternative[]" id="measureUnitAlternative" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;"  value="' . $rowRecipeToModify['MeasureUnit'] . '">
                        </div>
                    </div>
                </div>
            </div>';
                } else {
                    echo '  <div class="col-xl-6 fluid d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Alternative: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="alternative[]" id="alternative" list="ingredients" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" >
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> A. quantity: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="number" min="0" name="quantityAlternative[]" id="quantityAlternative" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> A. m. unit: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="measureunits" name="measureUnitAlternative[]" id="measureUnitAlternative" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>';
                }
            } ?>


            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Add an ingredient: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <button id="addIngredient" style="height: 100%; width:100%; border:none;" required>NEW INGREDIENT</button>
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
                    <form action="deliteRecipe.php" method="post">
                        <input type="hidden" name="idToDelite" value="<?php echo  $_SESSION['IdRecipeToModify']; ?>" />
                        <div class="row d-flex ">
                            <div class="col-12  d-flex justify-content-center ">
                                <div class="myform form" style="border: none;">
                                    <a href="#myModal" class="button trigger-btn btn btn-block mybtn mybtnImportant btn-danger logo" data-toggle="modal">DELETE THIS RECIPE</a>
                                </div>
                            </div>
                        </div>
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog modal-confirm rounded" style="background-color:white">
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
                                        <button type="submit" name="deliteRecipe" class="btn btn-danger logo">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="IdRecipeToModify" value="<?php echo $_POST['IdRecipeToModify']?>">
                    </form>





                </div>
            </div>
        </div>
    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>