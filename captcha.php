<!--------w------------
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Review CAPTCHA page

    Client Comment: This is the Review CAPTCHA for Critical Components. 
    This page generates 3 random letters to be used as a captcha.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
---------------------->
<?php
function generateRandomString($length = 3) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$captchaText = generateRandomString(3);
$_SESSION['captcha'] = $captchaText;

echo $captchaText;
?>
