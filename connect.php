<?php
     define('DB_DSN', 'mysql:host=localhost;dbname=criticalcomponents;charset=utf8');
     define('DB_USER','webdevuser');
     define('DB_PASS','2024');     
     
    //  PDO is PHP Data Objects
    //  mysqli <-- BAD. 
    //  PDO <-- GOOD.
    try {
        // Try creating new PDO connection to MySQL.
        $db = new PDO(DB_DSN,DB_USER,DB_PASS);
        //,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
        // When deploying to production you should handle this
        // situation more gracefully. ¯\_(ツ)_/¯
    }

    /*try {
        
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    
        $sql = "SHOW TABLES";  
    
        $stmt = $db->query($sql);
    
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        if ($tables) {
            echo "<h2>Tables in the database:</h2>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>" . $table . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No tables found!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }*/
    ?>
 