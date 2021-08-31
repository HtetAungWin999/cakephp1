<style>
	.form-control{
  		border-radius: 5px;
	}
</style>

<script>
	$(document).ready(function(){
		var hdflag = document.getElementById('hdflag').value;
		if(hdflag == "Update"){
			$("#frm_pwd").hide();
			document.getElementById('email').disabled = true;
		}
		$('#from_date').datepicker({
			format: 'yyyy-mm-dd',
			todayBtn: "linked"
		});
	});
</script>

<div class="row center">
	<div class="col-sm-1"></div>
	<div class="col-sm-10" style="text-align: center;">
		<h3>Employee Registration</h3>
	</div>
	<div class="col-sm-1"></div>
</div>
<br>
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
		<form method="post" action="<?php echo $this->webroot; ?>Registration/registerProcess" id="submit_form">
			<div id="errorMsg" class="error"><?php echo $errMsg; ?></div>
			<div id="succMsg" class="success"><?php echo $succMsg; ?></div>
			<div class="form-group">
				<div class="row">
					<div class="form-group col-md-6">
						<label for="userFirst"><?php echo __('First Name'); ?></label>
						<input type="text" name="fname" id="fname" class="form-control" value="<?php echo $empData['empFirstname']; ?>" required placeholder="First name">
					</div>
					<div class="form-group col-md-6">
						<label for="userFirst"><?php echo __('Last Name'); ?></label>
						<input type="text" name="lname" id="lname" class="form-control" value="<?php echo $empData['empLastname']; ?>" required="required" placeholder="Last name">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="username"><?php echo __('User Name'); ?></label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo $empData['empUsername']; ?>" required placeholder="user name">
				</div>
				<div class="form-group col-sm-6">
					<label for="dateofbirth"><?php echo __('Date of Birth'); ?></label>
					<div class='input-group date datetimepicker' id='from'>
						<input type='text' class="form-control" id='from_date' name="from_date" autofocus placeholder="YYYY-MM-DD" value="<?php echo $empData['empDOB'] ?>" /><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="gender"><?php echo __('Gender'); ?></label>
				<div class="radio-inline">
					<input class="form-check-input" type="radio" name="gender" id="gender1" value="M" <?php if($empData['empGender'] == 'M'){echo 'checked= "checked"';} ?>>
				  	<label class="form-check-label" for="inlineRadio1">Male</label>
				</div>
				<div class="radio-inline">
				  	<input class="form-check-input" type="radio" name="gender" id="gender2"value = "F" <?php if($empData['empGender'] == 'F'){echo 'checked= "checked"';} ?>>
				  	<label class="form-check-label" for="inlineRadio2">Female</label>
				</div>
			</div>
			<div class="form-group">
			    <label for="Marital"><?php echo __('Marital Status'); ?></label>
			    <select class="form-control" id="marital" name="marital">
			      <option value="0" selected><?php echo __('---Select Marital Status---'); ?></option> 
			      <option value="1" <?php if($empData['empMarital'] == 1){echo 'selected = "selected"';} ?>><?php echo __('Single'); ?></option>
			      <option value="2" <?php if($empData['empMarital'] == 2){echo 'selected = "selected"';} ?>><?php echo __('Relationship'); ?></option>
			      <option value="3" <?php if($empData['empMarital'] == 3){echo 'selected = "selected"';} ?>><?php echo __('Maried'); ?></option>
			    </select>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="email"><?php echo __('Email'); ?></label>
					<input type="email" name="email" id="email" class="form-control" value="<?php echo $empData['empEmail']; ?>" required placeholder="Enter email address">
				</div>
				<div class="form-group col-sm-6">
					<label for="phone"><?php echo __('Phone'); ?></label>
					<input type="text" name="phone" id="phone" class="form-control" value="<?php echo $empData['empPhone']; ?>" required placeholder="Enter phone number">
				</div>
			</div>
			<div class="form-group" id="frm_pwd">
				<label for="pass"><?php echo __('Password'); ?></label>
				<input type="password" name="password" id="password" class="form-control" required placeholder="Enter password" value="<?php echo $empData['empPassword']; ?>">
			</div>
			<div class="form-group">
				<label for="address"><?php echo __('Address'); ?></label>
				<textarea name="address" id="address" class="form-control" placeholder="Your address!"><?php echo $empData['empAddress']; ?></textarea>
			</div>
			<div class=form-group>
				<input type="button" onclick="FormValidation()" class="form-control btn btn-primary btn-block" value="<?php echo __('Save'); ?>" id="btn_save" data-toggle="confirmation" data-popout="true">
			</div>
			<input type="hidden" name="hdflag" id="hdflag" value="<?php echo $hdflag; ?>">
			<input type="hidden" name="hdemail" id="hdemail" value="<?php echo $empData['empEmail']; ?>">
		</form>
	</div>
	<div class="col-sm-3"></div>
</div>


