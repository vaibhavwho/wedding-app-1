<?php
use yii\helpers\Html;
?>

<div class="container">
	<div class="mb-2">
		<?= Html::a('Create Package', ['create'], ['class' => 'btn btn-success']);?>	
	</div>
    <?php
    foreach ($model as $item) : ?>
	    <p><?= $item->id ?></p>
        <p><?= $item->package_name ?></p>
        <p><?= $item->package_location ?></p>
        <p><?= $item->package_description ?></p>
        <p><?= $item->package_price ?></p>
        <p><?= $item->package_review ?></p>
	    <button class="btn btn-success updatebtn" data-id="<?= $item->id?>">Update</button>
	    <button class="btn btn-danger deletebtn" data-id="<?= $item->id?>">Delete</button>
  <?php endforeach; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$(".updatebtn").click(function(){
			console.log("update clicked");
			let id = $(this).data("id");
			console.log(id);
			window.location.href= '/admin/update?id=' +id;
			
		});
		$(".deletebtn").click(function(){
			let id = $(this).data("id");
			let data = confirm("Are you sure you want to delete this package?");
			if(data){
				console.log("Package Deleted");
				window.location.href= '/admin/delete?id=' +id;
			}else{
				console.log("You choose not to delete");
			};
			
		});
	
	});
</script>