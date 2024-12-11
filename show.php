<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Display Specific Product Page

    Client Comment: This is the Display Specific Product page for Critical Components Admins. 
    
    This page displays the detailed information for a specific product selected by the user. It fetches product data from the database using the product ID passed in the URL and dynamically presents information such as:
    - Product Name (Title)
    - Product Description
    - Product Reviews (if available)
    - Associated Image(s) for the product

    The page allows users to view the details of a product, including its reviews and images. 
    It also provides an option to submit a review for the product, which is validated using a CAPTCHA to prevent spam.
    The page uses PHP to interact with the database and retrieve data for the selected product, including its reviews, images, and other details. 
    A form for submitting reviews is included, which will only be processed if the CAPTCHA validation is successful.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->
<?php
// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
require('connect.php');

// *Start the session to manage user sessions*
session_start();

// * Handle form submission. *
if (isset($_GET['id'])) {
    //!Filters and Sanitizes all data that is needed to attach to the database!
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //!Queries Product Information!
    $query = "SELECT * FROM Products WHERE product_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    //!Queries Image Information!
    $query2 = "SELECT * FROM Images WHERE product_id = :id";
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':id', $id, PDO::PARAM_INT);

    //!Queries Review Information!
    $query3 = "SELECT * FROM Reviews WHERE product_id = :id";
    $statement3 = $db->prepare($query3);
    $statement3->bindValue(':id', $id, PDO::PARAM_INT);
    $statement3->execute();
   
    //Executes and fetches the Image
    $statement2->execute();
    $image = $statement2->fetch();  
    
    //Executes and fetches the Product
    $statement->execute();
    $product = $statement->fetch();
  
}
else{
    $id = false;
 }

// * Handle form submission and validate input. *
if($_POST && isset($_POST['content']))
{
    //!Filters and Sanitizes all data that is needed to attach to the database!
    $product_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
    // !*Check if the review command is triggered and CAPTCHA validation is correct *!     
    if(isset($_POST['command']) && $_POST['command'] == 'Add Review'&&($_SESSION["captcha"]==$_POST["captcha"]))
    {
        // *Display success message if CAPTCHA is valid*
        echo '<div class="alert alert-success">CAPTHCA is valid; proceed the message</div>';  

        //!Inserts and creates a new Review!
        $query = "INSERT INTO Reviews (content, product_id) VALUES (:content, :product_id)";
        $statement4 = $db->prepare($query);
        $statement4->bindValue(':content', $content);
        $statement4->bindValue(':product_id', $product_id,PDO::PARAM_INT);
        
        //!Changes header location to be the index once category is created! 
        $location = "index.php";
        $statement4->execute();
        header("Location: {$location}");
    }
    else  
    {  
        // !Display error message if CAPTCHA is not valid!
        echo '<div class="alert alert-danger">CAPTHCA is not valid; ignore submission</div>';  
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title><?="{$product['product_name']}"?> - Product</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="basic.css">
    <!-- This Script is for the Review Box below. -->
    <script src="reviewbox.js"></script>
</head>
<body>
    <!--*The header section will contain the main header / page title.* -->
    <header class="header">
        <div class="text-center">
            <h1>Product Details</h1>
        </div>
    </header>
    
    <?php  
    // Additional PHP logic if required goes here.
    ?>
    
    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>

    <!-- !The main section contains "forms" for the product and its associated images and reviews. They can be removed and added depending on the category needs. ! -->
    <main class="container py-1">
    <!-- Form for adding a review to the product -->
     
    <form role="form" method="post">
        <?php if ($id): ?>
            <!-- Display product name -->
            <h1 class="product-name"><?= $product['product_name'] ?></h1>  
            
            <!-- Display product description -->
            <p class="product-description"><?= $product['description'] ?></p>
            
            <div class="product-details">
                <!-- Product Image -->
                <div class="product-image">
                    <img src="images/<?= $image['image_name'] ?>" alt="Uploaded Image">
                </div>
                <p>REVIEWS</p>
                <!-- Product Reviews on the right -->
                <div class="product-reviews">
                    <!-- Loop through and display all reviews for the product -->
                    <?php while($row = $statement3->fetch()): ?>
                        <article>
                            <p class="review-post"><?= $row['content'] ?></p>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
            
            <!-- Link to edit the product details -->
            <a href="updatepages.php?id=<?= $product['product_id']?>" class="blog-post-edit">edit</a>
            
        <?php else: ?>
            <p>No product found. <a href="index.php">Return to the homepage</a>.</p>
        <?php endif; ?>

        <!-- Review submission form -->
        <div class="form-group">
            <label for="review">Review</label>
            <textarea name="content" id="content" cols="5" rows="5" minlength="1" required></textarea>
        </div>

        <!-- CAPTCHA section for anti-spam validation -->
        <form method="post" action="validate.php">
        <label for="captcha">Enter the following letters: 
            <strong><?php include('captcha.php'); ?></strong>
        </label>
        <input type="text" name="captcha" id="captcha" required>
        <!-- Submit button for adding the review -->
        <input type="submit" class="button-primary" name="command" value="Add Review">
    </form>
</main>


    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
    <?php include('footer.php'); ?>
</body>
</html>

