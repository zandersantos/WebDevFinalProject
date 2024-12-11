<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Product Creation Page

    Client Comment: This is the Product Creation page for Critical Components Admins. 
    
    This page allows users to create and submit new products to the "Products" table in the database. It features a form for inputting product details, including:
   - Product Name (Title)
   - Category (Dropdown populated dynamically from the "Categories" table)
   - Quantity (Numeric)
   - Price (Numeric)
   - Description (Text)
   - Optional File Upload (Image or PDF)

    The page dynamically fetches category options from the database, ensuring an up-to-date list.
    Navigation and footer elements are included from reusable PHP files for consistency across the site.
    Form fields include validation requirements to enhance user experience and ensure data integrity.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->
<?php
// * The admin.php file is used to ensure only authorized users can access this page. See "admin.php" for further details.*
require('admin.php');

// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
require('connect.php');

// * Handle form submission and validate input. *
if($_POST && !empty($_POST['title']) && !empty($_POST['content'])&& !empty($_POST['quantity'])&& !empty($_POST['price'])&& !empty($_POST['price'])&& !empty($_POST['category']))
    {
        //!Filters and Sanitizes all data that is needed to attach to the database!
        $title = filter_input(INPUT_POST,'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST,'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $quantity = filter_input(INPUT_POST,'quantity', FILTER_SANITIZE_NUMBER_INT);
        $price = filter_input(INPUT_POST,'price', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST,'category', FILTER_SANITIZE_NUMBER_INT);
        
        //!Inserts a new Product!
        $query = "INSERT INTO Products (product_name, description,quantity,price,category_id) VALUES (:title, :content, :quantity, :price, :category)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':category', $category);
        
        //!Changes header location to be the index once product is created!
        header("Location: index.php?{$id}");
        exit;
    }
    // * Fetch categories for the dropdown menu. *  
    $queryCategories = "SELECT category_id, category_name FROM Categories"; 
    $statementCategories = $db->prepare($queryCategories);
    $statementCategories->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title>Welcome to the Critical Components Product Creation!</title>

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
            <h1>Product</h1>
        </div>
    </header>

    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>

    <!-- *Main content section with the product creation form* -->
     <!-- !The main section contains "forms" for each product column. They can be removed and added depending on the product needs. ! -->
    <main class = "container py-1" id="create-post">
        <form action="post.php" method ="POST"enctype="multipart/form-data">
            <h2>New Product</h2>
            <!-- *Input field for the product title (name) *-->
            <div class="form-group">
                <label for ="title">Product Name</label>
                <input type = "text" name = "title" id = "title" minlength="1" required>
            </div>
            <!-- *Dropdown for selecting product category *-->
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select Category</option>
                    <?php while ($row = $statementCategories->fetch()): ?>
                        <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!-- *Input field for the product quantity* -->
            <div class="form-group">
                <label for ="quantity">Quantity</label>
                <input type = "text" name = "quantity" id = "quantity" minlength="1" required>
            </div>   

            <!-- *Input field for the product price *-->
            <div class="form-group">
                <label for ="Price">Price</label>
                <input type = "text" name = "price" id = "price" minlength="1" required>
            </div>

            <!-- *File input for uploading an image or PDF related to the product. See "show.php" to see more details about image uploading.* -->
            <div class="form-group">
                <label for="image">Image or PDF Filename:</label>
                <input type="file" name="image" id="image">
            </div>

            <!-- *Textarea for the product description* -->
            <div class="form-group">
                <label for ="content">Description</label>
                <textarea name = "content" id = "content" cols = "30" rows = "10" minlength="1" required></textarea>
            </div>

            <!-- Submit button to create the new product -->
            <button type = "submit" class = "button-primary">Submit Product</button>
        </form>
    </main>
    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
     <?php include('footer.php'); ?>

</body>
</html>