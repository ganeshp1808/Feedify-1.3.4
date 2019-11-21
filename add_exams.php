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
$type=$college_name['type'];
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
echo"<title>Enter Exams $college</title>";
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
	<div class='container text-center ops'>
		<br><br>
		<h1 class='display-2'>Welcome to Feedify</h1>
			<h1>Here are exams setup to be done,do that to proceed further.</h1>
			<br><br>
			 <h3>1.Just enter all required exam name of your curicullum for which you want to analyze results.<br>2.After that, add the maximum marks of the respective exams you are going to add.</h3>
			 <br>
			 <h3>Good Luck!! Hope you Enjoy using Product.</h3>
			 <br>
			 <form align='center' method="post">
					<tr>
						<td><h2>How many exams you want to add? </h2></td><br>
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
	echo"<form id='form' method='post' >
			<table class='table-responsive-sm' border='5' align='center' bgcolor='#91b1e6'>
			<tr><th align='center' colspan='3'><h2>Enter Exam Details</h2></th></tr>
			<tr>
				<th>Exam Name</th>
				<th>Maximum Marks</th>
			</tr>";
			for($i=1;$i<=$number;$i++)
			{
				?>
				<tr>
					<td><input  class="form-control pip" type="text" name="exam_name[]" placeholder="Exam Name" required="required" /></td>
					<td><input  class="form-control pip" type="number" name="max_marks[]" placeholder="Maximum Marks" required="required" /></td>
				</tr>
	<?php
			}
			?>
			<tr><td><input  class='form-control' type='hidden' name='number' value="<?php echo $number ?>"></td></tr>
			<?php
			echo"<tr><td align='center' colspan='4'><button  type='submit' class='btn btn-primary' name='add_exams'>Enter Exams</button></td></tr></table></form><br><br>"; }
?>
</body>
</html>
<?php
if(isset($_POST['add_exams'])){
	$s = "insert into exams (exam_name,maximum_marks) values";
	for($i=0;$i<$_POST['number'];$i++)
	{
		$s .="('".$_POST['exam_name'][$i]."','".$_POST['max_marks'][$i]."'),";
	}
	$s = rtrim($s,",");
	$p="insert into event_status (event,status) values";
	for($i=0;$i<$_POST['number'];$i++)
	{
		$ex=$_POST['exam_name'][$i];
		$poy=$ex." Marks Entry";
		$p .="('".$poy."','No'),";
	}
	$p = rtrim($p,",");
	$get_it=mysqli_query($con,$s);
	$got_it=mysqli_query($con,$p);
	if(!$get_it and !$got_it){
		echo"<script>alert('Data Not Entered Succesfully!!!')</script>";
		echo mysqli_error($con);
	}
	else{
		echo "<script>alert('Data Entered Succesfully!!!')</script>";
		echo "<script>window.open('college_page?name=$college','_self')</script>";
	}
	}
}
else{
	echo "<script>window.open('login','_self')</script>";
}
?>