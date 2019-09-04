<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 20/12/2018
 * Time: 05:51 PM
 */

class Database
{
    private $_connection;
    private static $_instance; //The single instance
/*    private $_host = "localhost";
    private $_username = "root";
    private $_password = "root";
    private $_database = "tinta";*/

    private $_host = "db770780097.hosting-data.io";
    private $_username = "dbo770780097";
    private $_password = "Muukstudio1!!";
    private $_database = "db770780097";


    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if(!self::$_instance) // If no instance then make one
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    public function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username,$this->_password, $this->_database);
        $this->_connection->set_charset("utf8");
        // Error handling
        if(mysqli_connect_error())
        {
            trigger_error("Failed to conect to MySQL: " . mysql_connect_error(),E_USER_ERROR);
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }

    // Get mysqli connection
    public function getConnection()
    {
        return $this->_connection;
    }

    public function get_data($sql)
    {
        $ret = array('STATUS'=>'ERROR','ERROR'=>'','DATA'=>array());

        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);

        if($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();

        while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
            $ret['DATA'][] = $row;
        }
        return $ret;
    }

    public function exec($sql)
    {
        $ret = array('STATUS'=>'ERROR','ERROR'=>'');

        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);

        if($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();

        return $ret;
    }

}