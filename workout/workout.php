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

    ws45675fdtsx6figaiudsfgo69ua s



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
    <link rel="stylesheet" href="../css/page.css" />
</head>
<style type="text/css">
    form
    {
        text-align:center;
    }
</style>
<body>

<div id="haut">
    <?php require_once('../bar/menu.php') ?>
</div>

<?php require_once('../bar/footer.php')?>

<?php


$list = $pdo->query('SELECT list_name, list_description, list_commentary, list_difficulty, ID_list FROM tb_list');


echo '<table>';
while ($donnees = $list->fetch())
{
    echo '<tr>';
    echo '<td>'.htmlentities($donnees['list_name']).'</td>';
    echo '<td>'.htmlentities($donnees['list_description']).'</td>';
    echo '<td>'.htmlentities($donnees['list_commentary']).'</td>';
    echo '<td>'.htmlentities($donnees['list_difficulty']).'</td>';
    echo '<td><a href="question.php?id='.$donnees['ID_list'].'">Lancer</a></td>';
    echo '</tr>';
}
echo '</table>';
$list->closeCursor();

?>
</body>
</html>