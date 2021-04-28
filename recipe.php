<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    ?>
    <link rel="stylesheet" href="ingredients.css">
    <!-- ROBA PER LE RECENSIONI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="jquery.rateyo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="reviews.js"></script>
    <style>
        .trashBin {
            color: lightslategrey;
        }

        .trashBin:hover {
            color: #4d0000;
        }
    </style>
</head>

<body>
    <div class="container-fluid">


        <?php
        if (isset($_GET['recipe']) && is_numeric($_GET['recipe'])) {
            $stmt = $dbh->getInstance()->prepare("SELECT IdRecipe, Title, Preparation FROM recipes WHERE recipes.IdRecipe= :idRecipe");
            $stmt->bindParam(':idRecipe', $_GET['recipe']);
            $stmt->execute();
            $row = $stmt->fetch();
            if (!isset($row) || $row['IdRecipe'] != $_GET['recipe']) {
                header('Location: blog.php');
            }

            $stmt2 = $dbh->getInstance()->prepare("SELECT images.Path from images INNER join recipesimages on recipesimages.IdImage=images.IdImage INNER join recipes on recipesimages.IdRecipe=recipes.IdRecipe WHERE recipesimages.IdRecipe=:idRecipe AND images.Path not like '%CUT%' ");
            $stmt2->bindParam(':idRecipe', $_GET['recipe']);
            $stmt2->execute();
            $row2 = $stmt2->fetch();
        } else {
            header('Location: blog.php');
        }
        require_once("callingLogin.php");
        require_once("navbar.php");
        echo '<header class="text-center logo">';
        echo '<h1 style="font-size: 65px">';
        $explode = explode(';', $row['Title']);
        $prepations = explode(';', $row['Preparation']);
        $title = $explode[0];
        $subtitle = $explode[1];
        echo $title . ' </h1>';
        echo '<h3 style="font-size: 35px">' . $subtitle . '</h3>';
        echo '</header>';
        ?>
        <div id="top"></div>
        <div class="jumbotron" style="background-image:url('<?php echo $row2['Path']; ?>')!important">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 half-image">
                    <h4 style="font-size: 25px" class="navbar-font">INGREDIENTS</h4>
                    <?php echo '<h5 style="font-size: 15px" class="navbar-font">' . $prepations[0] . '</h5>'; ?>
                    <!-- lo sfondo deve essere l'immagine della ricetta in questione -->
                    <div id="checklist" style="margin-left:10%; margin-top:10%">

                        <?php $stmt3 = $dbh->getInstance()->prepare("SELECT ingredients.IdIngredient,ingredients.Ingredient,recipesingredients.Quantity,ingredients.IdAlternative,measureunits.MeasureUnit FROM recipesingredients INNER JOIN recipes ON recipes.IdRecipe=recipesingredients.IdRecipe INNER JOIN ingredients ON ingredients.IdIngredient=recipesingredients.IdIngredient INNER JOIN measureunits ON measureunits.IdMeasureUnit=ingredients.IdMeasureUnit WHERE recipes.IdRecipe=:idRecipe");
                        $stmt3->bindParam(':idRecipe', $_GET['recipe']);
                        $stmt3->execute();
                        $id_alt = 0;
                        $listToPrint = array();

                        for ($cnt = $stmt3->rowCount(); $cnt > 0; --$cnt) {
                            $row3 = $stmt3->fetch();
                            if ($cnt == $stmt3->rowCount()) {
                                $toPrint  = $row3['Ingredient'] . ' ' . $row3['Quantity'] . $row3['MeasureUnit'];
                                $id_alt = (int) $row3['IdIngredient'];
                            } else if ($id_alt == $row3['IdAlternative']) {
                                $toPrint .= ' or ' . $row3['Ingredient'] . ' ' . $row3['Quantity'] . $row3['MeasureUnit'];
                                array_pop($listToPrint);
                                $listToPrint[] = $toPrint;
                                $toPrint = null;
                            } else {
                                $toPrint = $row3['Ingredient'] . ' ' . $row3['Quantity'] . $row3['MeasureUnit'];
                                $id_alt = (int) $row3['IdIngredient'];
                            }
                            if (isset($toPrint)) {
                                $listToPrint[] = $toPrint;
                            }
                        }
                        for ($cnt = 0; $cnt < sizeof($listToPrint); ++$cnt) {
                            echo ' <input id="' . $cnt . '" type="checkbox"  name="' . $cnt . '">';
                            echo '<label for="' . $cnt . '" class="text-justify navbar-font" style="font-size: 22px">' . $listToPrint[$cnt] . '</label>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <section style="margin-top: 35px; margin-bottom: 35px;">
            <h4 style="font-size: 35px" class="navbar-font" style="margin-bottom:15px">PREPARATION</h4>
            <!-- prepation title -->
            <?php
            for ($cnt = 1; $cnt < sizeof($prepations); ++$cnt) {
                echo ' <div class="row"  style="margin-top: 5px; margin-bottom: 5px;">';
                if (isset($prepations[$cnt])) {
                    $number = mb_substr($prepations[$cnt], 0, 4);
                    $text = mb_substr($prepations[$cnt], 4);
                    echo '  <div class="col-lg-3 col-md-12 col-xs-12">
                <div class="prepartionNumber text-center sublogo error" style="font-size: 35px;"> <!-- LA CLASSE ERROR è SOLO PER IL COLORE ROSSO -->
                    ' . $number . ' <br>
                </div>
                <div class="preparationText navbar-font text-justify" style="font-size: 20px;">
                  <!-- larghezza al 100% e testo giustificato -->
                   ' . $text . '
                </div>
            </div>';
                }
                ++$cnt;
                if (isset($prepations[$cnt])) {
                    $number = substr($prepations[$cnt], 0, 4);
                    $text = substr($prepations[$cnt], 4);
                    echo '  <div class="col-lg-3 col-md-12 col-xs-12">
                <div class="prepartionNumber text-center sublogo error" style="font-size: 35px;"> <!-- LA CLASSE ERROR è SOLO PER IL COLORE ROSSO -->
                    ' . $number . ' <br>
                </div>
                <div class="preparationText navbar-font text-justify" style="font-size: 20px;">
                  <!-- larghezza al 100% e testo giustificato -->
                   ' . $text . '
                </div>
            </div>';
                }
                ++$cnt;
                if (isset($prepations[$cnt])) {
                    $number = substr($prepations[$cnt], 0, 4);
                    $text = substr($prepations[$cnt], 4);
                    echo '  <div class="col-lg-3 col-md-12 col-xs-12">
                <div class="prepartionNumber text-center sublogo error" style="font-size: 35px;"> <!-- LA CLASSE ERROR è SOLO PER IL COLORE ROSSO -->
                    ' . $number . ' <br>
                </div>
                <div class="preparationText navbar-font text-justify" style="font-size: 20px;">
                  <!-- larghezza al 100% e testo giustificato -->
                   ' . $text . '
                </div>
            </div>';
                }
                ++$cnt;
                if (isset($prepations[$cnt])) {
                    $number = substr($prepations[$cnt], 0, 4);
                    $text = substr($prepations[$cnt], 4);
                    echo '  <div class="col-lg-3 col-md-12 col-xs-12">
                    <div class="prepartionNumber text-center sublogo error" style="font-size: 35px;"> <!-- LA CLASSE ERROR è SOLO PER IL COLORE ROSSO -->
                        ' . $number . ' <br>
                    </div>
                    <div class="preparationText navbar-font text-justify" style="font-size: 20px;" >
                        <!-- larghezza al 100% e testo giustificato -->
                       ' . $text . '
                    </div>
                </div>';
                }
                echo ' </div>';
            }
            ?>
        </section>



        <?php
        require_once("reviews.php");
        require_once("footer.php"); ?>
    </div>

</body>

</html>