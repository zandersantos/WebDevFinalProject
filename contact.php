<!--------w------------

    Project 4
    Name: Zander Santos
    Date: April. 18, 2024
    Description: Contact Page
    
    References used:
    https://wallpaperaccess.com/full/8201170.jpg
---------------------->
<?php

require('connect.php');



?>
<!DOCTYPE html>

<html lang="en">


<head>
    <title>Critical Components</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&display=swap" rel="stylesheet">
    <script src="contactp4.js"></script>
</head>
<header>
    <nav class = "headernav">
            <h1>Zander Santos</h1>

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>  
    </nav>
</header>
<body>
    <article>
        <div class="mainsectiontitle">
            <h1>Contact</h1>
        </div>
        <div class="contactinfo">
            <form id="contactForm">
                <ul>
                    <li>
                        <label for="fullname">Full Name</label>
                        <input id="fullname" name="fullname" type="text"/>
                        <p class="contactError error" id="fullname_error" style="display: none;">* Required field</p>
                    </li>
                    <li>
                        <label for="phone">Phone Number</label>
                        <input id="phone" name="phone" type="text"/>
                        <p class="contactError error" id="phone_error" style="display: none;">* Required field</p>
                        <p class="contactError error" id="phone_error2" style="display: none;">* Invalid Phone Number</p>
                    </li>
                    <li>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="text"/>
                        <p class="contactError error" id="email_error" style="display: none;">* Required field</p>
                        <p class="contactError error" id="email_error2" style="display: none;">* Invalid Email</p>
                    </li>
                    <li>
                        <label for="comment">Comments</label>
                        <textarea id="comment" name="comment" rows="6" cols="50"></textarea>
                    </li>
                </ul>
                <button type="submit" class="submitbutton">Submit</button>
                <button type="reset" class="resetbutton">Reset</button>
            </form>
        </div>
    </article>
</body>
<footer>
    <div class="footerlinks">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Inquiries</a></li>
        </ul>
    </div>    
</footer>

</html>