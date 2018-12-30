<?php
/*
* Mysql database class - only one connection alowed
*/

namespace Database;

use mysqli;
/**
 * Class database
 */
class Database {
    /**
     * @var mysqli
     */
    private $_connection;
    /**
     * @var
     */
    private static $_instance; //The single instance
    /**
     * @var string
     */
    private $_host = DBSERVER;
    /**
     * @var string
     */
    private $_username = DBUSER;
    /**
     * @var string
     */
    private $_password = DBPASSWORD;
    /**
     * @var string
     */
    private $_database = DBNAME;
    /*
    Get an instance of the Database
    @return Instance
    */
    /**
     * @return database
     */
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor

    /**
     * database constructor.
     */
    public function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);
        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(),
                E_USER_ERROR);
        }
        mysqli_set_charset($this->_connection,DBCHARSET);
    }

    /**
     *
     */
    public function __destruct() {
        $this->_connection->close();
    }
    // Magic method clone is empty to prevent duplication of connection

    /**
     *
     */
    private function __clone() { }
    // Get mysqli connection

    /**
     * @return mysqli
     */
    public function getConnection() {
        return $this->_connection;
    }

    /**
     * @param $sql
     * @return bool|statement
     */
    public function query($sql){
        return $this->_connection->query($sql);
    }

    /**
     * @return bool|int|string
     */
    public function insertedID(){
        if(is_object($this->_connection)) return mysqli_insert_id($this->_connection);
        return false;
    }
}

