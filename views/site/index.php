<?php
use app\models\User;
use yii\helpers\Html;

$this->title = 'Wedding Planner';
?>
<div class="container content-space-sm-2">
	<div class="row my-2 my-lg-0">
		<div class="d-flex justify-content-center">
			<input class="form-control mr-sm-2" type="search"
				placeholder="Search" aria-label="Search" id="searchInput">
			<button class="btn btn-outline-success my-2 my-sm-0 mx-1"
				id="searchPackage">Search</button>
		</div>

		<div class="container">
			<div id="res" style="display:none;">
			<button class="btn btn-danger mt-2" id="removeSearch">Remove Search Result</button>
				<div class="col-sm-4 my-2" >

					<div class="card card-bordered mt-2 h-100">

						<div class="card-pinned">
							<img class="card-img-top"
								src="<?= Yii::$app->urlManager->createUrl('/img/mehndi(4).webp') ?>"
								alt="images">

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
										<span class="fw-semibold text-black me-1" id="packagereview"></span>
										<span class="text-white-70">(1.5k+ reviews)</span>
									</div>
								</div>
							</div>
						</div>

						<div class="card-body">
							<small class="card-subtitle" id="packagenamesmall"></small>

							<div class="mb-3">
								<h3 class="card-title">
									<a class="text-dark" href="/" id="packagename"> Package</a>
								</h3>
							</div>
							<div class="mb-2 lead" >
								<p id="packagedescription"></p>
							</div>
							<span class="text-muted small" id="packagelocations"></span>
							 <h5 class="card-title" id="packageprice"></h5>
						</div>




						<div class="card-footer pt-0">
							<div class="d-flex justify-content-between align-items-center">

								<button class="btn btn-success  m-2"
									data-id="" id="buypackage">Buy</button>
								<button class="btn btn-primary  m-2"
									data-id="" id="enquiry">Enquiry</button>

							</div>
						</div>

					</div>

				</div>
				
			</div>

		</div>

	</div>
	<div class="w-md-75 mt-2 text-center mx-md-auto mb-9">
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
					<img class="card-img-top randomImage"
						src="<?= Yii::$app->urlManager->createUrl('/img/mehndi') ?>"
						alt="images">

					<script>
                    window.onload = function() {
                        
                        let images = document.querySelectorAll('.randomImage');
                        
                        images.forEach(function(image) {
                        let randomNum = Math.floor(Math.random() * 4) + 1;
                            image.src += '(' + randomNum + ').webp';
                        });
                    };
                </script>

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
					<h5 class="card-title"> &#x20B9;<?= $item->package_price ?></h5>
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
				<blockquote class="blockquote mb-7">“ Lorem ipsum dolor sit amet
					consectetur adipisicing elit. Dolore nesciunt exercitationem enim
					excepturi quaerat, esse corrupti. A expedita et nisi? Sapiente
					recusandae ex doloribus officiis odit aliquid. Sed, eum quaerat?
					Nobis eum maxime aperiam! ”</blockquote>

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
		
		
		
		$("#searchPackage").click(function(){
			let searchText = $("#searchInput").val();
			//console.log(searchText);
			let data = {
				'searchText' : searchText,
			};
			$.ajax({
				url: '/site/search',
				method: 'post',
				data : JSON.stringify(data),
				contentType: 'application/json',
				dataTpe: 'json',
				beforeSend: function (xhr) {
                  xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function(data) {
                	if(data){
                    console.log('Result found');
                    searchdata = data;
                    searchdata.id;
                    $("#packagename").html(searchdata.package_name);
                    $("#packagenamesmall").html(searchdata.package_name);
                    $("#packagelocations").html(searchdata.package_location);
                
                    $("#packagedescription").html(searchdata.package_description);
                    $("#packageprice").html(searchdata.package_price);
                    $("#packagereview").html(searchdata.package_review);
                    $("#buypackage").data("id" , searchdata.id);
                    $("#enquiry").data("id" , searchdata.id);
                    $("#searchInput").val("");
                    $("#buypackage").prop("disabled", true);
                    $("#enquiry").prop("disabled", true);
                    $("#res").css('display','block');
                    } else {
                    console.log('No result found');
                    }
                },
				error: function(error) {
					console.log(error);
				}
			});
			
		});
		
		$("#removeSearch").click(function(){
			$("#res").css('display','none');
		});
		 
		
	});
</script>
