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
$this_dep=$_GET['dept'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
echo"<title>My Account-$college_pat</title>";
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
	<style>
	.navbar-nav>li>a{
	line-height:1.3rem;}
.pop{font-size:0.9rem;}
</style>
</head>
<body>
	<header id="firstsection">
		<nav class="navbar fixed-top navbar-expand-lg">
			<a class="navbar-brand" href="../college_page?name=<?php echo $college ?>">Feedify</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item active"><a class="nav-link" href="my_account?name=<?php echo $college_pat ?>&dept=<?php echo $this_dep ?>">Home <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="insert_data?name=<?php echo $college_pat ?>&dept=<?php echo $this_dep ?>">Insert Marks</a></li>
					<li class="nav-item"><a class="nav-link" href="insert_attendance?name=<?php echo $college_pat ?>&dept=<?php echo $this_dep ?>">Insert Attendance</a></li>
					<li class="nav-item"><a class="nav-link" href="update_data?name=<?php echo $college_pat ?>&dept=<?php echo $this_dep ?>">Update Data</a></li>
					<li class="nav-item"><a class="nav-link" href="view_data?name=<?php echo $college_pat ?>&dept=<?php echo $this_dep ?>">View Data</a></li>
					<li class="nav-item"><a style='color:yellow;' class='nav-link' href='../college_page?name=<?php echo $college ?>'><b>Logout</b></a></li>
				</ul>
			</div>
		</nav>
	</header>
	<section id="secondsection" style="margin-top:150px;">
		<?php
				$get_teacher="select * from teachers where teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id' and no_of_class='1'";
				$run_teacher=mysqli_query($con, $get_teacher);
				$row_teacher =mysqli_fetch_array($run_teacher);
				$teacher_id=$row_teacher['teacher_id'];
				echo"<div class='container'>
						<h1 class='animated fadeInUp' style='animation-duration:2s;'>ID:$teacher_id</h1>
						<h1 style='text-decoration:underline;animation-duration:2s;' class='display-3 animated bounceInLeft'>Welcome To $this_dep Department</h1>
						<h1 class='display-3 animated bounceInRight' style='animation-duration:2s;'>Hi, $college_pat .</h1>";?>	
								<br><br>
								<h3>Simple Steps to follow:</p>
								<h6>1. Click on the link of operation you wish to perform.</h6>
								<h6>2. Enter the marks and attendance 	of the students.</h6>
								<h6>3. Then get the table of marks of students and click on Get Result.</h6>
								<h6>4. Then see your results in the form of feedback.</h6>
								<br><br><br><br><br><br><br><br>
							</div>
	</section>
	</body>
</html>
<?php 
}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>