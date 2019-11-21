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
$college_name=mysqli_fetch_array($run_teacher);$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<!DOCTYPE HTML>
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
<title>Teacher Login-<?php echo $college ?></title>
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
<link rel="stylesheet" media="all" />
<style>
	body
	{
		background-color:#29638a;
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
	color:white;
}
#loginbox
{
	text-align:center;
	background:radial-gradient(#046eb5,black);
	width:40%;
	margin:auto;
	margin-top:5%;
	margin-bottom:15%;
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
<a style='color:yellow;margin-left:30px;margin-top:30px;width:200px;' class='btn' href='../college_page?name=<?php echo $college ?>'><b>Go To Main Page</b></a>
<body>
	<div id="loginbox">
	<br><br>
		<h1>Teacher Login</h1>
		<br><br>
		<form align='center'  method="post">
			<select  class="form-control" type="number" name="t_id"  required>
					<option value="">Select Teacher ID</option>
					<?php $get_cats="select distinct teacher_id from teachers order by teacher_id asc";
															$run_cats=mysqli_query($con,$get_cats);
															while($row_cats=mysqli_fetch_array($run_cats))
															{
																$my_roll=$row_cats['teacher_id'];
																
															echo"<option value='$my_roll'>".$my_roll."</option>";
															}
															?>
					</select><span style='color:red;float:left;margin-left:20%;' id="idipo"></span><br><br>
			<input class="form-control" type="text" name="teacher_username" placeholder="Username" required="required" />
			<span id="user"></span>
			<br><br>
			<input class="form-control" type="password" name="teacher_pass" placeholder="Password" required="required" />
			<span id="pass"></span>
			<br><br>
			<a href="teacher_password_change" align="center">Forgot Password?</a><br><br>
			<button  type="submit" class="btn" name="login">Login</button>
		</form>
	</div>
</body>
</html>
<?php 
if(isset($_POST['login']))
{
	$user_id=$_POST['t_id'];
	$user_name = $_POST['teacher_username'];
	$user_pass = $_POST['teacher_pass'];
	$sel_teacher = "select * from teachers where teacher_username='$user_name' AND teacher_password='$user_pass' and teacher_id='$user_id' and no_of_class='1'";
	$run_teacher = mysqli_query($con, $sel_teacher); 
	$check_teacher = mysqli_num_rows($run_teacher);
	$sel_teach = "select distinct department from teachers where teacher_username='$user_name' AND teacher_password='$user_pass' and teacher_id='$user_id'";
	$run_teach = mysqli_query($con, $sel_teach); 
	$check_teach = mysqli_num_rows($run_teach);
	$college_name=mysqli_fetch_array($run_teacher);
	$cor_pass=$college_name['teacher_password'];
	$teach_name=$college_name['name'];
	if($cor_pass==$user_pass){
		if($check_teach>0){
			$_SESSION['teacher_username']=$user_name ;
			$_SESSION['teacher_password']=$user_pass;
			$_SESSION['t_id']=$user_id;
			echo "<script>window.open('select_department?name=$teach_name','_self')</script>";
		}
	}
		else {
			echo "<script>
				var p3=document.querySelector('#idipo');
				var p1=document.querySelector('#user');
				var p2=document.querySelector('#pass');
				p1.textContent='Invalid Username';
				p2.textContent='Incorrect Password';
				p3.textContent='Invalid Teacher Id';
			</script>"; 
			}
		}
	
	}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>