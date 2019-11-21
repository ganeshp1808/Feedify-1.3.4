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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="animate.css">
<?php
$user_name=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sele_teacher = "select * from institutions where username='$user_name' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$rune_teacher = mysqli_query($con,$sele_teacher); 
$college_name=mysqli_fetch_array($rune_teacher);
$college_pat=$college_name['name'];
echo"<title>Get Started- $college</title>";
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<link rel="stylesheet" media="all" />
<style>
body
{
	font-family: 'Ubuntu Mono', monospace;
	background-color:#c3ed07;
}
	.ops
	{
		margin-top:150px;
		background-color:#1ce8ff;
	}
	}
	@media only screen and (max-width:700px){
		h3{font-size:1rem;}
	}
.form-control
{
	width:50%;
	margin:auto;
	background-color:#fae6c0;
	border-radius:20px;
}
.pip
{
	width:100%;
	margin:auto;
	
}
.form-control:focus {

    background-color:#b4f0e9;
}
.form-control::placeholder
{
	color:black;
}
#form{margin-left:auto;margin-right:auto;}
.form-control::input
{
	color:black;
}
.ops h1,h2{color:#220357;}
@media only screen and (max-width:700px){
	.display-2{font-size:2rem;}
		h1,h2,h3{font-size:1rem;}
		.pip{font-size:0.7rem;}
	}
</style>
</head>
<body>
<div class='container text-center ops'>
<br><br>
<h1 class='display-2'>Welcome to Feedify</h1>
	<h1>Here are some initial Steps to be done,do that to proceed further.</h1>
	<br><br>
	 <h3>1.Just enter all the departments you want.<br>2.After that, add all the Semesters. <br>3.Finally, add the Teachers and Students.</h3>
	 <br>
	 <h3>Good Luck!! Hope you Enjoy using Product.</h3>
	 <br>
	 <h3>Department mail id is basically the email id of the HOD. The analysis results for the individual professors will be mailed to the HOD.</h3>
	 <br>
	 <form align='center' method="post">
			<tr>
				<td><h2>How many Departments you Want to Insert? </h2></td><br>
				<td ><input class='form-control' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    maxlength = "1" type="number" name="num" required/></td>
			</tr><br><br>
			<tr>
				<input type="submit" class='btn btn-primary' name='enter_entries' value='Enter Entries' />
			</tr>
	</form>
	<br><br>
</div>
<?php
if(isset($_POST['enter_entries']))
{
	$number=$_POST['num'];
	echo"<form id='form' method='post'>
			<table class='table-responsive-sm' border='5' align='center' bgcolor='#91b1e6'>
			<tr><th align='center' colspan='3'><h2>Enter Department Details</h2></th></tr>
			<tr>
				<th>Department ID</th>
				<th>Name</th>
				<th>Department EMAIL</th>
			</tr>";
			for($i=1;$i<=$number;$i++)
			{
				?>
				<tr>
					<td><input  class="form-control pip" type="number" name="dept_id[]" placeholder="Department ID" required="required" /></td>
					<td><input  class="form-control pip" type="text" name="dept_name[]" placeholder="Department Name" required="required" /></td>
					<td><input  class="form-control pip" type="text" name="dept_email[]" placeholder="Department Email" required="required" /></td>
				</tr>
	<?php
			}
			?>
			<tr><td><input  class='form-control' type='hidden' name='number' value="<?php echo $number ?>"></td></tr>
			<?php
			echo"<tr><td align='center' colspan='4'><button  type='submit' class='btn btn-primary' name='add_dept'>Add Department</button></td></tr></table></form><br><br>"; }
?>
</body>
</html>
<?php
if(isset($_POST['add_dept'])){
	$s = "insert into departments (dept_id,dept_name,dept_email) values";
	for($i=0;$i<$_POST['number'];$i++)
	{
		$s .="('".$_POST['dept_id'][$i]."','".$_POST['dept_name'][$i]."','".$_POST['dept_email'][$i]."'),";
	}
	$s = rtrim($s,",");
	$get_it=mysqli_query($con,$s);
	if(!$get_it){
		echo"<script>alert('Data Not Entered Succesfully$data_name!!!')</script>";
		echo mysqli_error($con);
	}
	else{
		echo "<script>alert('Data Entered Succesfully!!!')</script>";
		echo "<script>window.open('enter_semester?name=$college','_self')</script>";
		
	}
	mysqli_close($con);
}
}
else{
	echo "<script>window.open('login','_self')</script>";
}  
?>