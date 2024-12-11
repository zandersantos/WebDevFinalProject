<?php session_start() ?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>A Simple Example Of PHP CAPTCHA Script </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>A Simple Example Of PHP CAPTCHA Script</h1>
<?php  
if(isset($_POST["captcha"]))  
if($_SESSION["captcha"]==$_POST["captcha"])  
{  
    //CAPTHCA is valid; proceed the message: save to database, send by e-mail …  
    echo '<div class="alert alert-success">CAPTHCA is valid; proceed the message</div>';  
}  
else  
{  
    echo '<div class="alert alert-danger">CAPTHCA is not valid; ignore submission</div>';  
}  
?>
<form role="form" method="post">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd">
  </div>
   <div class="form-group">
    <div class="col-sm-5 pull-left"><label for="pwd">Anti Spam code, Please Enter 3 Black Symbols</label>
    <img src="captcha.php" alt="captcha image"></div>
	<div class="col-sm-7 pull-right"><input type="text" name="captcha" size="3″ maxlength="3″ class="form-control"></div>
  </div>
  <div class="form-group" style="padding-top:75px;">
	<button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
</body>
</html>