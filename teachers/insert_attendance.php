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
$college_id=$_SESSION['college_id'];
$this_dep=$_GET['dept'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
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
    <link rel="stylesheet" href="t/insert_data.css">
<?php 
$teacher_session=$_SESSION['teacher_username'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
$dept=$college_name['department'];
$t_id=$college_name['teacher_id'];
echo"<title>Insert Attendance-$college_pat</title>";
$itis=$college_pat.$t_id;
$itis = str_replace(' ', '',$itis);
$itis = str_replace('.', '',$itis);
$itis = str_replace('-', '',$itis);
$itis = preg_replace('/[^A-Za-z0-9\-]/', '',$itis);
$itis=strtolower($itis);
?>
<link rel="stylesheet"  media="all" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script language='javascript' type="text/javascript">
	window.history.forward();
	</script>
	<style>
	@media only screen and (max-width:700px){
		.display-3,h1{font-size:2rem;}
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
	$feed_status="select status as 'allow' from event_status where event='Attendance Entry'";
		$run_status=mysqli_query($con,$feed_status);
		$row_status=mysqli_fetch_array($run_status);
		$pit=$row_status['allow'];
	if($pit=='No'){
		echo"<div id='msg' style='margin-top:150px;' class='container text-center'>
							<h1>ID:$t_id</h1>
							<h1 style='text-decoration:underline;' class='display-3'>Welcome To  $dept Department</h1>
							<h1 class='display-3'>Hi, $college_pat .</h1>
							<h1>Attendance Entering System has not yet been Activated you can give it once it is Activated by Admin.</h1>"; }
	else{
?>
	<section id="secondsection" style="margin-top:150px;">
		<form id="form" style='margin-top:150px;' method="post" >
				<div class='container' align='center'>
					<select  class="form-control" name="current_sem" required>
										<option value="">Select Semester</option>
												<?php
														$get_cats="select * from teachers where teacher_username='$teacher_session' and teacher_id='$t_id'";
														$run_cats=mysqli_query($con,$get_cats);
														while($row_cats=mysqli_fetch_array($run_cats))
														{
															$my_sem=$row_cats['class'];
														echo"<option value='$my_sem'>".$my_sem."</option>";
														}
														?> </select><br><br>
					<input type="submit" class='btn ' name='enter_entries' value='Enter Semester'/>
			</div>
		</form>
	</section>
	<?php
if(isset($_POST['enter_entries']))
{
	$now_sem=$_POST['current_sem'];
$check_en="select sum(attendance) as 'pip' from $itis where semester='$now_sem'";
		$run_en=mysqli_query($con,$check_en);
		$row_en=mysqli_fetch_array($run_en);
		$po=$row_en['pip'];
		if($po>0)
		{
			echo"<div id='msg' style='margin-top:150px;' class='container text-center'>
							<h1>ID:$t_id</h1>
							<h1 style='text-decoration:underline;' class='display-3'>Welcome To $dept Department</h1>
							<h1 class='display-3'>Hi, $college_pat .</h1>
							<h1>You have already Entered Attendance ,now You can update from Update Button if you Want to Change Data.</h1>";
		}
		else{
?><div class="table-responsive-sm">
		<form method="post">
			<table align='center' >
			<tr>
			<th>Teacher ID:</th>
				<td colspan='2'><input class="form-control" type="text" name="teacher_id" value="<?php echo $t_id; ?>" required="required" readonly="readonly"/></td>
			</tr>
			<tr>
			<th>Semester:</th>
				<td colspan='2'><input  class="form-control" type="text" name="current_sem" value="<?php echo $now_sem; ?>" required="required" readonly="readonly"/></td>
			</td>
			</tr>
			<tr><th  colspan='2'>Enter Students Details</th></tr>
			<tr>
			<th >Sr No.</th>
			<th>Roll No</th>
			<th>Name</th>
			<th>Attendance(Enter %)</th>
			<?php
			$now_sem=$_POST['current_sem'];
			$get_stu="select * from $itis where semester='$now_sem' order by roll_no asc";
			$run_stu=mysqli_query($con,$get_stu);
			$i=0;
			while($row_stu=mysqli_fetch_array($run_stu))
			{
				$i++;
				$roll_no=$row_stu['roll_no'];
				$name=$row_stu['student_name'];
				echo"<tr>";
				?>
				<th>Student <?php echo $i;?></th>
				<td><input class='form-control' value="<?php echo $roll_no;?>" type='number' name='roll_no[]' readonly/></td>
				<td><input class='form-control' value="<?php echo $name;?>" type='text' name='student_name[]' readonly/></td>
			<?php	
				echo"<td><input  class='form-control' onKeyUp='if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';}' onkeypress='return event.charCode >= 48 && event.charCode <= 57'  min='0' max='100' type='text' name='student_atten[]' required /></td></tr>";
			}
	?>
	<tr><td><input class='form-control' style='width:75%;margin-left:auto;margin-right:auto;' type="hidden" value="<?php echo $i;?>" name="numbers" readonly/></td></tr>
	<?php
	echo"
	<tr><td colspan='9' align='center'><button  type='submit'  class='btn btn-primary' name='enter_atten'>Enter</button></td>
			</tr>
			</table>
		</form></div>";
		}
	}
}
?>
<?php 
if(isset($_POST['enter_atten'])){
$numb=$_POST['teacher_id'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
$itis=$college_pat.$numb;
$itis = str_replace(' ', '',$itis);
$itis = str_replace('.', '',$itis);
$itis = str_replace('-', '',$itis);
$itis = preg_replace('/[^A-Za-z0-9\-]/', '',$itis);
$itis=strtolower($itis);
	for($i=0;$i<$_POST['numbers'];$i++){
		$roll_no=$_POST['roll_no'][$i];
		$atten=$_POST['student_atten'][$i];
		$s="update $itis set attendance='$atten' where roll_no='$roll_no'";
		$get_it=mysqli_query($con,$s);
	}
	if(!$get_it){
		echo"<script>alert('Data Not Entered Succesfully!!!')</script>";
		echo mysqli_error($con);
	}
	else{
		echo "<script>alert('Attendance Entered Succesfully!!!')</script>";
		echo "<script>window.open('my_account?name=$college_pat','_self')</script>";
	}
	mysqli_close($con);
}
}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>