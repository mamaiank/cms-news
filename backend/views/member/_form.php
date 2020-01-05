<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url; 
?>

<div class="member-form">
<p>ป้อนข้อมูลด้านล่างให้ถูกต้อง :</p>
    <?php $form = ActiveForm::begin(['options'=>['class'=>'well']]); ?>
    
    <?= Html::errorSummary($model) ?>

    <?php if($model->isNewRecord) { ?>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?php } ?>

    <?= $form->field($profile, 'firstname')->textInput() ?>

    <?= $form->field($profile, 'lastname')->textInput() ?>

    <?= $form->field($model, 'email') ?>
    <?php if($model->isNewRecord) { ?>
    <?= $form->field($model, 'password_hash')->passwordInput() ?>
    <?php } else { ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'validatePassword')->passwordInput() ?>
    <?php } ?>
    <div class="form-group">
       <?= Html::submitButton('สมัครสมาชิก', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>