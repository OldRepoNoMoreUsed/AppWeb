<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 03.05.2016
 * Time: 18:39
 */
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/page.css" />
</head>
<body>
<div id="haut">
    <?php include_once('bar/menu.php')?>

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

        <h2>Qu'est ce que SandBoxLearn</h2>
        <p>SandBoxLearn est une application sur le web permettant l'apprentissage via des questionnaires que chaque utilisateur peut créer selon ses envies.</p>
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
