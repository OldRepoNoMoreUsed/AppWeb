<?php

//TODO :Ajouter précision  liste, protection modification selon propriétaire

require_once '../admin/config-db.php';
require_once '../admin/open-db.php';
require_once '../compte/function_compte.php';

/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 04.05.2016
 * Time: 16:06
 */

// Connexion à la base de données


if(!isset($_SESSION['user'])){
    redirect("../auth/login.php");
}

if(!isset($_GET['ID_Question'])){
    redirect("../auth/login.php");
}

$question = $pdo->query('SELECT ID_Question, Question, Answer FROM tb_question WHERE ID_Question='.$pdo->quote($_GET['ID_Question']));
$_SESSION['ID_Question_edit']=$_GET['ID_Question'];
$data = $question->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Modifier question</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<link rel="stylesheet" href="../css/page.css" />
<body>
<div id="haut">
    <?php require_once('../bar/menu.php') ?>
</div id="global">
    <div id="centre" align="center">
        <form action="update_question_post.php" method="post">
            <p>
                <label for = "question" >Question </label>
                <input type="text" value="<?php echo $data['Question'] ?>" name="question" id="question"/>
            </p>

            <p>
                <label for = "answer">Réponse </label>
                <input type="text" value="<?php echo $data['Answer'] ?>" name="answer" id="answer"/>
            </p>

            <p>
                <input type="submit" value="Modifier" />
            </p>
        </form>
    </div>

</body>

<?php require_once('../bar/footer.php')?>
</html>



