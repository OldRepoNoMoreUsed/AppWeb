<?php
	session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>insertion liste</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
	<style>
		*{
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		html{
			height: 100%;
		}
		body{
			position: relative;
			min-height: 100%;
			margin: 0;
			padding 0;
		}
		#titreAccueil{
			text-align:center;
		}
		#Global #gauche{
			float:left;
			margin-right: auto;
			width:25%;
		}
		#Global #centre{
			float:left;
			margin-left:auto;
			margin-right:auto;
			width:50%;
		}
		#Global #droite{
			float: left;
			margin-left: auto;
			width:25%
		}
		#haut{
			text-align: center;
		}
		footer{
			position:absolute;
			bottom:0;
			left:0;
			right:0;
		}
	</style>
</head>
	<body>
		<h1 id="titreAccueil">Accueil du projet SandBoxLearn</h1>
		<div id="haut">
			<?php
			if(isset($_SESSION['user'])) {
				echo '<a href="../Compte.php">'.$_SESSION['user'].' '.'</a>';
				echo '<a href="auth/disconnect.php">Deconnexion </a>';
				echo '<a href="insert-list.php">Création de questionnaire </a>';
				echo '<a href="insert_question.php">Ajout de question</a>';
			}else {
				echo '<a href = "auth/login.php" >Connexion </a >';
				echo '<a href="auth/login.php">Inscription </a>';
			}
			?>

			<a href="">Rechercher un quizz</a>


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
				<form action="insert-list-post.php" method="post">
					<p>

						<label for = "list_name">Nom de la liste </label>
						<input type = "text" name = "list_name" id = "list_name"/>
					</p>

					<p>
						<label for = "list_description">Description </label>
						<textarea name = "list_description" id = "list_description"></textarea>
					</p>

					<p>
						<label for = "list_commentary">Commentaire </label>
						<textarea name = "list_commentary" id = "list_commentary"></textarea>
					</p>

					<p>
						<label for = "list_difficulty">Difficulté </label>
						<select name = "list_difficulty" >
							<option>Très facile</option>
							<option>Facile</option>
							<option>Moyen</option>
							<option>Diffile</option>
							<option>Très difficile</option>
					</p>

					<input type = "submit" name = "send" id = "send" value ="Envoyer la réponse"/>
				</form>
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


