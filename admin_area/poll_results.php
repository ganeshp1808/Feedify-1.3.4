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
echo"<title>Poll Results-$college</title>";
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
	<link rel="stylesheet" href="t/admin_panel.css">
	<link rel="stylesheet"  media="all" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
</head>
<body>
<header>
		<nav class="navbar navbar-expand-lg fixed-top">
			  <a class="navbar-brand" href="../college_page?name=<?php echo $college ?>">Feedify</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				  <li class="nav-item active"><?php echo"<a class='nav-link' href='admin_panel?name=$college'>Home <span class='sr-only'>(current)</span></a>"; ?></li>
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add...</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php echo"<a class='dropdown-item' href='add_faculty?name=$college'>Add Faculty <span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='add_students?name=$college'>Add Students<span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='add_semester?name=$college'>Add Semester<span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='add_department?name=$college'>Add Departments<span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='add_main?name=$college'>Add HOD/Principal<span class='sr-only'>(current)</span></a>"; ?>
						</div>
					<li class="nav-item"><?php echo"<a class='nav-link' href='button_panel?name=$college'>Button Panel<span class='sr-only'>(current)</span></a>"; ?></li>
					<li class="nav-item"><?php echo"<a class='nav-link' href='poll_results?name=$college'>Poll Results<span class='sr-only'>(current)</span></a>"; ?></li>
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdow" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete...</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdow">
						<?php echo"<a class='dropdown-item' href='delete_student?name=$college'>Delete Student<span class='sr-only'>(current)</span></a>"; ?>
						<?php echo"<a class='dropdown-item' href='delete_class?name=$college'>Delete Class<span class='sr-only'>(current)</span></a>"; ?>
						<?php echo"<a class='dropdown-item' href='delete_main_people?name=$college'>Delete Main People<span class='sr-only'>(current)</span></a>"; ?>
						<?php echo"<a class='dropdown-item' href='delete_faculty?name=$college'>Delete Faculty<span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='delete_data?name=$college'>Delete Data<span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='delete_department?name=$college'>Delete Department<span class='sr-only'>(current)</span></a>"; ?>
							<?php echo"<a class='dropdown-item' href='delete_semester?name=$college'>Delete Semester<span class='sr-only'>(current)</span></a>"; ?>
						</div>
					<li class="nav-item"><a style='color:yellow;' class='nav-link' href='../college_page?name=<?php echo $college ?>'><b>Logout</b></a></li>
				</ul>
			  </div>
		</nav>
	</header>
	<section id='secondsection'>
		<div class='container text-center' >
			<h1>Track Users</h1>
			<h3>Select Department</h3>
			<form method="post">
				<div class='container'>
					<select class="form-control" name="current_dep" required>
										<option value="">Select Department</option>
															<?php
														$get_cats="select distinct dept_name from departments order by dept_name asc";
														$run_cats=mysqli_query($con,$get_cats);
														while($row_cats=mysqli_fetch_array($run_cats))
														{
															
															$my_sem=$row_cats['dept_name'];
														echo"<option value='$my_sem'>".$my_sem."</option>";
														}
														?></select>
					<br><br>
					<input type="submit" class='btn btn-primary' name='enter_entries' value='Enter'/>
				</div>
			</form>
		</div>
	<?php
	if(isset($_POST['enter_entries']))
	{
		$dept=$_POST['current_dep'];
		$select_head="select * from main_people where dept_name='$dept'";
		$run_head=mysqli_query($con,$select_head);
		?>
		<h1 align='center'>Main People</h1>
		<table class="table-responsive-sm" border="5" align='center' bgcolor='#6699FF'>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Password</th>
						</tr>
		<?php
		while($main_got=mysqli_fetch_array($run_head))
				{
					$main_name=$main_got['panel_name'];
					$main_username=$main_got['panel_username'];
					$main_password=$main_got['panel_password'];
					echo"
					<tr align='center' bgcolor='#6699FF' text-align='center'>
						<td>$main_name</td>
						<td>$main_username</td>
						<td>$main_password</td>
					</tr>";
			}echo"</table>";
		$get_data="select * from teachers where department='$dept' order by teacher_id asc";
		$run_data=mysqli_query($con,$get_data);
		$i=0;
	?>
		<h1 align='center'>Teachers</h1>
		<table class="table-responsive-sm" border="5" align='center' bgcolor='#6699FF'>
						<tr>
							<th>Sr No</th>
							<th>Teacher Id</th>
							<th>Name</th>
							<th>Department</th>
							<th>Class</th>
							<th>Username</th>
							<th>Password</th>
							<th>Subject</th>
							<th>Feedback</th>
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
					$stat_1=$college_got['feedback'];
					echo"
					<tr align='center' bgcolor='#6699FF' text-align='center'>
						<td>$i</td>
						<td>$teacher_id</td>
						<td>$teacher_des$teacher_name</td>
						<td>$teacher_department</td>
						<td>$teacher_class</td>
						<td>$teacher_username</td>
						<td>$teacher_password</td>
						<td>$teacher_subject</td>
						<td><b>$stat_1</b></td>
					</tr>";
			}echo"</table>";
	}
	?>
	<?php
	if(isset($_POST['enter_entries']))
	{
		$dept=$_POST['current_dep'];
		$get_dat="select * from students where department='$dept' order by roll_no asc";
		$run_dat=mysqli_query($con,$get_dat);
		$i=0;
		?>
		<h1 align='center'>Students</h1>
		<table class="table-responsive-sm" border="5" align='center' bgcolor='#6699FF'>
						<tr >
							<th>Sr No</th>
							<th>Roll No</th>
							<th>Name</th>
							<th>Department</th>
							<th>Username</th>
							<th>Password</th>
							<th>Feedback</th>
						</tr>
			<?php
			while($college_go=mysqli_fetch_array($run_dat))
				{
					$i++;
					$student_id=$college_go['roll_no'];
					$student_name=$college_go['name'];
					$student_department=$college_go['class'];
					$student_username=$college_go['student_username'];
					$student_password=$college_go['student_password'];
					$student_1=$college_go['feedback'];
					echo" <tr width='1000' align='center' bgcolor='#6699FF' text-align='center'>
						<td>$i</td>
						<td>$student_id</td>
						<td>$student_name</td>
						<td>$student_department</td>
						<td>$student_username</td>
						<td>$student_password</td>
						<td>$student_1</td>
					</tr>";
		}echo"</table><br><br>";
	}
	?>
</body>
</html>
<?php
						}
else{
	echo "<script>window.open('../login','_self')</script>";
}
 
?>