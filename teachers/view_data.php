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
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$run_teacher = mysqli_query($con,$sel_teacher); 
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
error_reporting(0);
ini_set('display_errors', 0);
$teacher_session=$_SESSION['teacher_username'];
$sel_teacher = "select * from teachers where teacher_username='$teacher_session' and no_of_class='1'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$college_pat=$college_name['name'];
$dept=$college_name['department'];
$t_email=$college_name['teacher_email'];
$t_id=$college_name['teacher_id'];
$itis=$college_pat.$t_id;
$itis = str_replace(' ', '',$itis);
$itis = str_replace('.', '',$itis);
$itis = str_replace('-', '',$itis);
$itis = preg_replace('/[^A-Za-z0-9\-]/', '',$itis);
$itis=strtolower($itis);
$this_dep=$_GET['dept'];
echo"<title>View Data-$college_pat</title>";
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
	<link rel="stylesheet" href="t/insert_data.css">
	<link rel="stylesheet"  media="all" />
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style>
	@media only screen and (max-width:700px){
		.display-3{font-size:2rem;}
		h1{font-size:1.5rem;}
	}
	</style>
</head>
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
	$check_data="select * from $itis";
	$run_check=mysqli_query($con,$check_data);
	$row_check=mysqli_fetch_array($run_check);
	$pit=$row_check['roll_no'];
	if ($pit==0){
		echo"<h1 style='margin:150px;'>Enter the Marks of students first then only you can view data.</h1>";
		}
	else{
	?>
	<section id="secondsection" style="margin-top:100px;">
		<div class='container text-center'>
		<h1>View Data</h1>
		<h3>Check Roll Number and Marks are correctly entered.</h3>
		<form style='margin-top:150px;' method="post">
			<select  class="form-control" name="current_sem" required>
								<option>Select Semester</option>
													<?php
												$get_cats="select * from teachers where teacher_username='$teacher_session'";
												$run_cats=mysqli_query($con,$get_cats);
												while($row_cats=mysqli_fetch_array($run_cats))
												{
													$my_sem=$row_cats['class'];
													echo"<option value='$my_sem'>".$my_sem."</option>";
												}
												?>
			</select><br><br>
			<input type="submit" name="enter"  class="btn btn-primary " value="Make Entry" />
		</form>
	</div>
</section>
<?php
if(isset($_POST["enter"]))
{			$just_sem=$_POST['current_sem'];
	if($just_sem=='Select Semester'){
		echo"<div class='text-center'>Select a semester please.</div>";
	}
	else{
		$get_da="select sum(marks_obtained) as 'com_ma' from $itis where semester='$just_sem'";
		$run_da=mysqli_query($con,$get_da);
		$row_da=mysqli_fetch_array($run_da);
		$what_marks=$row_da['com_ma'];
		if($what_marks==0){
			echo"<p align='center'>Enter marks first to view data.</p>";
		}
		else {
			$get_data="select * from $itis where semester='$just_sem'";
				$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$run_avg=mysqli_query($con,$get_avg);
				$row_avg=mysqli_fetch_array($run_avg);
				$average=$row_avg['average'];
				$run_data=mysqli_query($con,$get_data);
				$subject_now="select * from teachers where class='$just_sem' and teacher_username='$teacher_session' and teacher_id='$t_id'";
				$get_sub=mysqli_query($con,$subject_now);
				$row_sub=mysqli_fetch_array($get_sub);
				$my_sub=$row_sub['subject'];
				echo"<br><br><br><br><h3 style='text-align:center;'>Your $just_sem Data .</h3>
				<h6 style='text-align:center;'>Subject:- $my_sub</h6>
				<table class='table-responsive-sm' border='5' align='center' bgcolor='#6699FF'>
						<tr>
							<th>Sr No</th>
							<th>Roll No</th>
							<th>Name</th>";
							$get_ca="select * from exams";
							$run_ca=mysqli_query($con,$get_ca);
							while($row_ca=mysqli_fetch_array($run_ca)){
								$no_ex=$row_ca['exam_name'];
								echo"<th>$no_ex Marks</th>";
							}
							echo"<th>Marks Obtained</th>
							<th>Attendance</th>
							</tr>";
					$i=0;
			$num_rows=mysqli_num_rows($run_data);
			if($num_rows>0)
			{
				while($row_data=mysqli_fetch_array($run_data))
				{
					$roll_no=$row_data['roll_no'];
					$student_name=$row_data['student_name'];
					$marks_obtained=$row_data['marks_obtained'];
					$attendance=$row_data['attendance'];
					$i++;
					echo"<tr style='color:black'  bgcolor='white'>
							<td >$i</td>
							<td>$roll_no</td>
							<td>$student_name</td>";
							$get_ca="select * from exams";
							$run_ca=mysqli_query($con,$get_ca);
							$sum=0;
							while($row_ca=mysqli_fetch_array($run_ca)){
							$no_ex=$row_ca['exam_name'];
							$my_sem = str_replace('-', '',$no_ex);
							$my_sem = str_replace('.', '',$my_sem);
							$my_sem = preg_replace('/[^A-Za-z0-9\-]/', '',$my_sem); 
							echo"<td>$row_data[$my_sem]</td>";
							}
							echo"<td>$marks_obtained</td>
							<td>$attendance%</td></tr>"; }
				echo"</table>";
				$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$run_avg=mysqli_query($con,$get_avg);
				$row_avg=mysqli_fetch_array($run_avg);
				$average=$row_avg['average'];
				$run_data=mysqli_query($con,$get_data);		
				echo"<br><br><br><br><h6 style='text-align:center;'>Your Students Above Average.</h6>
				<table class='table-responsive-sm' border='5' align='center' bgcolor='#8840f5'>
						<tr><th>Sr No</th><th>Roll No</th><th>Name</th><th>Marks Obtained</th><th>Attendance</th>
				</tr>";
				$count_above=0;
				$num_rows=mysqli_num_rows($run_data);
				if($num_rows>0)
				{
				while($row_data=mysqli_fetch_array($run_data))
				{
					$roll_no=$row_data['roll_no'];
					$student_name=$row_data['student_name'];
					$marks_obtained=$row_data['marks_obtained'];
					$attendance=$row_data['attendance'];
					$i++;
					if($marks_obtained>=$average)
					{
						$count_above++;
						echo"
						<tr align='center' bgcolor='#6699FF' >
							<td>$count_above</td>
							<td>$roll_no</td>
							<td>$student_name</td>
							<td>$marks_obtained</td>
							<td>$attendance%</td></tr>";
					}
				}echo"</table>";
			}
			if($count_above==0)
			{
				echo"<p align='center'>No Student in this Criteria.</p>";
			}
				$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$run_avg=mysqli_query($con,$get_avg);
				$row_avg=mysqli_fetch_array($run_avg);
				$average=$row_avg['average'];
				$run_data=mysqli_query($con,$get_data);		
				echo"<br><br><br><br><h6 style='text-align:center;'>Your Students Below Average.</h6>
				<table class='table-responsive-sm' border='5' align='center' bgcolor='#8840f5'>
						<tr>
							<th>Sr No</th>
							<th>Roll No</th>
							<th>Name</th>
							<th>Marks Obtained</th>
							<th>Attendance</th></tr>";
				$count_bel=0;
				$num_rows=mysqli_num_rows($run_data);
				if($num_rows>0)
				{
					while($row_data=mysqli_fetch_array($run_data))
					{
						$roll_no=$row_data['roll_no'];
						$student_name=$row_data['student_name'];
						$marks_obtained=$row_data['marks_obtained'];
						$attendance=$row_data['attendance'];
						$i++;
						if($marks_obtained<$average)
						{
							$count_bel++;
							echo"
							<tr  align='center' bgcolor='#6699FF' text-align='center'>
								<td>$count_bel</td>
								<td>$roll_no</td>
								<td>$student_name</td>
								<td>$marks_obtained</td>
								<td>$attendance%</td></tr>";
						}
					}echo"</table>";
				}
				if($count_bel==0)
				{
					echo"<p align='center'>No Student in this Criteria.</p>";
				}
				$just_sem=$_POST['current_sem'];
				$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$run_data=mysqli_query($con,$get_data);
				$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem'";
				$get_att="select avg(attendance) as 'avg_attendance' from $itis where semester='$just_sem'";
				$get_var_marks="select var(marks_obtained) as 'var_mark' from $itis where semester='$just_sem'";
				$get_var_att="select var(attendance) as 'var_att' from $itis where semester='$just_sem'";
				$run_avg=mysqli_query($con,$get_avg);
				$run_att=mysqli_query($con,$get_att);
				$row_avg=mysqli_fetch_array($run_avg);
				$row_att=mysqli_fetch_array($run_att);
				$average=$row_avg['average']/5;
				$avg_attendance=$row_att['avg_attendance'];
				$x=0;$y=0;$p=0;$q=0;$z=0;$tik=0;
				$num_rows=mysqli_num_rows($run_data);
				if($num_rows>0)
				{
					while($row_data=mysqli_fetch_array($run_data))
					{
						$roll_no=$row_data['roll_no'];
						$student_name=$row_data['student_name'];
						$marks_obtained=$row_data['marks_obtained']/5;
						$attendance=$row_data['attendance'];
						$z++;
						$x=($marks_obtained-$average);	
						$y=($attendance-$avg_attendance);
						$sub_marks_sqau=pow($x,2);
						$tik=$tik+$sub_marks_sqau;
						$prod=$x*$y;
						$p=$p+$prod;
						$q=$q+pow($y,2);
					}
					$a=0;
					if($q>0){
					$a=round(($p/$q),5);
					}
					else{ echo"";}
					$b=round(($average-($a*$avg_attendance)),5);
	$var_marks=$tik/$num_rows;
							$std_marks=round(sqrt($var_marks),2);
				}
				echo"<br><br><br><br><h1 style='text-align:center;text-decoration:underline'>Remedial Students</h1>
				<table width='500' border='5' align='center' bgcolor='#6699FF'>
						<tr>
							<th>Sr No</th>
							<th>Roll No</th>
							<th>Name</th>
							<th>Marks Obtained</th>
							<th>Attendance</th></tr>";
				$count_belo=0;
				$num_rows=mysqli_num_rows($run_data);
	if($num_rows>0)
	{
		$get_data="select * from $itis where semester='$just_sem'";
						$run_data=mysqli_query($con,$get_data);

		while($row_data=mysqli_fetch_array($run_data))
		{
			$roll_no=$row_data['roll_no'];
			$student_name=$row_data['student_name'];
			$marks_obtained=$row_data['marks_obtained']/5;
			$attendance=$row_data['attendance'];
			
			$count_belo++;
			$y_exp_below=($a*$attendance)+$b-(1.5*$std_marks);
			if($marks_obtained<$y_exp_below){
				echo"
				<tr width='500' align='center' bgcolor='#6699FF' text-align='center'>
					<td>$count_belo</td>
					<td>$roll_no</td>
					<td>$student_name</td>
					<td>$marks_obtained</td>
					<td>$attendance%</td></tr>";
			}
		}
	}echo"</table>";
	if($num_rows==0)
	{
		echo"<p align='center'>No Student in this Criteria.</p>";
	}
	echo"<br><br><br><br><h1 style='text-align:center;text-decoration:underline'>Academically Excellent Students</h1>
				<table border='5' width='500' align='center' bgcolor='#6699FF'>
						<tr>
							<th>Sr No</th>
							<th>Roll No</th>
							<th>Name</th>
							<th>Marks Obtained</th>
							<th>Attendance</th></tr>";
				$count_below=0;
				$num_rows=mysqli_num_rows($run_data);
	
	if($num_rows>0)
	{
		$get_data="select * from $itis where semester='$just_sem'";
						$run_data=mysqli_query($con,$get_data);
		while($row_data=mysqli_fetch_array($run_data))
		{
			$roll_no=$row_data['roll_no'];
			$student_name=$row_data['student_name'];
			$marks_obtained=$row_data['marks_obtained']/5;
			$attendance=$row_data['attendance'];
			$count_below++;
			$y_exp_below=($a*$attendance)+$b+(1.5*$std_marks);
			if($marks_obtained>$y_exp_below){
				echo"
				<tr width='500' align='center' bgcolor='#6699FF' text-align='center'>
					<td>$count_below</td>
					<td>$roll_no</td>
					<td>$student_name</td>
					<td>$marks_obtained</td>
					<td>$attendance%</td></tr>";
			}
	}echo"</table>"; }
	if($num_rows==0)
	{
		echo"<p align='center'>No Student in this Criteria.</p>";
	}
	$chec_data="select sum(attendance) as 'attendance' from $itis where semester='$just_sem'";
				$run_chec=mysqli_query($con,$chec_data);
				$row_chec=mysqli_fetch_array($run_chec);
				$pot=$row_chec['attendance'];
				
				if($pot==0)
					{
						echo"<h1 style='margin:150px;'>Enter the Attendance then get the result.</h1>";
					}
		else
		{
			$feed_status="select status as 'allow' from event_status where event='Teachers Feedback'";
			$run_status=mysqli_query($con,$feed_status);
			$row_status=mysqli_fetch_array($run_status);
			$pit=$row_status['allow'];
			if($pit=='No')
			{
				echo"<div class='container text-center'>
								<h1>ID:$t_id</h1>
								<h1 style='text-decoration:underline;' class='display-3'>Welcome To $just_sem of $dept Department</h1>
								<h1 class='display-3'>Hi, $college_pat .</h1>
								<h1 id='msg'>FeedBack System has not yet been Activated you can give it once it is Activated by Admin.</h1>";
			}
		else 
		{ echo"<br><br><br><div style='background:#F5D06A;'><br><br><br><h1 style='text-align:center;text-decoration:underline'>Your Analysis Feedback</h1><br><br>
					<h1 class='display-1'>Dear $college_pat,</h1><br>
					<h5 class='display-4'>Your result was analysed for the particular entered semester and the exam 
					.So the inference drawn from the above entered data is as follows:<br><br></h5>";
				$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$get_att="select avg(attendance) as 'avg_attendance' from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$run_avg=mysqli_query($con,$get_avg);
				$run_att=mysqli_query($con,$get_att);
				$row_avg=mysqli_fetch_array($run_avg);
				$row_att=mysqli_fetch_array($run_att);
				$average=$row_avg['average'];
				$avg_attendance=$row_att['avg_attendance'];
				$run_data=mysqli_query($con,$get_data);		
				$sum_1=0;
				$sum_2=0;
				$sum_3=0;
				$n=0;
				while($row_data=mysqli_fetch_array($run_data))
						{
							$marks_obtained=$row_data['marks_obtained'];
							$attendance=$row_data['attendance'];
							$sub_marks=$marks_obtained-$average;
							$sub_marks_sqau=pow($sub_marks,2);
							$sub_att=$attendance-$avg_attendance;
							$sub_att_sqau=pow($sub_att,2);
							$product_sum=$sub_marks*$sub_att;
							$sum_1=$sum_1+$product_sum;
							$sum_2=$sum_2+$sub_marks_sqau;
							$sum_3=$sum_3+$sub_att_sqau;
						$n++; }
							$prod_want=$sum_2*$sum_3;
							if($n<30){
								$var1=$sum_2/($n-1);
								$var2=$sum_3/($n-1);
							}
							else if($n>30)
							{
								$var1=$sum_2/$n;
								$var2=$sum_3/$n;
							}
							$root_want=sqrt($prod_want);
							$corr=round(($sum_1/$root_want),4);
							$var_marks=round($var1,3);
							$std_marks=round(sqrt($var_marks),2);
							$var_att=round($var2,3);
							$std_att=round(sqrt($var_att),2);
				$just_sem=$_POST['current_sem'];
				$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
				$run_data=mysqli_query($con,$get_data);		
				echo"<br><br><br><br><h6 style='text-align:center;'>Attendance Defaulters.</h6>
				<table class='table-responsive-sm' border='5' align='center' bgcolor='#8840f5'>
						<tr><th>Sr No</th>
							<th>Roll No</th>
							<th>Name</th>
							<th>Marks Obtained</th>
							<th>Attendance</th></tr>";
				$count_below=0;
				$num_rows=mysqli_num_rows($run_data);
			if($num_rows>0)
			{
				while($row_data=mysqli_fetch_array($run_data))
				{
					$roll_no=$row_data['roll_no'];
					$student_name=$row_data['student_name'];
					$marks_obtained=$row_data['marks_obtained'];
					$attendance=$row_data['attendance'];
					if($attendance<75)
					{
						$count_below++;
						echo"
						<tr align='center' bgcolor='#6699FF' >
							<td>$count_below</td>
							<td>$roll_no</td>
							<td>$student_name</td>
							<td>$marks_obtained</td>
							<td>$attendance%</td></tr>";
					}
				}echo"</table><br><br>";
			}
			if($count_below==0)
			{
				echo"<p align='center'>No Student in this Criteria.</p><br><br>";
			}
		$just_sem=$_POST['current_sem'];
		$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$run_data=mysqli_query($con,$get_data);
		$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_att="select avg(attendance) as 'avg_attendance' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_var_marks="select var(marks_obtained) as 'var_mark' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_var_att="select var(attendance) as 'var_att' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_n1="select * from $itis where semester='$just_sem' and attendance>=$avg_attendance";
		$run_n1=mysqli_query($con,$get_n1);
		$n1=mysqli_num_rows($run_n1);
		$sum1=0;
		while($row_n1=mysqli_fetch_array($run_n1))
		{
			$marks_now=$row_n1['marks_obtained'];
			$sum1=$sum1+$marks_now;
		}
		$get_n2="select count(student_name) as 'num_2' from $itis where semester='$just_sem' and attendance<$avg_attendance";
		$run_n2=mysqli_query($con,$get_n2);
		$row_n2=mysqli_fetch_array($run_n2);
		$n2=$row_n2['num_2'];
		$run_avg=mysqli_query($con,$get_avg);
		$run_att=mysqli_query($con,$get_att);
		$row_avg=mysqli_fetch_array($run_avg);
		$row_att=mysqli_fetch_array($run_att);
		$average=$row_avg['average'];
		$avg_attendance=$row_att['avg_attendance'];
		$sum2=0;
		while($row_n1=mysqli_fetch_array($run_n1))
		{
			$marks_now=$row_n1['marks_obtained'];
			$sum1=$sum1+$marks_now;
		}
		$num_rows=mysqli_num_rows($run_data);
		if($num_rows>0)
		{
			while($row_data=mysqli_fetch_array($run_data))
			{
				$marks_obtained=$row_data['marks_obtained'];
				$attendance=$row_data['attendance'];
				
				if($attendance<$avg_attendance)
				{
					$sum2=$sum2+$marks_obtained;
				}
			}
			$avg1=$sum1/$n1;
			$avg2=$sum2/$n2;
		}
		$just_sem=$_POST['current_sem'];
		$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$run_data=mysqli_query($con,$get_data);
		$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_att="select avg(attendance) as 'avg_attendance' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_var_marks="select var(marks_obtained) as 'var_mark' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_var_att="select var(attendance) as 'var_att' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_n1="select * from $itis where semester='$just_sem' and attendance>=$avg_attendance";
		$run_n1=mysqli_query($con,$get_n1);
		$n1=mysqli_num_rows($run_n1);
		$get_n2="select * from $itis where semester='$just_sem' and attendance<$avg_attendance";
		$run_n2=mysqli_query($con,$get_n2);	
		$n2=mysqli_num_rows($run_n2);		
		$run_avg=mysqli_query($con,$get_avg);
		$run_att=mysqli_query($con,$get_att);
		$row_avg=mysqli_fetch_array($run_avg);
		$row_att=mysqli_fetch_array($run_att);
		$average=$row_avg['average'];
		$avg_attendance=$row_att['avg_attendance'];
		$num_rows=mysqli_num_rows($run_data);
		if($num_rows>0)
		{
			$sum_part1=0;
				while($row_n1=mysqli_fetch_array($run_n1))
					{
						$marks_now=$row_n1['marks_obtained'];
						$sub_marks1=$marks_now-$avg1;
						$sub_marks_sqau1=pow($sub_marks1,2);
						$sum_part1=$sum_part1+$sub_marks_sqau1;						
					}
			if($n1<10){
				$var1=0;
				if($n1>1){
				$var1=$sum_part1/($n1-1);
				}
				else{ echo"";} 
			}
			else if($n1>10)
			{
				if($n1>1){
				$var1=$sum_part1/$n1; }
				else{ echo"";}
			}
			$std_marks1=sqrt($var1);
			$s1=pow($std_marks1,2)/$n1;
		}
		$just_sem=$_POST['current_sem'];
		$get_data="select * from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$run_data=mysqli_query($con,$get_data);
		$get_avg="select avg(marks_obtained) as 'average' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_att="select avg(attendance) as 'avg_attendance' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_var_marks="select var(marks_obtained) as 'var_mark' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_var_att="select var(attendance) as 'var_att' from $itis where semester='$just_sem' and teacher_id='$t_id'";
		$get_n1="select * from $itis where semester='$just_sem' and attendance>=$avg_attendance";
		$run_n1=mysqli_query($con,$get_n1);
		$n1=mysqli_num_rows($run_n1);
		$get_n2="select * from $itis where semester='$just_sem' and attendance<$avg_attendance";
		$run_n2=mysqli_query($con,$get_n2);	
		$n2=mysqli_num_rows($run_n2);		
		$run_avg=mysqli_query($con,$get_avg);
		$run_att=mysqli_query($con,$get_att);
		$row_avg=mysqli_fetch_array($run_avg);
		$row_att=mysqli_fetch_array($run_att);
		$average=$row_avg['average'];
		$avg_attendance=$row_att['avg_attendance'];
		$num_rows=mysqli_num_rows($run_data);
		if($num_rows>0)
		{
			$sum_part2=0;
				while($row_n2=mysqli_fetch_array($run_n2))
					{
						$marks_now=$row_n2['marks_obtained'];
						
						$sub_marks2=$marks_now-$avg2;
						$sub_marks_sqau2=pow($sub_marks2,2);
						$sum_part2=$sum_part2+$sub_marks_sqau2;	;	
					}
					if($n2<10){
						$var2=0;
						if($n2>1){
						$var2=$sum_part2/($n2-1); }
						else { echo""; }
			}
			else if($n2>10)
			{
				if($n2>1){
				$var2=$sum_part2/$n2; }
				else { echo""; }
			}
			$std_marks2=sqrt($var2);
			$s2=pow($std_marks2,2)/$n2;
			$diff=0;
		if($avg1>$avg2)
		{
			$diff=$avg1-$avg2;	
		}
		else if($avg1<$avg2)
		{
			$diff=$avg2-$avg1;
		}
		$s=$s1+$s2;
		$t=sqrt($s);
		$z_value=round(($diff/$t),4); 
	}
	$nowit=$dept.$just_sem;
		$getit = str_replace('-', '', $nowit);
		$ohgod=0;
			$want_it="select * from $getit where teacher_name='$college'";
			$run_it=mysqli_query($con,$want_it);
			$wan_it=mysqli_fetch_array($run_it);
			$feed1=$wan_it['feedback'];
			$get_it="select count(feedback) as 'number' from students where class='$just_sem' and department='$dept' and feedback='Yes'";
			$we_it=mysqli_query($con,$get_it);
			$omg=mysqli_fetch_array($we_it);
			$val=$omg['number'];
			if($val==0){
				echo"<h3 align='center'>Don't submit your result till students give the feedback, if you submit it is going to effect your result.";
			}
			else{
			$ohgod=$feed1/$val;
			}
		if(($z_value>2.33 or $z_value==2.33) and $ohgod>3.5)
		{
			$feed="<h1 style='text-align:center;background-color:blue;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Congratulations!!! Your teaching is <b>Excellent</b> and your feedback is <b>Excellent</b> as well.<br>Keep It Up!!<br><br></h1>";
			$teach="Teaching is Excellent";
			$student_rel="FeedBack is Excellent";
		}
		else if(($z_value>2.33 or $z_value==2.33) and (($ohgod<3.5 and $ohgod>2.5) or $ohgod==2.5))
		{
			$feed="<h1 style='text-align:center;background-color:blue;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Congratulations!!! Your teaching is <b>Excellent</b> and your feedback is <b>Very Good</b>.<br>Please consult with HOD
			about how to become an even better professor<br></h1>";
			$teach="Teaching is Excellent";
			$student_rel="FeedBack is Very Good";
		}
		else if(($z_value>2.33 or $z_value==2.33) and (($ohgod<2.5 and $ohgod>1.5) or $ohgod==1.5))
		{
			$feed="<h1 style='text-align:center;background-color:yellow;color:black;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hello!!! Your teaching is <b>Excellent</b> and your feedback is <b>Good</b>.<br>Please consult with HOD
			about how to make your feedback better.<br><br></h1>";
			$teach="Teaching is Excellent";
			$student_rel="FeedBack is Good";
		}
		else if(($z_value>2.33 or $z_value==2.33) and ($ohgod<1.5))
		{
			$feed="<h1 style='text-align:center;background-color:yellow;color:black;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hello!!! Your teaching is <b>Excellent</b> but your feedback is <b>Satisfactory</b>.<br>Please consult with HOD
			about how to make your classes more student-friendly.<br><br></h1>";
			$teach="Teaching is Excellent";
			$student_rel="FeedBack is Satisfactory";
		}
		else if((($z_value<2.33 and $z_value>1.65) or $z_value==1.65) and $ohgod>=3.5)
		{
			$feed="<h1 style='text-align:center;background-color:blue;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Congratulations!!! Your teaching is <b>Very Good</b> and your feedback is <b>Excellent</b>.<br>Please consult with HOD
			about how to make your classes even more effective.<br><br></h1>";
			$teach="Teaching is Very Good";
			$student_rel="FeedBack is Excellent";
		}
		else if((($z_value<2.33 and $z_value>1.65) or $z_value==1.65) and (($ohgod<3.5 and $ohgod>2.5) or $ohgod==2.5))
		{
			$feed="<h1 style='text-align:center;background-color:blue;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Congratulations!!! Your teaching is <b>Very Good</b> and your feedback is <b>Very Good</b> as well.<br>Please consult with HOD
			about how to make your classes even more effective and student friendly.<br><br></h1>";
			$teach="Teaching is Very Good";
			$student_rel="FeedBack is Very Good";
		}
		else if((($z_value<2.33 and $z_value>1.65) or $z_value==1.65) and (($ohgod<2.5 and $ohgod>1.5) or $ohgod==1.5))
		{
			$feed="<h1 style='text-align:center;background-color:yellow;color:black;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hello!!! Your teaching is <b>Very Good</b> and your feedback is <b>Good</b>.<br>Please consult with HOD
			about how to make your classes even more effective and how to make your feedback better.<br><br></h1>";
			$teach="Teaching is Very Good";
			$student_rel="FeedBack is Good";
		}
		else if((($z_value<2.33 and $z_value>1.65) or $z_value==1.65) and ($ohgod<1.5))
		{
			$feed="<h1 style='text-align:center;background-color:yellow;color:black;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hello!!! Your teaching is <b>Very Good</b> but your feedback is <b>Satisfactory</b>.<br>Please consult with HOD
			about how to make your classes even more effective and how to make your classes more student friendly.<br><br></h1>";
			$teach="Teaching is Very Good";
			$student_rel="FeedBack is Satisfactory";
		}
		else if((($z_value<1.65 and $z_value>1.28) or $z_value==1.28) and $ohgod>=3.5)
		{
			$feed="<h1 style='text-align:center;background-color:green;color:yellow;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hi!!! Your teaching is <b>Good</b> and your feedback is <b>Excellent</b>.<br>Please set your papers at a more moderate
			level, they were either too hard or too easy.<br><br></h1>";
			$teach="Teaching is Good";
			$student_rel="FeedBack is Excellent";
		}
		else if((($z_value<1.65 and $z_value>1.28) or $z_value==1.28) and (($ohgod<3.5 and $ohgod>2.5) or $ohgod==2.5))
		{
			$feed="<h1 style='text-align:center;background-color:green;color:yellow;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hi!!! Your teaching is <b>Good</b> and your feedback is <b>Very Good</b>.<br>Please set your papers at a more moderate
			level, they were either too hard or too easy.<br><br></h1>";
			$teach="Teaching is Good";
			$student_rel="FeedBack is Very Good";
		}
		else if((($z_value<1.65 and $z_value>1.28) or $z_value==1.28) and (($ohgod<2.5 and $ohgod>1.5) or $ohgod==1.5))
		{
			$feed="<h1 style='text-align:center;background-color:red;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Ummm, your teaching is <b>Good</b> and your feedback is <b>Good</b> as well.<br>Please discuss with HOD how to improve your effectiveness
			and student interaction.<br><br></h1>";
			$teach="Teaching is Good";
			$student_rel="FeedBack is Good";
		}
		else if((($z_value<1.65 and $z_value>1.28) or $z_value==1.28) and ($ohgod<1.5))
		{
			$feed="<h1 style='text-align:center;background-color:red;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Ummm, your teaching is <b>Good</b> and your feedback is <b>Satisfactory</b>.<br>Please discuss with HOD how to improve your effectiveness
			and student interaction, especially the latter.<br><br></h1>";
			$teach="Teaching is Good";
			$student_rel="FeedBack is Satisfactory";
		}
		else if($z_value<1.28 and $ohgod>=3.5)
		{
			$feed="<h1 style='text-align:center;background-color:green;color:yellow;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hi!!! Your teaching is <b>Satisfactory</b> and your feedback is <b>Excellent</b>.<br>Please set your papers at a more moderate
			level, they were either too hard or too easy.<br><br></h1>";
			$teach="Teaching is Satisfactory";
			$student_rel="FeedBack is Excellent";
		}
		else if($z_value<1.28 and (($ohgod<3.5 and $ohgod>2.5) or $ohgod==2.5))
		{
			$feed="<h1 style='text-align:center;background-color:green;color:yellow;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Hi!!! Your teaching is <b>Satisfactory</b> and your feedback is <b>Very Good</b>.<br>Please set your papers at a more moderate
			level, they were either too hard or too easy.<br><br></h1>";
			$teach="Teaching is Satisfactory";
			$student_rel="FeedBack is Very Good";
		}
		else if($z_value<1.28 and (($ohgod<2.5 and $ohgod>1.5) or $ohgod==1.5))
		{
			$feed="<h1 style='text-align:center;background-color:red;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Ummm, your teaching is <b>Satisfactory</b> and your feedback is <b>Good</b>.<br>Please discuss with HOD how to improve your effectiveness
			and student interaction, especially the former.<br><br></h1>";
			$teach="Teaching is Satisfactory";
			$student_rel="FeedBack is Good";
		}
		else if($z_value<1.28 and ($ohgod<1.5))
		{
			$feed="<h1 style='text-align:center;background-color:red;color:white;width:80%;margin-left:auto;margin-right:auto;'><br><br>
			Ummm, your teaching is <b>Satisfactory</b> and your feedback is <b>Satisfactory</b> as well.<br>Please discuss with HOD how to improve your effectiveness
			and student interaction, you need to urgently work upon both.<br><br></h1>";
			$teach="Teaching is Satisfactory";
			$student_rel="FeedBack is Satisfactory";
		}
	
		echo"$feed<br><br>
		<form method='post' align='center'>
			<input type='hidden' name='feed_val' value='$z_value'> 
			<input type='hidden' name='feed_t' value='$teach'>
			<input type='hidden' name='sub' value='$my_sub'>
			<input type='hidden' name='feed_s' value='$student_rel'>
			<td align='center'><input type='submit' name='feed_sub'  class='btn btn-primary' value='Submit FeedBack'></td>
		</form>";
	}	
		}
}	
}
	}
}
?>
<?php 
if(isset($_POST['feed_sub'])){
	$now_sub=$_POST['sub'];
	$pipat=$_POST['feed_val'];
	$fed=$_POST['feed_t'];
	$fex=$_POST['feed_s'];
			echo"<div class='container text-center'>
					<br><br><h6 style='text-align:center;'>Your report which will be submited to HOD/Principal.</h6><br><br>
						<table class='table-responsive-sm' border='5' align='center' bgcolor='#94f7d6'>
							<tr><th>Teacher ID</th><td>$t_id</td></tr>
							<tr><th>Teacher Name</th><td>$college_pat</td></tr>
							<tr><th>Subject</th><td>$now_sub</td></tr>
							<tr><th>Department</th><td>$dept</td></tr>
							<tr><th>FeedBack value</th><td>$pipat</td></tr>
							<tr><th>Message</th><td>$fed and $fex</td></tr>
						</table>
				</div>
				<br><br><form method='post' align='center'>
				<input type='hidden' name='feed_val' value='$pipat'> 
				<input type='hidden' name='feed_t' value='$fed'>
				<input type='hidden' name='sub' value='$now_sub'>
				<input type='hidden' name='feed_s' value='$fex'>
				<td align='center'><input type='submit' name='dept_sub'  class='btn btn-primary' value='Submit Report' /></td></form>";
		}
?>
<?php 
		if(isset($_POST['dept_sub'])){
			$now_sub=$_POST['sub'];
		$pipat=$_POST['feed_val'];
		$fed=$_POST['feed_t'];
		$fex=$_POST['feed_s'];
		$update_feed="update teachers set feedback='Yes',feed_value='$pipat',teaching='$fed',student_feedback='$fex' where name='$college_pat' and subject='$now_sub'   and teacher_username='$teacher_session'";
		$run_update=mysqli_query($con,$update_feed);
		if($run_update)
		{
			echo "<script>alert('FeedBack Given Succesfully')</script>";
			echo "<script>window.open('my_account?name=$college_pat','_self')</script>";
		}
		else
		{
			echo "<script>alert('FeedBack Not  Given Succesfully)</script>";
			echo "<script>window.open('my_account?name=$college_pat','_self')</script>";
		}
		}
}
}
else {
	echo "<script>window.open('../login','_self')</script>";
}	?>
</body>
</html>

