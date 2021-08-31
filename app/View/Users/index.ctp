<style>
	.push-right {
		margin-right: 10px;
	}
	.center {
		text-align: center;
	}
	/*=================================
		Pagination (Common)
	===================================*/
	.paging .current,
	.paging .disabled,
	.paging a {
		font-family: raleway;
		font-weight: bolder;
		text-decoration: none;
		padding: 8px 12px;
		display: inline-block;
		color: #fff;
	}
	.paging > span {
		display: inline-block;
		border: 1px solid #34495E;
		background: #34495E;
		min-width: 3em;
		margin: 5px 5px;
		box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.3);
	}
	.paging > span:not(.current):hover {
		background: #D7DBDD;
		border: 1px solid #D7DBDD;
	}
	.paging .disabled {
		color: #fff;
	}
	.paging .disabled:hover {
		background: #ffd32a;
		border: 1px solid #ffd32a;
	}
	.paging .current {
		background: #00FF00;
		border: 1px solid #00FF00;
		color: #fff;
	}
	.form-control{
		border: 1px solid blue;
  		border-radius: 10px;
	}
	.glyphicon{
		color: white;
	}
	.error{
		color: red;
	}
	tr:hover {background-color: #ECF0F1;}
	/*tr:nth-child(even) {background-color: #f2f2f2;}*/
	.table th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #F5B041;
		color: white;
	}
	/*.table tr, th, td {
		border: 1px solid black;
	}*/
	#delete-btn span {
		color: red;
	}

</style>
<?php
	$emp_id = '';
	$emp_name = '';
	$email = '';
	if(!empty($search)) {
		$emp_id = $search['id'];
		$emp_name = $search['username'];
		$email = $search['email'];
		// pr($email);die();
	}
?>
<div class="row center">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<form class="form-inline" action="" method="post">
			<div id="errMsg" class="error"><?php echo $errMsg; ?></div>
			<div id="succMsg" class="success"><?php echo $succMsg; ?></div>

			<div class="errorSuccess">
				<?php if($this->Session->check('Message.errorMessage')): ?>
					<div class="error">
						<strong style="color: red;">
							<?php echo $this->Flash->render("errorMessage"); ?>	
						</strong>
					</div>
				<?php endif; ?>
			</div>

			<div class="form-group">
				<label for="emp_id"><?php echo __('EmpID:'); ?></label>
				<input type="text" class="form-control push-right" id="emp_id" name="emp_id" value="<?php echo $emp_id; ?>">
			</div>
			<div class="form-group">
				<label for="name"><?php echo __('Name:') ?></label>
				<input type="text" class="form-control push-right" id="name" name="username" value="<?php echo $emp_name; ?>">
			</div>
			<div class="form-group">
				<label for="email"><?php echo __('Email:') ?></label>
				<input type="email" class="form-control push-right" id="email" name="email" value="<?php echo $email; ?>">
			</div>
			<button type="button" id="search" class="btn btn-success push-right"><span class="fa fa-search "></span></button>
			
			<input type="button" name="csv_excel" id="csv_excel" class="btn btn-primary push-right" onclick="export_csv()" value="<?php echo __('ExportCSV'); ?>">

			<input type="button" name="btn_excel" id="btn_excel" class="btn btn-primary push-right" value="<?php echo __('ExportExcel'); ?>">

			<input type="submit" name="btn_print" id="btn_print" class="btn btn-success" formtarget="_blank" value="<?php echo __('Print'); ?>">

			<input type="text" id="hdId" name="hdId">
		</form>
	</div>
	<div class="col-sm-1"></div>
