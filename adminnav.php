<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Administration Page

    Client Comment: This is the Administration Navigation Page for Critical Components.
    This is used for product and category creation that only Administration can use. 
    Below, you will find detailed descriptions for each section of this page.


    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->

<?php
// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
require('connect.php');

// * The admin.php file is used to ensure only authorized users can access this page. See "admin.php" for further details.*
require('admin.php');

// * Fetches all products from the "Products" table in the database *
$query_products = "SELECT * FROM Products";
$statement = $db->prepare($query_products);
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title>Admin Navigation</title>

    <!-- *Specifies the character encoding and ensures the website supports special characters* -->
    <meta charset="UTF-8">

    <!-- *Links the main.css file to style the page visually. See "main.css" for further details.*-->
    <link rel="stylesheet" type="text/css" href="basic.css">

    <!-- *Ensures the page looks good on mobile devices by enabling responsive design* -->
    <meta name="viewport" content="width=device-width, initial-scale=1">    
</head>
<body>
    <!--*The header section will contain the main header / page title.* -->
    <header class="header">
        <div class="text-center">
            <h1>Admin Navigation</h1>
        </div>
    </header>

    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>

    <!--! The main section is used implement the About Us Paragraphs. <h3> and <p> tags are used to group them for the css styling that matches the other pages !-->
    <main>
    <!-- * Message for the admin user explaining the page functionality * -->
    <p>Here you can Create New Products or Categories! Individual Products can be edited on their Display Page!</p>

        <!-- * Links for creating new products or categories * -->
        <h3><a href="post.php">Create a New Product</a></h3>
        <h3><a href="postcategory.php">Create a New Category</a></h3>
   
    </main>

    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
    <?php include('footer.php'); ?>
</body>
</html>
