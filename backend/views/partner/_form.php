<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

    <?php $form = ActiveForm::begin(['options'=>['class'=>'well']]); ?>

    <?= $form->field($model, 'partner_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partner_link')->textInput(['maxlength' => true]) ?>
    <span style="color: red;">ตัวอย่าง : https://www.google.co.th/
    </span><br><br>
    
    <span style="color: red;">ขนาดรูปที่เหมาะสมควรเป็น <br>
    </span>
    <label>รูปภาพ</label>
    <div class="row">
        <div class="col-md-5">
            <div class="slim" data-min-size="0,0">
                <input type="file"/>
                <?php
                if ($model->partner_pic != ""){
                    echo Yii::$app->MData->showImage($model->partner_pic,'','backend');
                }
                ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
