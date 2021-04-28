<!DOCTYPE html>
<html>

<head>
<?php ob_start(); //non so cosa sia ma mi risolve un bug legato a header(refresh:0) ?>
    <?php
    require_once("header.php");
    ?>


    <script src="registerPassowrdControl.js"> </script>
    <link rel=stylesheet href="userPage.css">
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>
    <?php
    if (!isset($_SESSION['Category'])) {
        header("Location: index.php");
        ;
        ;


        
    }
    ?>

    <div class="container-fluid ">

        <?php
        require_once("navbar.php");
        $stmt = $dbh->getInstance()->prepare("SELECT `IdUser`, `Name`, `Surname`, `Email`, `Password`, `Newsletter` FROM `users` WHERE `IdUser`=:IdUser");
        $stmt->bindParam(':IdUser', $_SESSION['IdUser']);
        $stmt->execute();
        $row = $stmt->fetch();
        $name=$row['Name'];
        $surname=$row['Surname'];
        $email=$row['Email'];
        $newsleter=$row['Newsletter'];
        ?><?php
        if (isset($_POST['submit'])) {
            
            $stmt2 = $dbh->getInstance()->prepare("UPDATE `users` SET `Name`=:name,`Surname`=:surname,`Email`=:email,`Password`=:password,`Newsletter`=:newsleter WHERE `IdUser`=:IdUser");
            $stmt2->bindParam(':IdUser', $_SESSION['IdUser']);
            if ((isset($_POST['name2']) && $_POST['name2'] != '') &&( $_POST['name2'] != $row['Name'])) {
                $stmt2->bindParam(':name', $_POST['name2']);
                $_SESSION['Name'] = htmlentities($_POST['name2']);
                $name=$_POST['name2'];
            } else {
                $stmt2->bindParam(':name', $row['Name']);
            }
            if (isset($_POST['surname2'])  && $_POST['surname2'] != '' && $_POST['surname2'] != $row['Surname']) {
                $stmt2->bindParam(':surname', $_POST['surname2']);
                $name=$_POST['surname2'];
            } else {
                $stmt2->bindParam(':surname', $row['Surname']);
            }
            if (isset($_POST['email2'])  && $_POST['email2'] != '' && $_POST['email2'] != $row['Email']) {
                $stmt2->bindParam(':email', $_POST['email2']);
                $name=$_POST['email2'];
            } else {
                $stmt2->bindParam(':email', $row['Email']);
            }


            
            if (!isset($_POST['newsletter2'])) {
                $row['Newsletter'] = 0;
            } else if ($_POST['newsletter2'] == true) {
                $row['Newsletter']  = 1;
            }



            $stmt2->bindParam(':newsleter', $newsleter);
            if (isset($_POST['password2']) && $_POST['password2'] != '' && !password_verify($_POST['password2'], $row['Password'])) {
                $password = password_hash($_POST['password2'], PASSWORD_DEFAULT);
                $stmt2->bindParam(':password', $password);
            } else {
                $stmt2->bindParam(':password', $row['Password']);
            }
            $stmt2->execute();
            header("Refresh:0");
        }
        ?>

        <header class="text-center logo">
            <h1 style="font-size: 65px">Hello <?php echo htmlentities($_SESSION['Name']); ?> this is you</h1>
        </header>


        <form action="userPage.php" method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Name: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="name2" maxlength="255" placeholder="<?php echo htmlentities($name); ?>" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>



            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Surname: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="surname2" maxlength="255" placeholder="<?php echo htmlentities($surname); ?>" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Email: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="email" name="email2" maxlength="255" placeholder="<?php echo htmlentities($email); ?>" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Password: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="password" name="password2" maxlength="255" placeholder="New password" id="password" onChange="onChange()" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;">Confirm password: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="password" maxlength="255" placeholder="Confirm new password" id="confirm_password" onChange="onChange()" style="height: 100%; width:100%; border:none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <label class="form-check-label navbar-font" for="exampleCheck1">
                            <span class="navbar-font" style="font-size: 30px;">Subscribe to the newsletter: </span></label>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="newsletter2" <?php if ($row['Newsletter'] == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex ">
                <div class="col-6  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <input type="submit" class="btn btn-block mybtn btn-primary logo" name="submit" value="UPDATE">
                    </div>
                </div>
                <div class="col-6  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <input type="reset" class="btn btn-block mybtn btn-primary logo" name="reset" value="RESET">
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
                                $url = "chefPage.php";
                                $action = "MANAGE RECIPES AND PRODUCTS";
                                break;
                            case "Administrator":
                                $url = 'adminPage.php';
                                $action = "MANAGE USERS";
                                break;
                        }
                        echo  '<a href="' . $url . '" class="button btn btn-block mybtn btn-primary logo">' . $action . '</a>';
                    }

                    ?>

                </div>
            </div>
        </div>
        <form action="deliteAccount.php" method="post">
            <div class="row d-flex ">
                <div class="col-12  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <a href="#myModal" class="button trigger-btn btn btn-block mybtn mybtnImportant btn-primary logo" data-toggle="modal">DELITE YOUR ACCOUNT</a>
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
                            <p>Do you really want to delete your acount? This process cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary logo" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submitDeliteUser" class="btn btn-danger logo">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php require_once("footer.php"); ?>



</body>

</html>