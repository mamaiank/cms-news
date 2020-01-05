<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Ads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ads-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data' ,'class'=>'well']]); ?>
    <?= $form->errorSummary($model) ?>
    <?= $form->field($model, 'ads_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ads_type')->dropDownList([ 'intra' => 'ลิงค์ภายใน', 'inter'=> 'ลิงค์ภายนอก' ], ['onchange' => 'type_link(this.value)']) ?>
    <div class="form-group intra">
        <?= $form->field($model,'ads_detail')->textArea(['class'=>'tinymce']); ?>
    </div>

    <div class="form-group inter">
        <?= $form->field($model,'ads_link')->textInput(); ?>
        <span style="color: red;">ตัวอย่าง : https://www.youtube.com/watch?v=8dx87IFU00k
        </span><br><br>
    </div>
        
    <label>รูปภาพหน้าปก</label>
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

    </div><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    <br>
    

    <?php ActiveForm::end(); ?>

</div>

<?php 
if(!$model->isNewRecord){
    $this->registerJs(
        '$("document").ready(function(){ 
            init_tinymce_update();
        });'
    );
    if($model->ads_type == 'intra'){
        $this->registerJs(
            '$("document").ready(function(){ 
            $(".intra").show();
            $(".inter").hide();
            });'
        );
    } else {
        $this->registerJs(
            '$("document").ready(function(){ 
            $(".intra").hide();
            $(".inter").show();
            });'
        );
    }
} else {
    $this->registerJs(
        '$("document").ready(function(){ 
            $(".intra").show();
            $(".inter").hide();
            init_tinymce_create();
        });'
    );
}
?>

<script>
    function type_link(val){
        if(val == 'intra'){
            $(".intra").show();
            $(".inter").hide();
        } else if(val == 'inter'){
            $(".intra").hide();
            $(".inter").show();
        } else {
            $(".intra").hide();
            $(".inter").hide();
        }
    }
</script>