<?php

$dbnew = new mysqli('localhost','vatroslav','70lk13n','iuc_new');

$dbold = new mysqli('localhost','vatroslav','70lk13n','iuc_old');

$tables = $dbnew->query("SHOW TABLES");

foreach($tables as $k=>$v){
    var_dump($v['Tables_in_iuc_new']);
    $dbnew->query("DELETE FROM ".$v['Tables_in_iuc_new']);
    $dbnew->query("ALTER TABLE ".$v['Tables_in_iuc_new'] . " AUTO_INCREMENT = 1");
    echo $dbnew->error;
}


