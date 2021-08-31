
<style>
	.card{
		border-radius: 16px;
		width: 35rem;
		padding: 20px;
	}
	img{
		text-align: center;
	}
	.card-footer{
		text-align: center;
	}
	#forgot{
		color: black;
	}
	.card{
		margin-top: 100px;
		margin-bottom: 100px;
		background-color: LightGray;
	}
</style>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Login
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.css');
		echo $this->Html->script('jquery-2.1.4.min.js');
		echo $this->Html->script('bootstrap.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body style="margin-top:20px; background: #16A085;">
	<div class="container">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 ">
			<div class="card text-white">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-4"><h2 style="text-align: center;">Login</h2></div>
						<div class="col-md-4">
							<img src="<?php echo $this->webroot; ?>/img/security-logo.png" width="70" height="70">
						</div>
						<div class="col-md-5"></div>
					</div>
				</div><br><br>
				<form action="<?php echo $this->webroot; ?>Login/loginprocess" id="loginproc" method="post">
					<div class="card-body">
						<div id="errorMsg" class="error"><?php echo $errorMsg; ?></div>
						<div class="form-group">
							<div class="form-group">
								<!-- <label for="emp_id">Email:</label> -->
								<input type="email" class="form-control push-right" id="email" autofocus name="email" placeholder="Enter email address" style="border-radius: 18px;" />
								<div id="erremail" class="errmsg" ></div>
							</div>
							<div class="form-group">
								<!-- <label for="name">Password:</label> -->
								<input type="password" class="form-control push-right" id="password" name="password" placeholder="Enter password" style="border-radius: 18px;" />
								<div id="errpassword" class="errmsg" ></div>
							</div>
							<div class="form-group">
								<input type="button" id="btnlogin" class="form-control btn btn-primary btn-block" value="Login" onclick="formValidation()" style="border-radius: 18px;" />
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a href="#" onclick="ForgotPwd()" id="forgotbtn" class="forgotbtn"><?php echo __('Forgot Password?') ?></a>
					</div>
				</form>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
</body>
</html>
<script>
	
	function formValidation(){
		
		document.getElementById("erremail").innerHTML = "";
		document.getElementById("errpassword").innerHTML = "";
		
		var email = document.getElementById("email").value;		
		var password = document.getElementById("password").value;
		var chk = true;
		
		if(email == "" || email == null){			
			document.getElementById("erremail").innerHTML ="Enter Email!";
			chk = false;
		}
		
		if(password == "" || password == null){			
			document.getElementById("errpassword").innerHTML ="Enter Password!";
			chk = false;
		}
		
		if(chk) {
	   		document.forms[0].action = "<?php echo $this->webroot; ?>Login/loginprocess";
			document.forms[0].method = "POST";
			document.forms[0].submit();	
		
			//document.getElementById('loginproc').submit();
		}		
	}

	function ForgotPwd(){
		var forgetEmail = document.getElementById('email')
		document.forms[0].action = "<?php echo $this->webroot;?>Login/forgot";
		document.forms[0].method = "POST";
		document.forms[0].submit();				
	}
	
</script>
