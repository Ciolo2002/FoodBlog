<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . strtok($_SERVER["REQUEST_URI"], '?');
if (isset($_GET['recipe'])) {
    $actual_link .= '?recipe=' . $_GET['recipe'].'&';
}else if (isset($_GET['item'])) {
    $actual_link .= '?item=' . $_GET['item'].'&';
}
 else {
    $actual_link.='?';
 }
 ?>
<link rel=stylesheet href="loginStyle.css">
<script src="registerPassowrdControl.js"></script>
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="first">
                    <div class="myform form" name="registerForm">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1 class="sublogo" style="font-size:40px;">Sign Up</h1>
                            </div>
                        </div>
                        <form action="RegistrationOK.php?page=<?php echo $actual_link; ?>" method="post">
                            <div class="form-group">
                                <label for="name" class="navbar-font" style="padding-bottom: 5px; padding-left:5px;"><b>Name</b></label>
                                <input type="name" maxlength="255" name="name" class="form-control navbar-font" id="name" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="surname" class="navbar-font" style="padding-bottom: 5px;  padding-left:5px; padding-top:30px;"><b>Surame</b></label>
                                <input type="surname"  maxlength="255" name="surname" class="form-control navbar-font" id="surname" placeholder="Enter surname" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="navbar-font" style="padding-bottom: 5px;  padding-left:5px; padding-top:30px;"><b>Email address</b></label>
                                <input type="email" name="email"  maxlength="255" class="form-control navbar-font" id="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="navbar-font" style="padding-bottom: 5px;  padding-left:5px; padding-top:30px; "><b>Password</b></label>
                                <input type="password" name="password" id="password" class="form-control navbar-font" placeholder="Enter password" onChange="onChange()" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="navbar-font" style="padding-bottom: 5px;  padding-left:5px; padding-top:30px; "><b>Confirm password</b></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control navbar-font" placeholder="Enter password" onChange="onChange()" required>
                            </div>
                            <div class="form-check" style="margin-top:15px; margin: bottom 15px;">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="newsletter">
                                <label class="form-check-label navbar-font" for="exampleCheck1">Subscribe to the newsletter</label>
                            </div>
                            <?php
                            if (isset($_SESSION['SignUp']) && $_SESSION['SignUp'] == false) {
                                echo '<div class="form-group">';
                                echo '<p class="error">Email already used!<br>Try another one or <a href=' . $actual_link . 'page=loginForm id="signup" class="toRegister error">Sign in</a>
                                </p> </div>';
                            }
                            ?>
                            <div class="col-md-12 text-center ">
                                <input type="submit" class="btn btn-block mybtn btn-secondary logo" name="Signup" value="SIGN UP ">
                            </div>
                            <div class="col-md-12 ">
                                <div class="login-or">
                                    <hr class="hr-or">
                                    <span class="span-or">or</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="text-center">Already have an account? <a href='<?php echo $actual_link ?>page=loginForm' id="signup" class="toRegister">Sign in here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>