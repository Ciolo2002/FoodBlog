<nav class="navbar navbar-expand-md bg-light navbar-light">
<div id='userControl'></div>
    <a class="navbar-brand" href="index.php">
        <div>
            <span class="logo">
                BURNT LEEKS & RAW BEETS
            </span>
        </div>
        <div>
            <span class="sublogo">
                a foodblog by Matthew D. Gullidge
            </span>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" title="Open and close navigation bar" data-target="#collapsibleNavbar" >
    <!-- open navbar button -->
            <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION['Name'])) {
                echo '<li class="nav-item navbar-font">
               <a class="nav-link" href="userPage.php"><b> Hi ' . htmlentities($_SESSION['Name']) . '!</b></a>
                </li>';
            }
            ?>
            <li class="nav-item navbar-font">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item navbar-font">
                <a class="nav-link" href="shop.php">Shop</a>
            </li>
            <li class="nav-item navbar-font">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item navbar-font">
                <a class="nav-link" href="blog.php">Blog</a>
            </li>
            <li class="nav-item navbar-font">
                <?php
                if (!isset($_SESSION['Name'])) {
                    echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>';
                } else {
                    echo '<a class="nav-link" href="logout.php">Logout</a>';
                }
                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.instagram.com/mattgullidge/" alt="Instagram"><i class="fab fa-instagram fa-lg" alt="Instagram" title="Instagram link"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.pinterest.it/mattgullidge/" alt="Pinterest"><i class="fab fa-pinterest-p" title="Pinterest link"></i></a>
            </li>
        </ul>
    </div>
</nav>
