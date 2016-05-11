<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 11.05.2016
 * Time: 08:52
 */

?>

<!DOCTYPE html>
<html>
<head
</head>
<body>

    <div>
        <a href="index.php">Page d'accueil</a>
        <?php
        if(isset($_SESSION['user'])){
            echo '<a href="compte/Compte.php">'.$_SESSION['user'].' '.'</a>';
        }else{
            echo '<a href="auth/login.php">Login</a>';
        }

        ?>
        <a href="auth/disconnect.php">Deconnexion </a>
        <a href="questionnary/insert-list.php">Création de questionnaire </a>
        <a href="questionnary/insert_question.php">Insertion de question </a>
        <a href="">Rechercher un quizz</a>
    </div>
    
</body>
</html>

