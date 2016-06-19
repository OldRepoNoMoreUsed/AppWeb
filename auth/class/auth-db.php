<?php require_once 'auth-abstract.php';

class Auth_DB extends Auth_Abstract{
    private $db;
    function __construct($pdo)
    {
        $this->db = $pdo;
    }

    function checkUser($name, $pwd)
    {
        $sql = "SELECT ID_User, username FROM tb_user  WHERE username = ".$this->db->quote($name)." AND password = ".$this->db->quote(sha1($name.$pwd)).";";

        $result = $this->db->query($sql);

        if ($result->rowCount() == 0){
            return false;
        }
        else{
            $user = $result->fetch();
            $_SESSION['user'] = $user['username'];
            $_SESSION['ID_User'] = $user['ID_User'];


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