<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Ads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ads-form">
    <?= Html::errorSummary($model) ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'well']]); ?>

    <?= $form->field($model, 'ads_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_detail')->textArea(['rows' => 6]) ?>

    <?php //$form->field($model, 'start_date')->widget(
        // DatePicker::className(), [
            // inline too, not bad
    //          'inline' => true, 
    //          'language' => 'th',
    //          // modify template for custom rendering
    //         'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    //         'clientOptions' => [

    //             'autoclose' => true,
    //             'format' => 'yyyy-m-d'
    //         ]
    // ]);
    ?>

    <?php //$form->field($model, 'end_date')->widget(
    //     DatePicker::className(), [
    //         // inline too, not bad
    //          'inline' => true, 
    //          'language' => 'th',
    //          // modify template for custom rendering
    //         'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    //         'clientOptions' => [
    //             'autoclose' => true,
    //             'format' => 'yyyy-m-d'
    //         ]
    // ]);
    ?>

    <?= $form->field($model, 'ads_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6' ], ['prompt' => 'เลือกตำแหน่ง']) ?>
    <label>รูปภาพ</label>
    <span style="color: red;">ขนาดรูปที่เหมาะสมควรเป็นดังนี้<br>
    ตัวอย่าง = กว้างxสูง<br>
    ตำแหน่ง 1 = 360x250<br>
    ตำแหน่ง 2 = 970x250<br>
    ตำแหน่ง 3 = 960x160<br>
    ตำแหน่ง 4 = 300x250<br>
    ตำแหน่ง 5 = 960x160<br>
    ตำแหน่ง 6 = 950x120<br>
    </span>
    <div class="row">
        <div class="col-md-5">
            <div class="slim">
                <input type="file"/>
                <?php
                if ($model->ads_pic_file != ""){
                    echo Yii::$app->MData->showImage($model->ads_pic_file,'','backend');
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
