<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'accessType')->dropDownList(
        [
            \app\models\User::ACCESS_TYPE_CUSTOMER => 'Customer',
            \app\models\User::ACCESS_TYPE_ADMIN => 'Admin',
        ],
        [
            'options' => [
                \app\models\User::ACCESS_TYPE_ADMIN => ['disabled' => true],
            ],
            'value' => \app\models\User::ACCESS_TYPE_CUSTOMER,
        ]
    )->label(false) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

 <div class="text-center">
     <p>Already have an account? <a class="link" href="/site/login">Log in here</a></p>
</div>

<script>
	
</script>
