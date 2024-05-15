<?php
    
    $conn = new mysqli("localhost", "root", "", "dolgozok");
    
    if($conn -> errno)
    {
        echo 'Adatbázis HIBA!';
        die();
    }
    
    $conn -> set_charset("utf8");
