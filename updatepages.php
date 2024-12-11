<?php
require('connect.php');
require('admin.php');

function file_upload_path($original_filename, $upload_subfolder_name = 'images') {
    $current_folder = dirname(__FILE__);
    
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
    
    return join(DIRECTORY_SEPARATOR, $path_segments);
 }

 function file_is_an_image($temporary_path, $new_path) {
     //application/pdf was added to include pdf (found through stackoverflow and then again through screencast)
     $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png', 'application/pdf'];
     
     //pdf was included
     $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png', 'pdf'];
     
     $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);

     //mime_content_type replaced getimagesize so it can also allow pdfs (found through stackoverflow and then again through screencast)
     $actual_mime_type        = mime_content_type($temporary_path);
     
     $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
     $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
     
     return $file_extension_is_valid && $mime_type_is_valid;
 }
 
 $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
 $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

 if ($image_upload_detected) { 
     $image_filename        = $_FILES['image']['name'];
     $temporary_image_path  = $_FILES['image']['tmp_name'];
     $new_image_path        = file_upload_path($image_filename);
     if (file_is_an_image($temporary_image_path, $new_image_path)) {
         move_uploaded_file($temporary_image_path, $new_image_path);
     }
 } 
if ($_POST && isset($_POST['title']) && isset($_POST['content'])&& isset($_POST['id'])  && !empty($_POST['title'])&& !empty($_POST['content'])&& !empty($_POST['price'])&& !empty($_POST['quantity'])&& !empty($_POST['category'])) {
    // Sanitize input data
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $product_id = $id;

    if (isset($_POST['command']) && $_POST['command'] == 'Delete') {
        // Delete quer
        $query = "DELETE FROM Images WHERE product_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $query = "DELETE FROM Products WHERE product_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $location = "index.php";
    }
    else if (isset($_POST['command']) && $_POST['command'] == 'Upload Image'){
        $query = "INSERT INTO Images (image_name, product_id) VALUES (:image_filename, :product_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(':image_filename', $image_filename);
        $statement->bindValue(':product_id', $product_id,PDO::PARAM_INT);
        

        $location = "index.php";
    }
    
    else{
        // Update query
        
        $query = "UPDATE Products SET product_name = :title, description = :content, price = :price, quantity = :quantity, category_id = :category WHERE product_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':price', $price, PDO::PARAM_STR);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':category', $category);

        

        $location = "index.php";
    }

    $statement->execute();

    header("Location: {$location}");
    exit; // Ensure script halts after redirect
} else if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Fetch product details
    $query = "SELECT * FROM Products WHERE product_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $product = $statement->fetch();

    $query2 = "SELECT * FROM Images WHERE product_id = :id";
    $statement2 = $db->prepare($query);
    $statement2->bindValue(':id', $id, PDO::PARAM_INT);

    
    



}
else{
    $id = false;
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
    <title>Edit this Product!</title>
</head>
<body>
    <header class="header">
        <div class="text-center">
            <h1>Product</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>
    
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
        <input type="submit" class="button-primary" name="command" value="Update Product">
        <input type="submit" class="button-primary-outline" name="command" value="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
    </form>

    <?php include('footer.php'); ?>

</body>
</html>