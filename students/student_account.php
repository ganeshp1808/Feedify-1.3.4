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
$sel_teacher = "select * from institutions where username='$user_name' and security_pin='$user_pass' and name='$college'";
$run_teacher = mysqli_query($con,$sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
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
	<link rel="stylesheet" href="s/animate.css">
    <link rel="stylesheet" href="s/student.css">
	<?php
$student_session=$_SESSION['student_username'];
$sel_teacher = "select * from students where student_username='$student_session'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
$roll_no=$college_name['roll_no'];
$college_pat=$college_name['name'];
$dept=$college_name['department'];
$now_sem=$college_name['class'];
$mail=$college_name['student_email'];
$getit=$dept.$now_sem;
$getit = str_replace('-', '', $getit);
echo"<title>My Account-$college</title>";
?>
<style>
body{ background-image: linear-gradient(#fcba03,#d9fa00); }
	input[type='radio']
	{
		transform:scale(1.5);
	}
	h3
	{
		text-decoration:bold;
	}
	td,th{text-align:center;}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
</head>
<?php
$feed_status="select status as 'allow' from event_status where event='Students FeedBack'";
$run_status=mysqli_query($con,$feed_status);
$row_status=mysqli_fetch_array($run_status);
$pit=$row_status['allow'];
if($pit=='No')
{
	echo"<a style='color:yellow;margin-left:30px;margin-top:30px;' class='btn' href='../college_page?name= $college'><b>Logout</b></a><div class='container'>
					<br><br><br><h1>ID:$roll_no</h1>
					<h1 style='text-decoration:underline;' class='display-3'>Welcome To $now_sem of $dept Department</h1>
					<h1 class='display-3'>Hi, $college_pat .</h1>
					<h1 id='msg'><br><br>Opps!!FeedBack System has not yet been Activated you can give it once it is Activated by Admin.<br><br></h1>";
}
else
{
?>
<body>
	<a style='color:yellow;margin-left:30px;margin-top:30px;' class='btn' href='../college_page?name=<?php echo $college ?>'><b>Logout</b></a>
	<header id="firstsection">
		<?php
				echo"<div class='container'>
					<br><br><br><h1 id='impo' class='animated fadeInUp' style='animation-duration:2s;'>ID:$roll_no</h1>
					<h1 style='text-decoration:underline;animation-duration:2s;' class='display-3 animated bounceInLeft'>Welcome To $now_sem of $dept Department</h1>
					<h1 class='display-3 animated bounceInRight' style='animation-duration:2s;'>Hi, $college_pat .</h1>";
							?>	<br><br>
								<h3>Simple Steps to follow:</p>
								<h6>1. Complete the feedback within the due time.</h6>
								<h6>2. Make sure feedback is given properly for every teacher.</h6>
								<h6>3. Thank You for your valuable time, your feedback means a lot for the system.</h6>
								<h6>4. Please provide honest and accurate feedback, the data you provide is meant for statistical analysis to gauge professor performance.</h6>
							<br><br><br><br>
							<form method='post' align='center'>
								<input type="submit" name="enter" class="btn" value="Give FeedBack"/>
							</form>
					</div>
	</header>
	<header id="secondsection">
		<div class='container text-center'>
			<?php
				if(isset($_POST['enter'])){
					$sel_teacher = "select * from students where student_username='$student_session' and roll_no='$roll_no'";
					$run_it=mysqli_query($con,$sel_teacher);
					$my_it=mysqli_fetch_array($run_it);
					$pop=$my_it['feedback'];
					if($pop=='Yes')
					{
						echo"<h3>You have already given this feedback.</h3>";
					}
					else{
							$feed_teach="select * from $getit";
							echo"<h1>Give Feedback</h1><br>";
							$run_feed=mysqli_query($con,$feed_teach);
							$i=0;
							while($row_feed=mysqli_fetch_array($run_feed))
							{
								$teacher_name=$row_feed['teacher_name'];
								$sub=$row_feed['subject'];
								$sub_new = str_replace(' ', '', $sub);
								echo"<table class='table-responsive-sm' border=2 align='center' width='80%'>
								<tr><td align='center' colspan='5'><h2>Name:$teacher_name</h2></td></tr>
								<tr><td align='center' colspan='5'><h2>Subject:$sub</h2></td></tr>
								<tr>
									<th><h3><b>Questions</h3></th>
									<th><h3><b>Excellent</b></h3></th>
									<th><h3><b>Very Good</b></h3></th>
									<th><h3><b>Good</b></h3></th>
									<th><h3><b>Satisfactory</b></h3></th></tr>";?>
									<tr>
									<td><h4> Rate the faculty on their clarity of speech</h4></td>
									<form class='form-control' method='post'>    
										<td><input type='radio' name='one<?php echo $sub_new; ?>[]' value='4' required/></td>  
										<td><input type='radio' name='one<?php echo $sub_new; ?>[]' value='3' required/></td>  
										<td><input type='radio' name='one<?php echo $sub_new; ?>[]' value='2' required/></td>  
										<td><input type='radio' name='one<?php echo $sub_new; ?>[]' value='1' required/></td> 
									</tr>
									<tr>
									<td><h4>Rate yourself on the basis of your understanding of the subject</h4></td>
										<td><input type='radio' name='two<?php echo $sub_new; ?>[]' value='4' required/></td>  
										<td><input type='radio' name='two<?php echo $sub_new; ?>[]' value='3' required/></td>  
										<td><input type='radio' name='two<?php echo $sub_new; ?>[]' value='2' required/></td>  
										<td><input type='radio' name='two<?php echo $sub_new; ?>[]' value='1' required/></td> 
									</tr>
									<tr>
									<td><h4> Rate the faculty on the basis of their involvement of students in the learning process</h4></td>
										<td><input type='radio' name='three<?php echo $sub_new; ?>[]' value='4' required/></td>  
										<td><input type='radio' name='three<?php echo $sub_new; ?>[]' value='3' required/></td>  
										<td><input type='radio' name='three<?php echo $sub_new; ?>[]' value='2' required/></td>  
										<td><input type='radio' name='three<?php echo $sub_new; ?>[]' value='1' required/></td> 
									</tr>
									<td><h4> Rate the faculty on the basis of their efforts to relate the subject to daily life/industrial applications</h4></td>
										<td><input type='radio' name='four<?php echo $sub_new; ?>[]' value='4' required/></td>  
										<td><input type='radio' name='four<?php echo $sub_new; ?>[]' value='3' required/></td>  
										<td><input type='radio' name='four<?php echo $sub_new; ?>[]' value='2' required/></td>  
										<td><input type='radio' name='four<?php echo $sub_new; ?>[]' value='1' required/></td> 
									</tr>
									<td><h4>How do you rate the overall effectiveness of the teacher?</h4></td>
										<td><input type='radio' name='five<?php echo $sub_new; ?>[]' value='4' required/></td>  
										<td><input type='radio' name='five<?php echo $sub_new; ?>[]' value='3' required/></td>  
										<td><input type='radio' name='five<?php echo $sub_new; ?>[]' value='2' required/></td>  
										<td><input type='radio' name='five<?php echo $sub_new; ?>[]' value='1' required/></td> 
									</tr>
							</tr></table><br><br>
				<?php
					$i++;}
					?><input type='submit' name='give_feed' class='btn' value='Submit FeedBack' /></form>
				<?php			
					}}?>
		</div>
	</header>
</body>
</html>
<?php
}
if(isset($_POST['give_feed']))
{
	$feed_teach="select * from $getit";
	$run_feed=mysqli_query($con,$feed_teach);
	while($row_feed=mysqli_fetch_array($run_feed))
	{	$i=0;
		$sum=0;
		$teacher_name=$row_feed['teacher_name'];
		$sub=$row_feed['subject'];
		$sub_new = str_replace(' ', '', $sub);
		$pal=$row_feed['feedback'];
		$val_1=$_POST['one'.$sub_new][$i];
		$val_2=$_POST['two'.$sub_new][$i];
		$val_3=$_POST['three'.$sub_new][$i];
		$val_4=$_POST['four'.$sub_new][$i];
		$val_5=$_POST['five'.$sub_new][$i];
		$sum=$sum+(($val_1+$val_2+$val_3+$val_4+$val_5)/5.00);
		$pal=$pal+$sum;
		$update_tb="update $getit set feedback='$pal' where teacher_name='$teacher_name' and subject='$sub'";
		$feedback=mysqli_query($con,$update_tb);
		$i++;
	}
	$update_feed="update students set feedback='Yes' where student_username='$student_session'";
	$run_feed=mysqli_query($con,$update_feed);
	if($feedback and $run_feed){
		echo "<script>alert('$college_pat you have given FeedBack Succesfully!!!')</script>";
			echo "<script>window.open('student_account?name=$college_pat','_self')</script>";
			
		}
		else{
			echo"<script>alert('Data Not Entered Succesfully!!!')</script>";
			echo mysqli_error($con);
		}
}
	}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>