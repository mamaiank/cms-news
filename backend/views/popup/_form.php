<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\Popup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="popup-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'well']]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'popup_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'popup_detail')->textArea(['rows' => 6]) ?>

    <?= $form->field($model, 'start_date')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => true, 
             'language' => 'th',
             // modify template for custom rendering
            'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [

                'autoclose' => true,
                'format' => 'yyyy-m-d'
            ]
    ]);?>

    <?= $form->field($model, 'end_date')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => true, 
             'language' => 'th',
             // modify template for custom rendering
            'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-d'
            ]
    ]);?>
    <?= $form->field($model, 'popup_type')->dropDownList([ 'image' => 'รูปภาพ', 'video' => 'วิดีโอ' ], ['prompt' => 'เลือกประเภท', 'onchange' => 'type_file(this.value)']) ?>

    <div class="row">
        <div class="col-md-5 img-hover" style="display:none">
        <?= $form->field($model, 'popup_link')->textInput(['maxlength' => true]) ?>
        <label>รูปภาพ</label><br>
            <div class="slim" data-min-size="0,0">
                <input type="file"/>
                <?php
                if ($model->popup_pic_file != ""){
                    echo Yii::$app->MData->showImage($model->popup_pic_file,'','backend');
                }
                ?>
            </div>
        </div>

        <div class="col-md-5 vdo">
            <label for="">วีดีโอ <span style="color: red">(ไฟล์ mp4 เท่านั้น)</span></label>
           <?php if($model->popup_type == 'video'){
               $vdo = Yii::$app->MData->getFile($model->popup_pic_file,'','backend');
        ?>            
            
                <video width="auto" height="350px" controls>
                    <source src="<?= $vdo ?>" type="video/mp4">
                </video>
                <?php } ?>
            <?php echo $form->field($model, 'vdo')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    'showUpload' => false,
                ],
                'options' => ['accept' => 'video/mp4'],
            ])->label(false); ?>
        </div>
    </div>

<div class="clearfix"></div><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function type_file(val){
        if(val == 'image') {
            $('.img-hover').show();
            $('.vdo').hide();
        } else if(val == 'video'){
            $('.img-hover').hide();
            $('.vdo').show();
        } else {
            $('.img-hover').hide();
            $('.vdo').hide();
        }
    }

    <?php 
if(!$model->isNewRecord){
    // if($model->popup_pic_file != ''){
        if($model->popup_type == 'image'){
            $this->registerJs(
                '$("document").ready(function(){ 
                    $(".img-hover").show();
                    $(".vdo").hide();
                });'
            );
        } else if($model->popup_type == 'video') {
            $this->registerJs(
                '$("document").ready(function(){ 
                    $(".img-hover").hide();
                    $(".vdo").show();
                });'
            );
        }
    // }
}
?>

</script>