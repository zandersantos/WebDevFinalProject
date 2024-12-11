<!--------w------------

    Project 4
    Name: Zander Santos
    Date: April. 18, 2024
    Description: The About Page


    References for Images used:
    https://wallpaperaccess.com/full/8201170.jpg
    HTML <a target="_blank" href="https://icons8.com/icon/10246/html">HTML</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
    CSHARP <a target="_blank" href="https://icons8.com/icon/10256/cs">c sharp</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
    PYTHON <a target="_blank" href="https://icons8.com/icon/13441/python">Python</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
    JAVA <a target="_blank" href="https://icons8.com/icon/39854/javascript">JavaScript</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
    CSS <a target="_blank" href="https://icons8.com/icon/10236/css">CSS</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
    POSTGRES <a target="_blank" href="https://icons8.com/icon/38561/postgresql">postgres</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
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
    
</head>
    
<body>
    <header class="header">
        <div class="text-center">
            <h1>About Critical Components</h1>
        </div>
    </header>

    <?php include('nav.php'); ?>

    <main>
        <h2>Forge Your Destiny</h2>
        <p>Welcome to Critical Components, where your journey into the extraordinary begins. 
        Nestled in the heart of Winnipeg, Manitoba, our mission is to craft Dungeons & Dragons and tabletop gaming accessories that inspire creativity and bring your campaigns to life. 
        With every roll of the dice, we aim to spark the imagination and enhance the stories you weave around the table.</p>

        <h2>A Cast of Magical Items</h2>
        <p>Our collection is more than just gaming tools—it’s a treasure trove of possibilities. From the radiant glow of our precision-engineered dice to the enchanting charm of our hand-crafted dice bags, every product is a testament to our commitment to quality and artistry. Whether you’re navigating ancient dungeons, forging alliances, or embarking on epic quests, our magical items are here to empower your gameplay and make every moment unforgettable.</p>

        <h2>Join the Fellowship</h2>
        <p>At Critical Components, we believe that tabletop gaming is more than a pastime—it’s a community of storytellers and dreamers united by a love of adventure. By choosing us, you become part of a fellowship dedicated to exploring uncharted worlds, defeating formidable foes, and celebrating the camaraderie that gaming brings. Together, we’ll create memories as legendary as the quests we undertake.</p>

        <h2>May the Dice Be Ever in Your Favor!</h2>
        <p>Whether you're a seasoned Dungeon Master or a new adventurer, we’re here to equip you with the tools to forge your own destiny. So gather your party, roll the dice, and let Critical Components guide you to greatness.</p>
        
    </main>

    <?php include('footer.php'); ?>
</body>

</html>