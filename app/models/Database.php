<?php

final class Database
{
    private static $instance = null;
    private $connection;
    private $driver;
    private $host;
    private $name;
    private $user;
    private $password;
    private $charset;
    private $options;

    private function __construct($db_driver, $db_host, $db_name, $db_user, $db_pass, $db_charset, $db_options)
    {
        try {
            $this->driver = $db_driver;
            $this->host = $db_host;
            $this->name = $db_name;
            $this->user = $db_user;
            $this->password = $db_pass;
            $this->charset = $db_charset;
            $this->options = $db_options;

            $this->connection = new PDO(
                "$this->driver:host=$this->host;dbname=$this->name;charset=$this->charset",
                $this->user,
                $this->password,
                $this->options
            );
        } catch (PDOException $e) {
            print "Ошибка подлкючения к базе данных: " . $e->getMessage();
            die();
        }

    }

    private function __clone() {

    }

    public static function getInstance($db_driver, $db_host, $db_name, $db_user, $db_pass, $db_charset, $db_options)
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database($db_driver, $db_host, $db_name, $db_user, $db_pass, $db_charset, $db_options);
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

}