<script>
	function FormValidation(){
		document.getElementById('errorMsg').innerHTML='';
		document.getElementById('succMsg').innerHTML='';
		var hdflag = document.getElementById('hdflag').value;

		var chk = true;

		var patt = /^[a-zA-Z -]+$/;
		var phoneno = /^[0-9]*$/;

		

		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
    	

		var fname = document.getElementById('fname').value;
		var lname = document.getElementById('lname').value;
		var username = document.getElementById('username').value;
		var dofbirth = document.getElementById('from_date').value;
		var gender = document.getElementsByName('gender');
		var maritalStatus = document.getElementById('marital').value;
		var phone = document.getElementById('phone').value;
		var email = document.getElementById('email').value;
		var pass = document.getElementById('password').value;
		var addr = document.getElementById('address').value;

		if(fname == '' || fname == null){
			document.getElementById('errorMsg').innerHTML+="Enter first name!"+"<br>";
			document.getElementById('fname').style.border='1px solid red';
			chk = false;

		}else if(!patt.test(fname)){
			document.getElementById("errorMsg").innerHTML +="Enter first name is Character Only!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('fname').style.border='1px solid red';
			chk = false;
		}
		if(lname == '' || lname == null){
			document.getElementById('errorMsg').innerHTML+="Enter last name!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('lname').style.border='1px solid red';
			chk = false;

		}else if(!patt.test(lname)){
			document.getElementById("errorMsg").innerHTML +="Enter last name is Character Only!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('lname').style.border='1px solid red';
			chk = false;
		}
		if(username == '' || username == null){
			document.getElementById('errorMsg').innerHTML+="Enter username name!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('username').style.border='1px solid red';
			chk = false;

		}else if(!patt.test(username)){
			document.getElementById("errorMsg").innerHTML +="Enter userame is Character Only!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('username').style.border='1px solid red';
			chk = false;
		}

		if(dofbirth == '' || dofbirth == null){
			document.getElementById('errorMsg').innerHTML+="Enter Date of Birth!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('from_date').style.border='1px solid red';
			chk = false;
		}

		if((gender[0].checked == false) && (gender[1].checked == false)){
			document.getElementById('errorMsg').innerHTML+="Choose Gender Type!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('errorMsg').style.border='1px solid red';
			chk = false;
		}

		if(maritalStatus == 0){
			document.getElementById('errorMsg').innerHTML+="Select Marital Status!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('marital').style.border='1px solid red';
			chk = false;
		}

		if(phone == '' || phone == null){
			document.getElementById('errorMsg').innerHTML+="Enter phone number!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('phone').style.border='1px solid red';
			chk = false;
		}else if(!phoneno.test(phone)){
			document.getElementById('errorMsg').innerHTML+="Enter  number only!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('phone').style.border='1px solid red';
			chk = false;
		}

		if(email == '' || email == null){
			document.getElementById('errorMsg').innerHTML+="Enter email address!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('email').style.border='1px solid red';
			chk = false;
		}else if(!re.test(String(email).toLowerCase())){
			document.getElementById('errorMsg').innerHTML+="Enter valid email format!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('email').style.border='1px solid red';
			chk = false;
		}

		if(addr == '' || addr == null){
			document.getElementById('errorMsg').innerHTML+="Enter address!"+"<br>";
			document.getElementById('errorMsg').style.color='red';
			document.getElementById('address').style.border='1px solid red';
			chk = false;
		}

		if(hdflag == "Register"){
			if(pass == '' || pass == null){
				document.getElementById('errorMsg').innerHTML+="Enter password!"+"<br>";
				document.getElementById('errorMsg').style.color='red';
				document.getElementById('password').style.border='1px solid red';
				chk = false;
			}else if((pass.length > 7) && (!pass.match(paswd))){
				document.getElementById('errorMsg').innerHTML+="Don't enter at most 6 character!"+"<br>";
				document.getElementById('errorMsg').style.color='red';
				document.getElementById('password').style.border='1px solid red';
				chk = false;
			}
		}

		if(chk){
			if(hdflag == "Register"){
				$.confirm({

					title: 'Confirmation',
					content: 'Are you sure want to save?',
					icon: 'fa fa-question-circle',
					animation: 'scale',
					closeAnimation: 'scale',
					opacity: 0.5,
					buttons: {
						'confirm': {
							text: 'Ok',
							action: function(){
								document.forms[0].action="<?php echo $this->webroot; ?>Registration/create_emp";
								document.forms[0].method = "POST";
								document.forms[0].submit();
							}
						},
						Cancel: function(){}
					}
				});			
			}else{

				$.confirm({

					title: 'Confirmation',
					content: 'Are you sure want to update?',
					icon: 'fa fa-question-circle',
					animation: 'scale',
					closeAnimation: 'scale',
					opacity: 0.5,
					buttons: {
						'confirm': {
							text: 'Ok',
							action: function(){
								document.forms[0].action="<?php echo $this->webroot; ?>Registration/update";
								document.forms[0].method = "POST";
								document.forms[0].submit();
							}
						},
						Cancel: function(){}
					}
				});
			}
		}

	}

</script>