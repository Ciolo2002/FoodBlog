<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("header.php");
    if ((isset($_SESSION['ErrorLogin']) && $_SESSION['ErrorLogin'] == false)  || !isset($_SESSION['Name'])) {
        echo '<script src="scriptOpenLogin.js"></script>';
    } 
    if(isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin'])==true){
        $_SESSION['modifyByAdmin']=false;
    }?>

</head>

<body>
    <div class="container-fluid">
        <?php
        if (isset($_GET['page']) && $_GET['page'] == "registerForm") {
            require('registerForm.php');
        } else if (isset($_GET['page']) && $_GET['page'] == "loginForm") {
            require('loginForm.php');
        } else {
            require('loginForm.php');
        }
        ?>
        <?php require_once("navbar.php"); ?>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 half-image" style="background: rgba(255, 255, 255, 0.3)">
                    <div class="d-flex align-items-center justify-content-center" style=" margin: 25%;">
                        <h1 class="logo main">Burnt Leeks<br>& Raw Beets</h1> <!-- lo stile di questo h1 non funziona se usato dentro style.css-->
                    </div>
                </div>
            </div>
        </div>

        <?php require_once("footer.php"); ?>
    </div>
</body>

</html>