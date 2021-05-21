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

</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>





        <header class="text-center logo">
            <h1 style="font-size: 65px"> Insert the new Recipe </h1>
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
            $title = strtoupper($_POST['title2']) . ';' . strtolower($_POST['subtitle2']);
             
            $preparation = strtoupper($_POST['time2']).';'. $_POST['preparation2'];
            $ingredients = '';
            // print_r($_POST['ingredient']);
            //  print_r($_POST['alternative']);
            for ($i = 0; $i < count($_POST['ingredient']); $i++) {
                if ($_POST['alternative'][$i] != "") {
                    $ingredients .= '||' . $_POST['ingredient'][$i] . '@' . $_POST['quantity'][$i] . '@' . $_POST['measureUnit'][$i] . '@' . $_POST['alternative'][$i] . '@' . $_POST['quantityAlternative'][$i] . '@' . $_POST['measureUnitAlternative'][$i];
                } else {
                    $ingredients .= '||' . $_POST['ingredient'][$i] . '@' . $_POST['quantity'][$i] . '@' . $_POST['measureUnit'][$i];
                }
            }
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
                }
            }
            echo $title;
            print_r($ingredients);
            echo $preparation;
            echo $target_file;

            $stmtTitle= $dbh->getInstance()->prepare("INSERT INTO `recipes`( `Title`, `Preparation`) VALUES (:title, :preparation) ");
           
            $stmtTitle->bindParam(':title', $title);
            $stmtTitle->bindParam(':preparation', $preparation);
            $stmtTitle->execute();
            $IdNewRecipe=$dbh->getInstance()->lastInsertId();

            $stmtImage=$dbh->getInstance()->prepare("INSERT INTO `images`( `Path`) VALUES (:path)");
            $stmtImage->bindParam(':path',$target_file);
            $stmtImage->execute();
            $IdNewImage=$dbh->getInstance()->lastInsertId();


            $stmtImageRecipe=$dbh->getInstance()->prepare("INSERT INTO `recipesimages`( `IdRecipe`, `IdImage`) VALUES (:idRecipe,':idImage')");
            $stmtImageRecipe->bindParam(':idRecipe', $IdNewRecipe);
            $stmtImageRecipe->bindParam(':idImage', $IdNewImage);
            $stmtImageRecipe->execute();


            for ($i = 0; $i < count($_POST['ingredient']); $i++) {
                if($_POST['alternative'][$i]!=null){
               $stmtIngredients=$dbh->getInstance()->prepare("SELECT a.IdIngredient as aId,  a.IdMeasureUnit as aMu, b.IdIngredient as bId, b.IdMeasureUnit as bMu FROM ingredients a , ingredients b  WHERE a.Ingredient= :ingredient AND b.Ingredient=:alternative");
               $stmtIngredients->bindParam(':ingredient', $_POST['ingredient'][$i]);
               $stmtIngredients->bindParam(':alternative', $_POST['alternative'][$i]);
               $stmtIngredients->execute();
               $rowIngredients=$stmtIngredients->fetch();
                if($rowIngredients['aId']!=null && $rowIngredients['aMu']!=null && $rowIngredients['bId']!=null && $rowIngredients['bMu']!=null){
                    $stmtInsertRecipeIngrediet=$dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idRecipe,:idIngredient,:quantity)");
                    $stmtInsertRecipeIngrediet->bindParam(':idRecipe', $IdNewRecipe);
                    $stmtInsertRecipeIngrediet->bindParam(':idIngredient', $rowIngredients['aId']);
                    $stmtInsertRecipeIngrediet->bindParam(':quantity', $_POST['quantity'][$i]);
                    $stmtInsertRecipeIngrediet->execute();
                    $stmtInsertRecipeIngrediet2=$dbh->getInstance()->prepare("INSERT INTO `recipesingredients`(`IdRecipe`, `IdIngredient`, `Quantity`) VALUES (:idRecipe,:idIngredient,:quantity)");
                    $stmtInsertRecipeIngrediet2->bindParam(':idRecipe', $IdNewRecipe);
                    $stmtInsertRecipeIngrediet2->bindParam(':idIngredient', $rowIngredients['bId']);
                    $stmtInsertRecipeIngrediet2->bindParam(':quantity', $_POST['quantityAlternative'][$i]);
                    $stmtInsertRecipeIngrediet2->execute();
                }else{
                    $stmtUnit=$dbh->getInstance()->prepare("SELECT 1 FROM `measureunits` WHERE `MeasureUnit`=:mu");
                    $stmtUnit->bindParam(':mu',$_POST['measureUnit'][$i]);
                    $stmtUnit->execute();
                    $rowUnit=$stmtUnit->fetch();
                    if($rowUnit['1']==null){
                        $stmtInsertMeasure=$dbh->getInstance()->prepare() ;//inserire la nuova unità di misura
                    }
                }
            }



            }


        }
        ?>

        <form action="InsertNewRecipe.php" method="post" enctype="multipart/form-data">
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
                        <span class="navbar-font" style="font-size: 30px;"> Subtitle: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="subtitle2" maxlength="255" placeholder="Insert the subtitle" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Time: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="time2" maxlength="255" placeholder="Insert PREP | COOKING | REST | TOTAL | SERVES" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" id="preparation">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Preparation: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <textarea name="preparation2" maxlength="65535" rows="6" style="height: 100%; width:100%; border:none;" placeholder="Enter the preparation by separating each step by a ; and remember to write the number (2 digits) before each step." required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center" id="ingredient">
                <div class="col-xl-6 fluid d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Ingredient: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="ingredients" name="ingredient[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required>


                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Quantity: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="number" min="0" name="quantity[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Measure unit: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="measureunits" name="measureUnit[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 fluid d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style=" font-size: 2vw;"> Alternative: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="alternative[]" id="alternative" list="ingredients" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;">
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
            </div>




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