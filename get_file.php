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
   <?php
$user_name=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sele_teacher = "select * from institutions where username='$user_name' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$rune_teacher = mysqli_query($con,$sele_teacher); 
$college_name=mysqli_fetch_array($rune_teacher);
$type=$college_name['type'];
$address=$college_name['address'];
$location=$college_name['location'];
$city=$college_name['city'];
$state=$college_name['state'];
$zipcode=$college_name['pincode'];
$admin_user=$college_name['admin_panel_username'];
$admin_pass=$college_name['admin_panel_password'];
echo"<title>$college</title>";
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
	<link rel="stylesheet" media="all" />
<script language='javascript' type="text/javascript">
	window.history.forward();
</script>
<body>
<?php

			header('Content-Type:text/plain');    
			header("Content-Disposition: attachment; filename=college_data.xls");
			echo"<br><h1 align='center'>Teachers Data</h1>";
			$sql_data="select * from teachers";
			$result_daton=$con->query($sql_data);
			echo '<table border="1">';
			//make the column headers what you want in whatever order you want
			echo '<tr><th>Teacher Id</th><th>Designation</th><th>Name</th><th>Department</th><th>Class Number</th><th>Class</th><th>Teacher Username</th><th>Teacher Password</th><th>Teacher Email</th><th>Subject</th><th>Feedback Given</th><th>Teaching Value</th><th>Teaching Performance</th><th>Student Feedback</th></tr>';
			//loop the query data to the table in same order as the headers
			while ($row = mysqli_fetch_assoc($result_daton)){
				echo "<tr><td>".$row['teacher_id']."</td><td>".$row['designation']."</td><td>".$row['name']."</td><td>".$row['department']."</td><td>".$row['no_of_class']."</td><td>".$row['class']."</td><td>".$row['teacher_username']."</td><td>".$row['teacher_password']."</td><td>".$row['teacher_email']."</td><td>".$row['subject']."</td><td>".$row['feedback']."</td><td>".$row['feed_value']."</td><td>".$row['teaching']."</td><td>".$row['student_feedback']."</td></tr>";
			}
			echo "</table><br>";
			echo"<h1 align='center'>Students Data</h1>";
			$sq_data="select * from students";
			$resul_daton=$con->query($sq_data);
			echo '<table border="1" width="100%">';
			//make the column headers what you want in whatever order you want
			echo '<tr><th>Roll No</th><th>Name</th><th>Department</th><th>Class</th><th>Student Username</th><th>Student Password</th><th>Feedback</th></tr>';
			//loop the query data to the table in same order as the headers
			while ($row_stupe = mysqli_fetch_assoc($resul_daton)){
				echo "<tr><td>".$row_stupe['roll_no']."</td><td>".$row_stupe['name']."</td><td>".$row_stupe['department']."</td><td>".$row_stupe['class']."</td><td>".$row_stupe['student_username']."</td><td>".$row_stupe['student_password']."</td><td>".$row_stupe['feedback']."</td></tr>";
			}
			echo"</table>";
?>
</body>
</html>
<?php
}
else{
	echo "<script>window.open('login','_self')</script>";
} 
?>