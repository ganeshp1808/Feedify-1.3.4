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
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../feed/animate.css">
    <link rel="stylesheet" href="t/admin_panel.css">
<?php
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
echo"<title>Admin Panel-$college</title>";
?>
<link rel="stylesheet" media="all" />
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
			<div class="text-center">
				<?php
						$sel_teacher = "select * from institutions where username='$college_time'";
						$run_teacher = mysqli_query($con, $sel_teacher); 
						$college_name=mysqli_fetch_array($run_teacher);
						$type=$college_name['type'];
						$college=$college_name['name'];
						$address=$college_name['address'];
						$city=$college_name['city'];
						$state=$college_name['state'];
						$zipcode=$college_name['pincode'];
				echo"<h1 class='animated bounceInUp'>Type:$type</h1><br>
				<h1 class='display-3 animated bounceInUp'><span style='text-decoration:underline;'>Welcome To Admin Panel</span><br> $college<br></h1><br>
				<h2 class='display-6 animated bounceInUp'>$address,$city,$state-$zipcode</h2>";
				?>
			</div>	
		<div class='container text-center'>
			<h1 class='display-5'>Rules and Precautions</h1>
		</div>
		<div class='container'>
			<h1>Rules</h1>
			<h5>1. Enter the Teacher details correctly in the textbox provided.</h5>
			<h5>2. Make sure every teacher gets the services with ease.</h5>
			<h5>3. Admin Panel Manager will be managing whole institution's faculty feedback system.So make sure your college teachers are only added.</h5>
			<h1>Precautions</h1>
			<h5>1. Don't share Password with anybody in the institution.</h5>
			<h5>2. Make sure only the relevant authority get access to the Admin Panel ,as from here the teachers' data will be added.</h5>
			<h5>3. Adding of unwanted data can lead to errors.</h5>
			<p>Add Teachers in the following table by clicking on the 'Add Faculty' button</p>
			<h1 class='text-center'>Search teachers by ID (as ID's are in  order.)</h1>
			<table border='5' class='table-responsive-sm' align='center' bgcolor='#29ff7b'>
				<tr>
					<th>Sr No</th>
					<th>Teacher Id</th>
					<th>Name</th>
					<th>Department</th>
					<th>Class</th>
					<th>Username</th>
					<th>Password</th>
					<th>Subject</th>
				</tr>
			<?php
			$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
				$sel_name= "select * from teachers order  by teacher_id asc";
				$run_name = mysqli_query($con,$sel_name);
				$i=0;
				while($college_got=mysqli_fetch_array($run_name))
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
					echo"
					<tr  align='center' bgcolor='white' text-align='center'>
						<td>$i</td>
						<td>$teacher_id</td>
						<td>$teacher_des$teacher_name</td>
						<td><b>$teacher_department</b></td>
						<td><b>$teacher_class</b></td>
						<td>$teacher_username</td>
						<td>$teacher_password</td>
						<td>$teacher_subject</td>
					</tr>"; } 
					echo"</table><br><br>";
					?>
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
