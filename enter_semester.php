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
$type=$college_name['type'];
echo"<title>Enter Semester-$college</title>";
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
		background-color:#a3d48a;
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
table{width:40%;}
.ops h1,h2{color:#8f4f06;}
@media only screen and (max-width:700px){
		h1,h2,h3{font-size:1rem;}
		.pip{font-size:0.7rem;}
	}
	</style>
</head>
<body>
<?php if($type=='College'){ ?>
<div class='container text-center ops'>
<br><br>
	<h1 >Don't Go Back have patience you are on the last stage of Getting Started.</h1>
	<br><br>
	<h3 >Good Luck!! Hope you Enjoy using Product.</h3>
	<form align='center' method="post">
		<tr>
			<td><h2>How many Semesters you Want to Insert? </h2></td><br>
			<td><input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    maxlength = "2" class='form-control' type="number" name="num" required/></td>
		</tr>
		<br><br>
		<tr>
			<td ><input type="submit" class='btn btn-primary' name='enter_entries' value='Enter Entries' /></td>
		</tr>
	</form>
	<br><br>
</div>
<?php
if(isset($_POST['enter_entries']))
{
	$number=$_POST['num'];
	echo"<br><br><form method='post'>
			<table align='center'>
			<tr><th  colspan='9'>Enter Semester</th></tr>";
			for($i=1;$i<=$number;$i++)
			{ ?>
				<tr>
					<td>
						<select class='form-control pip' type='number' name='sem[]' required>
										<option value="">Select Semester</option>
										<option value='Semester-1'>Semester-1</option>
										<option value='Semester-2'>Semester-2</option>
										<option value='Semester-3'>Semester-3</option>
										<option value='Semester-4'>Semester-4</option>
										<option value='Semester-5'>Semester-5</option>
										<option value='Semester-6'>Semester-6</option>
										<option value='Semester-7'>Semester-7</option>
										<option value='Semester-8'>Semester-8</option>
										<option value='Semester-9'>Semester-9</option>
										<option value='Semester-10'>Semester-10</option>
						</select>
					</td>
				</tr>
	<?php
			}
			?>
			<tr ><input  class='form-control' type='hidden' name='number' value="<?php echo $number ?>"  /></tr>
			<?php
			echo"<tr><td align='center'><button  type='submit' class='btn btn-primary' name='add_dept'>Add Semester</button><td></tr></table></form><br><br>";
} } else if($type=='School'){
?><br><br>
<div class='container text-center ops'>
<br><br>
	<h1 >Don't Go Back have patience you are on the last stage of Getting Started.</h1>
	<br><br>
	<h3 >Good Luck!! Hope you Enjoy using Product.</h3>
	<form align='center' method="post">
		<tr>
			<td><h2>How many Classes you Want to Insert? </h2></td><br>
			<td><input  class='form-control' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    maxlength = "1" type="number" name="num"/></td>
		</tr>
		<br><br>
		<tr>
			<td ><input type="submit" class='btn btn-primary' name='enter_entries' value='Enter Entries' /></td>
		</tr>
	</form>
	<br><br>
</div>
<?php
if(isset($_POST['enter_entries']))
{
	$number=$_POST['num'];
	echo"<br><br><form method='post'>
			<table align='center' bgcolor='white'>
			<tr><th  colspan='9'>Enter Class</th></tr>";
			for($i=1;$i<=$number;$i++)
			{
				?>
				<tr>
					<td>
						<select class='form-control pip' type='number' name='sem[]'>
										<option value="">Select Class</option>
										<option value='Class-1'>Class-1</option>
										<option value='Class-2'>Class-2</option>
										<option value='Class-3'>Class-3</option>
										<option value='Class-4'>Class-4</option>
										<option value='Class-5'>Class-5</option>
										<option value='Class-6'>Class-6</option>
										<option value='Class-7'>Class-7</option>
										<option value='Class-8'>Class-8</option>
										<option value='Class-9'>Class-9</option>
										<option value='Class-10'>Class-10</option>
										<option value='Class-11'>Class-11</option>
										<option value='Class-12'>Class-12</option>
						</select>
					</td>
				</tr>
	<?php } ?>
			<tr ><input  class='form-control' type='hidden' name='number' value="<?php echo $number ?>"  /></tr>
			<?php
			echo"<tr><td align='center'><button  type='submit' class='btn btn-primary' name='add_dept'>Add Class</button><td></tr></table></form><br><br>";
}
}
?>
</body>
</html>
<?php
if(isset($_POST['add_dept'])){
	$s = "insert into semester (sem_name) values";
	for($i=0;$i<$_POST['number'];$i++)
	{
		$s .="('".$_POST['sem'][$i]."'),";
	}
	$s = rtrim($s,",");
	$get_it=mysqli_query($con,$s);
	if(!$get_it){
		echo"<script>alert('Data Not Entered Succesfully!!!')</script>";
		echo mysqli_error($con);
	}
	else{
		echo "<script>alert('Data Entered Succesfully!!!')</script>";
		echo "<script>window.open('add_exams?name=$college','_self')</script>";
		
	}
	mysqli_close($con);
} 
}
else{
	echo "<script>window.open('login','_self')</script>";
}
?>