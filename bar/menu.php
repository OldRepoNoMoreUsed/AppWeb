<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 11.05.2016
 * Time: 08:52
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/config_sandboxlearn.php');

?>

<!DOCTYPE html>
<html>
<head
</head>

<body>
    <div>
        <a href="<?php echo $path ?>">Page d'accueil</a>
        <?php
        if(isset($_SESSION['user'])){
            echo '<a href="'.$path.'compte/Compte.php">'.$_SESSION['user'].' '.'</a>';
        }else{
            echo '<a href="'.$path.'auth/login.php">Login</a>';
        }

        ?>
        <a href="<?php echo $path?>auth/disconnect.php">Deconnexion </a>
        <a href="<?php echo $path ?>questionnary/insert-list.php">Création de questionnaire </a>
        <a href="<?php echo $path ?>questionnary/insert_question.php">Insertion de question </a>
        <a href="">Rechercher un quizz</a>
    </div>
    
</body>
</html>

