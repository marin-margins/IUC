<?php

class class_db_setup
{
    public function get_db()
    {
        try {
            return new mysqli(DB_SERVER, DB_USER_NAME, DB_PASSWORD, DB_NAME);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
