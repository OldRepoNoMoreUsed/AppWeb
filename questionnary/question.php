<?php
	session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
	<link rel="stylesheet" href="../css/page.css" />
    <script src="script.js"></script>
</head>
<body>

<div id="haut">
	<?php include_once('../bar/menu.php') ?>
</div>

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

</body>
</html>




