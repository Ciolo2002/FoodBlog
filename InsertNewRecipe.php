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
        while($row=$stmt->fetch()){
            echo '<option value="'.$row['Ingredient'].'">';
        }
        echo '</datalist>';

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
                            <input type="text" name="time2" maxlength="255" placeholder="Insert the PREP | COOKING | REST | TOTAL | SERVES" style="height: 100%; width:100%; border:none;" required>
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
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Ingredient: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" list="ingredients" name="ingredient[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required>
                            

                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Quantity: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="quantity[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Measure unit: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="measureUnit[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Alternative: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="alternative[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> A. quantity: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="measureUnit[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> A. m. unit: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="measureUnit[]" maxlength="255" placeholder="Insert an ingredient" style="height: 100%; width:100%; border:none;">
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