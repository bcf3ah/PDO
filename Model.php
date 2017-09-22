<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/22/2017
 * Time: 12:52 PM
 */

class Model
{
    private $handler;
    private $user = 'root';
    private $pwd = '';
    private $db_name = 'pdo_app';
    private $host = 'localhost';

    private $stmt;

    /**
     * Model constructor.
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

    public function query($query)
    {
        $this->stmt = $this->handler->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function lastInsertId()
    {
        return $this->handler->lastInsertId();
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }


}