<?php
include('./design/inc/header.php');
include_once('./design/action.php');
include_once('./design/config.php');
include_once('./design/User.php');
//include('./design/action.php');
?>
<title>DISPLAY USER</title>
<script src="./design/js/jquery.dataTables.min.js"></script>
<script src="./design/js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="./design/css/dataTables.bootstrap.min.css" />
<script src="./design/js/data.js"></script>	
<?php include('./design/inc/container.php');?>
<div class="container contact">	
	<h2>TABLEAU DISPLAY USER</h2>	
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">   		
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2">
					<button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add User</button>
				</div>
			</div>
		</div>
		<table id="Users" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>id</th>
					<th>username</th>
					<th>mail</th>					
					<th>password</th>
					<th>isAdmin</th>
					<th></th>
					<th></th>	
				</tr>
			</thead>
		</table>
	</div>
	<div id="UserModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="UserForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
    				</div>
					<div class="form-group">
							<label for="id" class="control-label">id</label>							
							<input type="text" class="form-control" id="empid" name="empid" required>			
						</div>	

    				<div class="modal-body">
						<div class="form-group">
							<label for="username" class="control-label">username</label>
							<input type="text" class="form-control" id="empusername" name="empusername"  >			
						</div>
						<div class="form-group">
							<label for="email" class="control-label">email</label>							
							<input type="text" class="form-control" id="empemail" name="empemail" >							
						</div>	   	
						<div class="form-group">
							<label for="password" class="control-label">password</label>							
							<textarea class="form-control" rows="5" id="emppassword" name="emppassword"></textarea>							
						</div>	 
						<div class="form-group">
							<label for="isAdmin" class="control-label">isAdmin</label>							
							<input type="number" class="form-control" id="empisAdmin" name="empisAdmin"></input>							
						</div>
											
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="empid" id="empid" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
</div>	
<?php include('./design/inc/footer.php');?>