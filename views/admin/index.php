<?php
use app\models\Packages;
use app\models\User;
use yii\helpers\Html;
?>

<div class="mb-2">
		<?= Html::a('Create Package', ['create'], ['class' => 'btn btn-success']);?>	
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
				<button class="btn btn-success updatebtn m-2" data-id="<?= $item->id?>">Update</button>
	    <button class="btn btn-danger deletebtn m-2" data-id="<?= $item->id?>">Delete</button>

					</div>
				</div>

			</div>

		</div>
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

<h3>Order Table</h3>

    <div class="card">

        <div class="table-responsive datatable-custom">
          <table id="datatable" class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%">
            <thead class="thead-light">
              <tr>
                <th class="lead">Order</th>
                <th class="lead">Date</th>
                <th class="lead">Customer</th>
                <th class="lead">Payment status</th>
                <th class="lead">Package Name</th>
                <th class="lead">Amount</th>
              </tr>
            </thead>

            <tbody>
            <?php foreach ($transactions as $transaction) : ?>
              <tr>
                <td class="table-column-ps-0">
                  <p><?= $transaction->transaction_id ?></p>
                </td>
                <td><?= $transaction->purchase_date ?></td>
                <td>
                  <p><?php 
                  $customer_id = $transaction->customer_id;
                  $user = User::find()->where(['id' => $customer_id])->one();
                  echo $user->username;
                   ?></p>
                </td>
                <td>
                  <span class="badge bg-soft-success text-success">
                    <span class="legend-indicator bg-success"></span>Paid
                  </span>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="text-dark">
                    <?php 
                  $product_id = $transaction->product_id;
                  $product = Packages::find()->where(['id' => $product_id])->one();
                  echo $product->package_name;
                   ?>
                   </span>
                  </div>
                </td>
                <td><?= $transaction->amount ?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>