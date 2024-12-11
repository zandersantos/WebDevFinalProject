<?php

/*******w******** 
    
    Name: Zander Santos
    Date:  September.27, 2024
    Description: Assignment 3 Blogs 
        - Is used for the Creation and Submittion of new blogs. Showcases a Title and Content. You can also go back to the home page through the navigation 
****************/

require('admin.php');
require('connect.php');

if($_POST && !empty($_POST['title']) && !empty($_POST['content'])&& !empty($_POST['quantity'])&& !empty($_POST['price'])&& !empty($_POST['price'])&& !empty($_POST['category']))
    {
        $title = filter_input(INPUT_POST,'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST,'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $quantity = filter_input(INPUT_POST,'quantity', FILTER_SANITIZE_NUMBER_INT);
        $price = filter_input(INPUT_POST,'price', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST,'category', FILTER_SANITIZE_NUMBER_INT);

        
        $query = "INSERT INTO Products (product_name, description,quantity,price,category_id) VALUES (:title, :content, :quantity, :price, :category)";

        $statement = $db->prepare($query);

        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':category', $category);

        if($statement->execute())
        {
            echo "Success";
        }
       
        header("Location: index.php?{$id}");
        exit;
    }

    $queryCategories = "SELECT category_id, category_name FROM Categories"; 
    $statementCategories = $db->prepare($queryCategories);
    $statementCategories->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to the Critical Components Product Creation!</title>
</head>
<body>
    <header class="header">
        <div class="text-center">
            <h1>Product</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>

    <main class = "container py-1" id="create-post">
        <form action="post.php" method ="POST"enctype="multipart/form-data">
            <h2>New Product</h2>
            <div class="form-group">
                <label for ="title">Product Name</label>
                <input type = "text" name = "title" id = "title" minlength="1" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select Category</option>
                    <?php while ($row = $statementCategories->fetch()): ?>
                        <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for ="quantity">Quantity</label>
                <input type = "text" name = "quantity" id = "quantity" minlength="1" required>
            </div>

            

            <div class="form-group">
                <label for ="Price">Price</label>
                <input type = "text" name = "price" id = "price" minlength="1" required>
            </div>

            <div class="form-group">
        <label for="image">Image or PDF Filename:</label>
        <input type="file" name="image" id="image">
    </div>
            

            <div class="form-group">
                <label for ="content">Description</label>
                <textarea name = "content" id = "content" cols = "30" rows = "10" minlength="1" required></textarea>
            </div>
            <button type = "submit" class = "button-primary">Submit Product</button>
        </form>
    </main>

     <?php include('footer.php'); ?>

</body>
</html>