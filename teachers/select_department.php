<?php
@session_start();
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['teacher_username'] ){
	include("includes/database.php");
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$run_teacher = mysqli_query($con,$sel_teacher); 
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="t/animate.css">
    <link rel="stylesheet" href="t/my_account.css">
<?php
$teacher_session=$_SESSION['teacher_username'];
$teacher_pass=$_SESSION['teacher_password'];
$teacher_id=$_SESSION['t_id'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
echo"<title>Select Department-$college_pat</title>";
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<style>
	body{background:black;}
	h1{color:white;margin-top:100px;}
	#sel_dep{margin-top:75px;}
	a{margin-top:20px;}
	.btn{color:#ff9012;}
</style>
</head>
<body>
<div class="container text-center">
<h1>Select Your Department</h1>
<div id="sel_dep">
<?php
 $sel_department = "select distinct department from teachers where teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id'";
$run_department = mysqli_query($con, $sel_department); 
while($college_department=mysqli_fetch_array($run_department)){
		$now_dep=$college_department['department'];
		?>
		<a href='my_account?name=<?php echo $college_pat ?>&dept=<?php echo $now_dep ?>' class='btn' ><?php echo"$now_dep"; ?></a><br>
		<?php
	}
?>
</div>
</div>
</body>
</html>
<?php
}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>