</div>
<br/>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">

		<div id="errorMsg" class="error"><?php echo $errorMsg; ?></div>
		<div id="successMsg" class="success"><?php echo $successMsg; ?></div>

		<?php if(!empty($users)) { ?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead id="thead">
						<tr>
							<th><?php echo $this->Paginator->sort('EmpID'); ?></th>
							<th><?php echo __('First Name'); ?></th>
							<th><?php echo __('Last Name'); ?></th>
							<th><?php echo __('User Name'); ?></th>
							<th><?php echo __('Date Of Birth'); ?></th>
							<th><?php echo __('Gender'); ?></th>
							<th><?php echo __('Marital Status'); ?></th>
							<th><?php echo __('Email'); ?></th>
							<th><?php echo __('Phone'); ?></th>
							<th><?php echo __('Address'); ?></th>
							<th colspan = "3" class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): 
							if($user['UserModel']['gender'] == 'M'){
								$gender = 'Male';
							}else{
								$gender = 'Female';
							}
							if($user['UserModel']['marital_status'] == '1'){
								$merital = 'Single';
							}else if($user['UserModel']['marital_status'] == '2'){
								$merital = 'Relationship';
							}else{
								$merital = 'Maried';
							}
							?>
						<tr>
							<td><?php echo h($user['UserModel']['id']); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['firstname']); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['lastname']); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['username']); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['dateofbirth']); ?>&nbsp;</td>
							<td><?php echo h($gender); ?>&nbsp;</td>
							<td><?php echo h($merital); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['email']); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['phone']); ?>&nbsp;</td>
							<td><?php echo h($user['UserModel']['address']); ?>&nbsp;</td>
							<td class="actions">

								<a href="#" onclick="ViewLink(<?php echo $user['UserModel']['id']; ?>)"><span class='fa fa-eye'></span></a>
							</td>
							<td>
								<a href="#" onclick="EditLink(<?php echo $user['UserModel']['id']; ?>)"><span class='fa fa-pencil-square-o'></span></a>
							</td>
							<td id="delete-btn">
								<a href="#" style="display: inline;" data-toggle="confirmation" data-popout="true" onclick="DeleteLink(<?php echo $user['UserModel']['id']; ?>)"><span class='fa fa-trash-o'></span></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php } ?>
	</div>
	<div class="col-sm-1"></div>
</div>

<div class="row" style="clear:both;margin: 40px 0px;">
	<?php if($pageCount > 1) { ?>
	    <div class="col-sm-12" style="padding: 10px;text-align: center;">
			<div class="paging">
			<?php
				echo $this->Paginator->first('<<');
			    echo $this->Paginator->prev('< ', array(), null, array('class' => 'prev disabled'));
			    echo $this->Paginator->numbers(array('separator'=>'', 'modulus'=>2));
			    echo $this->Paginator->next(' >', array(), null, array('class' => 'next disabled'));
			    echo $this->Paginator->last('>>');
			?>
			</div>
		</div> 
	<?php } ?>
</div>

