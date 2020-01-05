<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Social */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-form">

    <?php $form = ActiveForm::begin(['options'=>['class'=>'well']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
	<span style="color: red;">ตัวอย่าง : https://www.google.co.th/
    </span><br><br>
<!--     <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?> -->

<!--     <?= $form->field($model, 'active')->dropDownList([ 'un_active' => 'Un active', 'active' => 'Active', ], ['prompt' => '']) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
