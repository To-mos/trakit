<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Welcome</title>
	  <link href="<?= base_url(); ?>assets/css/normalize.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nothing+You+Could+Do" />
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="mainPage">
		<h1>Welcome to TRAKIT!</h1>
		<div id="registerMain">
			<h3>Register</h3>
			<?php if($this->session->flashdata('regError')){
				echo $this->session->flashdata('regError');
			} ?>
			<form method="POST" action="<?php base_url()?>register">
				<input type="text" name="name"  placeholder="Name" /><br />
				<input type="text" name="username" placeholder="Username" /><br />
				<input type="text" name="email" placeholder="Email" /><br />
				<input type="password" name="pword" placeholder="Password" /><br />
				<input type="password" name="confirm_pword" placeholder="Password" /><br />
				<input type="submit" value="Register" />
			</form>
		</div>
		<div id="loginMain">
			<h3>Login</h3>
			<?php if($this->session->flashdata('loginError')){
				echo $this->session->flashdata('loginError');
			} ?>
			<form method="POST" action="<?php base_url()?>login">
				<input type="text" name="email" placeholder="email" /><br />
				<input type="password" name="pword" placeholder="password" /><br />
				<input type="submit" value="Login" />
			</form>
		</div>
	</div>
</body>
</html>