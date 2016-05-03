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
        $sql = "SELECT username FROM tb_user  WHERE username = ".$this->db->quote($name)." AND password = ".$this->db->quote(sha1($name.$pwd)).";";
		
		echo $sql;

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