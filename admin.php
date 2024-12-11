<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Administration Page

    Client Comment: This is the Administration Page for Critical Components.
    This is used for pages that only Administration can use. This includes the editing pages, product creation, and category creation.
    Below, you will find detailed descriptions for each section of this page.


    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->

<?php
//!The define statements are simply just placeholders. They can be changed whenever.!

// *Defines the admin username. Change 'matt' to your desired username if needed.*
  define('ADMIN_LOGIN','matt');

// *Defines the admin password. Change 'mercer' to your desired password if needed.*
  define('ADMIN_PASSWORD','mercer');

// *Checks if the user is already authenticated*
  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
      
      // *This will verify if the entered Password matches the defined admin Password above.*
      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)

      // *This will verify if the entered Username matches the defined admin Username above.*
      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {

    // *If the username or password is incorrect, it will prompt the user to enter valid credentials*
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Our Blog"');

    // *It will display an error message and exit if the authentication fails*
    exit("Access Denied: Username and password required.");

  }
  // *If the user enters the correct username and password, they gain access to the page*
?>