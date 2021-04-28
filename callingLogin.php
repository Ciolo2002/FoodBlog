<?php
        if (isset($_GET['page']) && $_GET['page'] == "registerForm") {
            echo '<script src="scriptOpenLogin.js"></script>';
            require('registerForm.php');

        }else if (isset($_GET['page']) && $_GET['page'] == "loginForm") {
            echo '<script src="scriptOpenLogin.js"></script>';
            require('loginForm.php');
        } else if(isset($_SESSION['SignUp']) && $_SESSION['SignUp'] === false){
            echo '<script src="scriptOpenLogin.js"></script>';
            require('registerForm.php');
        }  else if(isset($_SESSION['ErrorLogin'])&& $_SESSION['ErrorLogin']===false){
            echo '<script src="scriptOpenLogin.js"></script>';
            require('loginForm.php');
        }else{
            require('loginForm.php');
        }
