<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<?php
use yii\helpers\Url;
?>



<div class="container mt-5">
	<div class="row">
		<h3 class="alert-warning text-center p-2">Create Package</h3>

		<div>
			<label for="titleCreate" class="form-label">Title</label> <input
				type="text" id="titleCreate" class="form-control">
		</div>
		<div>
			<label for="titleCreate" class="form-label">Location</label> <input
				type="text" id="locationCreate" class="form-control">
		</div>
		<div>
			<label for="contentCreate" class="form-label">Description</label>
			<textarea id="descriptionCreate" class="form-control" rows="8"></textarea>
		</div>
		<div>
			<label for="titleCreate" class="form-label">Price</label> <input
				type="text" id="priceCreate" class="form-control">
		</div>
		<div>
			<label for="titleCreate" class="form-label">Review</label> <input
				type="text" id="reviewCreate" class="form-control">
		</div>
		<div class="mt-2">
			<button class="btn btn-primary" id="createBtn" onClick="createfn()">Create</button>
		</div>
		<div id="msg"></div>

	</div>
</div>


<script>
	console.log('Ready');
    	function createfn(){
            let data = {
                'package_name': $("#titleCreate").val(),
				'package_location': $("#locationCreate").val(),
				'package_description': $("#descriptionCreate").val(),
				'package_price': $("#priceCreate").val(),
				'package_review': $("#reviewCreate").val(),
            };

         	console.log(data);
    
            $.ajax({
                url: '/admin/create',
                method: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                dataType: 'json',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function (resp) {
                    if (resp.success) {
                        console.log('Created successfully');
                        msg = "<div class='alert alert-dark mt-3'>'Created successfully'</div>"; 
                        $("#msg").html(msg);
                        $("#createBtn").prop("disabled", true);
                        $("#titleCreate").val("");
                        $("#locationCreate").val("");
                        $("#descriptionCreate").val("");
                        $("#priceCreate").val("");
                        $("#reviewCreate").val("");
                    } else {
                        console.log('Error: ' + resp.error);
                         msg = "<div class='alert alert-dark mt-3'>'Creation Failed'</div>"; 
                        $("#msg").html(msg);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                    console.log(xhr.responseText);
                }  
            });



     	}

</script>