<?php
use yii\helpers\Url;
?>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container mt-5">
	<div class="row">
		<h3 class="alert-warning text-center p-2">Update Package</h3>

		<input value="<?= $model['id']?>" id="updateid" type="hidden">
		<div>
			<label for="titleCreate" class="form-label">Title</label> <input
				type="text" id="titleCreate" value="<?= $model['package_name']?>"
				class="form-control">
		</div>
		<div>
			<label for="titleCreate" class="form-label">Location</label> <input
				type="text" id="locationCreate"
				value="<?= $model['package_location']?>" class="form-control">
		</div>
		<div>
			<label for="contentCreate" class="form-label">Description</label>
			<textarea id="descriptionCreate" class="form-control" rows="8"><?= $model['package_description']?> </textarea>
		</div>
		<div>
			<label for="titleCreate" class="form-label">Price</label> <input
				type="text" id="priceCreate" value="<?= $model['package_price']?>"
				class="form-control">
		</div>
		<div>
			<label for="titleCreate" class="form-label">Review</label> <input
				type="text" id="reviewCreate" value="<?= $model['package_review']?>"
				class="form-control">
		</div>
		<div class="mt-2">
			<button class="btn btn-primary" onClick="updatefn()">Update</button>
		</div>


	</div>
</div>


<script>
	console.log('Ready');
    	function updatefn(){
         	let id = $("#updateid").val();
         	console.log(id)
            let data = {
            	'id': id,
                'package_name': $("#titleCreate").val(),
				'package_location': $("#locationCreate").val(),
				'package_description': $("#descriptionCreate").val(),
				'package_price': $("#priceCreate").val(),
				'package_review': $("#reviewCreate").val(),
            };


         	console.log(data);
    
            $.ajax({
                url: '/admin/update?id=' +id,
                method: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                dataType: 'json',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function (resp) {
                    if (resp.success) {
                        console.log('Updated successfully');
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