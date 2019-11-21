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
    <link rel="stylesheet" href="feed/login.css">
<?php
	$college_time=$_SESSION['username'];
	$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college=$college_name['name'];
	echo"<title>Main Login Panel-$college</title>";
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
<link rel="stylesheet" media="all" />
<style>
body
	{
		background-color:#c3e30b;
		background-repeat:no-repeat;
	background-size:cover;
	height:100%;
	
	}
	.form-control
{
	background-color:#b0e8d9;
	border-radius:20px;
}
#loginbox h1
{
	color:black;
}
#loginbox
{
	text-align:center;
	background:radial-gradient(#259602,#02966c);
	width:40%;
	margin:auto;
	margin-top5%;
	border-radius:10%;
	box-shadow:2px
}
@media only screen and (max-width:790px){
		#loginbox
	{
		width:80%;
		border-radius:0%;
	}
	.form-control
	{
		width:70%;
	}
}
</style>
</head>
<body>
<a style='color:black;margin-left:30px;margin-top:30px;width:200px;' class='btn' href='college_page?name=<?php echo $college ?>'><b>Go To Main Page</b></a>
	<div id="loginbox">
	<br><br>
		<h1 style='text-align:center;'>Main Result Login</h1>
		<br><br>
		<form align='center' method="post">
			<input class="form-control" type="text" name="panel_username" placeholder="Enter Username" required="required" />
			<span id="user"></span>
			<br><br>
			<input class="form-control" type="password" name="panel_password" placeholder="Enter Password" required="required" />
			<span id="pass"></span>
			<br><br>
			<button  type="submit" class="btn btn-primary " name="login">Login</button>
		</form>
	</div>
</body>
</html>
<?php 
if(isset($_POST['login'])){
	$user_name = $_POST['panel_username'];
	$user_pass = $_POST['panel_password'];
	$sel_teacher = "select * from main_people where panel_username='$user_name' AND panel_password='$user_pass'";
	$run_teacher = mysqli_query($con, $sel_teacher);	
	$check_teacher = mysqli_num_rows($run_teacher);
	$college_name=mysqli_fetch_array($run_teacher);
	$college=$college_name['panel_name'];
	if($check_teacher>0){
		echo "<script>window.open('main_results?$college','_self')</script>";
		}
	else{ echo"<script>
				var p1=document.querySelector('#user');
				var p2=document.querySelector('#pass');
				p1.textContent='Invalid Username';
				p2.textContent='Incorrect Password';
			</script>";	
}
}
}
else{
	echo "<script>window.open('login','_self')</script>";
} 
?>