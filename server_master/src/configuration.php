<?php
     /*
     PROJET: INNOVATION WEEK 2017 - NO NAME
     MAKER: Arnaud LEHERPEUR (Martient)
     DESCRIPTION: Service de modulation de calendrier en IOT.
     */
    
$ip_db = "";
$user_db = "";
$mdp_db = "";
$name_db = "";

function database_conect($ip_db, $user_db, $mdp_db, $name_db) {
    mysql_connect($ip_db, $user_db, $mdp_db);
    mysql_select_db($name_db);
}
database_connect($ip_db, $user_db, $mdp_db, $name_sb);
?>