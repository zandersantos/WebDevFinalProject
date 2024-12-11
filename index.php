<?php
require('connect.php');

// Fetch all products from the Products table
$query_products = "SELECT * FROM Products";
$statement = $db->prepare($query_products);
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Critical Components</title>
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
            <h1>Critical Components</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>

    <main class="container py-1">
        <h2>Product List</h2>
        <?php while($row = $statement->fetch()): ?>
            <article class ="blog-post">
                <h3 class=""blog-post>
                    <a href="show.php?id=<?= $row['product_id']?>"><?= $row['product_name'] ?></a>
                </h3>
            </article>
        <?php endwhile; ?>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
