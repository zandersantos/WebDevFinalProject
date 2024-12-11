<?php

/*******w******** 
    
    Name: Zander Santos
    Date:  September.27, 2024
    Description: Assignment 3 Blogs 
        - Is used for the Creation and Submittion of new blogs. Showcases a Title and Content. You can also go back to the home page through the navigation 
****************/

require('admin.php');
require('connect.php');

if($_POST && !empty($_POST['title']) && !empty($_POST['content']))
    {
        $title = filter_input(INPUT_POST,'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST,'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $query = "INSERT INTO Categories (category_name, description) VALUES (:title, :content)";

        $statement = $db->prepare($query);

        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
       

        if($statement->execute())
        {
            echo "Success";
        }
       
        header("Location: index.php?{$id}");
        exit;
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to the Critical Components Category Creation!</title>
</head>
<body>
    <header class="header">
        <div class="text-center">
            <h1>Category</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>

    <main class = "container py-1" id="create-post">
        <form action="postcategory.php" method ="POST"enctype="multipart/form-data">
            <h2>New Category</h2>
            <div class="form-group">
                <label for ="title">Category Name</label>
                <input type = "text" name = "title" id = "title" minlength="1" required>
            </div>

            <div class="form-group">
                <label for ="content">Description</label>
                <textarea name = "content" id = "content" cols = "30" rows = "10" minlength="1" required></textarea>
            </div>
            <button type = "submit" class = "button-primary">Submit Category</button>

    </main>

     <?php include('footer.php'); ?>

</body>
</html>