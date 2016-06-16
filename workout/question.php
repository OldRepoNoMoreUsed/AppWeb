<?php

require_once '../admin/config-db.php';
session_start();

if(isset($_SESSION['questionnaire'])){
	$_SESSION['questionnaire1'] = $_SESSION['questionnaire'];
}

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
	$_SESSION['id'] = $_GET['id'];

	$questionnaire = requete($pdo);
	//print_r($questionnaire);

}else{
	if(isset($_SESSION['id'])){
		$questionnaire = requete($pdo);
	}else {
		header("Location: ../index.php");
	}
}

function requete($pdo){
	$req = $pdo->prepare('SELECT Question, Answer, ID_Question FROM tb_question, tb_list_question, tb_masteries 
							WHERE list_ID_list = :list AND ID_Question = tb_masteries.question_ID_question AND tb_masteries.user_ID_Utilisateur = :user 
							AND tb_masteries.level => :levelmin AND tb_masteries.level =< :levelmax
							AND tb_masteries.last_answer <= :last_answer ORDER BY rand() LIMIT 1');

	//On regarde si on a un mot en maitrise négative
	$ques = $req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'],':levelmin' => -666, ':levelmax' => 0, ':last_answer' => 1));
	//Si il y en a pas, on choisit aléatoirement un nouveau mot
	while($ques->rowCount() == 0){
		$alea = rand(1, 20);
		//Dernier faux
		if ($alea < 6) {
			$ques = $req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => -666, ':levelmax' => 666, ':last_answer' => 0));
		} //basse Maitrise <= 3
		elseif ($alea < 9) {
			$ques = $req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => -666, ':levelmax' => 3, ':last_answer' => 1));
		} //moyenne Maitrise =>4 et <=6
		elseif ($alea < 11) {
			$ques = $req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => 4, ':levelmax' => 6, ':last_answer' => 1));
		} //haute Maitrise =>7
		elseif ($alea < 13) {
			$ques = $req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => 7, ':levelmax' => 666, ':last_answer' => 1));
		} //Nouveau Mot
		else {
			$ques = $pdo->query('SELECT Question, Answer, ID_Question FROM tb_question WHERE ID_Question NOT IN 
							(SELECT question_ID_question FROM tb_masteries WHERE user_ID_Utilisateur =' . ($_SESSION['ID_User'] + 0) . ' ORDER BY rand() LIMIT 1)');
		}
	}

	$sql_query = 'SELECT tb_question.Question , tb_question.Answer, tb_question.ID_Question
				  FROM tb_list_question, tb_question 
				  WHERE tb_list_question.question_ID_question = tb_question.ID_Question AND tb_list_question.list_ID_list = '.$_SESSION['id'].' ORDER BY rand() LIMIT 1';

	//echo $sql_query;

	$listIDquestion = $pdo->query($sql_query);
	$questionnaire = array();
	while($ID = $listIDquestion->fetch()){
		array_push($questionnaire, $ID);
	}
	$_SESSION['questionnaire'] = $questionnaire;
	return $questionnaire;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Questionneur</title>
	<link rel="stylesheet" href="../css/page.css" />
    <script src="script.js"></script>
</head>
<body>
<div id="haut">
	<?php require_once('../bar/menu.php') ?>
</div>

<?php require_once('../bar/footer.php')?>

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

/*$questionnaire = array(
    array("ads", "a"), 
	array("ade", "b"),
	array("awq", "c"),
	array("are", "d")
);*/

function displayQuest(){
    global $questionnaire;
	global $a;
	$qlength = count($questionnaire);
	$indexRand = rand(0, $qlength-1);
	$_SESSION['indexRand'] = $indexRand;
	$_SESSION['ID_Question'] = $questionnaire[$indexRand][2];
    echo '<form action="question.php" method="post">';
    echo '<p>'.$questionnaire[$indexRand][0].' ?</p>';
	echo '<label for = "answer">Réponse: </label>';
	echo '<input type = "text" name = "answer" id = "answer"/>';
	echo '<input type = "submit" name = "send" id = "send" value ="Envoyer la réponse"/>';
	echo '</form>';
}

function validateAnswer($pdo){
	global $questionnaire;
	echo '<p>Réponse envoyée:'.$_POST['answer'].'</p>';
	echo 'Réponse attendue:'. $_SESSION['questionnaire1'][$_SESSION['indexRand']][1];
	$state = $pdo->prepare('SELECT * FROM tb_masteries WHERE user_ID_Utilisateur ='.$_SESSION['ID_User'].' AND question_ID_Question = '.$_SESSION['ID_Question']);
	$state->execute();
	if($_POST['answer'] == $_SESSION['questionnaire1'][$_SESSION['indexRand']][1]){
		echo '<p>Bonne réponse</p>';
		//Modification du savoir de l'utilisateur
		if ($state->fetchColumn() < 1){
			$pdo->exec('INSERT INTO tb_masteries (user_ID_Utilisateur, question_ID_Question, level, last_answer) VALUES ('.$_SESSION['ID_User'].', '.$_SESSION['ID_Question'].', 1, 1);');
		}
		else{
			$pdo->exec('UPDATE tb_masteries SET level = level + 1, last_answer = 1 WHERE user_ID_Utilisateur ='.$_SESSION['ID_User'].' AND question_ID_Question = '.$_SESSION['ID_Question']);
		}

		//$req = $pdo->prepare("INSERT INTO tb_masteries (last_answer, level, list_commentary, list_difficulty, list_owner_user) VALUES (?, ?, ?, ?, ?)");
	}
	else{
		echo '<p>Mauvaise réponse !</p>';
		if ($state->fetchColumn() == FALSE){
			$pdo->exec('INSERT INTO tb_masteries (user_ID_Utilisateur, question_ID_Question, level, last_answer) VALUES ('.$_SESSION['ID_User'].', '.$_SESSION['ID_Question'].', 0, 0)');
		}
		else{
			$pdo->exec('UPDATE tb_masteries SET level = level - 1, last_answer = 0 WHERE user_ID_Utilisateur ='.$_SESSION['ID_User'].' AND question_ID_Question = '.$_SESSION['ID_Question']);
		}
	}
}
if(isset($_POST['send'])){
	echo 'Réponse envoyé';
	validateAnswer($pdo);
}
displayQuest();

?>


