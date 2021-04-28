<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("header.php");
    ?>
    <link rel="stylesheet" href="blog.css">
</head>

<body>
    <div class="container-fluid ">
       
        <?php
        require_once("callingLogin.php"); 
        require_once("navbar.php"); ?>
        <header class="text-center logo">
            <h1 style="font-size: 65px"> The Taistiest Recipes</h1>
        </header>
        <div id="top"></div>
        <?php
        $stmt = $dbh->getInstance()->prepare("SELECT Recipes.IdRecipe, Images.IdImage, Recipes.Title, Images.Path FROM RecipesImages INNER JOIN Recipes on Recipes.IdRecipe=RecipesImages.IdRecipe INNER JOIN Images ON Images.IdImage=RecipesImages.IdImage WHERE Images.Path LIKE '%CUT%'");
        $stmt->execute();
        $titles = array();
        $paths = array();
        for ($cnt = $stmt->rowCount(); $cnt > 0; --$cnt) {  //questo ciclo farà in modo di stampare a video le immagini di ogni ricetta con all'ineterno il titolo della ricetta. 
            $row = $stmt->fetch();
            //echo $row['Title'].' ';
            $explode = explode(';', $row['Title']);
            $titles[] = $explode[0];
            $subtitles[] = $explode[1];
            $idRecipes[]=$row['IdRecipe'];
            $paths[] = $row['Path'];
        }

        for ($i = 0; $i < sizeof($titles); ++$i ) {
            echo '<div class="row">';
            echo '<div class="col-lg-6 mb-3 mb-lg-0" style="margin-top: 12px !important; margin-bottom: 12px !important ">
                    <a href="recipe.php?recipe='.$idRecipes[$i].'">
                        <div class="hover hover-1 text-white box rounded"><img src="' . $paths[$i] . '" alt="' . $titles[$i] . '">
                            <div class="hover-overlay"></div>
                                <div class="hover-1-content px-5 py-4">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold mb-0"> <span class="sublogo" style="font-size: 30px"><b>' . $titles[$i] . '</b> </span></h3>
                                    <p class="hover-1-description sublogo mb-0" style="font-size: 18px">' . $subtitles[$i] . '</p>
                            </div>
                        </div>
                    </a>
                </div>';
            ++$i;
            if(isset($paths[$i])){
            echo '<div class="col-lg-6" style="margin-top: 12px !important; margin-bottom: 12px !important">
                   <a href="recipe.php?recipe='.$idRecipes[$i].'">
                    <div class="hover hover-1 text-white box rounded"><img src="' . $paths[$i] . '" alt="' . $titles[$i] . '">
                        <div class="hover-overlay"></div>
                            <div class="hover-1-content px-5 py-4">
                                <h3 class="hover-1-title text-uppercase font-weight-bold mb-0"> <span class="sublogo" style="font-size: 30px"><b>' . $titles[$i] . '</b> </span></h3>
                                <p class="hover-1-description sublogo mb-0" style="font-size: 18px">' . $subtitles[$i] . '</p>
                            </div>
                        </div>
                    </a>
                 </div>';
            echo '</div>'; //row
            }
        }
        ?>
    </div> <!-- contriner -->
    <?php require_once("footer.php"); ?>
</html>