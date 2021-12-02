<?php
include_once 'Database/Parametres.php';
$admins_list = array('admin');


class Database
{
    private static $_instance;
    private $_pdo;

    /**
     * Initialise une connexion à la BDD
     *
     */
    public static function getInstance(): Database
    {
        $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=cds;';
        $user = 'root';
        $password = 'enes57';

        if (self::$_instance == NULL)
            self::$_instance = new self($dsn, $user, $password);
        return self::$_instance;
    }
    /**
     * Creates new DB wrapping a PDO instance
     *
     * Constructor is private because this class can't be instantiated.
     *
     */
    private function __construct($dsn, $user, $password){
        try {
            $this->_pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * Singletons may not be cloned
     */
    private function __clone() {}


    /**
     * Delegate every method call to PDO instance
     *
     * @param  String $method
     * @param  Array  $args
     * @return Mixed
     */
    public function __call($method, $args) {
        return call_user_func_array(array($this->_pdo, $method), $args);
    }

}

/*
function Database(): PDO
{
    {
        return new PDO('mysql:host=127.0.0.1;port=3306;dbname=cds;', 'enes', 'enes57');
    }
}*/