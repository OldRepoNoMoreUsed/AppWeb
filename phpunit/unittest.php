<?php

/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 19.06.2016
 * Time: 00:33
 */

//Testé avec phpuni-5.4.6 -> phpunit.de
//Mettre un nouveau username pour chaque test ou le supprimer de la BDD
//Tester avec ligne de commande : php phpunit-5.4.6.phar unittest.php

class unittest extends PHPUnit_Framework_TestCase
{
    public static function Main(){
        $unittest = new unittest();

    }

    public function testCreateAccount(){

        $auth = $this->openDB();

        $this->assertTrue($auth->addUser("Gisele", "MotDePasseHyperLongEtSecuriseAvecUneEntropieEnorme"));


    }

    public function testAccount(){

        $auth = $this->openDB();

        $this->assertFalse($auth->checkUser("Gisele", "MotDePasseHyperLongEtSecuriseAvecUneEntropieEnormeMaixFaux"));
        $this->assertTrue($auth->checkUser("Gisele", "MotDePasseHyperLongEtSecuriseAvecUneEntropieEnorme"));
    }

    public function openDB(){
        require_once "../admin/config-db.php";
        require_once "../auth/class/auth-db.php";

        try{
            $pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        return new Auth_DB($pdo);
    }
}
