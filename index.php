<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Home  Page

    Client Comment: This is the Home page for Critical Components. 
    
    This page dynamically displays a list of all available products from the database. 
    Each product name is a clickable link that directs the user to a detailed view of that 
    product on a separate page (show.php). The page is styled using an external CSS file (main.css), 
    incorporates a responsive design, and utilizes a custom Google font for enhanced aesthetics. 
   
    It connects to a MySQL database using PDO (PHP Data Objects).
    Products listed are retrieved from the "Products" table in the database.
    Navigation and footer elements are included from separate reusable PHP files for consistency across the site.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->

<?php
// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
require('connect.php');

// * Fetch all products from the Products table to display on the homepage. *
$query_products = "SELECT * FROM Products"; // !SQL query to retrieve all products. !
$statement = $db->prepare($query_products); // ! Prepare the SQL query for execution. !
$statement->execute(); // ! Execute the prepared query. !

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title>Critical Components</title>

    <!-- *Specifies the character encoding and ensures the website supports special characters* -->
    <meta charset="UTF-8">    

    <!-- *Ensures the page looks good on mobile devices by enabling responsive design* -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- *Links the main.css file to style the page visually. See "main.css" for further details.*-->
    <link rel="stylesheet" type="text/css" href="basic.css">
    
</head>

<body>
    <!--*The header section will contain the main header / page title.* -->
    <header class="header">
        <div class="text-center">
            <h1>Critical Components</h1>
        </div>
    </header>

    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>

    <!-- * Main content area displaying the product list. * -->
    <main class="container py-1">

        <!-- * Title for the product section. * -->
        <h2>Product List</h2>

        <!-- ! Loop through each product fetched from the database. ! -->
        <?php while($row = $statement->fetch()): ?>
            <article class ="product-list">

                <!-- * Display each product's name as a link to its details page. * -->
                <h3 class=""product-list>
                    <!-- ! Display each product's image which can be changed in the "updatepages.php page! -->
                    <a href="show.php?id=<?= $row['product_id']?>"><?= $row['product_name'] ?></a>
                </h3>
            </article>
        <?php endwhile; ?>
    </main>

    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
    <?php include('footer.php'); ?>
</body>
</html>
