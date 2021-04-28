    <?php
    require_once('Header.php');
    if (isset($_POST['Signup'])) {
        $email = htmlentities($_POST['email']);
        $stmt1 = $dbh->getInstance()->prepare("SELECT email FROM Users
        WHERE email =:email");
        $stmt1->bindParam(':email', $email);
        $stmt1->execute();
        $row1 = $stmt1->fetch();
        if (isset($_GET['page'])) {
            $actualLink = $_GET['page'];
            if (isset($_GET['recipe'])) {
                $actual_link .= '&recipe=' . $_GET['recipe'];
            }
        }
        if ($_POST['email'] != $row1['email']) {
            $stmt = $dbh->getInstance()->prepare("INSERT INTO users(name, surname, email,  password, newsletter, category) values(:name, :surname, :email,  :password, :newsletter, :category)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':category', $categoy);
            $stmt->bindParam(':newsletter', $newsltetter);
            $name = htmlentities($_POST['name']);
            $categoy = 3;
            $surname = htmlentities($_POST['surname']);
            $email =  htmlentities($_POST['email']);
            if (isset($_POST['newsletter'])) {
                $newsltetter = true;
            } else {
                $newsltetter = false;
            }
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->execute();
            $stmt2 = $dbh->getInstance()->prepare("SELECT MAX(IdUser), categories.Category FROM users INNER JOIN categories on categories.IdCategory=users.Category  WHERE email=:email"); 
            $stmt2->bindParam(':email', $email);
            $stmt2->execute(); 
            $row2 = $stmt2->fetch();
            $_SESSION['Category']=$row2['Category'];
            $_SESSION['IdUser'] = (int)$row2['MAX(IdUser)']; 
            $_SESSION['Name'] = $_POST['name'];
            $_SESSION['SignUp'] = true;
            $_SESSION['ErrorLogin'] = true;
            echo $_SESSION['IdUser'];
            header('Location:' . $actualLink);
        } else {
            $_SESSION['SignUp'] = false;
            header('Location:' . $actualLink);
        }
    } else {
        header('Location: index.php' );
    }
