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
        global $dsn, $user, $password;

        if (self::$_instance == NULL)
            self::$_instance = new self($dsn, $user, $password);
        return self::$_instance;
    }
    /**
     * Initialisation de notre singleton et de son instance PDO
     * Privée puisque qu'il ne doit pas y avoir plusieur instances
     * @see getInstance()
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
     * On ne clone pas un singleton
     */
    private function __clone() {}


    /**
     * Délegue toutes les méthodes à notre instance PDO
     *
     * @param  String $method
     * @param  Array  $args
     * @return Mixed
     */
    public function __call($method, $args) {
        return call_user_func_array(array($this->_pdo, $method), $args);
    }

}

/**
 * Vérifie si le prédicat est valide pour tous les membres du tableau
 * @param $array
 * @param $predicate
 * @return bool
 */
function all($array, $predicate) {
    return array_filter($array, $predicate) === $array;
}