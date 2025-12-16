<?php
class Database {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "latihan_oop");
        if ($this->conn->connect_error) {
            die("Koneksi gagal");
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }
}