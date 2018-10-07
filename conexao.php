<?php

try{
        
        $con = new PDO('mysql:host=localhost;dbname=sgm;charset=utf8', 'root', '');
        
    }
    catch(Exception $e){ 
        
        echo  "$e";
        
    } 
?>