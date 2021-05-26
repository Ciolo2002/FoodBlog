<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("header.php");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $_SESSION['modifyByAdmin'] = false;
    }
    if (!isset($_SESSION['Category']) || $_SESSION['Category'] != 'Administrator') {
        header("Location: index.php");
    }
    ?>



</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php");

        // ini_set("SMTP", "tls://smtp.gmail.com");
        //ini_set("smtp_port", "587");
       
        if (isset($_POST['submit'])) {
            $stmt = $dbh->getInstance()->prepare("SELECT  `Name`, `Surname`, `Email` FROM `users` WHERE `Newsletter`=true");
            $stmt->execute();
            $message = $_POST['message'];
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = 'From: Burnt Leeks & Raw Beets <michael.sarto@ptpvenezia.edu.it>';
            while ($row = $stmt->fetch()) {
                $to = $row['Email'];
                $subject = 'Hi ' . $row['Name'] . ' ' . $row['Surname'] . ', ' . $_POST['subject'];
                mail($to, $subject, $message, implode("\r\n", $headers));
            }
        }



        ?>

        <header class="text-center logo">
            <h1 style="font-size: 65px"> Send your newsletter</h1>
            <h2 style="font-size: 45px"> to all subscribed</h2>
        </header>


        <form action="sendEmail.php" method="post" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Subject: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <input type="text" name="subject" maxlength="255" placeholder="Add the subject afer 'Hi [NAME] [SURNAME], ' " style="height: 100%; width:100%; border:none;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center ">

                    <div class="myform form" style="border: none;">
                        <span class="navbar-font" style="font-size: 30px;"> Message: </span>
                        <div class="form-control navbar-font" style="font-size: 25px; height: auto; width:auto">
                            <textarea name="message" rows="6" style="height: 100%; width:100%; border:none;" placeholder="Insert your message in HTML" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex ">
                <div class="col-6  d-flex justify-content-center ">
                    <div class="myform form" style="border: none;">
                        <input type="submit" class="btn btn-block mybtn btn-secondary logo" name="submit" value="SEND">
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
                                echo  '<a href="sendEmail.php" class="button btn btn-block mybtn btn-secondary logo">SEND NEWSLETTER</a>';
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