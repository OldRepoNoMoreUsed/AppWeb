<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 05.05.2016
 * Time: 11:41
 */
require_once '../admin/config-db.php';
require_once 'function_compte.php';
session_start();

$base_url = $_SERVER['PHP_SELF'];

$colonnes = array("ID", "Nom");

try{
    $db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);
}catch(Exception $e)
{
    die('Erreur:'.$e->getMessage());
}

if(isset($_GET['del']) && is_scalar($_GET['del']) && is_numeric($_GET['del'])){
    remove_list($_GET['del']);
    redirect($base_url);
}elseif (isset($_GET['start']) && is_scalar($_GET['start']) && is_numeric($_GET['start'])){
    start_list($_GET['start']);
}
elseif (isset($_GET['tri']) && is_scalar($_GET['tri']) && in_array($_GET['tri'], $colonnes)) {
    $tri = $_GET['tri'];
} else {
    $tri = "ID";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../css/page.css" />
</head>
<body>
<div id="haut">
    <?php require_once('../bar/menu.php') ?>
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

        <h2>Mon compte</h2>
        <p><a href="questionnary/insert-list.php">Ajouter un questionnaire</a></p>

        <h2>Liste des questionnaires lié a ce compte</h2>
        <table border="1">
            <tr>
                <?php
                    foreach($colonnes as $c) {
                        echo "<th>";
                        echo action_links($base_url, "tri", $c, $c);
                        echo "</th>";
                    }
                ?>
                <th>Description</th>
                <th>Commencer</th>
                <th>Supprimer</th>
            </tr>
            <?php
                if($question_list = get_question($tri)){
                    while($row = $question_list->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>"
                            .balisage(array_map("htmlentities", $row))
                            ."<td>".action_links($base_url, "start", $row['ID_list'], "Start")."</td>"
                            ."<td>".action_links($base_url, "del", $row['ID_list'], "X")."</td>"
                            ."</tr>";
                    }
                }
            ?>
        </table>
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
<?php require_once('../bar/footer.php')?>


</body>
</html>
