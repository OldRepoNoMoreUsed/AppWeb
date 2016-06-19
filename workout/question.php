<?php

require_once '../admin/config-db.php';
require_once '../admin/open-db.php';

if(isset($_GET['id'])){
	$_SESSION['id'] = $_GET['id'];
}
if(!isset($_SESSION['id'])){
	header("Location: ../index.php");
}

function requete($pdo){

	$req = $pdo->prepare('SELECT Question, Answer, ID_Question FROM tb_question, tb_list_question, tb_masteries 
							WHERE list_ID_list = :list AND ID_Question = tb_masteries.question_ID_question AND tb_masteries.user_ID_Utilisateur = :user 
							AND tb_masteries.level > :levelmin AND tb_masteries.level < :levelmax
							AND tb_masteries.last_answer < :last_answer ORDER BY rand() LIMIT 1');
	$reqcopy = $req;

	//On regarde si on a un mot en maitrise négative
	$req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'],':levelmin' => -666, ':levelmax' => 0, ':last_answer' => 2));
	//Si il y en a pas, on choisit aléatoirement un autre mot
	while(!$res = $req->fetch(PDO::FETCH_ASSOC)){
		$req = $reqcopy;
		$alea = rand(1, 20);
		//Dernier faux
		if ($alea < 6) {
			$req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => -666, ':levelmax' => 666, ':last_answer' => 1));
		} //basse Maitrise <= 3
		elseif ($alea < 9) {
			$req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => -666, ':levelmax' => 3, ':last_answer' => 2));
		} //moyenne Maitrise =>4 et <=6
		elseif ($alea < 11) {
			$req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => 4, ':levelmax' => 6, ':last_answer' => 2));
		} //haute Maitrise =>7
		elseif ($alea < 13) {
			 $req->execute(array(':list' => $_SESSION['id'], ':user' => $_SESSION['ID_User'], ':levelmin' => 7, ':levelmax' => 666, ':last_answer' => 2));
		} //Nouveau Mot
		else {
			$req = $pdo->prepare('SELECT Question, Answer, ID_Question FROM tb_question, tb_list_question WHERE ID_Question
				NOT IN (SELECT question_ID_question FROM tb_masteries WHERE user_ID_Utilisateur = '.$_SESSION['id'].')
				AND ID_Question = question_ID_question AND list_ID_list = '.$_SESSION['id'].'  ORDER BY rand() LIMIT 1;');
			$req->execute();
		}

	}

	return $res;
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

function displayQuest($pdo){
	//Test si la liste n'est pas vide
	$tst = $pdo->prepare('SELECT * FROM tb_list_question WHERE list_ID_list = ?');
	$tst->execute(array($_SESSION['id']));
	if($tst->fetch()){
		$quest = requete($pdo);
		$_SESSION['ID_Question'] = $quest['ID_Question'];
		$_SESSION['Answer'] = $quest['Answer'];
		echo '<form action="question.php" method="post">';
		echo '<p>'.htmlentities($quest['Question']).' ?</p>';
		echo '<label for = "answer">Réponse: </label>';
		echo '<input type = "text" name = "answer" id = "answer"/>';
		echo '<input type = "submit" name = "send" id = "send" value ="Envoyer la réponse"/>';
		echo '</form>';
	}
	else{
		echo '<p>Liste vide, veuillez ajouter des questions</p>';
	}
}

function validateAnswer($pdo){
	echo '<p>Réponse envoyée:'.htmlentities($_POST['answer']).'</p>';
	echo '<p>Réponse attendue:'.htmlentities($_SESSION['Answer']).'</p>';
	$state = $pdo->prepare('SELECT * FROM tb_masteries WHERE user_ID_Utilisateur ='.$_SESSION['ID_User'].' AND question_ID_Question = '.$_SESSION['ID_Question']);
	$state->execute();
	if($_POST['answer'] == $_SESSION['Answer']){
		echo '<p>Bonne réponse</p>';
		//Modification du savoir de l'utilisateur
		if ($state->fetchColumn() < 1){
			$pdo->exec('INSERT INTO tb_masteries (user_ID_Utilisateur, question_ID_Question, level, last_answer) VALUES ('.$_SESSION['ID_User'].', '.$_SESSION['ID_Question'].', 1, 1);');
		}
		else{
			$pdo->exec('UPDATE tb_masteries SET level = level + 1, last_answer = 1 WHERE user_ID_Utilisateur ='.$_SESSION['ID_User'].' AND question_ID_Question = '.$_SESSION['ID_Question']);
		}

	}
	else{
		echo '<p>Mauvaise réponse !</p>';
		if ($state->fetchColumn() == FALSE){
			$pdo->exec('INSERT INTO tb_masteries (user_ID_Utilisateur, question_ID_Question, level, last_answer) VALUES ('.$pdo->quote($_SESSION['ID_User']).', '.$pdo->quote($_SESSION['ID_Question']).', 0, 0)');
		}
		else{
			$pdo->exec('UPDATE tb_masteries SET level = level - 1, last_answer = 0 WHERE user_ID_Utilisateur ='.$pdo->quote($_SESSION['ID_User']).' AND question_ID_Question = '.$pdo->quote($_SESSION['ID_Question']));
		}
	}
}
if(isset($_POST['send'])){
	validateAnswer($pdo);
}
displayQuest($pdo);

?>


