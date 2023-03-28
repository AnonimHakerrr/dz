<?php
$user="root";
$pass="";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=pd018;port=3306', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}