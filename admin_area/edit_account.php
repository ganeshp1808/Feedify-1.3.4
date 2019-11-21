<?php
@session_start();
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['username'] and $_SESSION['college_id']){
include("includes/database.php");
$user_name=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$user_name' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con,$sel_teacher); 
	$row=mysqli_fetch_array($run_teacher);
	$type=$row['type'];
				$institution_name=$row['name'];
				$address=$row['address'];
				$city=$row['city'];
				$state=$row['state'];
				$zipcode=$row['pincode'];
				$username=$row['username'];
				$password=$row['security_pin'];
				$again_password=$row['again_security_pin'];
				$admin_panel_username=$row['admin_panel_username'];
				$admin_panel_password=$row['admin_panel_password'];
				$data_name=$row['database_name'];
?>
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
echo"<title>Edit Account-$college</title>";
?>
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
			<h1 style='text-align:center;color:#067050;'>Edit Account</h1>
			<br><br>
			<form align='center' method="post">
				<select  class="form-control" name="institution_type">
											<option value="<?php echo $type; ?>">
										<?php echo $type; ?>
											</option>
											<option value="School">School</option>
											<option value="College">College</option>
											<option value="Personal Class">Personal Class</option>
				</select><br><br>
				<input  class="form-control" type="text" name="college_id" value="<?php echo $college_id; ?>" required="required" readonly/>
				<br>
				<input  class="form-control" type="text" name="institution_name" value="<?php echo $institution_name; ?>" required="required" />
				<br><p>Enter Name properly and carefully as it will appear on college panel.</p><br>
				<input class="form-control" type="text" name="address" value="<?php echo $address; ?>" required="required" />
				<br><p>Enter Address properly and carefully as it will appear on college panel.</p><br>
				<select  class="form-control" name="city">
											<option value="<?php echo $city; ?>">
										<?php echo $city; ?>
											</option>
											<option value="Mumbai">Mumbai</option>
											<option value="Banglore">Banglore</option>
											<option value="New Delhi">New Delhi</option>
											<option value="Kolkata">Kolkata</option>
											<option value="Chennai">Chennai</option>
				</select><br><br>
				<select  class="form-control" name="state">
											<option value="<?php echo $state; ?>">
										<?php echo $state; ?>
											</option>
											<option value="Maharastra">Maharastra</option>
											<option value="Karnataka">Karnataka</option>
											<option value="Delhi">Delhi</option>
											<option value="West Bengal">West Bengal</option>
											<option value="Tamil Nadu">Tamil Nadu</option>
				</select><br><br>
				<input class="form-control" type="number" name="zipcode" value="<?php echo $zipcode; ?>" required="required" /><br><br>
				<input class="form-control" type="text" name="username" value="<?php echo $username; ?>" required="required" readonly/><br><br>
				<input class="form-control" type="text" name="password" value="<?php echo $password; ?>" required="required" readonly/><br><br>
				<input class="form-control" type="text" name="again_password" value="<?php echo $again_password; ?>" required="required" /><br><br>
				<input class="form-control" type="text" name="admin_panel_username" value="<?php echo $admin_panel_username; ?>" required="required" />
				<br><p>This will be the Username for admin panel where you will be adding college data.</p><br>
				<input class="form-control" type="text" name="admin_panel_password" value="<?php echo $admin_panel_password; ?>" required="required" />
				<br><p>This will be the Password for admin panel where you will be adding college data.So remember This.</p><br>
				<input  type="submit" name="update_account" class="btn btn-success" value="Update Account" /></form>
		</div>
	</section>
</body>
</html>
<?php
if(isset($_POST['update_account'])){
	
	$type=$_POST['institution_type'];
				$institution_name=$_POST['institution_name'];
				$address=$_POST['address'];
				$city=$_POST['city'];
				$state=$_POST['state'];
				$zipcode=$_POST['zipcode'];
				$username=$_POST['username'];
				$password=$_POST['password'];
				$again_password=$_POST['again_password'];
				$admin_panel_username=$_POST['admin_panel_username'];
				$admin_panel_password=$_POST['admin_panel_password'];
	$update_c="update institutions set type='$type',name='$institution_name',
				address='$address',city='$city',state='$state',pincode='$zipcode',
				username='$username',security_pin='$password',again_security_pin='$again_password',
				admin_panel_username='$admin_panel_username',
				admin_panel_password='$admin_panel_password',doj=NOW(),database_name='$data_name' where username='$user_name' and security_pin='$user_pass' and college_id='$college_id'";
				$run_c=mysqli_query($con,$update_c);
				?>
				<?php
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
	$update_co="update details set type='$type',name='$institution_name',
				address='$address',city='$city',state='$state',pincode='$zipcode',
				username='$username',security_pin='$password',again_security_pin='$again_password',
				admin_panel_username='$admin_panel_username',
				admin_panel_password='$admin_panel_password',doj=NOW() where username='$user_name' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
				$con=mysqli_connect("localhost","root","","$data_name");
$run_co=mysqli_query($con,$update_co);
	if($run_c and $run_co){
		echo "<script>alert('Your Account has been Updated!!')</script>";
		echo "<script>window.open('admin_panel?name=$college','_self')</script>";
	}
	else
	{
		echo "<script>alert('Update Failed!!')</script>";
	}
}
			}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>