<?php

class User {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
        echo $this->db->connect() . "<br>";
    }

    public function getName() {
        return "Esther";
    }
}
