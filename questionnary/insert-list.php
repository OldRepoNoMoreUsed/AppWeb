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
</head>
<body>
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

</body>
</html>