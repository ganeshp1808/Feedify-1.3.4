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
?>
<!DOCTYPE HTML>
<html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="animate.css">
	<link rel="stylesheet" href="feed/login.css">
<title>Change Password Panel</title>
<link rel="stylesheet" media="all" />
</head>
<style>
body
{
font-family:Calibri;
background:linear-gradient(#ffab2e,#c9f005);

}
h1
{
	color:white;
}
#loginbox
{
	background:rgba(23, 24, 26);
}
.btn
{
	height:70px;
	width:200px;
}
.hiden
{
	display:none;
}
</style>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<section id="loginbox">
	<h1 class="display-4">Change Password</h1>
	<br><br>
    <form align='center' method="post">
		<br><br>
    	<input  class="form-control" type="text" name="username" placeholder="Username" required="required" />
		<span id="user"></span>
        <br><br>
		<input id="passwor" class="form-control" type="password" name="pass" placeholder="Enter New Password" required="required" />
        <br><br>
		<input id="verify" class="form-control" type="password" name="again_pass" placeholder="Password Again" required="required" />
		<span id="match" class="hiden" style="color:red;">Password Not Matching</span>
        <br><br>
		<br><br>
		<button  type="submit" class="btn" name="login">Change Password</button>
    </form>
</section>
<script>
	$(document).ready(function() {
		$('#verify').keyup(function() {
			if($(this).val()==$('#passwor').val()) {
				$('#match').addClass('hiden');
			}
			else
			{
				$('#match').removeClass('hiden');
			}
		});
	});
	</script>
</body>
</html>
<?php 
if(isset($_POST['login']))
{
	$user_name = $_POST['username'];
	$user_pass = $_POST['pass'];
	$pass_again=$_POST['again_pass'];
	$up_teacher = "update institutions set admin_panel_password='$pass_again' where admin_panel_username='$user_name' and name='$college' and college_id='$college_id' ";
	$run_up = mysqli_query($con, $up_teacher); 
	$sel_teacher = "select * from institutions where admin_panel_username='$user_name' and name='$college' and college_id='$college_id'";
	$run_teacher = mysqli_query($con,$sel_teacher); 
	$row=mysqli_fetch_array($run_teacher);
	$data_name=$row['database_name'];
				$con=mysqli_connect("localhost","root","","$data_name");
				if (!$con){
					die("Connection failed: ".mysqli_connect_error());
				}
				$upon_teacher="update details set admin_panel_password='$pass_again' where admin_panel_username='$user_name' and name='$college' and college_id='$college_id'";
	$run_upon = mysqli_query($con, $upon_teacher);
	if($run_up and $run_upon)
	{
		echo "<script>window.open('admin_area/admin_panel_login.php','_self')</script>";
	}
	else
	{
		echo"<script>
				var p1=document.querySelector('#user');
				p1.textContent='Invalid Username';
			</script>";
	}
}
}
else{
	echo "<script>window.open('login','_self')</script>";
}
?>