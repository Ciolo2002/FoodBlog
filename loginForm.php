<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . strtok($_SERVER["REQUEST_URI"], '?');
if (isset($_GET['recipe'])) {
    $actual_link .= '?recipe=' . $_GET['recipe'].'&';
}else if (isset($_GET['item'])) {
    $actual_link .= '?item=' . $_GET['item'].'&';
}
 else {
    $actual_link.='?';
 } ?>
<link rel=stylesheet href="loginStyle.css">
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="first">
                    <div class="myform form" name="loginForm">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1 class="sublogo" style="font-size:40px;">Login</h1>
                            </div>
                        </div>
                        <form action="LoginOK.php?page=<?php echo $actual_link; ?>" method="post">
                            <div class="form-group">
                                <label for="email" class="navbar-font" style="padding-bottom: 5px; padding-left:5px;"><b>Email address</b></label>
                                <input type="email" name="email" class="form-control navbar-font" id="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="navbar-font" style="padding-bottom: 5px;  padding-left:5px; padding-top:30px; "><b>Password</b></label>
                                <input type="password" name="password" id="password" class="form-control navbar-font" placeholder="Enter Password" required>
                            </div>
                            <?php
                            if (isset($_SESSION['ErrorLogin']) && $_SESSION['ErrorLogin'] == false) {
                                echo '<div class="form-group">';
                                echo '<p class="error">Incorrect email or password.</p> </div>';
                            }
                            ?>
                            <div class="col-md-12 text-center ">
                                <input type="submit" class="btn btn-block mybtn btn-secondary logo" name="Login" value="LOGIN">
                            </div>
                            <div class="col-md-12 ">
                                <div class="login-or">
                                    <hr class="hr-or">
                                    <span class="span-or">or</span>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <p class="text-center">Don't have account? <a href='<?php echo $actual_link ?>page=registerForm' id="signup" class="toRegister">Sign up here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>