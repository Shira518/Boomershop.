<?php
$user = 'root';
$password = '6N8_hXunzF.JZKi';
$host = 'localhost';
$bdd = 'boomershop';

// Create connection
$bdd = mysqli_connect($host, $user, $password, $bdd);

// Check connection
if (!$bdd) {
    die("Connection failed: " . mysqli_connect_error());
}

?>