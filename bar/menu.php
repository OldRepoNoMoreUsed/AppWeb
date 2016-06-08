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
<head><meta charset="utf-8"/>
<style>

    /* http://www.w3schools.com/css/css_navbar.asp */
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    li a:hover {
        background-color: #111;
    }

</style>
</head>

<body>
    <ul id="menu">
        <li class="menuelem"><a href="<?php echo $path ?>">SandBoxLearn</a></li>
        <?php
        if(isset($_SESSION['user'])){
            echo '<li class="menuelem"><a href="'.$path.'questionnary/insert-list.php">Création de questionnaire </a></li>';
            echo '<li class="menuelem"><a href="'.$path.'questionnary/insert_question.php">Insertion de question </a></li>';
            echo '<li class="menuelem"><a href="'.$path.'compte/compte.php">'.$_SESSION['user'].' '.'</a></li>';
            echo '<li class="menuelem"><a href="'.$path.'auth/disconnect.php">Deconnexion </a></li>';
        }else{
            echo '<li class="menuelem"><a href="'.$path.'auth/login.php">Connexion </a>';
            echo '<li class="menuelem"><a href="'.$path.'auth/login.php">Inscription</a>';
        }

        ?>


        <!-- <a href="">Rechercher un quizz</a> -->
    </ul>
    
</body>
</html>

