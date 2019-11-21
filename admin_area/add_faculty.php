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
echo"<title>Add Faculty-$college</title>";
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
<style>
	@media only screen and (max-width:900px){
	.display-3
	{
		font-size:2rem;
	}
	h1,h2,h3,h4,h5,h6{font-size:1rem;}
	table
	{
		font-size:1rem;
	}
	}
	.notice{
		background:black;
		color:#03fcdf;
		text-shadow:1px 1px #fcd703;
	}
</style>
</head>
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
			<h1 style='text-align:center;color:#09db95;'>Add Faculty</h1>
			<br><br>
			<div class="notice">
			<h3 style='text-align:center;color:black;'>1.Add one faculty at a time.<br><br>2.Add all the classes of that faculty once.<br><br>3.Get all details of that faculty(Eg:Semester,Departments).</h3><br>
			<h3 style='text-align:center;color:black;'>4.Don't add same teacher details again.<br><br>5.<b>Check all added data in POLL RESULTS SECTION.</b></h3><br><br>
			</div>
			<form align='center' method="post">
				<h2>How many classes the teacher take of which you are going to add data? </h2><br>
				<input class='form-control' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    maxlength = "1" type="number" name="num" required/><br><br>
				<input type="submit" class='btn btn-primary' name='enter_entries' value='Enter Entries' />
			</form>
		</div>
	<?php
		if(isset($_POST['enter_entries'])){
				$numb=$_POST['num'];
			?>
				<form method="post" align='center' >
				<div class="table-responsive-sm">
				<table  align='center'>
					<tr><td colspan='2'><input class="form-control" type="text" name="institution_name" value="<?php echo $institution_name; ?>" required="required" readonly="readonly"/></td></tr>
					<tr><td colspan='2'><input class="form-control" type="text" name="address" value="<?php echo $address; ?>" required="required" readonly="readonly"/></td></tr>
					<tr><td colspan='2'><select class="form-control" name="designation" required>
											<option value="">Select Designation</option>
											<option value="Mr.">Mr.</option>
											<option value="Dr.">Dr.</option>
											<option value="Ms.">Ms.</option>
											<option value="Mrs.">Mrs.</option>
					</select></td></tr>
					<tr><td colspan='2'><input class="form-control" type="text" name="teacher_name" placeholder="Enter Name" required="required" /></td></tr>
					<tr><td colspan='2'><input class="form-control" type="text" name="teacher_username" placeholder="Enter Username" required="required" /></td></tr>
					<tr><td colspan='2'><input class="form-control" type="password" name="teacher_password" placeholder="Enter Password" required="required" /></td></tr>
					<tr><td colspan='2'><input class="form-control" type="text" name="email" placeholder="Enter Email" required="required" /></td></tr>
					
					<?php for($i=0;$i<$numb;$i++){
					echo"<tr><th>Class</th><th>Department</th><th>Class Number</th><th>Subject</th>";
					?>
					
				<tr><td><select class="form-control" name="class_name[]" required>
											<option value="">Select Semester</option>
											<?php
													$get_cats="select distinct sem_name from semester order by sem_name asc";
													$run_cats=mysqli_query($con,$get_cats);
													while($row_cats=mysqli_fetch_array($run_cats))
													{
														$my_name=$row_cats['sem_name'];
														
													echo"<option value='$my_name'>".$my_name."</option>";
													}
													?></select></td>
				<td><select class="form-control" name="teacher_department[]" required>
											<option value="">Select Department</option>
														<?php
													$get_cats="select distinct dept_name from departments order by dept_name asc";
													$run_cats=mysqli_query($con,$get_cats);
													while($row_cats=mysqli_fetch_array($run_cats))
													{
														$my_name=$row_cats['dept_name'];
														
													echo"<option value='$my_name'>".$my_name."</option>";
													}
													?></select></td>						
				<td><input class="form-control" type="number" name="numbe[]" placeholder="<?php echo $i+1 ?>" readonly="readonly" /></td>
				<td><input class="form-control" type="text" name="subject[]" placeholder="Enter Subject" required="required" /></td></tr>
				<?php } ?>
				<tr><td><input class='form-control' type="hidden" value="<?php echo $i;?>" name="numbers" readonly/></td></tr>
				<tr><td colspan='4'><input align='center' type='submit'  class='btn' name='enter_teachers' value='Enter Teachers'></td></tr><table></div></form>
<?php } ?>
	</section>
