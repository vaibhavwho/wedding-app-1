<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<?php
use yii\helpers\Url;
?>



<div class="container mt-5">
	<div class="row">
		<h3 class="alert-warning text-center p-2">Enquiry for <?= $model['package_name']?></h3>
			<input value="<?= $model['id'] ?>" id="packageId" type="hidden">

		<div>
			<label for="enqName" class="form-label">Full Name</label> <input
				type="text" id="enqName" class="form-control">
		</div>
		<div>
			<label for="enqEmail" class="form-label">Email</label> <input
				type="email" id="enqEmail" class="form-control">
		</div>
		<div>
			<label for="enqContact" class="form-label">Contact Number</label>
			<input
				type="text" id="enqContact" class="form-control">
		</div>
		<div>
			<label for="enqAddress" class="form-label">Address</label> <textarea
				id="enqAddress" class="form-control" rows="5"></textarea>
		</div>
		<div>
			<label for="titleMessage" class="form-label">Message</label>
			<textarea id="enqMessage" class="form-control" rows="5"></textarea> 
		</div>
		<div class="mt-2">
			<button class="btn btn-primary" onClick="enqFn()">Enquire</button>
		</div>


	</div>
</div>


<script>
	console.log('Ready');
    	function enqFn(){
            let data = {
            	'packageId': $("#packageId").val(),
                'enqName': $("#enqName").val(),
				'enqEmail': $("#enqEmail").val(),
				'enqContact': $("#enqContact").val(),
				'enqAddress': $("#enqAddress").val(),
				'enqMessage': $("#enqMessage").val(),
            };
			
			let id = $("#packageId").val();
         	console.log(data);
    
            $.ajax({
                url: '/customer/enquiry?id=' + id,
                method: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                dataType: 'json',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function (resp) {
                    if (resp.success) {
                        console.log('Enquiry was successfully');
                        $("#enqName").val("");
                        $("#enqEmail").val("");
                        $("#enqContact").val("");
                        $("#enqAddress").val("");
                        $("#enqMessage").val("");
                    } else {
                        console.log('Error: ' + resp.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                    console.log(xhr.responseText);
                }  
            });



     	}

</script>