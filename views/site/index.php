<?php
use yii\helpers\Html;

$this->title = 'Wedding Planner';
?>

<div class="container">
    <?php
    foreach ($model as $item) : ?>
	    <p><?= $item->id ?></p>
        <p><?= $item->package_name ?></p>
        <p><?= $item->package_location ?></p>
        <p><?= $item->package_description ?></p>
        <p><?= $item->package_price ?></p>
        <p><?= $item->package_review ?></p>
	    <button class="btn btn-primary enquiry" data-id="<?= $item->id?>">Enquiry</button>
	   	<button class="btn btn-success buypackage" data-id="<?= $item->id?>">Buy</button>
  <?php endforeach; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$(".enquiry").click(function(){
		<?php if(Yii::$app->user->isGuest) : ?>
			window.location.href= '/site/login';
		<?php else : ?>
			console.log("enquiry clicked");
			let id = $(this).data("id");
			console.log(id);
			window.location.href= '/customer/enquiry?id=' +id;
			
		<?php endif;?>
		});
		
		$(".buypackage").click(function(){
			let id = $(this).data("id");
			console.log(id);
			window.location.href= '/site/buypackage?id=' +id;
		});
		
	});
</script>