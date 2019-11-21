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
	<link rel="stylesheet" href="animate.css">
	<link rel="stylesheet" href="t/admin_panel.css">
<?php
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
echo"<title>Delete Data-$college</title>";
$institution_name=$college_name['name'];
$address=$college_name['address'];
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
		<div id="form">
			<h1 align='center'>Delete Main People</h1>
			<h4 align='center'>Select department and named of the respective Main People you want to remove.</h4>
			<br><br>
			<form align='center' method="post">
				<select  class="form-control" name="teach_name" required>
				<option value="">Select Main Person</option>
					<?php
							$get_cats="select panel_name from main_people order by panel_name asc";
							$run_cats=mysqli_query($con,$get_cats);
															while($row_cats=mysqli_fetch_array($run_cats))
															{
																$my_roll=$row_cats['panel_name'];
																
															echo"<option value='$my_roll'>".$my_roll."</option>";
															}
															?> </select><br><br><span id="user"></span><br><br>
					<select  class="form-control" name="dep"  required>
					<option value="">Select Department</option>
					<?php $get_cats="select distinct dept_name from main_people order by dept_name  asc";
															$run_cats=mysqli_query($con,$get_cats);
															while($row_cats=mysqli_fetch_array($run_cats))
															{
																$my_roll=$row_cats['dept_name'];
																
															echo"<option value='$my_roll'>".$my_roll."</option>";
															}
															?>
					</select><br><br><span id="pass"></span><br><br>
					<button align='center' type="submit" class="btn btn-primary " name="add_sem">Delete</button>
</body>
</html>
<?php
if(isset($_POST['add_sem'])){
		$teach_name=$_POST['teach_name'];
	$t_id=$_POST['dep'];
	$sel_p=mysqli_query($con,"select * from main_people where dept_name='$t_id'");
	$count=0;
	while($row_pip=mysqli_fetch_array($sel_p)){
		$ch_p=$row_pip['panel_name'];
		if($ch_p==$teach_name){
			$count=$count+1;
		}
	}
	if($count>0){
		$delete_data="delete from main_people where dept_name='$t_id' and panel_name='$teach_name'";
		$run_delte=mysqli_query($con,$delete_data);
		if($run_delte){
			echo "<script>alert('Data Deleted Succesfully!!!')</script>";
				echo "<script>window.open('admin_panel?name=$college','_self')</script>";
				}
	}
else if($count==0){
		echo"<script>
					var p1=document.querySelector('#user');
					var p2=document.querySelector('#pass');
					p1.textContent='Wrong Name';
					p2.textContent='Wrong Department';
				</script>";
		}
	}
	}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>