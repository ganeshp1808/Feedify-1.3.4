<?php 
@session_start();
error_reporting(0);
ini_set('display_errors', 0);
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
    <link rel="stylesheet" href="feed/animate.css">
	<link rel="stylesheet" href="feed/login.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script language='javascript' type="text/javascript">
	window.history.backward();
</script>
<title>Login Panel</title>
<link rel="stylesheet" media="all" />
</head>
<body>
<section id="loginbox">
	<h1 class="display-4">Login</h1><br><br>
    <form align='center' method="post">
	<select  class="form-control" type="number" name="name" required>
		<?php
				$get_cats="select distinct name from institutions";
				$run_cats=mysqli_query($con,$get_cats);
												while($row_cats=mysqli_fetch_array($run_cats))
												{
													$my_roll=$row_cats['name'];
													
												echo"<option value='$my_roll'>".$my_roll."</option>";
												}
												?> </select><br><br>
		<select  class="form-control" type="number" name="location"  required>
		<?php $get_cats="select distinct location from institutions";
												$run_cats=mysqli_query($con,$get_cats);
												while($row_cats=mysqli_fetch_array($run_cats))
												{
													$my_roll=$row_cats['location'];
													
												echo"<option value='$my_roll'>".$my_roll."</option>";
												}
												?>
		</select><br><br>
    	<input  class="form-control" type="text" name="username" placeholder="Username" required="required" />
		<span id="user"></span><br><br>
		<input class="form-control" type="password" name="pass" placeholder="Password" required="required" />
		<span id="pass"></span><br><br>
		<button  type="submit" class="btn" name="login">Login</button>
    </form>
</section>
</body>
</html>
<?php 
if(isset($_POST['login']))
{
	$name=$_POST['name'];
	$location=$_POST['location'];
	$user_name = $_POST['username'];
	$user_pass = $_POST['pass'];
	$sel_teacher = "select * from institutions where username='$user_name' AND security_pin='$user_pass' and name='$name' and location='$location'";
	$run_teacher = mysqli_query($con, $sel_teacher); 
if($run_teacher=='0'){
	echo"";
	} 
	else{
		$college_name=mysqli_fetch_array($run_teacher);
		$check_teacher = mysqli_num_rows($run_teacher);
		$college=$college_name['name'];
		$college_id=$college_name['college_id'];
		$pay_it=$college_name['payment_status'];
		if($pay_it=='No')
		{
			echo "<script>window.open('payment_status','_self')</script>";
		}
		else{
		if($check_teacher>0)
		{
			$_SESSION['username']=$user_name;
			$_SESSION['pass']=$user_pass;
			$_SESSION['name']=$college;
			$_SESSION['college_id']=$college_id;
			echo "<script>window.open('college_page?name=$college','_self')</script>";
		}else 
			{
				echo "<script>
					var p1=document.querySelector('#user');
					var p2=document.querySelector('#pass');
					p1.textContent='Invalid Username';
					p2.textContent='Incorrect Password';
				</script>"; }
		}
	}
}
?>
