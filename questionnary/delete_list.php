<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 05.05.2016
 * Time: 11:56
 */

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <meta charset="utf-8"/>
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
</head>
<body>
<h1 id="titreAccueil">Accueil du projet SandBoxLearn</h1>
<div id="haut">
    <a href="index.php">Page d'accueil</a>
    <a href="auth/disconnect.php">Deconnexion </a>
    <a href="questionnary/insert-list.php">Création de questionnaire </a>
    <a href="">Rechercher un questionnaire</a>
</div>
<div id="Global">
    <div id="droite">
        <h2>Baniere droite</h2>
        <p>
            <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
        </p>
        <p>
            <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
        </p>
    </div>
    <div id="centre">

        <h2>Supprimer un questionnaire</h2>
        <p>Vous trouverez ci-dessous la liste de tout vos questionnaires cliquez sur la croix pour supprimer celui que vous desirez supprimer</p>
        /*TODO : Insertion d'un tableau contenant le nom et la description des questionnaire a supprimer et un colonne avec une croix pour la suppression*/
    </div>
    <div id="gauche">
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
