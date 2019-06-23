<?php

$dbnew = new mysqli('localhost','vatroslav','70lk13n','iuc_new');
$dbold = new mysqli('localhost','vatroslav','70lk13n','iuc_old');

$rez = $db->query("SELECT i.name, c.id, i.webAddress, i.isMember, i.address,i.president, i.iucRep, i.financeContact, i.internationalContact, i.memberFrom, i.withdrawl, i.other FROM iuc_old.member_inst i
JOIN iuc_new.city c ON c.name = i.city");


