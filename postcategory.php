<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Category Creation Page

    Client Comment: This is the Category Creation page for Critical Components. 
    It allows the admin to create and submit new categories for products in the "Categories" table of the database. 
    The page features a form for inputting category details, including:
   - Category Name
   - Category Description

    The page ensures smooth data entry and allows admins to efficiently add new categories. 
    Navigation and footer elements are included from reusable PHP files for consistency across the site.
    Form fields are validated to improve the user experience and data accuracy.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->
<?php
// * The admin.php file is used to ensure only authorized users can access this page. See "admin.php" for further details.*
require('admin.php');

// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
require('connect.php');

// * Handle form submission and validate input. *
if($_POST && !empty($_POST['title']) && !empty($_POST['content']))
    {
        //!Filters and Sanitizes all data that is needed to attach to the database!
        $title = filter_input(INPUT_POST,'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST,'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //!Inserts a new Category!
        $query = "INSERT INTO Categories (category_name, description) VALUES (:title, :content)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
       
        //!Changes header location to be the index once category is created! 
        header("Location: index.php?{$id}");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title>Welcome to the Critical Components Category Creation!</title>

    <!-- *Specifies the character encoding and ensures the website supports special characters* -->
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- *Links the main.css file to style the page visually. See "main.css" for further details.*-->
    <link rel="stylesheet" href="basic.css">

    <!-- *Ensures the page looks good on mobile devices by enabling responsive design* -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <!--*The header section will contain the main header / page title.* -->
    <header class="header">
        <div class="text-center">
            <h1>Category</h1>
        </div>
    </header>

    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>

    <!-- !The main section contains "forms" for each category column. They can be removed and added depending on the category needs. ! -->
    <main class = "container py-1" id="create-post">
        <form action="postcategory.php" method ="POST"enctype="multipart/form-data">
            <h2>New Category</h2>

            <!-- *Input field for the category title (name) *-->
            <div class="form-group">
                <label for ="title">Category Name</label>
                <input type = "text" name = "title" id = "title" minlength="1" required>
            </div>

            <!-- *Textarea for the product description* -->
            <div class="form-group">
                <label for ="content">Description</label>
                <textarea name = "content" id = "content" cols = "30" rows = "10" minlength="1" required></textarea>
            </div>

            <!-- Submit button to create the new category -->
            <button type = "submit" class = "button-primary">Submit Category</button>

    </main>

    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
     <?php include('footer.php'); ?>

</body>
</html>