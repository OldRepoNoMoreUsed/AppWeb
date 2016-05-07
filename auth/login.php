<?php
require_once 'class/config-production.php';

session_start();

//Vérifie ce qui vient par la POST
      if(isset($_POST["login_submit"]))
      {
          if($auth->checkUser(htmlentities($_POST["user_name"]),htmlentities($_POST["user_pwd"]))){
              $_SESSION['user'] = $_POST["user_name"];
              header('Location: ../index.php');
              exit;
          }
          else{
              echo("Nom d'utilisateur ou mot de passe non valide");
              form_auth(htmlentities($_POST["user_name"]));


          }
      }
      elseif(isset($_POST["new_user"])){
          if($auth->addUser(htmlentities($_POST["user_name"]),htmlentities($_POST["user_pwd"]))){
              echo '<p>Utilisateur créé</p>';
              header('Location: ../index.php');
          }
          else{
              echo("Pas accepté parmi nous");
              form_auth();
          }
      }

      else{
          form_auth("");
      }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>login</title>
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

  <h1 id="titreAccueil">Connexion a SandBoxLearn</h1>
  <div id="haut">
      <a href="Compte.php"></a>
      <a href="auth/disconnect.php">Deconnexion </a>
      <a href="questionnary/insert-list.php">Création de questionnaire </a>
      <a href = "auth/login.php" >Connexion </a >
      <a href="auth/login.php">Inscription </a>
      <a href="">Rechercher un quizz</a>
  </div>
  <div id="Global">
      <div id="droite">
          <h2>Baniere droite</h2>
          <p>
              <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
          </p>
          <p>
              <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
          </p>
      </div>

      <div id="centre">
          <h2 align="center">Veuillez vous connecter</h2>
          <?php //Fonction qui afficher le formulaire, param -> valeur par défaut pour l'utilisateur
          function form_auth($user_name=""){
              ?>
              <div align="center" for="centre">
              <form action="login.php" method="post" id="centre">
                  <p>
                      <label>
                          Nom utilisateur : <input type="text" name="user_name" value="<?php echo $user_name ?>"/>
                      </label>
                  </p>
                  <p>
                      <label>
                          Mot de passe : <input type="password" name="user_pwd" />
                      </label>
                  </p>
                  <input type="submit" name="login_submit" value="Connexion" />

                  <input type="submit" name="new_user" value="Nouvel Utilisateur" />


              </form>
              </div>
              <?php
          }
          ?>
      </div>
      <div id="gauche">
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


