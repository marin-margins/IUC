<?php
require_once './configuration.php';
class class_page_setup
{
    private $user_id;
    private $db_connection;

    function __construct($check_login = true)
    {
        session_start();

        if($check_login==true){
            $this->check_login();
        }
        $db_class = new class_db_setup();
        $this->db_connection = $db_class->get_db();
    }

    public function check_login(){




       if(!empty($_SESSION['user_id'])){

           $this->user_id =$_SESSION['user_id'];
       }else{
           header("Location: index.php");
       }
    }

    public function get_user_id(){
        return $this->user_id;
    }

    public function get_db_instance()
    {
        return $this->db_connection;
    }




}