<?php
@session_start;
$con=mysqli_connect("localhost","root","");
error_reporting(0);
ini_set('display_errors', 0);	
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
	<link rel="stylesheet" href="feed/back.css">
<title>Register</title>
</head>
<style>
.hiden
{
	display:none;
}
</style>
<body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<section id="registerbox"><br><br>
		<h1 class="text-center">Sign Up</h1><br><br>
	<form id="form"  method="post" autocomplete="off">
		<div class="row">
			<div class="col-lg-6 col-sm-12">
				<select class="form-control pon" name="institution_type" required>
										<option value="">Select Type</option>
										<option value="School">School</option>
										<option value="College">College</option>
										<option value="Personal Class">Personal Class</option>
				</select></div><br>
			<div class="col-lg-6 col-sm-12">
				<input class="form-control pin" type="text" name="institution_name" placeholder="Enter Name Of Institution" required="required" />
				<p class="impo">Enter Name exactly as you want it to appear on Institution panel.</p>
				</div>
			</div><br>
		<div class="row">
			<div class="col-lg-6 col-sm-12">
				<input class="form-control pam" type="text" name="address" placeholder="Enter Address Of Institution" required="required" />
				<p class="impo">Enter Address exactly as you want it to appear on Institution panel.</p>
			</div><br>
			<div class="col-lg-6 col-sm-12">
				<input class="form-control pon" type="text" name="location" placeholder="Enter Location Of Institution" required="required" />
				<p>Eg:- Vashi,Bandra.</p>
			</div>
		</div>
			<br>
		<div class="row">
			<div class="col-lg-4 col-sm-12">
			<select class="form-control" name="city" required>
			<option value="">Select City</option>
										<option value="Mumbai">Mumbai</option>
										<option value="Navi Mumbai">Navi Mumbai</option>
										<option value="Banglore">Banglore</option>
										<option value="New Delhi">New Delhi</option>
										<option value="Kolkata">Kolkata</option>
										<option value="Chennai">Chennai</option>
			</select>
			</div><br>
			<div class="col-lg-4 col-sm-12">
			<select class="form-control" name="state" required>
			<option value="">Select State</option>
										<option value="Maharastra">Maharastra</option>
										<option value="Karnataka">Karnataka</option>
										<option value="Delhi">Delhi</option>
										<option value="West Bengal">West Bengal</option>
										<option value="Tamil Nadu">Tamil Nadu</option>
			</select>
			</div><br>
			<div class="col-lg-4 col-sm-12">
			<input class="form-control " type="number" name="zipcode" placeholder="Enter Zipcode" required="required" />
			</div>
		</div><br><br>
		<div class="row">
			<div class="col-lg-4 col-sm-12">
			<input  class="form-control" type="text" name="username" placeholder="Enter Username" required="required" />
			<p class="impo">This is the common Username for the Institution.</p>
			</div><br>
			<div class="col-lg-4 col-sm-12">
			<input id="passwor" class="form-control" type="password" name="password" placeholder="Password" required="required" />
			<p class="impo">This is the common Password for the Institution.</p>
			</div><br>
			<div class="col-lg-4 col-sm-12">
			<input  id="verify" class="form-control" type="password" name="again_password" placeholder="Password Again" required="required" />
			<span id="match" class="hiden" style="color:red;float:left;">Password Not Matching</span>
			</div>
		</div><br><br>
		<div class="row">
			<div class="col-lg-6 col-sm-12">
			<input class="form-control" type="type" name="admin_panel_username" placeholder="Enter Admin Username" required="required" />
			<p class="impo">This is the Username of the Admin of the Institution.</p><br>
			</div><br>
			<div class="col-lg-6 col-sm-12">
			<input class="form-control" type="password" name="admin_panel_password" placeholder="Enter Admin Password" required="required" />
			<p class="impo">This is the Password for Admin of the Institution.</p><br>
			</div>
		</div>
		<div align="center">
			
			<input  align='center' type="submit" data-toggle="modal" data-target="#exampleModalLong" name="register" class="btn" value="Register" />
	</form>
	</section>
	<script>
	$(document).ready(function() {
		$('#verify').keyup(function() {
			if($(this).val()==$('#passwor').val()) {
				$('#match').addClass('hiden'); }
			else
			{
				$('#match').removeClass('hiden'); }
		});
	});
	</script>
