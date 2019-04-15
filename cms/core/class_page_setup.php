<?php

class class_page_setup
{


    function __construct($page_title)
    {
        session_start();
        include_once ("database.php");
        build_header($page_title);
		
		
		return $conn;

    }

    function build_footer()
    {
        echo ' </div>
                    </div>
                    <script src="assets/js/jquery.min.js"></script>
                    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                    <script src="assets/js/Sidebar-Menu.js"></script>
                    </body>

            </html>';
    }

    function build_header($page_title)
    {
        $html = '<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>'.$page_title.'</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Sidebar-Menu-1.css">
    <link rel="stylesheet" href="assets/css/Sidebar-Menu.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"> <a href="glavni_izb.php">Home Page</a></li>

           <li> <a href="logout.php">Logout</a></li><li> </li>
        </ul>
    </div>
    <div class="page-content-wrapper">';

        echo $html;
    }
}