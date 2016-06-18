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
<div id="global">
    <div id="droite" align="center">
        <?php require_once('bar/sidebarRight.php')?>
    </div>
    <div id="centre" align="center">

        <h2>Qu'est ce que SandBoxLearn</h2>
        <p>SandBoxLearn est une application sur le web permettant l'apprentissage via des questionnaires que chaque utilisateur peut créer selon ses envies.</p>
    </div>

</div>

<?php require_once('bar/footer.php')?>


</body>
</html>
