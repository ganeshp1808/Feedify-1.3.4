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
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
echo"<title>View Feedback-$college</title>";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="animate.css">
	<link rel="stylesheet" href="admin_area/t/admin_panel.css">
	<link rel="stylesheet"  media="all" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
</head>
<body>
<a style='color:yellow;margin-left:50px;margin-top:50px;' class='btn' href='college_page?name=<?php echo $college ?>'><b>Logout</b></a></li>
	<section id='secondsection'>
		<div class='container text-center'><br><br>
			<h1>Get Results</h1><br>
			<h3>Select Department</h3>
			<form method="post">
				<div class='container'>
					<select class="form-control" name="current_dep">
										<option value="">Select Department</option>
															<?php
														$get_cats="select * from departments ";
														$run_cats=mysqli_query($con,$get_cats);
														while($row_cats=mysqli_fetch_array($run_cats))
														{
															
															$my_sem=$row_cats['dept_name'];
														echo"<option value='$my_sem'>".$my_sem."</option>";
														}
														?></select>
					<br><br>
					<input type="submit" class='btn btn-primary' name='enter_entries' value='Enter Department'/>
				</div>
			</form>
		</div>
	<?php
	if(isset($_POST['enter_entries']))
	{
		$dept=$_POST['current_dep'];
		$get_data="select * from teachers where department='$dept' and feedback='Yes'";
		$run_data=mysqli_query($con,$get_data);
		$i=0;
		echo"<h1 align='center'>Welcome to $dept Department</h1><br><br>";
		?>
		<h1 align='center'>Feedback given Teachers</h1><br><br>
		<table width="90%" class="table-responsive-sm" border="5" align='center' bgcolor='#6699FF'>
						<tr>
							<th>Sr No</th>
							<th>Teacher Id</th>
							<th>Name</th>
							<th>Department</th>
							<th>Class</th>
							<th>Username</th>
							<th>Password</th>
							<th>Subject</th>
							<th>Feedback Value</th>
							<th>Teaching Feedback</th>
							<th>Feedback by Students</th>
						</tr>
			<?php
			while($college_got=mysqli_fetch_array($run_data))
				{
					$i++;
					$teacher_id=$college_got['teacher_id'];
					$teacher_des=$college_got['designation'];
					$teacher_name=$college_got['name'];
					$teacher_department=$college_got['department'];
					$teacher_class=$college_got['class'];
					$teacher_username=$college_got['teacher_username'];
					$teacher_password=$college_got['teacher_password'];
					$teacher_subject=$college_got['subject'];
					$stat_1=$college_got['feed_value'];
					$pot=$college_got['teaching'];
					$pit=$college_got['student_feedback'];
					echo"
					<tr align='center' bgcolor='#78f5cb' text-align='center'>
						<td>$i</td>
						<td>$teacher_id</td>
						<td><b>$teacher_des$teacher_name<b></td>
						<td>$teacher_department</td>
						<td>$teacher_class</td>
						<td>$teacher_username</td>
						<td>$teacher_password</td>
						<td>$teacher_subject</td>
						<td><b>$stat_1</b></td>
						<td><b>$pot</b></td>
						<td><b>$pit</b></td>
					</tr>";
			}echo"</table><br><br>";
			$get_data="select * from teachers where department='$dept' and feedback='No'";
		$run_data=mysqli_query($con,$get_data); ?>
	<h1 align='center'>Feedback not given Teachers</h1><br><br>
		<table width="90%" class="table-responsive-sm" border="5" align='center' bgcolor='#6699FF'>
						<tr>
							<th>Sr No</th>
							<th>Teacher Id</th>
							<th>Name</th>
							<th>Department</th>
							<th>Class</th>
							<th>Username</th>
							<th>Password</th>
							<th>Subject</th>
							<th>Feedback Value</th>
							<th>Teaching Feedback</th>
							<th>Feedback by Students</th>
						</tr>
			<?php
				while($college_got=mysqli_fetch_array($run_data))
				{
					$i++;
					$teacher_id=$college_got['teacher_id'];
					$teacher_des=$college_got['designation'];
					$teacher_name=$college_got['name'];
					$teacher_department=$college_got['department'];
					$teacher_class=$college_got['class'];
					$teacher_username=$college_got['teacher_username'];
					$teacher_password=$college_got['teacher_password'];
					$teacher_subject=$college_got['subject'];
					$stat_1=$college_got['feed_value'];
					$pot=$college_got['teaching'];
					$pit=$college_got['student_feedback'];
					echo"
					<tr align='center' bgcolor='#78f5cb' text-align='center'>
						<td>$i</td>
						<td>$teacher_id</td>
						<td><b>$teacher_des$teacher_name<b></td>
						<td>$teacher_department</td>
						<td>$teacher_class</td>
						<td>$teacher_username</td>
						<td>$teacher_password</td>
						<td>$teacher_subject</td>
						<td><b>$stat_1</b></td>
						<td><b>$pot</b></td>
						<td><b>$pit</b></td>
					</tr>";
			}echo"</table><br><br>";
	}  
	}
else{
	echo "<script>window.open('login','_self')</script>";
} ?>