<?php

require('bdd.php');

session_start();
session_unset();
session_destroy();

echo "<script>alert('Déconnexion réussi')</script>";
header('refresh:.8; url=../../index.php');

?>