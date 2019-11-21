<?php
@session_start();
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['username'] and $_SESSION['college_id']){
include("includes/database.php");
$user_name=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college_id=$_SESSION['college_id'];
$college=$_SESSION['name'];
$sel_teacher = "select * from institutions where username='$user_name' and security_pin='$user_pass' and name='$college'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
echo"<title>Add Students-$college</title>";
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
	<link rel="stylesheet" href="animate.css">
	<link rel="stylesheet" href="t/admin_panel.css">
<title>Online Feedback</title>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>$(document).ready(function() {
        $('td input').bind('paste', null, function(e) {
            $input = $(this);
            setTimeout(function() {
                var values = $input.val().split(/\s+/),
                    row = $input.closest('tr'),
                    col = $input.closest('td').index();
                    console.log(col);
                for (var i = 0; i < values.length; i++) {
                    row.children().eq(col).find('input').val(values[i]);
                    row = row.next();
                }
            }, 0);
        });
    })</script>
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
		<h1 style='text-align:center;'>Enter Number of Students</h1><br><br>
		<div align='center' class='container'>
			<form align='center' method="post">
					<tr><td><h2 id='pip' >Condition-Here You are Going to add students from same semester and Department. </h2></td><br>
							<td><h2>How many Students to Insert? </h2></td><br>
							<td><input id="bomb"  class='form-control' type="text" name="num" required/></td>
						</tr>
						<br><br>
						<tr>
							<input type="submit" class='btn btn-primary' name='enter_entries' value='Enter Entries' />
						</tr>
				</form>
		</div>
	</section>
<?php
if(isset($_POST['enter_entries']))
{
?>
	<h1 style='text-align:center;'>Be Careful with Students Roll No and make sure all Students are added.</h1>
			<form method='post'>
			<table align='center'>
				<tr><td>Select Department</td><td colspan='2'>
				<select  class="form-control" name="department" required>
				<option value="">Select Department</option>
													<?php
												$get_cats="select distinct dept_name from departments order by dept_name asc";
												$run_cats=mysqli_query($con,$get_cats);
												while($row_cats=mysqli_fetch_array($run_cats))
												{
													$my_name=$row_cats['dept_name'];
													
												echo"<option value='$my_name'>".$my_name."</option>";
												}
												?>
		</select></td></tr><br>
		<tr><td>Select Semester</td><td colspan='2'><select class="form-control" name="class" required>
						<option value="">Select Semester</option>
													<?php
												$get_cats="select distinct sem_name from semester order by sem_name asc";
												$run_cats=mysqli_query($con,$get_cats);
												while($row_cats=mysqli_fetch_array($run_cats))
												{
													$my_name=$row_cats['sem_name'];
													
												echo"<option value='$my_name'>".$my_name."</option>";
												}
												?></select>
			</td></tr><br>
			<tr><th align='center' colspan='9'><h1>Enter Students Details</h1></th></tr>
			<tr>
				<th>Sr No.</th>
				<th>Roll No</th>
				<th>Name</th>
			</tr>
			<tbody>
			<?php
			$numbers=$_POST['num'];
			for($i=1;$i<=$numbers;$i++)
			{
		?>
			<tr>
				<th>Student <?php echo $i;?></th>
				<input type="hidden" value="<?php echo $numbers;?>" name="numbers" required/>
				<td><input  class='form-control' type="text" name="roll_no[]" required/></td>
				<td><input class='form-control' type="text" name="name[]" required/></td>
			</tr>
		<?php } ?>
		</tbody>
			<tr>
				<td align='center' colspan='9'><button  type='submit'  class='btn btn-primary' name='enter_students'>Enter Students</button></td>
			</tr></table>
		</form>
<?php } ?>
</body>
</html>
<?php
if(isset($_POST['enter_students'])){
	$s = "insert into students (roll_no,name,department,class,student_username,student_password,feedback) values";
	for($i=0;$i<$_POST['numbers'];$i++)
	{
		$username_make=$_POST['class'].$_POST['roll_no'][$i];
		$password_make=$_POST['roll_no'][$i].$i;
		$s .="('".$_POST['roll_no'][$i]."','".$_POST['name'][$i]."','".$_POST['department']."','".$_POST['class']."','".$username_make."','".$password_make."','No'),";
	}
	$s = rtrim($s,",");
	$get_it=mysqli_query($con,$s);
	if(!$get_it){
		echo"<script>alert('Data Not Entered Succesfully!!!')</script>";
		echo mysqli_error($con);
	}
	else{
		echo "<script>alert('Data Entered Succesfully!!!')</script>";
		echo "<script>window.open('admin_panel?name=$college','_self')</script>";
	}
	mysqli_close($con);
} 
}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>