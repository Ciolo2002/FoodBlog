<?php
require('header.php');
if (isset($_POST['Login'])) {
    $stmt = $dbh->getInstance()->prepare("SELECT `IdUser`, password, `Name`, categories.Category FROM `users` INNER join categories on categories.IdCategory=users.Category
                    WHERE email =:email");

    $stmt->bindParam(':email', $email);
    $email = htmlentities($_POST['email']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($_GET['page'])) {
        $actualLink = $_GET['page'];
        if (isset($_GET['recipe'])) {
            $actual_link .= '&recipe=' . $_GET['recipe'];
        }
    }
    // $row is false if the user does not exist
    if ($row) {
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['IdUser'] = $row['IdUser'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Category']=$row['Category'];
            $_SESSION['SignUp'] = true; //vero se l'utente si è appena registrato e quindi si è anche appena loggato
            $_SESSION['ErrorLogin'] = true; //vero se il l'utente è loggato
            header('Location:' . $actualLink);
            exit;
        } else {
            $_SESSION['ErrorLogin'] = false;
            header('Location:' . $actualLink);
            exit;
        }
    } else {
        $_SESSION['ErrorLogin'] = false;
        header('Location:' . $actualLink);
        exit;
    }
} else {
    $_SESSION['ErrorLogin'] = true;
    header('Location: index.php');
}
