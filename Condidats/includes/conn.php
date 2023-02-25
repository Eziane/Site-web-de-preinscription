<?php

try{
    $conn = new PDO("mysql:host=localhost;dbname=preinscreption", "root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
}
?>