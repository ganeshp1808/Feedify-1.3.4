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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="animate.css">
<link rel="stylesheet" href="t/admin_panel.css">
<?php
$college_time=$_SESSION['username'];
$user_pass=$_SESSION['pass'];
$college=$_SESSION['name'];
$college_id=$_SESSION['college_id'];
$sel_teacher = "select * from institutions where username='$college_time' and security_pin='$user_pass' and name='$college' and college_id='$college_id'";
$run_teacher = mysqli_query($con, $sel_teacher); 
$college_name=mysqli_fetch_array($run_teacher);
echo"<title>Button Panel-$college</title>";
$data_name=$college_name['database_name'];
$con=mysqli_connect("localhost","root","","$data_name");
if (!$con){
    die("Connection failed: ".mysqli_connect_error());
}
?>
<link rel="stylesheet" media="all" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>
.btn{width:300px;}
</style>
</head>
<body>
<?php
$event=$_GET['event'];
if($event=='Teachers Feedback')
{ ?>
<a href='<?php echo"admin_panel?name=$college"; ?>' class='btn'>Go To Admin Panel</a>
<?php 
$check_stat="select status from event_status where event='$event'";
$run_stta=mysqli_query($con,$check_stat);
$row_stat=mysqli_fetch_array($run_stta);
$omg=$row_stat['status'];
	if($omg=='Yes'){
	?>
	<div class='container text-center'>
		<br><br>
		<h1>You have already activated this event.</h1>
	</div>
<?php } else{ ?>
<div class='container text-center'>
<br><br>
	<h1>Important Instruction</h1>
	<h2>By pressing this button, you make sure that all other buttons are pressed and feedback is on the last stage of completion.</h2>
	<h2>Once you click below button, then teachers have only <b>14 days</b> to give feednback as after that product will get expire and you have to <b>renew the SUBSCRIPTION.</b></h2>
<?php
	$cur_date = strtotime("+0 day", time());echo "<br><br><h4><b>Today's Date:</b>".date('M d, Y', $cur_date)."</h4><br><br>";
	 $date = strtotime("+14 day", time());echo "<h4><b>SUBSCRIPTION ENDS ON:</b>".date('M d, Y', $date)."</h4><br><br>";
?>
<form method='post'>
	<button  type='submit' class='btn btn-warning' name='finaly_doit'>Activate</button></form>
</div>
<?php
}
if(isset($_POST['finaly_doit'])){
	$update_eve="update event_status set status='Yes' where event='Teachers Feedback'";
	$run_eve=mysqli_query($con,$update_eve);
	$cur_date = strtotime("+0 day", time());$now_datep=date('M d, Y', $cur_date);
	$date = strtotime("+14 day", time());$end_datep=date('M d, Y', $date);
	$ins_subscrip="insert into subscription(active_date,end_date) values ('$cur_date','$date')";
	$run_subscrip=mysqli_query($con,$ins_subscrip);
	if($run_eve and $run_subscrip){
			echo "<script>alert('Teachers Feedback Activated')</script>";
		echo "<script>window.open('button_panel?name=$college','_self')</script>"; } 
		else{
				echo "<script>alert('Teachers Feedback not Activated')</script>";
			}
		}
	}

else{
	$check_stat="select status from event_status where event='$event'";
	$run_stta=mysqli_query($con,$check_stat);
	$row_stat=mysqli_fetch_array($run_stta);
	$omg=$row_stat['status'];
	if($omg=='Yes'){
		?>
		<div class='container text-center'>
			<br><br>
			<h1>You have already activated this event.</h1>
			<a href='<?php echo"admin_panel?name=$college"; ?>' class='btn'>Go To Admin Panel</a>
		</div>
		<?php
	}
	else if($omg=='No'){
	$update_eve="update event_status set status='Yes' where event='$event'";
	$run_eve=mysqli_query($con,$update_eve);
		if($run_eve){
			echo "<script>alert('$event Activated')</script>";
					echo "<script>window.open('button_panel?name=$college','_self')</script>";
		} 
		else{
			echo "<script>alert('$event not Activated')</script>";
		}
	}
}
}
else{
	echo "<script>window.open('../login','_self')</script>";
}
?>
</body>
</html>