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
// * The admin.php file is used to ensure only authorized users can access this page. See "admin.php" for further details.*
require('admin.php');

// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
require('connect.php');

// *Function to build the file upload path for images*
function file_upload_path($original_filename, $upload_subfolder_name = 'images') {
    // !Get the current directory of the script!
    $current_folder = dirname(__FILE__);
    
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
    
    // !Combines the directory path for uploading!
    return join(DIRECTORY_SEPARATOR, $path_segments);
 }

  // *Function to validate if the uploaded file is a valid image or PDF*
 function file_is_an_image($temporary_path, $new_path) {
     // !List of allowed MIME types and file extensions for images and PDFs!
     $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png', 'application/pdf'];
     $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png', 'pdf'];
     
     // !Get the file extension of the uploaded file!
     $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);

     // !Get the MIME type of the uploaded file!
     $actual_mime_type        = mime_content_type($temporary_path);
     
     // !Validate if the file extension and MIME type are allowed!
     $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
     $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
     
     // !Returns true if both are valid!
     return $file_extension_is_valid && $mime_type_is_valid;
 }
 // !Check if an image was uploaded and handle errors!
 $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
 $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

 //! If an image is uploaded successfully, move the file to the designated folder ("images")!
 if ($image_upload_detected) { 
     $image_filename        = $_FILES['image']['name'];
     $temporary_image_path  = $_FILES['image']['tmp_name'];
     $new_image_path        = file_upload_path($image_filename);
     if (file_is_an_image($temporary_image_path, $new_image_path)) {
         move_uploaded_file($temporary_image_path, $new_image_path);
     }
 } 
 // * Handle form submission and validate input. *
if ($_POST && isset($_POST['title']) && isset($_POST['content'])&& isset($_POST['id'])  && !empty($_POST['title'])&& !empty($_POST['content'])&& !empty($_POST['price'])&& !empty($_POST['quantity'])&& !empty($_POST['category'])) {
    //!Filters and Sanitizes all data that is needed to attach to the database!
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $product_id = $id;

    // !*Check if the command is equal to Delete *!  
    // *What happens when you click Delete*        
    if (isset($_POST['command']) && $_POST['command'] == 'Delete') {
        //!Deletes current Image!
        $query = "DELETE FROM Images WHERE product_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        //!Deletes current Product!
        $query = "DELETE FROM Products WHERE product_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        //!Changes header location to be the index once Delete button is clicked! 
        $location = "index.php";
    }
    // !*Check if the command is equal to Upload Image *!  
    // *What happens when you click Upload Image*        
    else if (isset($_POST['command']) && $_POST['command'] == 'Upload Image'){
        //!Uploads current Image!
        $query = "INSERT INTO Images (image_name, product_id) VALUES (:image_filename, :product_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(':image_filename', $image_filename);
        $statement->bindValue(':product_id', $product_id,PDO::PARAM_INT);
        
        //!Changes header location to be the index once Delete button is clicked! 
        $location = "index.php";
    }
    
    else{
        //!Updates the Current Product to fit the edited Product Columns!
        $query = "UPDATE Products SET product_name = :title, description = :content, price = :price, quantity = :quantity, category_id = :category WHERE product_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':price', $price, PDO::PARAM_STR);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':category', $category);

        //!Changes header location to be the index once Delete button is clicked! 
        $location = "index.php";
    }

    $statement->execute();

    header("Location: {$location}");
    exit; // !Ensure script halts after redirect!
    // * Handle form submission. *
} else if (isset($_GET['id'])) {
    //!Filters and Sanitizes all data that is needed to attach to the database!
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    //!Fetches the Product to be Edited!
    $query = "SELECT * FROM Products WHERE product_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $product = $statement->fetch();

    //!Fetches the Image to be Edited!
    $query2 = "SELECT * FROM Images WHERE product_id = :id";
    $statement2 = $db->prepare($query);
    $statement2->bindValue(':id', $id, PDO::PARAM_INT);

}
else{
    $id = false;
 }
//!Fetches all Categories!
 $queryCategories = "SELECT category_id, category_name FROM Categories"; 
 $statementCategories = $db->prepare($queryCategories);
 $statementCategories->execute();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title>Edit this Product!</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="basic.css">
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
    
    <!-- !The main section contains "forms" for each product column. They can be removed and added depending on the category needs. ! -->
    <form action="updatepages.php" method="POST" enctype="multipart/form-data">
        <h2>Edit this Product</h2>
        <input type="hidden" name="id" value="<?=$product['product_id']?>">

        <div class="form-group">
            <label for="product_name">Title</label>
            <input type="text" name="title" id="title" value="<?=$product['product_name']?>" minlength="1" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" value="<?=$product['price']?>" minlength="1" required>
        </div>

        <div class="form-group">
        <label for="image">Image or PDF Filename:</label>
        <input type="file" name="image" id="image">
        <input type="submit" class="button-primary" name="command" value="Upload Image">

    </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" id="quantity" value="<?=$product['quantity']?>" minlength="1" required>
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
            <label for="description">Description</label>
            <textarea name="content" id="content" cols="50" rows="15" minlength="1" required><?=$product['description']?></textarea>
        </div>
        <!-- Update button to edit the product -->
        <input type="submit" class="button-primary" name="command" value="Update Product">
        
        <!-- Delete button to delete product -->
        <input type="submit" class="button-primary-outline" name="command" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
    </form>

    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
    <?php include('footer.php'); ?>

</body>
</html>