</body>
</html>	
<?php
if(isset($_POST['enter_teachers'])){
	$unique_number=rand(1000000,9999999);
	$t_user=$_POST['teacher_name'];
	$t_user = str_replace(' ', '',$t_user);
	$t_user = str_replace('.', '',$t_user);
	$t_user = preg_replace('/[^A-Za-z0-9\-]/', '',$t_user);
	$table_name=$t_user.$unique_number;  
	$create_table="CREATE TABLE $table_name (teacher_id INT(10),roll_no INT(10),department VARCHAR(255),student_name VARCHAR(255),";
	 $get_cats="select * from exams";
			$run_cats=mysqli_query($con,$get_cats);
			while($row_cats=mysqli_fetch_array($run_cats)){
					$my_sem=$row_cats['exam_name'];
					$my_sem = str_replace('-', '',$my_sem);
					$my_sem = str_replace('.', '',$my_sem);
					$my_sem = preg_replace('/[^A-Za-z0-9\-]/', '',$my_sem);
						$create_table.="$my_sem varchar(100),"; } 
					$create_table.="marks_obtained FLOAT(4,2),attendance INT(101),semester VARCHAR(101))";
					$run_tab=mysqli_query($con,$create_table);
	$s = "insert into teachers (teacher_id,designation,name,department,no_of_class,class,teacher_username,teacher_password,teacher_email,subject,feedback,feed_value,teaching,student_feedback) values";
	for($i=0;$i<$_POST['numbers'];$i++)
	{
		$teacher_name=$_POST['teacher_name'];
		$subject=$_POST['subject'][$i];
		$teacher_department=$_POST['teacher_department'][$i];
		$class_name=$_POST['class_name'][$i];
		$now_dep = str_replace(' ', '',$teacher_department);
				$now_dep = str_replace('-', '',$now_dep);
		$now_dep=preg_replace('/[^A-Za-z0-9\-]/', '',$now_dep);
				$getit=$now_dep.$class_name;
				$getit = str_replace('-', '',$getit);
				$getit=preg_replace('/[^A-Za-z0-9\-]/', '',$getit);
		$s .="('".$unique_number."','".$_POST['designation']."','".$_POST['teacher_name']."','".$_POST['teacher_department'][$i]."','".($i+1)."','".$_POST['class_name'][$i]."','".$_POST['teacher_username']."','".$_POST['teacher_password']."','".$_POST['email']."','".$_POST['subject'][$i]."','No','0.00','Imp','Imp'),";
			$sql = "SHOW TABLES IN $data_name";
				// perform the query and store the result
				$result = $con->query($sql);
					// if the $result not False, and contains at least one row
				if($result !== false) {
					$point=0;
				  // if at least one table in result
				  if($result->num_rows > 0) {
					// traverse the $result and output the name of the table(s)
					while($row = $result->fetch_assoc()) {
					  if( $getit==$row['Tables_in_'.$data_name])
					  {
						  $point=1; } }
					if($point==1){
						$add_in="insert into $getit (teacher_name,subject,feedback) values ('$teacher_name','$subject','0.00')";
						$row_add=mysqli_query($con,$add_in);
					}
					else
					{
						$make_it="CREATE TABLE $getit (teacher_name VARCHAR(100),subject VARCHAR(100),feedback FLOAT(4,2))";
						$want_it=mysqli_query($con,$make_it);
						$first_in="insert into $getit (teacher_name,subject,feedback) values ('$teacher_name','$subject','0.00')";
						$row_in=mysqli_query($con,$first_in);
					} }
				  else echo 'There is no table in "tests"';
				}
				else echo 'Unable to check the "tests", error - '. $con->error;
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