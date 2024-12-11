<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components About Us Page

    Client Comment: This is the About Us page for Critical Components. 
    It explains who you are, what you offer, and invites visitors to join your gaming community. 
    Below, you will find detailed descriptions for each section of this page.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->
<?php
// * The connect.php file is used to include the database connection file to access the database. See "connect.php for further details." *
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

</head>
    
<body>
    <!--*The header section will contain the main header / page title.* -->
    <header class="header">
        <div class="text-center">
            <h1>About Critical Components</h1>
        </div>
    </header>

    <!-- *Includes the navigation menu from a separate file named nav.php. See "nav.php" for more details. *-->
    <?php include('nav.php'); ?>


<!--! The main section is used implement the About Us Paragraphs. <h2> and <p> tags are used to group them for the css styling that matches the other pages !-->
    <main>
        <!-- *Introduces Critical Components and its mission. This can be changed within the <p> (paragraph) section below.*-->
        <h2>Forge Your Destiny</h2>
        <p>Welcome to Critical Components, where your journey into the extraordinary begins. 
        Nestled in the heart of Winnipeg, Manitoba, our mission is to craft Dungeons & Dragons and tabletop gaming accessories that inspire creativity and bring your campaigns to life. 
        With every roll of the dice, we aim to spark the imagination and enhance the stories you weave around the table.</p>

        <!-- *Highlights the products offered and their unique features. This can be changed within the <p> (paragraph) section below.*-->
        <h2>A Cast of Magical Items</h2>
        <p>Our collection is more than just gaming tools—it’s a treasure trove of possibilities. From the radiant glow of our precision-engineered dice to the enchanting charm of our hand-crafted dice bags, every product is a testament to our commitment to quality and artistry. Whether you’re navigating ancient dungeons, forging alliances, or embarking on epic quests, our magical items are here to empower your gameplay and make every moment unforgettable.</p>

        <!-- *Invites visitors to join the gaming community. This can be changed within the <p> (paragraph) section below.* -->
        <h2>Join the Fellowship</h2>
        <p>At Critical Components, we believe that tabletop gaming is more than a pastime—it’s a community of storytellers and dreamers united by a love of adventure. By choosing us, you become part of a fellowship dedicated to exploring uncharted worlds, defeating formidable foes, and celebrating the camaraderie that gaming brings. Together, we’ll create memories as legendary as the quests we undertake.</p>

        <!-- *Offers an encouraging message to potential customers.  This can be changed within the <p> (paragraph) section below.* -->
        <h2>May the Dice Be Ever in Your Favor!</h2>
        <p>Whether you're a seasoned Dungeon Master or a new adventurer, we’re here to equip you with the tools to forge your own destiny. So gather your party, roll the dice, and let Critical Components guide you to greatness.</p>
        
    </main>

    <!-- *Includes the footer from a separate file named footer.php. See "footer.php" for more details. *-->
    <?php include('footer.php'); ?>
</body>

</html>