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
	<link rel="stylesheet" href="../css/page.css" />
</head>
	<body>

		<div id="haut">
			<?php require_once('../bar/menu.php') ?>
		</div>

		<h1 id="titreAccueil">Ajouter des listes de questions</h1>

		<div id="global">
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
							<option value="1">Très facile</option>
							<option value="2">Facile</option>
							<option value="3">Moyen</option>
							<option value="4">Diffile</option>
							<option value="5">Très difficile</option>
					</p>

					<input type = "submit" name = "send" id = "send" value ="Valider"/>
				</form>
			</div>
			
		</div>
		
		<?php require_once('../bar/footer.php')?>


	</body>
</html>


