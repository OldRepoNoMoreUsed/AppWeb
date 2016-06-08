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

if(!isset($_GET['ID_Question'])){
    header('Location: insert_question.php');
}

$question = $pdo->query('SELECT ID_Question, Question, Answer FROM tb_question WHERE ID_Question='.$_GET['ID_Question']);
$data = $question->fetch();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Nouvelle question</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<link rel="stylesheet" href="../css/page.css" />
<body>
<div id="haut">
    <?php require_once('../bar/menu.php') ?>
</div>
        <form action="update_question_post.php" method="post">
            <p>
                <label for = "question" >Question </label>
                <input type="text" value="<?php $data['Question'] ?>" name="question" id="question"/>
            </p>

            <p>
                <label for = "answer">Réponse </label>
                <input type="text" value="<?php $data['Answer'] ?>" name="answer" id="answer"/>
            </p>

            <p>
                <input type="submit" value="Modifoer" />
            </p>
        </form>

</body>

<?php require_once('../bar/footer.php')?>
</html>



