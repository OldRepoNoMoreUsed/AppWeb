<?php

//Ajouter précision  liste

require_once '../admin/config-db.php';

session_start();
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 04.05.2016
 * Time: 16:06
 */

// Connexion à la base de données
try{
    $pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);
} catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

if(!isset($_SESSION['user'])){
    header('Location: ../auth/login.php');
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Nouvelle question</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <style>
        *{
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        html{
            height: 100%;
        }
        body{
            position: relative;
            min-height: 100%;
            margin: 0;
            padding 0;
        }
        #titreAccueil{
            text-align:center;
        }
        #Global #gauche{
            float:left;
            margin-right: auto;
            width:25%;
        }
        #Global #centre{
            float:left;
            margin-left:auto;
            margin-right:auto;
            width:50%;
        }
        #Global #droite{
            float: left;
            margin-left: auto;
            width:25%
        }
        #haut{
            text-align: center;
        }
        footer{
            position:absolute;
            bottom:0;
            left:0;
            right:0;
        }
    </style>
    <body>
    <h1 id="titreAccueil">Ajouter des questions à vos listes</h1>
    <div id="haut">
        <?php
        if(isset($_SESSION['user'])) {
            echo '<a href="../Compte.php">'.$_SESSION['user'].' '.'</a>';
            echo '<a href="auth/disconnect.php">Deconnexion </a>';
            echo '<a href="insert-list.php">Création de questionnaire </a>';
            echo '<a href="insert_question.php">Ajout de question</a>';
        }else {
            echo '<a href = "auth/login.php" >Connexion </a >';
            echo '<a href="auth/login.php">Inscription </a>';
        }
        ?>
        <a href="">Rechercher un quizz</a>
    </div>
    <div id="Global">
        <div id="droite" align="center">
            <h2>Baniere droite</h2>
            <p>
                <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
            </p>
            <p>
                <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
            </p>
        </div>
        <div id="centre" align="center">
            <form action="insert_question_post.php" method="post">
                <p>
                    <label for = "question">Question </label>
                    <input type="text" name="question" id="question"/>
                </p>

                <p>
                    <label for = "answer">Réponse </label>
                    <input type="text" name="answer" id="answer"/>
                </p>

                <?php
                if(!isset($_GET['ID_list'])){
                    echo '<p>';
                    echo '<label for = "list">Liste </label>';
                    echo '<select name="list" id="list">';
                    $list = $pdo->query('SELECT * FROM tb_list WHERE list_owner_user ='.$_SESSION['ID_User']);
                    if($list->rowCount() < 1){
                        echo '<option value="error">Veuillez créer une liste</option>';
                    }else{
                        while($donnees = $list->fetch()){
                            echo '<option value="'.$donnees['ID_list'].'">'.$donnees['list_name'].'</option>';
                        }
                    }
                    echo '</p>';
                } else {
                    echo '<p><input type="hidden" name="list" id="list" value="' . $_GET['ID_list'] . '"/></p>';
                }
                ?>

                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </form>

            <?php

            if(isset($_GET['ID_list'])) {
            //Question déjà existantes
                $reponse = $pdo->query('SELECT Question, Answer FROM tb_question, tb_list_question, tb_list WHERE ID_list=' . $_GET['ID_list'] . ' AND ID_list=list_ID_list AND question_ID_question = ID_question ORDER BY ID_Question DESC ');
            }else{
                $reponse = $pdo->query('SELECT Question, Answer, list_name FROM tb_question, tb_list_question, tb_list WHERE ID_list=list_ID_list AND question_ID_question = ID_question ORDER BY ID_Question DESC ');
            }


            echo '<table>';
            while ($donnees = $reponse->fetch())
            {
                echo '<tr>';
                echo '<td>'.htmlentities($donnees['Question']).'</td>';
                echo '<td>'.htmlentities($donnees['Answer']).'</td>';
                if(!isset($_GET['ID_list'])) {echo '<td>'.htmlentities($donnees['list_name']).'</td>';}
                echo '<td><a href="">Modifier(a faire)</a></td>';
                echo '<td><a href="">Supprimer(a faire)</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            $reponse->closeCursor();

            ?>
        </div>
        <div id="gauche" align="center">
            <h2>Baniere gauche</h2>
            <p>
                <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
            </p>
            <p>
                <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
            </p>
        </div>
    </div>
    <footer>
        <h3>pied de page</h3>
        <p>On peut mettre ici les crédits</p>
    </footer>

</body>
</html>



