$(document).ready(function(){	
	var UserData = $('#Users').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"../action.php",
			type:"POST",
			data:{action:'listUser'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[5,6],
				"orderable":false,
			},
		],
		"pageLength": 10
	});		
	$('#addUser').click(function(){
		$('#UserModal').modal('show');
		$('#UserForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val('addUser');
		$('#save').val('Add');
	});		
	$("#Users").on('click', '.update', function(){
		var empid = $(this).attr("id");
		var action = 'getUser';
		$.ajax({
			url:'../action.php',
			method:"POST",
			data:{empid:empid, action:action},
			dataType:"json",
			complete:function(data){
				$('#UserModal').modal('show');
				$('#empid').val(data.id);
				$('#empusername').val(data.username);
				$('#empemail').val(data.email);
				$('#emppassword').val(data.password);				
				$('#empisAdmin').val(data.isAdmin);
				//$('#designation').val(data.designation);	
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit User");
				$('#action').val('updateUser');
				$('#save').val('Save');
			}
		})
	});
	$("#UserModal").on('submit','#UserForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"../action.php",
			method:"POST",
			data:formData,
			complete:function(data){				
				$('#UserForm')[0].reset();
				$('#UserModal').modal('hide');				
				$('#save').attr('disabled', false);
				UserData.ajax.reload();
			}
		})
	});		
	$("#Users").on('click', '.delete', function(){
		var empid = $(this).attr("id");		
		var action = "empDelete";
		if(confirm("Are you sure you want to delete this User?")) {
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{empid:empid, action:action},
				complete:function(data) {					
					UserData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
});