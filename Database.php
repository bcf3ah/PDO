<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/22/2017
 * Time: 12:52 PM
 */

class Database
{
    private $handler;
    private $user = 'root';
    private $pwd = '';
    private $db_name = 'pdo_app';
    private $host = 'localhost';

    private $stmt;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        //set dsn for db
        $dsn = "mysql:host=".$this->host.";dbname=".$this->db_name;

        //set PDO options
        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->handler = new PDO($dsn, $this->user, $this->pwd, $options);
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }


}