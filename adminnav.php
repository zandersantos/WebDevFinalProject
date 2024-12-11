<?php
require('connect.php');
require('admin.php');

// Fetch all products from the Products table
$query_products = "SELECT * FROM Products";
$statement = $db->prepare($query_products);
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Navigation</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&display=swap" rel="stylesheet">
    
</head>
<body>
    <header class="header">
        <div class="text-center">
            <h1>Admin Navigation</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>

    <main>
    <p>Here you can Create New Products or Categories! Individual Products can be edited on their Display Page!</p>


        <h3><a href="post.php">Create a New Product</a></h3>
        <h3><a href="postcategory.php">Create a New Category</a></h3>
        
        
    </main>
    <?php include('footer.php'); ?>
</body>
</html>
