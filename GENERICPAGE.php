<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("header.php");
    if(isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin'])==true){
        $_SESSION['modifyByAdmin']=false;
    }
    ?>



</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>

      


        
    <div class="row">
    
    
    
    </div>







    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>