<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

$mail_hand = new class_mail_handler();

$mail_hand->setup_parameters("prikenze.zenze@gmail.com","Prikenze","Test342","<h3>Prikenze sto se dogada</h3>","tinmodric@yahoo.com","Tin","Bolesno");

echo $mail_hand->send_mail();