<?php

?>

<div class="content-fluid">
	<h4 class="col-6 text-dark fw-semibold mb-3">Package Name: <?= $model['package_name'] ?></h4>
	<div class="row align-items-center">
		<h6 class="col-6 text-dark fw-semibold">Total to pay:</h6>
		<h3 class="col-6 text-end text-dark mb-0">&#x20B9;<?= $model['package_price'] ?></h3>
	</div>

	<div class="card my-3 mb-lg-5">

		<div class="card-header">
			<h4 class="card-header-title">Payment method</h4>
		</div>

		<div class="card-body">

			<div class="btn-group-sm-vertical">
				<div class="btn-group btn-group-segment btn-group-fill mb-4"
					role="group">
					<input type="radio" class="btn-check flex-fill"
						name="checkoutBtnRadio" id="checkoutBtnRadioCreditCard"
						autocomplete="off" checked> <label class="btn btn-sm"
						for="checkoutBtnRadioCreditCard"> Credit or Debit card </label> <input
						type="radio" class="btn-check flex-fill" name="checkoutBtnRadio"
						id="checkoutBtnRadioPayPal" autocomplete="off" disabled> <label
						class="btn btn-sm" for="ecommerceCheckoutBtnRadioPayPal"> PayPal</label>
				</div>
			</div>

			<div class="mb-4">
				<label for="cardNameLabel" class="form-label">Name on card</label> <input
					type="text" class="form-control" id="cardNameLabel"
					placeholder="Your Name">
			</div>

			<div class="mb-4">
				<label for="cardNumberLabel" class="form-label">Card number</label>
				<input type="text" class="js-input-mask form-control"
					name="cardNumber" id="cardNumberLabel"
					placeholder="xxxx xxxx xxxx xxxx">
			</div>


			<div class="row">
				<div class="col-sm-6">

					<div class="mb-4">
						<label for="expirationDateLabel" class="form-label">Expiration
							date</label> <input type="text"
							class="js-input-mask form-control" name="expirationDate"
							id="expirationDateLabel" placeholder="xx/xxxx">
					</div>

				</div>

				<div class="col-sm-6">

					<div class="mb-4">
						<label for="securityCodeLabel" class="form-label">CVV Code <i
							class="bi-question-circle text-body ms-1"
							data-bs-toggle="tooltip" data-bs-placement="top"
							title="A 3 - digit number, typically printed on the back of a card."></i></label>
						<input type="text" class="js-input-mask form-control"
							name="securityCode" id="securityCodeLabel" placeholder="xxx"
							aria-label="xxx"
							data-hs-mask-options='{
                                      "mask": "000"
                                    }'>
					</div>

				</div>
			</div>

		</div>

	</div>



	<div class="d-flex align-items-center">
		<button type="button" class="btn btn-ghost-secondary" id="returnbtn">Return to Home</button>
		<div class="ms-auto">
			<button type="button" class="btn btn-primary" id="purchaseBtn">Purchase
			</button>
		</div>
	</div>

	<div id="msg"></div>
</div>

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
        $(document).ready(function () {
            let userId = Number("<?= Yii::$app->user->id ?>");
            let productId = Number("<?= $model['id'] ?>");
            let productPrice = Number("<?= $model['package_price'] ?>");

            console.log(userId);
            console.log(productId);

            $("#purchaseBtn").click(function () {
                let data = {
                    'productId': productId,
                    'userId': userId,
                    'amount': productPrice
                };

                $.ajax({
                    url: '/customer/buypackage?id=' + productId,
                    method: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    },
                    success: function (resp) {
                        if (resp.success) {
                            console.log('Purchase was successfull');
                            $("#purchaseBtn").prop("disabled", true);
                            msg = "<div class='alert alert-dark mt-3'>Package Purchased</div>";
                            $("#msg").html(msg);
                        } else {
                            console.log('Error: ' + resp.error);
                            msg = "<div class='alert alert-dark mt-3'>Package Purchase Unsuccessfull</div>";
                            $("#msg").html(msg);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('Error: ' + error);
                        console.log(xhr.responseText);
                    }
                });



            });
            
            $("#returnbtn").click(function(){
            	window.location.href = '/site/index';
            });
        });

    </script>