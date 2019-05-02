<?php

require "configuration.php"; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

$mail_hand = new class_mail_handler();

$mail_hand->setup_parameters("vazno.wow@gmail.com","Tin","TEST 825","<h3>yoaloooo</h3>","tinmodric@yahoo.com","TIN","ALO");

echo $mail_hand->send_mail();