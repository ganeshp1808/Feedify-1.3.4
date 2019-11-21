<?php 
@session_start();
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['username'] and $_SESSION['college_id']){
include("includes/database.php");
?>
<!DOCTYPE HTML>
<html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>
	.ops
	{
		margin-top:150px;
		background-color:#a3d48a;
	}
	@media only screen and (max-width:700px){
		h3{font-size:1rem;}
	}
</style>	
<title>Payment Page</title>
<link rel="stylesheet" media="all" />
</head>
<body>
<div class="container ops">
<br><br>
	<h1 style='text-align:center;color:red;'>Oops!!!!</h1>
	<br><br>
	<h3 style='text-align:center;'>It seems you have <b>NOT</b> Completed Payment Status after registering for this product!</h3>
	<h3 style='text-align:center;'>Please contact us to complete the payment and you can use this product with ease.</h3>
	<h3 style='text-align:center;'>Go to the Home page where you have registered and then head to the 'Contact Us' section to Complete Payment.</h3>
<br><br>
</div>
</body>
</html>
<?php
}
else{
	echo "<script>window.open('login','_self')</script>";
} 
?>