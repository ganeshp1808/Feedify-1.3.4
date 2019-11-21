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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sele_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$rune_teacher = mysqli_query($con,$sele_teacher); 
$college_name=mysqli_fetch_array($rune_teacher);
$college_pat=$college_name['name'];
echo"<title>Final Stage-$college</title>";
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<style>
body
{
	font-family: 'Ubuntu Mono', monospace;
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
.ops h1,h2{color:#8f4f06;}
@media only screen and (max-width:700px){
		h1,h2,h3{font-size:1rem;}
		.pip{font-size:0.7rem;}
	}
</style>
</head>
<a style='color:black;margin-left:30px;margin-top:30px;width:200px;' class='btn' href='admin_panel?name=<?php echo $college ?>'><b>Go To Admin Panel</b></a>
<body>
		<div class='container text-center ops'>
			<br><br>
			<h3>OOpss It's Important</h3>
			<h3>Set Your Button Panel Code First.</h3>
			<h1>Important Instruction</h1>
			<h4>Hello Person Viewing this Page,<br>This Code will be with only one person as from this you will access Button Panel where Activation of marks entry by Teachers can be done and Other Events.So for Security Reasons keep this Code with only one person who will Activate Events.</h4><br><br>
			<h3>Enter any Six Digit Number</h3>
			<form method="post">
				<input class="form-control"  type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"    maxlength = "6" name="button_number" placeholder="Enter Six Digit Code" required="required" />
				<br><br>
				<button  type='submit' class='btn btn-primary' name='final'>Set Panel Code</button>
			</form>
			<br><br>
		</div>
</body>
</html>
<?php
if(isset($_POST['final']))
{
	$button_number=$_POST['button_number'];
	$insert_button="insert into button_panel_code (code) values ('$button_number')";
	$run_button=mysqli_query($con,$insert_button);
	if($insert_button)
	{
		echo "<script>alert('Ready To Go!!')</script>";
			echo "<script>window.open('button_panel?name=$college','_self')</script>";
		
	}
}
					}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>