</body>
</html>	
<?php
$unique_number=rand(1000000,9999999);
			if(isset($_POST["register"])){
				$type=htmlspecialchars($_POST['institution_type'],ENT_QUOTES);
				$institution_name=htmlspecialchars($_POST['institution_name'],ENT_QUOTES);
				$address=htmlspecialchars($_POST['address'],ENT_QUOTES);
				$location=htmlspecialchars($_POST['location'],ENT_QUOTES);
				$city=htmlspecialchars($_POST['city'],ENT_QUOTES);
				$state=htmlspecialchars($_POST['state'],ENT_QUOTES);
				$zipcode=htmlspecialchars($_POST['zipcode'],ENT_QUOTES);
				$username=htmlspecialchars($_POST['username'],ENT_QUOTES);
				$password=htmlspecialchars($_POST['password'],ENT_QUOTES);
				$again_password=htmlspecialchars($_POST['again_password'],ENT_QUOTES);
				$admin_panel_username=htmlspecialchars($_POST['admin_panel_username'],ENT_QUOTES);
				$admin_panel_password=htmlspecialchars($_POST['admin_panel_password'],ENT_QUOTES); 
				$data_name=$username.$unique_number;
				$data_name = str_replace('-', '', $data_name); 
				$data_name = str_replace('.', '', $data_name); 
				$data_name = preg_replace('/[^A-Za-z0-9\-]/', '',$data_name);
				
					$make_database='CREATE DATABASE '.$data_name.'';
					$run_database=mysqli_query($con,$make_database);
					$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}}
?>
<?php
if(isset($_POST["register"]))
	{
	
		$make_table="create table details (type varchar(100),college_id int(255),name varchar(255),address varchar(255),location varchar(255),city varchar(255),state varchar(255),pincode int(10),username VARCHAR(255),security_pin varchar(255),again_security_pin varchar(255),admin_panel_username varchar(255),admin_panel_password varchar(255),doj timestamp)";
		$run_table=mysqli_query($con,$make_table);
		$insert_data="insert into details (type,college_id,name,address,location,city,state,pincode,username,security_pin,again_security_pin,admin_panel_username,admin_panel_password,doj) values ('$type','$unique_number','$institution_name','$address','$location','$city','$state','$zipcode','$username','$password','$again_password','$admin_panel_username','$admin_panel_password',NOW())";
		$run_data=mysqli_query($con,$insert_data);
		$teacher_table="create table teachers (teacher_id int(255),designation varchar(255),name varchar(255),department varchar(255),no_of_class int(100),class varchar(255),teacher_username varchar(255),teacher_password varchar(255),teacher_email varchar(255),subject varchar(255),feedback varchar(10),feed_value FLOAT(4,2),teaching varchar(255),student_feedback varchar(255))";
		$run_teacher=mysqli_query($con,$teacher_table);
		$student_table="create table students (roll_no int(255),name varchar(255),department varchar(255),class varchar(255),student_username varchar(255),student_password varchar(255),feedback varchar(10))";
		$run_student=mysqli_query($con,$student_table);
		$dept_table="create table departments (dept_id int(10),dept_name varchar(100),dept_email varchar(255))";
		$run_dept=mysqli_query($con,$dept_table);
		$sem_table="create table semester (sem_name varchar(50))";
		$run_sem=mysqli_query($con,$sem_table);
		$status_table="create table event_status (event varchar(50),status varchar(50))";
		$run_status=mysqli_query($con,$status_table);
		$button_make="create table button_panel_code (code int(6))";
		$run_button=mysqli_query($con,$button_make);
		$make_main="create table main_people (dept_id int(10),dept_name varchar(100),panel_name varchar(100),panel_username varchar(100),panel_password varchar(100))";
		$run_main=mysqli_query($con,$make_main);
		$subs_table="create table subscription (active_date varchar(100),end_date varchar(100))";
		$run_subs=mysqli_query($con,$subs_table);
		$create_exam="create table exams (exam_name varchar(100),maximum_marks int(255))";
		$run_exam=mysqli_query($con,$create_exam);
		$status_3="insert into event_status (event,status) values ('Attendance Entry','No')";
		$run_status_3=mysqli_query($con,$status_3);
		$status_4="insert into event_status (event,status) values ('Teachers Feedback','No')";
		$run_status_4=mysqli_query($con,$status_4);
		$status_5="insert into event_status (event,status) values ('Students Feedback','No')";
		$run_status_5=mysqli_query($con,$status_5);
					if(((((($run_table and $run_data) and $run_teacher) and $run_dept) and $run_sem) and $run_status) and $run_button){
						echo"<script>alert('Registered Succesfully !!!')</script>";
						echo"<script>window.open('index','_self')</script>"; }
				else{ echo"<script>alert('Registration Failed')</script>";
						echo"<script>
							var p1=document.getElementsByName('password');
							var p2=document.getElementsByName('again_password');
							var p3=document.getElementById('match');
							if(p1!=p2)
							{
								p3.textContent='Password Not Matching';
							}
							else if(p1==p2)
							{
								p3.textContent='';
							}</script>";				}
				}
				
					
				

?>
<?php
$con=mysqli_connect("localhost","root","","feedback");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
if(isset($_POST["register"])){
					$insert_pot="insert into institutions (type,college_id,name,address,location,city,state,pincode,username,security_pin,again_security_pin,admin_panel_username,admin_panel_password,payment_status,doj,database_name) 
					values ('$type','$unique_number','$institution_name','$address','$location','$city','$state','$zipcode','$username','$password',
					'$again_password','$admin_panel_username','$admin_panel_password','No',NOW(),'$data_name')";
					$run_pot=mysqli_query($con,$insert_pot);
				
}
?>