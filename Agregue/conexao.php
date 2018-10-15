<?php

try{
        
        $con = new PDO('mysql:host=localhost;dbname=chatbo;charset=utf8', 'root', '');
        
    }
    catch(Exception $e){ 
        
        echo  "$e";
        
    } 
?>