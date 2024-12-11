<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Connect Page

    Client Comment: This is the Connect Page for Critical Components.
    This page establishes a connection to the MySQL database using PDO (PHP Data Objects).

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->

<?php
     define('DB_DSN', 'mysql:host=localhost;dbname=criticalcomponents;charset=utf8');
     define('DB_USER','webdevuser');
     define('DB_PASS','2024');     
     
    // ! PDO is PHP Data Objects!
    // ! mysqli <-- BAD. !
    //  !PDO <-- GOOD.!
    try {
        // !Try creating new PDO connection to MySQL.!
        $db = new PDO(DB_DSN,DB_USER,DB_PASS);
        //!,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)!
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); //! Force execution to stop on errors.!
        // !When deploying to production you should handle this!
        // !situation more gracefully. ¯\_(ツ)_/¯!
    }

    ?>
 