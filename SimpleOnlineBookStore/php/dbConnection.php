<?php

class DbConnection
{
    private $db;
    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "simpleonlinebookstore");
        if ($this->db->connect_error) {
            die("Error in connection: " . $this->db->connect_error);
        }
    }

    public function getconnection()
    {
        return $this->db;
    }
    public function closeConnection()
    {
        $this->db->close();
    }
}
?>