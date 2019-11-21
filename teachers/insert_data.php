<?php
@session_start();
//displays no error on the web page
error_reporting(0);
ini_set('display_errors', 0);
if($_SESSION['teacher_username'] ){
	include("includes/database.php");
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
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
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="t/animate.css">
    <link rel="stylesheet" href="t/insert_data.css">
<?php
$teacher_session=$_SESSION['teacher_username'];
$teacher_pass=$_SESSION['teacher_password'];
$teacher_id=$_SESSION['t_id'];
$this_dep=$_GET['dept'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
$t_id=$college_name['teacher_id'];
echo"<title>Insert Marks-$college_pat</title>";
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
		.display-3{font-size:2rem;}
		h3{font-size:1rem;}
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
<?php
$intialize_it="select * from $itis where department='$this_dep'";
$run_init=mysqli_query($con,$intialize_it);
$row_init=mysqli_fetch_array($run_init); 
$count_init=mysqli_num_rows($run_init);
if($count_init==0){
	?>
	<div class='container text-center'>
	<br><br>
		<h1>Before entering marks you need to get intialize first.</h1>
		<h1>So click on the button below and get started.</h1>
	</div>
	<form method='post' align='center'>
		<button  type='submit'  class='btn' name='intialize_table'>Intialize It</button>
	</from>
	<?php
	if(isset($_POST['intialize_table']))
	{
		
		$se_st="select * from students where ";
		$pipt_po="select * from teachers where teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id'";
		$run_pipt=mysqli_query($con,$pipt_po);
		while($row_pipt=mysqli_fetch_array()){
			$class=$row_pipt['class'];
			$se_st.=" class='$class' and";
		}
		$se_st.=" department='$this_dep'";
		$run_se=mysqli_query($con,$se_st);
			while($row_se=mysqli_fetch_array($run_se))
			{
				$ins_st="insert into $itis (teacher_id,roll_no,department,student_name,";
					$get_ca="select * from exams";
					$run_ca=mysqli_query($con,$get_ca);
					while($row_ca=mysqli_fetch_array($run_ca)){
						$my_sem=$row_ca['exam_name'];
						$my_sem = str_replace('-', '',$my_sem);
						$my_sem = str_replace('.', '',$my_sem);
						$my_sem = preg_replace('/[^A-Za-z0-9\-]/', '',$my_sem); 
						$ins_st.="$my_sem,"; 
					}
				$ins_st.="marks_obtained,attendance,semester) values ";
				$roll_no=$row_se['roll_no'];
				$name=$row_se['name'];
				$class=$row_se['class'];
				$ins_st.="('$t_id','$roll_no','$this_dep','$name',";
					$get_ca="select * from exams";
					$run_ca=mysqli_query($con,$get_ca);
					while($row_cats=mysqli_fetch_array($run_ca))
					{
						$ins_st.="'0',";
					}
					
				$ins_st.="'0','0','$class')";
				$run_in=mysqli_query($con,$ins_st);
			}
				echo "<script>alert('Ready To Go')</script>";
				echo "<script>window.open('my_account?name=$college_pat&dept=$this_dep','_self')</script>";
	}
}
else{
?>
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
	<section id="secondsection" style="margin-top:150px;">
		<form id="form" align='center' method="post" >
			<div class='container' align='center'>
					<select class="form-control" name="current_sem" required>
					<option value="">Select Semester</option>
															<?php
														$get_cats="select * from teachers where department='$this_dep' and teacher_username='$teacher_session' and teacher_password='$teacher_pass' and teacher_id='$teacher_id'";
														$run_cats=mysqli_query($con,$get_cats);
														while($row_cats=mysqli_fetch_array($run_cats))
														{
															
															$my_sem=$row_cats['class'];
														echo"<option value='$my_sem'>".$my_sem."</option>";
														}
														?></select><br><br>
					<select  class='form-control' name='exam_type' required>
					<option value="">Select Exam</option>
						<?php $get_ca="select * from exams";
							$run_ca=mysqli_query($con,$get_ca);
							while($row_ca=mysqli_fetch_array($run_ca)){
								$my_sem=$row_ca['exam_name'];
								echo"<option value='$my_sem'>".$my_sem."</option>";
							} ?>
					</select>
					<br><br>
					<input type="submit" class='btn ' name='enter_entries' value='Enter Semester'/>
				</div>
		</form>
	</section>
<?php
}
if(isset($_POST['enter_entries']))
{
	$now_sem=$_POST['current_sem'];
	$sel_sb="select * from teachers where class='$now_sem' and department='$this_dep' and teacher_username='$teacher_session' and teacher_password='$teacher_pass'";
					$run_p=mysqli_query($con,$sel_sb);
					$row_pop=mysqli_fetch_array($run_p);
					$now_sub=$row_pop['subject'];
	$now_exam=$_POST['exam_type'];
		$feed_status="select status as 'allow' from event_status where event='$now_exam Marks Entry'";
		$run_status=mysqli_query($con,$feed_status);
		$row_status=mysqli_fetch_array($run_status);
		$pit=$row_status['allow'];
		$now_ex = str_replace('-', '',$now_exam);
		$now_ex = str_replace('.', '',$now_ex);
		$now_ex = preg_replace('/[^A-Za-z0-9\-]/', '',$now_ex); 
		$check_ent="select sum($now_ex) as 'pipo' from $itis where semester='$now_sem'";
		$run_ent=mysqli_query($con,$check_ent);
		$row_ent=mysqli_fetch_array($run_ent);
		$pot=$row_ent['pipo'];
		if($pit=='No')
		{
			echo"<div id='msg' class='container text-center'>
							<h1>ID:$t_id</h1>
							<h1 style='text-decoration:underline;' class='display-3'>Welcome To $now_sem of $dept Department</h1>
							<h1 class='display-3'>Hi, $college_pat .</h1>
							<h1>Entry of Marks for $now_exam has not yet been Activated you can give it once it is Activated by Admin.</h1><br><br>";
		}
		else if($pot>0)
		{
			echo"<div id='msg' class='container text-center'>
							<h1>ID:$t_id</h1>
							<h1 style='text-decoration:underline;' class='display-3'>Welcome To $now_sem of $dept Department</h1>
							<h1 class='display-3'>Hi, $college_pat .</h1>
							<h1>You have already Entered Marks for $now_exam ,now You can update from Update Button if you Want to Change Data.</h1><br><br>";
							}
		else
		{ ?>
			<div class='piply' align='center'>
				<h3 style="text-decoration:underline;"><?php echo"Subject:$now_sub"; ?></h3>
				<h3>1.Before Entering Data just <b>Check if All Students are there<b>.</h3>
				<h3>2.In case if the student/students is/are not there in list tell admin to add them.</h3>
				<h3>3.After adding tell admin to delete your table data as to get intialized again.</h3>
				<form method="post">
					<div class="table-responsive-sm">
						<table  align='center'>
						<tr>
						<th>Teacher ID:</th>
							<td colspan='2'><input class="form-control pop" type="text" name="teacher_id" value="<?php echo $t_id; ?>" required="required" readonly="readonly"/></td>
						</tr>
						<tr>
						<th>Semester:</th>
							<td colspan='2'><input class="form-control pop" type="text" name="current_sem" value="<?php echo $now_sem; ?>" required="required" readonly="readonly"/></td></td>
						</tr>
						<tr>
						<th>Maximum Marks</th>
						<td colspan='2'>
								<?php 
								$get_ca="select * from exams where exam_name='$now_exam'";
								$run_ca=mysqli_query($con,$get_ca);
										$row_ca=mysqli_fetch_array($run_ca)	;										
										$my_sem=$row_ca['maximum_marks'];
											echo"<input class='form-control pop' type='number' value='$my_sem' name='total_marks' readonly='readonly'>";
										 ?>
						</tr>
						<tr><th  colspan='9'>Enter Students Details</th></tr>
						<tr>
						<th>Sr No.</th>
						<th>Roll No</th>
						<th>Name</th>
						<?php
						$now_sem=$_POST['current_sem'];
						$now_exam=$_POST['exam_type'];
						echo"<th>$now_exam Marks</th>";
						$get_stu="select * from $itis where semester='$now_sem' and department='$this_dep' order by roll_no asc";
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
						$get_c="select * from exams where exam_name='$now_exam'";
								$run_c=mysqli_query($con,$get_c);
										$row_c=mysqli_fetch_array($run_c);										
										$my_se=$row_c['maximum_marks'];
							echo"<td><input class='form-control' onkeypress='return event.charCode >= 48 && event.charCode <= 57' min='0' max='$my_se' type='text' name='student_marks[]' required/></td></tr>";
						}
				?>
			<tr><td><input class='form-control' type="hidden" value="<?php echo $i;?>" name="numbers" readonly/></td></tr>
			<tr><td><input class='form-control' type="hidden" value="<?php echo $now_exam;?>" name="exam_t" readonly/></td></tr>
			<?php
		echo"<tr><td colspan='9' align='center'><button  type='submit'  class='btn' name='enter_marks'>Enter Marks</button></td></tr>
					</table></div></form></div>";
			} }
?>
</body>
</html>
<?php
if(isset($_POST['enter_marks'])){
	$exam_t=$_POST['exam_t'];
	$select_now="select * from exams where exam_name='$exam_t'";
	$run_now=mysqli_query($con,$select_now);
	$row_now=mysqli_fetch_array($run_now);
	$max_now=$row_now['maximum_marks'];
	$now_ex = str_replace('-', '',$exam_t);
		$now_ex = str_replace('.', '',$now_ex);
		$now_ex = preg_replace('/[^A-Za-z0-9\-]/', '',$now_ex);
	for($i=0;$i<$_POST['numbers'];$i++)
	{
		$marks=$_POST['student_marks'][$i];
		$perc=$marks/$max_now;
		$roll_no=$_POST['roll_no'][$i];
			$get_c="select count(exam_name) as 'no_of_exam' from exams";
			$run_c=mysqli_query($con,$get_c);
			$p=mysqli_fetch_array($run_c);
			$popinns=$p['no_of_exam'];
		$sum=0;
		$get_ca="select * from exams";
		$run_ca=mysqli_query($con,$get_ca);
		$get_max="select sum(maximum_marks) as 'wanbe' from exams";
		$run_max=mysqli_query($con,$get_max);
		$row_max=mysqli_fetch_array($run_max);
		$sum_max=$row_max['wanbe'];
		while($row_ca=mysqli_fetch_array($run_ca)){
			$my_sem=$row_ca['exam_name'];
			$select_no="select * from exams where exam_name='$my_sem'";
			$run_no=mysqli_query($con,$select_no);
			$row_no=mysqli_fetch_array($run_no);
			$max_no=$row_no['maximum_marks'];
			$my_sem = str_replace('-', '',$my_sem);
			$my_sem = str_replace('.', '',$my_sem);
			$my_sem = preg_replace('/[^A-Za-z0-9\-]/', '',$my_sem); 
			$select_mark="select * from $itis where roll_no='$roll_no'";
			$run_mark=mysqli_query($con,$select_mark);
			$row_mar=mysqli_fetch_array($run_mark);
			$now_markit=$row_mar[$my_sem];
			$now_perc=$now_markit/$max_no;
			$avg_perc=$now_perc/$popinns;
			$sum=$sum+$avg_perc;
		}
		$sum=$sum+($perc/$popinns);
			$pippop=(($sum*$sum_max)*(100.00/$sum_max));
		$s="update $itis set $now_ex='$marks',marks_obtained='$pippop' where roll_no='$roll_no'";
		$get_it=mysqli_query($con,$s);
	}
	if(!$get_it){
		echo"<script>alert('Data Not Entered Succesfully!!!')</script>";
		echo mysqli_error($con);
	}
	else{
		echo "<script>alert('Data Entered Succesfully!!!')</script>";
		echo "<script>window.open('my_account?name=$college_pat&dept=$this_dep','_self')</script>";
	}
}
}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>