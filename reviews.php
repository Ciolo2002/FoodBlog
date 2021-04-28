<section>
            <div class="row d-flex justify-content-center">
                <div class="col-10 borderReview" style="border-top-style: solid">
                    <div class="logo" style="border-bottom-style: solid; border-color: #44444494 !important; border-width: 1px !important; padding: 15px; padding-bottom: 5px">
                        Comments
                    </div>
                </div>
            </div>
            <?php

            if (isset($_SESSION['IdUser'])) { //controllo se l'utente è gia loggato
                echo ' <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center borderReview">
                    <form class="myform form" style="border: none;" action="' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . '" method="post">
                        <div>
                            <label for="rateYo">' . htmlentities($_SESSION['Name']) . ' publish your comment: </label><div id="rateYo" ></div>
                        </div>
                        <input type="hidden" id="hiddenRating" value="4" name="rating">
                        <div>
                            <input type="text"  class="form-control navbar-font" maxlength="255" name="content" placeholder="Write a comment...">
                            </div>
                                <input type="submit" name="submit" class="mybtn btn btn-block btn-primary logo" value="PUBLISH">
                    </form>
                </div>
            </div>';
            } else {
                echo ' <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center borderReview">
                    <div class="myform form" style="border: none;" >
                        <div>
                            <label for="rateYo">Login to publish your comment: </label><div id="rateYo" data-rateyo-rating="4"></div>
                        </div>
                      
                        <div>
                            <input type="text"  class="form-control navbar-font" maxlength="255" name="content" placeholder="Write a comment..." readonly>
                            </div>
                                <input type="button" name="submit" href="#" data-toggle="modal" data-target="#loginModal" class="mybtn btn btn-block btn-primary logo" value="LOGIN">
                    </div>
                </div>
            </div>';
            }
            if (isset($_POST['submit'])) {
                $stmt5 = $dbh->getInstance()->prepare("INSERT INTO reviews (stars, review, idUser, idRecipe) VALUES (:stars, :review, :idUser, :idRecipe)");
                $stmt5->bindParam(':stars', $_POST['rating']);
                $stmt5->bindParam(':review',$_POST['content']);
                $stmt5->bindParam(':idUser', $_SESSION['IdUser']);
                $stmt5->bindParam(':idRecipe', $_GET['recipe']);
                $stmt5->execute();
            }
            $stmt4 = $dbh->getInstance()->prepare("SELECT users.IdUser, users.Name, users.Surname, reviews.Stars, reviews.Review, reviews.IdReview from reviews INNER JOIN users on users.IdUser=reviews.IdUser where reviews.IdRecipe=" . $row['IdRecipe']);
            $stmt4->execute();
            for ($cnt = $stmt4->rowCount(); $cnt > 0; --$cnt) {
                $row4 = $stmt4->fetch();
                $name = $row4['Name'];
                $surname = $row4['Surname'];
                $stars = $row4['Stars'];
                $review = $row4['Review'];
                
                echo '<div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center borderReview">
                    <div class="myform form" style="border: none;">
                        ' . htmlentities($name) . ' '. htmlentities($surname).': <div class="rateyo" data-rateyo-rating="' . $stars . '"></div>
                        <div class="form-control navbar-font" style="height: auto; width:auto">
                           ' . htmlentities($review);
                           if((isset($_SESSION['IdUser'])&& $_SESSION['IdUser']==$row4['IdUser']) ||( isset($_SESSION['Category']) && $_SESSION['Category']=="Administrator")){
                            echo '<form id"myform" class="d-flex flex-row-reverse" action="deliteReview.php" method="POST">
                            <input type="hidden" name="IdReview" value="'.$row4['IdReview'].'">
                            <input type="hidden" name="IdRecipe" value="'.$_GET['recipe'].'">
                            <button type="submit" name="submit" class="btn btn-link"><i class="fas fa-trash-alt fa-lg trashBin"></i></button>
                            </form>';
                            
                        }
                      echo' </div>
                    </div>
                </div>
            </div>';
            }

            ?>
            <div class="row d-flex justify-content-center">
                <div class="col-10  d-flex justify-content-center borderReview" style="border-bottom-style: solid;">
                </div>
            </div>
        </section>