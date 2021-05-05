<?php

class DBHandler
{
    private $db;

    function __construct()
    {
        $this->connect_database();
    }

    public function getInstance()
    {
        return $this->db;
    }

    public function getDb()
    {
        if ($this->db instanceof PDO) {
            return $this->db;
        }
    }

    private function connect_database()
    {
        if (isset($_SESSION['Category'])) {
            switch ($_SESSION['Category']) {
                case "User":
                    define('USER', 'user');
                    define('PASSWORD', 'UqZ)SA5/C?buu.6^"9t!!>!^kh"=?+vP');
                    break;
                case "Chef":
                    define('USER', 'chef');
                    define('PASSWORD', 'A.Djh!]XQg<TrTX+Gx(&V@fPv74qnTL~');
                    break;
                case "Administrator":
                    define('USER', 'admin');
                    define('PASSWORD', ';E&w#!%Br]]XtJLSe@$XY}qD<r3g2u2n');
                    break;
                    default:
                    define('USER', 'nouser');
                    define('PASSWORD', '4KsKhh{PL>4Mhcw7v;FE)~,6r6!Yzf!L');
                    break;
            }
        } else {
            define('USER', 'nouser');
            define('PASSWORD', '4KsKhh{PL>4Mhcw7v;FE)~,6r6!Yzf!L');
        }

        // Database connection
        try {
            $connection_string = 'mysql:host=localhost;dbname=foodblog;charset=utf8';
            $connection_array = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            $this->db = new PDO($connection_string, USER, PASSWORD, $connection_array);
            // echo 'Database connection established';
        } catch (PDOException $e) {
            $this->db = null;
        }
    }
}
