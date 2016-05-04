<?php

//Ajouter précision  liste

require_once '../admin/config-db.php';
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 04.05.2016
 * Time: 16:06
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Nouvelle question</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    </head>
    <style type="text/css">
    form
    {
        text-align:center;
    }
    </style>
    <body>

    <form action="insert_question_post.php" method="post">
        <p>

		<input type="text" name="question" id="question"/>
		<input type="text" name="answer" id="answer"/>


        <input type="submit" value="Envoyer" />
	</p>
    </form>

<?php
// Connexion à la base de données
try{
    $pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);
} catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

//Question déjà existantes
$reponse = $pdo->query('SELECT * FROM tb_question ORDER BY ID_Question DESC');

echo '<table>';
while ($donnees = $reponse->fetch())
{
    echo '<tr>';
    echo '<td>'.htmlentities($donnees['Question']).'</td>';
    echo '<td>'.htmlentities($donnees['Answer']).'</td>';
    echo '</tr>';
}
echo '</table>';
$reponse->closeCursor();

?>
</body>
</html>