<!-- Modal -->
<div id="empModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">	
	    <!-- Modal content-->
	    <div class="modal-content" style="background-color: #a9cce3;">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo __('Employee Detail Data');?></h4>
	       	</div>
			<div class="modal-body">
				<!-- Table-->
				<div class="row">
					<div class="control-label col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Employee ID"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text" name="popup_empid" id="popup_empid"  class="form-control" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Employee First Name"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_empfname" id="popup_empfname" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Employee Last Name"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_emplname" id="popup_emplname" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("User Name"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_username" id="popup_username" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Date Of Birth"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_dofbirth" id="popup_dofbirth" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Gender"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_gender" id="popup_gender" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Marital Status"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_marital" id="popup_marital" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Phone Number"); ?></label>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_phone" id="popup_phone" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">					
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Email"); ?></label>                        	
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_empemail" id="popup_empemail" class="form-control" readonly />
						</div>
					</div>			
				</div>
				<div class="row">					
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">
							<label><?php echo __("Address"); ?></label>                        	
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="form-group">                    		
							<input type="text"  name="popup_address" id="popup_address" class="form-control" readonly />
						</div>
					</div>
				</div>	
			</div>
			<div class="modal-footer"> 
				<button style="border-radius: 18px;" type="button" class="btn btn-success" data-dismiss="modal"><?php echo __("Close"); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	$(document).ready(function() {
		$("#emp_id").focusout(function(){
			var id = $(this).val();
			console.log(id);
			$.ajax({
				url: '<?php echo $this->webroot; ?>Users/autoFill',
				type: 'post',
				data: {id:id}, //first controller type, second this type
				dataType: 'json',
				success: function(data) {
					console.log(data);					
					console.log(data['UserModel']['username']);
					if(data != '' || data != undefined) {
						var id = data['UserModel']['id'];
						var name = data['UserModel']['username'];
						var email = data['UserModel']['email'];
						$("#id").val(id);
						$("#name").val(name);
						$("#email").val(email);
					}
				},
				error: function() {
					console.log('error');
				}
			});
		});
	});

	function EditLink(id){
		if(id != '' || id != null){ 
			document.getElementById('hdId').value = id;
			document.forms[0].action = "<?php echo $this->webroot;?>Users/edit";
			document.forms[0].method = "POST";
			document.forms[0].submit();
		}
	}

	function DeleteLink(id){
		$.confirm({

			title: 'Confirmation',
			content: 'Are you sure want to delete?',
			icon: 'fa fa-question-circle',
			animation: 'scale',
			closeAnimation: 'scale',
			opacity: 0.5,
			buttons: {
				'confirm': {
					text: 'Ok',
					action: function(){
						document.getElementById('hdId').value = id;
						document.forms[0].action = "<?php echo $this->webroot;?>Users/delete";
						document.forms[0].method = "POST";
						document.forms[0].submit();
					}
				},
				Cancel: function(){}
			}
		});
	}

	function ViewLink(id){
		document.getElementById('errorMsg').innerHTML = "";
		document.getElementById('successMsg').innerHTML = "";

		$('#empModal').modal('show');
	
		if(id != '' || id != null){
			// alert(id);die();
			document.getElementById('hdId').value = id;
			
			$.ajax({
				type: 'post',
				url: '<?php echo $this->Html->url(array('controller'=> 'Users','action' => 'viewer')); ?>',
				data: { 
					'id' : id
				},
				dataType: 'json',
				success: function(data) {

					if(data != '' || data != undefined) {

						if(data['UserModel']['gender'] == '1'){
							var gender = 'Male';
						}else{
							var gender = 'Female';
						}
						if(data['UserModel']['marital_status'] == '1'){
							var marital = 'Single';
						}else if(data['UserModel']['marital_status'] == '2'){
							var marital = 'Relationship';
						}else{
							var marital = 'Maried';
						}
						$("#popup_empid").val(data['UserModel']['id']);
						$("#popup_empfname").val(data['UserModel']['firstname']);
						$("#popup_emplname").val(data['UserModel']['lastname']);
						$("#popup_username").val(data['UserModel']['username']);
						$("#popup_dofbirth").val(data['UserModel']['dateofbirth']);
						$("#popup_gender").val(gender);
						$("#popup_marital").val(marital);
						$("#popup_phone").val(data['UserModel']['phone']);
						$("#popup_empemail").val(data['UserModel']['email']);
						$("#popup_address").val(data['UserModel']['address']);
					}	
					
				},			
			});
			
		}
		
	}

	function export_csv(){
		document.getElementById('csv_excel').value;
		document.forms[0].action = "<?php echo $this->webroot;?>Users/exportCSV";
		document.forms[0].method = "POST";
		document.forms[0].submit();
	}
	//Export Excel
	$("#btn_excel").click(function(){
		// alert("sfsl");
		document.getElementById('errorMsg').innerHTML = "";
		document.getElementById('successMsg').innerHTML = "";

		document.forms[0].action = "<?php echo $this->webroot;?>Users/ExportExel";
		document.forms[0].method = "POST";
		document.forms[0].submit();
		});

	$("#search").click(function(){
		document.forms[0].action = "<?php echo $this->webroot;?>Users/search";
		document.forms[0].method = "POST";
		document.forms[0].submit();
	})

	$('#btn_print').click(function(){
		document.getElementById('errorMsg').innerHTML = "";
		document.getElementById('successMsg').innerHTML = "";

		document.forms[0].action = "<?php echo $this->webroot;?>Users/Print";
		document.forms[0].method = "POST";
		document.forms[0].submit();
	})

</script>