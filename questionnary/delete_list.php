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
    <link rel="stylesheet" href="../css/page.css" />
</head>
<body>
<h1 id="titreAccueil">Accueil du projet SandBoxLearn</h1>
<div id="haut">
    <?php include_once('../bar/menu.php') ?>
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
