<?php 
@session_start(); 
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['teacher_username']){
	include("includes/database.php");
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$this_dep=$_GET['dept'];
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
echo"<title>Edit Data-$college</title>";
$teacher_session=$_SESSION['teacher_username'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
$dept=$college_name['department'];
$t_id=$college_name['teacher_id'];
$itis=$college_pat.$t_id;
$itis = str_replace(' ', '',$itis);
$itis = str_replace('.', '',$itis);
$itis = str_replace('-', '',$itis);
$itis = preg_replace('/[^A-Za-z0-9\-]/', '',$itis);
$itis=strtolower($itis);
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet"  media="all" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="animate.css">
	<link rel="stylesheet" href="t/insert_data.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script language='javascript' type="text/javascript">
		window.history.forward();
	</script>
<style>
#form{
	margin-top:100px;
}</style>
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
	<?php 
	$check_data="select roll_no from $itis";
	$run_check=mysqli_query($con,$check_data);
	$row_check=mysqli_fetch_array($run_check);
	$pit=$row_check['roll_no'];
	if ($pit==0){
		echo"<h1 style='margin:150px;'>Enter the Marks of students first then only you can update data.</h1>";
		}
	else{
	?>
	<section id="secondsection" style="margin-top:100px;">
		<h1 align='center'>Update Marks</h1>
		<p align='center'>Enter all details correctly of updating</p>
		<div id="form" class='container'>
			<form align='center' method="post" >
				<select  class="form-control" type="number" name="rollno" required>
												<option value="">Select Roll No</option>
															<?php
															$teacher_session=$_SESSION['teacher_username'];
														$get_cats="select distinct roll_no from $itis order by roll_no asc";
														$run_cats=mysqli_query($con,$get_cats);
														while($row_cats=mysqli_fetch_array($run_cats))
														{
															$my_roll=$row_cats['roll_no'];
															
														echo"<option value='$my_roll'>".$my_roll."</option>";
														}
														?></select><br><br>
					<input type="submit" name="enter" class="btn" value="Make Entry" />
			</form>
			<?php
			if(isset($_POST['enter']))
			{
				$now_roll=$_POST['rollno'];
				$want_it="select * from $itis where roll_no='$now_roll'";
				$run_want=mysqli_query($con,$want_it);
				$row_want=mysqli_fetch_array($run_want);
				$name=$row_want['student_name'];
				$attendance=$row_want['attendance'];
				if($attendance==0){
					echo"<h1>Enter the Attendance for this Student.</h1>";
				}
				else{
				?>
			 <form align='center' method="post" >
				<p>Student Name</p>
				<input class='form-control' type='text' value="<?php echo $name; ?>" name='student_name' /><br><br>
				<?php $get_ca="select * from exams";
						$run_ca=mysqli_query($con,$get_ca);
						while($row_ca=mysqli_fetch_array($run_ca)){
							$no_ex=$row_ca['exam_name'];
							$mxi=$row_ca['maximum_marks'];
							$my_sem = str_replace('-', '',$no_ex);
							$my_sem = str_replace('.', '',$my_sem);
							$my_sem = preg_replace('/[^A-Za-z0-9\-]/', '',$my_sem); 
							$select_mark="select * from $itis where roll_no='$now_roll'";
							$run_mark=mysqli_query($con,$select_mark);
							$row_mar=mysqli_fetch_array($run_mark);
							$now_piq=$row_mar[$my_sem];
							echo"<p>$no_ex Marks</p><input class='form-control' type='number' value='$now_piq' min='0' max='$mxi' name='$my_sem' /></td><br><br>";
						}
						 ?>
				<p>Attendance</p>
				<input class='form-control' type='number' value="<?php echo $attendance; ?>" min='0' max='100' name='student_atten' /></td><br><br>
				<input type="hidden" name="rollno" value="<?php echo $now_roll ;?>" class="btn" value="Make Entry" />
				<br><br>
				<input type="submit" name="enter_now" class="btn" value="Make Entry" /><br><br>
			</form>
		</div>
	</section>
				<?php }	} 
	}?>
</body>
</html>
<?php
		if(isset($_POST["enter_now"]))
			{	$roll_no=$_POST['rollno'];
				$student_name=$_POST['student_name'];
				$student_atten=$_POST['student_atten'];
					$get_c="select count(exam_name) as 'no_of_exam' from exams";
					$run_c=mysqli_query($con,$get_c);
					$p=mysqli_fetch_array($run_c);
					$popinns=$p['no_of_exam'];
					$get_max="select sum(maximum_marks) as 'wanbe' from exams";
					$run_max=mysqli_query($con,$get_max);
					$row_max=mysqli_fetch_array($run_max);
					$sum_max=$row_max['wanbe'];
					$update_data="update $itis set student_name='$student_name',";
					$get_ca="select * from exams";
						$run_ca=mysqli_query($con,$get_ca);
						$sum=0;
						while($row_ca=mysqli_fetch_array($run_ca)){
							$no_ex=$row_ca['exam_name'];
							$max_no=$row_ca['maximum_marks'];
							$my_sem = str_replace('-', '',$no_ex);
							$my_sem = str_replace('.', '',$my_sem);
							$my_sem = preg_replace('/[^A-Za-z0-9\-]/', '',$my_sem);
							$new_ma=$_POST[$my_sem];
							$update_data.="$my_sem='$new_ma',";
							$select_mark="select * from $itis where roll_no='$roll_no'";
							$run_mark=mysqli_query($con,$select_mark);
							$row_mar=mysqli_fetch_array($run_mark);
							$now_perc=$new_ma/$max_no;
							$avg_perc=$now_perc/$popinns;
							$sum=$sum+$avg_perc;
						}
			$pippop=(($sum*$sum_max)*(100.00/$sum_max));
				$update_data.="marks_obtained='$pippop',attendance= '$student_atten' where roll_no='$roll_no'";
				$run_update=mysqli_query($con,$update_data);
				if($run_update){
					echo"<script>alert('Data Updated Succesfully!!')</script>";
					}
				else{
					echo"<script>alert('Data not Changed Succesfully!!')</script>";
				}
			}
			}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>