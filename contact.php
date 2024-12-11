<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Contact Page

    Client Comment: This is the Contact Page for Critical Components.
    This page allows users to fill out a contact form with their information, 
    including their name, phone number, email, and comments. 
    The form provides validation to ensure correct data is entered.
    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->
<?php
require('connect.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <!-- *This is the Title for your page. This will appear in the URL* -->
    <title>Critical Components</title>

    <!-- *Specifies the character encoding and ensures the website supports special characters* -->
    <meta charset="UTF-8">

     <!-- *Links the main.css file to style the page visually. See "main.css" for further details.*-->   
    <link rel="stylesheet" type="text/css" href="basic.css">

     <!-- *Ensures the page looks good on mobile devices by enabling responsive design* -->   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--* This connects the contact page with the contact javascript page which is used for the validation of proper data being inserted. See contactp4.js for more details.*-->
    <script src="contactp4.js"></script>

</head>

<body>
    <!--*The header section will contain the main header / page title.* -->
    <header class="header">
        <div class="text-center">
            <h1>Contact Us</h1>
        </div>
    </header>

    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>

    <article>
        <div class="mainsectiontitle">
            <h1>Contact</h1>
        </div>


         <!-- * This section contains the contact form where users can enter their details. * -->
<!-- ! The div class contactinfo was created for basic Contact Info. Added information can be added or removed through the <li> tags.!  -->
         <div class="contactinfo">
            <form id="contactForm">
                <ul>
                    <!-- * Field for the user to enter their full name. The error message displays 
                    if the field is left empty. * -->
                    <li>
                        <label for="fullname">Full Name</label>
                        <input id="fullname" name="fullname" type="text"/>
                        <p class="contactError error" id="fullname_error" style="display: none;">* Required field</p>
                    </li>

                    <!-- * Field for the user to enter their phone number. The first error message 
                    displays if the field is left empty, and the second appears if the format is invalid. * -->
                    <li>
                        <label for="phone">Phone Number</label>
                        <input id="phone" name="phone" type="text"/>
                        <p class="contactError error" id="phone_error" style="display: none;">* Required field</p>
                        <p class="contactError error" id="phone_error2" style="display: none;">* Invalid Phone Number</p>
                    </li>

                    <!-- * Field for the user to enter their email address. The first error message 
                    displays if the field is left empty, and the second appears if the format is invalid. * -->
                    <li>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="text"/>
                        <p class="contactError error" id="email_error" style="display: none;">* Required field</p>
                        <p class="contactError error" id="email_error2" style="display: none;">* Invalid Email</p>
                    </li>

                    <!-- * Field for the user to add comments or messages. * -->
                    <li>
                        <label for="comment">Comments</label>
                        <textarea id="comment" name="comment" rows="6" cols="50"></textarea>
                    </li>
                </ul>
                 <!-- * Button to submit the form. * -->
                <button type="submit" class="submitbutton">Submit</button>
                <button type="reset" class="resetbutton">Reset</button>
            </form>
        </div>
    </article>
</body>
    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
<?php include('footer.php'); ?>


</html>