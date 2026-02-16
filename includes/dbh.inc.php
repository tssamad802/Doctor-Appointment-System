<?php
class database
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "doctor-appointment";
    public $conn;

    public function connection()
    {
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");

        return $this->conn;
    }
}
?>