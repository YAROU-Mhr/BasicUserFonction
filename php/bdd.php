<?php 
    try {
        $bdd = new PDO('mysql:host=localhost; dbname=zdelph; charset=utf8','root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
       die('la connexion a échoué:'.$e->getMessage());
    }
