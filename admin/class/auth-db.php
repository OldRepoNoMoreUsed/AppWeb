<?php require_once 'auth-abstract.php';

class Auth_DB extends Auth_Abstract{
    private $db;
    function __construct()
    {
        try{
            $this->db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

    }

    function checkUser($name, $pwd)
    {
        $sql = "SELECT ID_User, username FROM tb_user  WHERE username = ".$this->db->quote($name)." AND password = ".$this->db->quote(sha1($name.$pwd)).";";

        $result = $this->db->query($sql);

        if ($result->rowCount() == 0){
            return false;
        }
        else{
            $_SESSION['user'] = $result->fetchColumn(1);
            $_SESSION['ID_User'] = $result->fetchColumn(1);


            echo $_SESSION['user'];
            echo $_SESSION['ID_User'];
            //header('Location: ../index.php');
            exit;
        }
    }

    function addUser($name, $pwd)
    {
        $sql = "INSERT INTO tb_user (username, password) VALUES (".$this->db->quote($name).",".$this->db->quote(sha1($name.$pwd)).");";

        if($this->db->exec($sql)){
            return true;
        }
        else{
            return false;
        }

    }
}


?>