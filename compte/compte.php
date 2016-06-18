<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 05.05.2016
 * Time: 11:41
 */
require_once '../admin/config-db.php';
require_once '../admin/open-db.php';
require_once 'function_compte.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/config_sandboxlearn.php');


$base_url = $_SERVER['PHP_SELF'];

$colonnes = array("ID", "Nom");



if(validated($_GET, array('del'), "is_numeric")){
    remove_list($_GET['del']);
    redirect($base_url);
}elseif (validated($_GET, array('start'), "is_numeric")){
    start_list($path, $_GET['start']);
}
elseif(validated($_GET, array('tri', $colonnes), "in_array")){
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

<div id="global">
    <div id="droite" align="left">
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
                if($question_list = get_question($tri, $pdo)){
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
    <div id="gauche" align="right">
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
