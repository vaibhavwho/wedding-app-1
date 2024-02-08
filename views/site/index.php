<?php
use app\models\User;
use yii\helpers\Html;

$this->title = 'Wedding Planner';
?>
<div class="container content-space-sm-2">
	<div class="w-md-75 text-center mx-md-auto mb-9">
		<h2>Packages</h2>
		<p>Discover your dream package.</p>
	</div>

	<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 mb-5">
	    <?php
    foreach ($model as $item) :
        ?>
		<div class="col mb-5">

			<div class="card card-bordered h-100">

				<div class="card-pinned">
					<img class="card-img-top"
						src="<?= Yii::$app->urlManager->createUrl('/img/mehndi.webp')?>"
						alt="Image Description">
					<div class="card-pinned-top-start">
						<small class="badge bg-success rounded-pill">Best Deal</small>
					</div>


					<div class="card-pinned-bottom-start">
						<div class="d-flex align-items-center flex-wrap">

							<div class="d-flex gap-1">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <img
									src="<?= Yii::$app->urlManager->createUrl('/img/star.svg') ?>"
									alt="Review rating" width="16">
                                <?php endfor; ?>
                            </div>


							<div class="ms-1">
								<span class="fw-semibold text-black me-1"><?= $item->package_review ?></span>
								<span class="text-white-70">(1.5k+ reviews)</span>
							</div>
						</div>
					</div>
				</div>

				<div class="card-body">
					<small class="card-subtitle"><?= $item->package_name ?></small>

					<div class="mb-3">
						<h3 class="card-title">
							<a class="text-dark" href="/"><?= $item->package_name ?> Package</a>
						</h3>
					</div>
					<div class="mb-2 lead">
						<p><?= $item->package_description ?></p>
					</div>
					<span class="d-block text-muted small"><?= $item->package_location ?></span>
					<h5 class="card-title"><?= $item->package_price ?></h5>
				</div>




				<div class="card-footer pt-0">
					<div class="d-flex justify-content-between align-items-center">

						<button class="btn btn-success buypackage m-2"
							data-id="<?= $item->id?>">Buy</button>
						<button class="btn btn-primary enquiry m-2"
							data-id="<?= $item->id?>">Enquiry</button>

					</div>
				</div>

			</div>

		</div>
		  <?php endforeach; ?>
	</div>
</div>

<div class="overflow-hidden content-space-2">
	<div
		class="position-relative bg-light text-center rounded-2 zi-2 mx-3 mx-md-10">
		<div class="container content-space-2 p-3">
			<figure class="w-md-75 text-center mx-md-auto">
				<blockquote class="blockquote mb-7">“ Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore nesciunt exercitationem enim excepturi quaerat, esse corrupti. A expedita et nisi? Sapiente recusandae ex doloribus officiis odit aliquid. Sed, eum quaerat? Nobis eum maxime aperiam! ”</blockquote>

				<figcaption class="blockquote-footer mt-2">
					Jack <span class="blockquote-footer-source">Happy customer</span>
				</figcaption>
			</figure>

		</div>

	</div>
</div>


<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$(".enquiry").click(function(){
		<?php if(Yii::$app->user->isGuest) : ?>
			window.location.href= '/site/login';
		<?php elseif (Yii::$app->user->identity->username === User::ACCESS_TYPE_ADMIN) :?>
			alert("Invalid login");
		<?php else : ?>
			console.log("enquiry clicked");
			let id = $(this).data("id");
			console.log(id);
			window.location.href= '/customer/enquiry?id=' +id;
			
		<?php endif;?>
		});
		
		$(".buypackage").click(function(){
		<?php if(Yii::$app->user->isGuest) : ?>
			window.location.href = '/site/login';
		<?php else :?>
			let id = $(this).data("id");
			console.log(id);
			window.location.href= '/customer/buypackage?id=' +id;
		<?php endif;?>
		});
		
	});
</script>
