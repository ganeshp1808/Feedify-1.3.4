<?php
@session_start();
error_reporting(0);
ini_set('display_errors', 0);
include("includes/database.php");
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Neucha&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="feed/animate.css">
	<link rel="stylesheet" href="feed/style.css">
<title>Feedify-HomePage</title>
<style>
body{font-family: 'Bree Serif', serif;}
.btn{height:50px;width:70x;}
.pop{opacity:1;color:#0dff00;}
@media only screen and (max-width:1078px){
h1,.display-1{
	font-size:2rem;
}
h2,.display-2{
	font-size:2rem;
}
h3,.display-3{
	font-size:1rem;
}
h4,h5,h6,p,.display-4.display-5,.display-6{
	font-size:1rem;
}
}
</style>
</head>
<body>
	<section id="firstsection">
		<nav class="navbar fixed-top navbar-expand-lg ">
			<a class="navbar-brand" href="HomePage">Feedify</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active"><a class="nav-link" href="HomePage">Home <span class="sr-only">(current)</span></a></li>
							<li class="nav-item"><a class="nav-link" href="#thirdsection">Features</a></li>
							<li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
							<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About Us</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">How To Use?</a>
								<a class="dropdown-item" href="#fourthsection">Why Feedify?</a>
								<a class="dropdown-item" href="#">Our Team</a>
							</div></li>
						</ul>
						<form class="form-inline my-2 my-lg-0">
						  <a class="btn" href='login' type="submit">Login</a>
						</form>
					</div>
		</nav>
	</section>
	<section id="wantit" style='background-image:url("image/teach.jpg");background-repeat:no-repeat;background-size:cover;position: relative;'>
		<div>
			<div class="container text-center pip"><br><br><br><br><br>
				<h1 style='animation-duration:3s;' class="display-2 animated bounceIn">Welcome To Feedify</h1><br><br><br>
				<h2 >Start Using the Best Analytical System for getting Feedback</h2><br><br>
				<h5 style='animation-duration:3s;' class=" animated tada infinite"><b>Haven't Registered yet? Then Get Registered!!!</b></h5><br><br>
				<a style="background-color:#C40B43;" class="btn" href='register' type="submit">Get Started</a><br><br><br><br>
			</div>	
		</div>
	</section>
	<br><br>
	<section id="thirdsection">
		<div class="container">
			<h1 class="display-4">Features About Feedify</h1>
			<h2>This Section Explains, What services we provide.</h2>
			<h4>1.Students Feedback System to make sure Teacher-Student Relationship in Academics is maintained perfectly.</h4>
			<h4>2.Analysis of Marks And Attendance of every teacher for each class they teach.</h4>
			<h4>3.Admin Control Panel to Manage Faculty and Students of the Institution.</h4>
			<h4>4.Spreadsheet download of data entered after renew of subscription, for the relevant authorities to take decisions upon.</h4>
		</div>
	</section><br><br>
	<section id="fourthsection"><br><br>
		<div class="text-center">
			<h1 class="display-4">Why Feedify?</h1><br>
			<h4>Feedify gives you a 360 degree picture of professor effectiveness, tracking not only the feedback submitted by the students, but also real
			time quantitative analysis of marks and attendance for a particular
			semester or class.</h4><br><br>
		</div>
	</section>
	<br><br>
	<section id="fifthsection">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-12">
				<h5 class="card-title">Spandan Bhatacharya</h5>
				<p class="card-text">Analyst</p>
			</div>
			<div class="col-lg-3 col-sm-12">
				<h5 class="card-title">Ganesh Patil</h5>
				<p class="card-text">Web Developer</p>
			</div>
			<div class="col-lg-6 col-sm-12">
				<h4>Feedify looks great, is easy to access, affordable and we make sure that 
				you are happy with the product.</h4>
			</div>
		</div>
	</div>
	</section>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
