<?php

require_once '../admin/config-db.php';
session_start();

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

if(isset($_GET['id'])){
	//TODO chargement de toute les questions dont l id de la liste est passe par le $_GET
	echo "Nous allons nous servir du questionnaire dont l id est:".$_GET['id'];
	$sql_query = 'SELECT question_ID_question FROM tb_list_question WHERE list_ID_List = '.$_GET['id'];
	$listIDquestion = $pdo->query($sql_query);
	$listID = array();
	while($ID = $listIDquestion->fetch()){
		array_push($listID, $ID);
	}
	print_r($listID);

}else{
	header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Questionneur</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: cyril.ruedin, nicolas.sommer
 * Date: 23.03.2016
 * Time: 11:07
 */
$a = "test";

$questionnaire = array(
    array("ads", "a"), 
	array("ade", "b"),
	array("awq", "c"),
	array("are", "d")
);

function displayQuest(){
    global $questionnaire;
	global $a; 
	$qlength = count($questionnaire);
	$indexRand = rand(0, $qlength-1);
	$_SESSION['indexRand'] = $indexRand;
    echo '<form action="question.php" method="post">';
    echo '<p>'.$questionnaire[$indexRand][0].' ?</p>';
	echo '<label for = "answer">Réponse: </label>';
	echo '<input type = "text" name = "answer" id = "answer"/>';
	echo '<input type = "submit" name = "send" id = "send" value ="Envoyer la réponse"/>';
	echo '</form>';
}

function validateAnswer(){
	global $questionnaire;
	echo '<p>Réponse attendu:'.$_POST['answer'].'</p>';
	echo 'Reponse:'. $questionnaire[$_SESSION['indexRand']][1];
	if($_POST['answer'] == $questionnaire[$_SESSION['indexRand']][1]){
		echo '<p>Well done!</p>';
	}
	else{
		echo '<p>Noob!!!</p>';
	}
}
if(isset($_POST['send'])){
	echo 'Réponse envoyé';
	validateAnswer();
}
displayQuest();

?>


