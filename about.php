<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("header.php");
    if (isset($_SESSION['modifyByAdmin']) && isset($_SESSION['modifyByAdmin']) == true) {
        $_SESSION['modifyByAdmin'] = false;
    }
    ?>

    <link rel="stylesheet" href="about.css">





</head>

<body>

    <div class="container-fluid ">

        <?php
        require_once("callingLogin.php");
        require_once("navbar.php"); ?>



        <div class="row d-flex justify-content-center">
            <div class="col-12">

                <header>
                    <h1 class="sublogo" style=" font-size: 2vh;">
                        For over a decade, I worked in Pizzerias, Gastro-Pubs, 5 Star Hotels, Cafes, Fine Dining Restaurants, Greasy Spoons, the lot really. You name it, I've probably done it. My career in professional cookery spread across Cyprus, Italy and England. I guess I found it difficult to stay still because I wanted to learn more. I once learnt the lesson that, 'good food starts with good ingredients', something that should be obvious to a Chef, but really didn't make sense to me until I arrived in Italy.</h1>
                </header>
                <section class="sectionX section1">
                    <h1 class="sublogo" style=" font-size: 2vh;">
                        A place where agriculture and self sufficiency really is a normal thing for the average family. It was quite eye-opening for me to see how other peoples food cultures differ from my own.
                        I've now retired from the kitchen in search of family life. A little readjusting for more time with friends and family. Something I nearly forgot about for a while.
                        I learnt a lot working in kitchens. How passionate people can be, how determined and hardworking people are or how you can be self obssesive in search for perfection, which doesn't even exist. It really is the only thing i've ever studied that seems to correlate as, the more you know, the less you actually know.
                    </h1>
                </section>
                <section class="sectionX section2">
                    <h1 class="sublogo" style=" font-size: 2vh;">

                        One thing I do know now though is what good food is, I know what great cookery is and I know how much I want to share what I have learnt with you.
                        Some people told me never to share my recipes with others. Some Chefs even protect their dirty recipe books more than they would their kin. I'm not even cooking professionally anymore, so why should I lock them away? I mean, who else is going to use them?

                        My name is Matthew Gullidge and this is Burnt Leeks and Raw Beets.</h1>
                </section>

            </div>
        </div>








    </div>
    <?php require_once("footer.php"); ?>




</body>

</html>