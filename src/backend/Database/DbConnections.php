<?php

namespace MyApp\Database;

require_once 'Config.php';

class DbConnections
{
    private $db_host = '';
    private $db_user = '';
    private $db_pass = '';
    private $db_name = '';
    private $connection;

    public function __construct()
    {
        $this->db_host = DBHOST;
        $this->db_user = DBUSER;
        $this->db_pass = DBPASSWORD;
        $this->db_name = DBNAME;
    }

    public function connect()
    {
        if (!$this->connection) {
            $this->connection = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
            return $this->connection;
        }

    }

    public function disconnect()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    public function getDatabaseName(): string
    {
        return $this->db_name;
    }
}
