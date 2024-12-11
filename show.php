
<?php
require('connect.php');
  

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    
    

    // Fetch product details
    $query = "SELECT * FROM Products WHERE product_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    

    $query2 = "SELECT * FROM Images WHERE product_id = :id";
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':id', $id, PDO::PARAM_INT);

    $query3 = "SELECT * FROM Reviews WHERE product_id = :id";
    $statement3 = $db->prepare($query3);
    $statement3->bindValue(':id', $id, PDO::PARAM_INT);

   
   
  
    $statement3->execute();
   
    

    $statement2->execute();
    $image = $statement2->fetch();  
    
    $statement->execute();
    $product = $statement->fetch();
  
}
else{
    $id = false;
 }

if($_POST && isset($_POST['content']))
{
    $product_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (isset($_POST['command']) && $_POST['command'] == 'Add Review') {
        $query = "INSERT INTO Reviews (content, product_id) VALUES (:content, :product_id)";
        $statement4 = $db->prepare($query);
        $statement4->bindValue(':content', $content);
        $statement4->bindValue(':product_id', $product_id,PDO::PARAM_INT);
        

        $location = "index.php";
    }
    $statement4->execute();
    header("Location: {$location}");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <script src="reviewbox.js"></script>
    <title><?="{$product['product_name']}"?> - Product</title>
<body>
    <header class="header">
        <div class="text-center">
            <h1>Product Details</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>
    <main class="container py-1">
    <form method="POST">
        <?php if ($id): ?>
            <h1 class="product-name"><?=$product['product_name']?></h1>  
            <p class="product-description">
                    <?=$product['description']?>

               </p>
               <?php while($row = $statement3->fetch()): ?>
            <article class ="blog-post">
                <h3 class=""blog-post>
                <p><?= $row['content'] ?></p>
                </h3>
            </article>
        <?php endwhile; ?>
               <a href="updatepages.php?id=<?= $product['product_id']?>" class="blog-post-edit">edit</a>
               
               <img src="images/<?= $image['image_name'] ?>" alt="Uploaded Image">
        <?php else: ?>
            <p>No product found. <a href="index.php">Return to the homepage</a>.</p>
        <?php endif; ?>

        <div class="form-group">
            <label for="review">Review</label>
            <textarea name="content" id="content" cols="5" rows="5" minlength="1" required></textarea>
        </div>
        
        <input type="submit" class="button-primary" name="command" value="Add Review">
        </form>

    </main>
    
    <?php include('footer.php'); ?>
</body>
</html>