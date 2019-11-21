<?php 
@session_start();
//displays no error on the web page
if($_SESSION['username'] and $_SESSION['college_id']){
include("includes/database.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="feed/animate.css">
    <link rel="stylesheet" href="feed/college_page.css">
<?php
$user_name=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sele_teacher = "select * from institutions where username='$user_name' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$rune_teacher = mysqli_query($con,$sele_teacher); 
$college_name=mysqli_fetch_array($rune_teacher);
$type=$college_name['type'];
$address=$college_name['address'];
$location=$college_name['location'];
$city=$college_name['city'];
$state=$college_name['state'];
$zipcode=$college_name['pincode'];
$admin_user=$college_name['admin_panel_username'];
$admin_pass=$college_name['admin_panel_password'];
echo"<title>$college</title>";
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
	<link rel="stylesheet" media="all" />
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
</head>
<?php
$check_subs="select * from subscription";
$run_subs=mysqli_query($con,$check_subs);
$row_subs=mysqli_fetch_array($run_subs);
$number_sub=mysqli_num_rows($run_subs);
$what_date=$row_subs['end_date'];
$cur_date = strtotime("+0 day", time());$now_datep=date('M d, Y', $cur_date);
if(($cur_date>$what_date) and ($number_sub>0))
	{ ?>
	<div class='container text-center'>
		<h1>Your Subcription has ended please renew the subscription.</h1>
		<section id='secondsection'>
		<div id="form" class='container' align='center'>
			<form method="post">
			<h3>If you want to renew your subcription, enter button panel security pin.</h3>
				<br><br>
					<input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    maxlength = "6" type="number" name="button_number" placeholder="Enter Button Panel Code" required="required" /><br>
					<span style='color:red;' id="p"></span>
					<br><br>
					<button  type='submit' class='btn btn-primary' name='final'>Submit</button>
			</form>
		</div>
		<section>
	</div>
<?php

		if(isset($_POST['final']))
		{
			$number=$_POST['button_number'];
			$sel_number="select * from button_panel_code";
			$run_number=mysqli_query($con,$sel_number);
			$row_number=mysqli_fetch_array($run_number);
			$want=$row_number['code'];
				if($want==$number){
				echo"<div class='container text-center'>
					<h1>Before renewing subcription download data of students and teachers so that you have your data with you ,once you renew your subsription your data will be lost.</h1>
					<a href='get_file?name=$college' class='btn'>Get Your Data</a>
					<h3>Do you want to renew your subcription?</h3>
					<form method='post'>
						<button  type='submit' class='btn-success' name='yes'>Yes</button>
						<button  type='submit' class='btn-warning' name='no'>No</button>
					</form>
				</div>";
			}
			else if($want!=$number){
				echo"<script>var p1=document.getElementsById('p');
				p1.textContent='Incorrect Number';</script>";
			}
		}
	}
	if(isset($_POST['yes'])){
		$renew_subs="update details set doj='NOW()'";
		$run_renew=mysqli_query($con,$renew_subs);
			$sql = "SHOW TABLES IN $data_name";
				$result = $con->query($sql);
					$i=0;
				while($row=mysqli_fetch_array($result)){
					$poin=$row[$i];
					$run_delete=mysqli_query($con,"drop table $poin");
				}
		$run_table=mysqli_query($con,"create table details (type varchar(100),college_id int(255),name varchar(255),address varchar(255),location varchar(255),city varchar(255),state varchar(255),pincode int(10),username VARCHAR(255),security_pin varchar(255),again_security_pin varchar(255),admin_panel_username varchar(255),admin_panel_password varchar(255),doj timestamp)");
		$run_data=mysqli_query($con,"insert into details (type,college_id,name,address,location,city,state,pincode,username,security_pin,again_security_pin,admin_panel_username,admin_panel_password,doj) values ('$type','$college_id','$college','$address','$location','$city','$state','$zipcode','$user_name','$user_pass','$user_pass','$admin_user','$admin_pass',NOW())");
		$run_teacher=mysqli_query($con,"create table teachers (teacher_id int(255),designation varchar(255),name varchar(255),department varchar(255),no_of_class int(100),class varchar(255),teacher_username varchar(255),teacher_password varchar(255),teacher_email varchar(255),subject varchar(255),feedback varchar(10),feed_value FLOAT(4,2),teaching varchar(255),student_feedback varchar(255))");
		$run_student=mysqli_query($con,"create table students (roll_no int(255),name varchar(255),department varchar(255),class varchar(255),student_username varchar(255),student_password varchar(255),student_email varchar(255),feedback varchar(10))");
		$run_dept=mysqli_query($con,"create table departments (dept_id int(10),dept_name varchar(100),dept_email varchar(255))");
		$run_sem=mysqli_query($con,"create table semester (sem_name varchar(50))");
		$run_status=mysqli_query($con,"create table event_status (event varchar(50),status varchar(50))");
		$run_button=mysqli_query($con,"create table button_panel_code (code int(6))");
		$run_main=mysqli_query($con,"create table main_people (dept_id int(10),dept_name varchar(100),panel_name varchar(100),panel_username varchar(100),panel_password varchar(100))");
		$run_subs=mysqli_query($con,"create table subscription (active_date varchar(100),end_date varchar(100))");
		$run_exam=mysqli_query($con,"create table exams (exam_name varchar(100),maximum_marks int(255))");
		$run_status_3=mysqli_query($con,"insert into event_status (event,status) values ('Attendance Entry','No')");
		$run_status_4=mysqli_query($con,"insert into event_status (event,status) values ('Teachers Feedback','No')");
		$run_status_5=mysqli_query($con,"insert into event_status (event,status) values ('Students Feedback','No')");
		include("includes/database.php");
		$renew_sub="update institutions set doj=NOW(),payment_status='No' where name='$college' and college_id='$college_id' and username='$user_name' and admin_panel_username='$admin_user'";
		$run_popit=mysqli_query($con,$renew_sub);
		echo "<script>alert('Your Subcription has been renewed.')</script>";
			echo "<script>window.open('index','_self')</script>";
	}
	else if(isset($_POST['no']))
	{
		echo "<script>window.open('index','_self')</script>";
	}
else if(($number_sub==0) or ($cur_date<=$what_date)){
		$dep_status="select count(dept_name) as 'val1' from departments";
		$run_dep=mysqli_query($con,$dep_status);
		$row_dep=mysqli_fetch_array($run_dep);
		$count_dep=$row_dep['val1'];
		$sem_status="select count(sem_name) as 'val2' from semester";
		$run_sem=mysqli_query($con,$sem_status);
		$row_sem=mysqli_fetch_array($run_sem);
		$count_sem=$row_sem['val2'];
		$exam_status="select count(exam_name) as 'val3' from exams";
		$run_exam=mysqli_query($con,$exam_status);
		$row_exam=mysqli_fetch_array($run_exam);
		$count_exam=$row_exam['val3'];
		if($count_dep==0)
		{
			echo "<script>window.open('get_started?name=$college','_self')</script>";
		}
		else if($count_dep>0 and $count_sem==0)
		{
			echo "<script>window.open('enter_semester?name=$college','_self')</script>";
		}
		else if(($count_dep>0 and $count_sem>0) and $count_exam==0){ echo "<script>window.open('add_exams?name=$college','_self')</script>"; }
else {
?>
<body style="background-image:url('image/college.jpg');background-repeat:no-repeat;background-size:cover;">
	<header id="firstsection">
		<nav class="navbar fixed-top navbar-expand-lg">
			<a class="navbar-brand" href="college_page?name=<?php echo $college_pat; ?>">Feedify</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav"><li class="nav-item active"><a class="nav-link" href="college_page?name=<?php echo $college_pat; ?>">HOME <span class="sr-only">(current)</span></a></li></ul>
				<form class="form-inline my-2 my-lg-0">
					<a class="btn" href='logout' type="submit">Go to Welcome Page</a>
				</form>
			</div>
		</nav>
	</header>
	<section id='secondsection' >
	<br><br><br>
		<div class='container text-center'>
		<?php
			$type=$college_name['type'];
					$college=$college_name['name'];
					$address=$college_name['address'];
					$city=$college_name['city'];
					$state=$college_name['state'];
					$zipcode=$college_name['pincode'];
			echo"<h1 class='animated bounceInUp'>Type:$type</h1><br><br>
			<h1 class='display-3 animated bounceInUp'>Welcome To $college</h1><br><br>
			<h2 class='display-6 animated bounceInUp'>$address,$city,$state -$zipcode</h2>";
		?><br><br><br>
		<h4 style="color:white;">Experience Feedify at it's very best!</h4>
		<br><br><br>
		</div>
	</section>
	<section id="thirdsection">
	<br><br><br>
		<div class="container text-center">
			<h1>You can now access your account by clicking on Below Button.</h1><br><br>
			<div class="row justify-content-around">
				<div class="card mon" style='background-color:#9cf536;'>
					<img src="image/m.png" class="card-img-top" >
					<div class="card-body">
					<h1 class="card-text">HOD/<br>Principal<br> Login</h1>
						<a href='main_login' class='btn' role='button' aria-pressed='true'>Main Panel</a> 
					</div>
				</div>
			
				<div class="card tue" >
					<img src="image/admin.png" class="card-img-top" >
					<div class="card-body">
					<h1 class="card-text">Admin Login</h1>
						<a href='admin_area/admin_panel_login' class='btn' role='button' aria-pressed='true'>Admin Panel</a> 
					</div>
				</div>
			</div><br><br>
				<div class="row justify-content-around">
					<div class="card  wed">
						<img src="image/teacher.png" class="card-img-top" >
						<div class="card-body">
						<h1 class="card-text">Teacher Login</h1>
							<a class='btn' role='button' aria-pressed='true' href='teachers/teacher_login'>My Account</a>
						</div>
					</div>
					<div class="card  thurs">
						<img src="image/stu.png" class="card-img-top" >
						<div class="card-body ">
						<h1 class="card-text">Student Login</h1>
							<a class='btn' role='button' aria-pressed='true' href='students/student_login'>My Account</a>
						</div>
					</div>
				</div>
		</div>
		<br><br><br>
	</section>
</body>
</html>
	<?php
	}
}
}
else{
	echo "<script>window.open('login','_self')</script>";
} ?>