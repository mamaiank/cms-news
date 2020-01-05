<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Bank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-form">
    <?= Html::errorSummary($model) ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_link')->textInput(['maxlength' => true]) ?>
    <span style="color: red;">ตัวอย่าง : https://www.google.co.th/
    </span><br><br>
    
        <label>รูปภาพ</label><br>
        <span style="color: red;">
        ขนาดรูปที่เหมาะสมควรเป็นดังนี้<br>
        กว้างxสูง = 50x50<br>
        </span>
        
    <div class="row">
        <div class="col-md-5">
            <div class="slim" data-min-size="0,0">
                <input type="file"/>
                <?php
                if ($model->bank_pic_file != ""){
                    echo Yii::$app->MData->showImage($model->bank_pic_file,'','backend');
                }
                ?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>