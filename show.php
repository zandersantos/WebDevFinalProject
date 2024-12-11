

<?php
require('connect.php');
  

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Fetch product details
    $query = "SELECT * FROM Products WHERE product_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    

    $query2 = "SELECT * FROM Images WHERE product_id = :id";
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':id', $id, PDO::PARAM_INT);

    $statement2->execute();
    $image = $statement2->fetch();  
    
    $statement->execute();
    $product = $statement->fetch();
}
else{
    $id = false;
 }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title><?="{$product['product_name']}"?> - Product</title>
<body>
    <header class="header">
        <div class="text-center">
            <h1>Product Details</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>
    <main class="container py-1">
        <?php if ($id): ?>
            <h1 class="product-name"><?=$product['product_name']?></h1>  
            <p class="product-description">
                    <?=$product['description']?>

               </p>
               <a href="updatepages.php?id=<?= $product['product_id']?>" class="blog-post-edit">edit</a>
               
               <img src="images/<?= $image['image_name'] ?>" alt="Uploaded Image">
        <?php else: ?>
            <p>No product found. <a href="index.php">Return to the homepage</a>.</p>
        <?php endif; ?>

        

    </main>
    
    <?php include('footer.php'); ?>
</body>
</html>