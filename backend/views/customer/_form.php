<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data' ,'class'=>'well']]); ?>
	<?= $form->errorSummary($model) ?>
    <?= $form->field($model, 'customer_title')->textInput(['maxlength' => true]) ?>
        
    <label>รูปภาพหน้าปก</label>
    <div class="row">
        <div class="col-md-5">
            <div class="slim">
                <input type="file"/>
                <?php
                if ($model->customer_pic != ""){
                    echo Yii::$app->MData->showImage($model->customer_pic,'','backend');
                }
                ?>
            </div>
        </div>
        <div class="col-md-5">
            <?php 
     $cateMem = array();
     if(empty($term)){
         $term = array();
     }
    ?>
        </div>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

