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
        $sql = "SELECT name_user FROM tb_users  WHERE name_user = ".$this->db->quote($name)." AND password_user = ".$this->db->quote(sha1($name.$pwd)).";";

        $result = $this->db->query($sql);

        if ($result->rowCount() == 0){
            return false;
        }
        else{
            return true;
        }
    }

    function addUser($name, $pwd)
    {
        $sql = "INSERT INTO `tb_users` (`name_user`, `password_user`) VALUES (".$this->db->quote($name).",".$this->db->quote(sha1($name.$pwd)).");"; //Echappement juste, échappement sha1 utile ?

        if($this->db->exec($sql)){
            return true;
        }
        else{
            return false;
        }

    }
}


?>