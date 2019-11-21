<?php 
@session_start(); 
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['username'] and $_SESSION['college_id']){
include("includes/database.php");
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<!DOCTYPE HTML>
<html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../feed/login.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>Student Login</title>
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
<link rel="stylesheet" media="all" />
</head>
<style>
	body
	{
		background-color:#040b0d;
		background-repeat:no-repeat;
	background-size:cover;
	height:100%;
	
	}
	.form-control
{
	background-color:#b0e8d9;
	border-radius:20px;
}

#loginbox
{
	text-align:center;
	background:radial-gradient(#1ae2ed,#000000);
	width:40%;
	margin:auto;
	margin-top:5%;
	border-radius:10%;
}
@media only screen and (max-width:790px){
		#loginbox
	{
		width:80%;
	}
	.form-control
	{
		width:70%;
	}
}
</style>
<a style='color:yellow;margin-left:30px;margin-top:30px;width:200px;' class='btn' href='../college_page?name=<?php echo $college ?>'><b>Go To Main Page</b></a>
<body>
	<div id="loginbox">
	<br><br>
		<h1 style='text-align:center;'>Student Login</h1>
		<br><br>
		<form align='center'  method="post">
			<input class="form-control" type="text" name="student_username" placeholder="Username" required="required" />
			<span id="user"></span>
			<br><br>
			<input class="form-control" type="password" name="student_pass" placeholder="Password" required="required" />
			<span id="pass"></span>
			<br><br>
			<button  type="submit" class="btn btn-primary " name="login">Login</button>
		</form>
	</div>
</body>
</html>
<?php 
if(isset($_POST['login']))
{
	$user_name = $_POST['student_username'];
	$user_pass = $_POST['student_pass'];
	$sel_teacher = "select * from students where student_username='$user_name' AND student_password='$user_pass'";
	$run_teacher = mysqli_query($con, $sel_teacher); 
	$check_teacher = mysqli_num_rows($run_teacher);
	$college_name=mysqli_fetch_array($run_teacher);
	$teach_name=$college_name['name'];
	if($check_teacher>0){
		$_SESSION['student_username']=$user_name ;
		echo "<script>window.open('student_account?name=$teach_name','_self')</script>";
		}
		else {
			echo "<script>
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