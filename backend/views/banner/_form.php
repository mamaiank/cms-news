<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
function isChecked($model){
    if($model == 1){
        return 'checked';
    }
}
?>

<div class="banner-form">
    <?= Html::errorSummary($model) ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'well']]); ?>

    <?= $form->field($model, 'banner_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'banner_detail')->textArea(['rows' => 6]) ?>

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
    
    <?= $form->field($model, 'banner_link')->textInput(['maxlength' => true]) ?>
    <span style="color: red;">ตัวอย่าง : https://www.google.co.th/
    </span><br><br>

    <?= $form->field($model, 'level')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', ], ['prompt' => 'เลือกตำแหน่ง', 'onchange' => 'level_banner(this.value)']) ?>
       
    <div class="row">
        <div class="col-md-5 img">
        <label>รูปภาพ</label><br>
        <span style="color: red;">ขนาดรูปที่เหมาะสมควรเป็นดังนี้<br>
    ตัวอย่าง = กว้างxสูง<br>
    ตำแหน่ง 1 = 970x250<br>
    ตำแหน่ง 2 = 1300x420<br>
    ตำแหน่ง 3 = 970x250<br>
    ตำแหน่ง 4 = 970x250<br>
    ตำแหน่ง 5 = 970x250<br>
    ตำแหน่ง 6 = 960x160<br>
    ตำแหน่ง 7 = 300x250<br>
    ตำแหน่ง 8 = 960x160<br>
    ตำแหน่ง 9 = 950x120<br>
    </span>
    <?= $form->field($model, 'type')->dropDownList([ 1 => 'ภาพนิ่ง', 2 => 'ภาพเคลื่อนไหว'], ['onchange' => 'typeImg(this.value)']) ?>
            <div id="pic" class="slim" data-min-size="0,0">
                <input name="banner_pic_file" type="file"/>
                <?php
                if ($model->banner_pic_file != ""){
                    echo Yii::$app->MData->showImage($model->banner_pic_file,'','backend');
                }
                ?>
            </div>
            <div id="animate" style="display:none; margin-bottom: 10px; ">
                <input type="file" name="Banner[animate]">
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-6 img">
            <?php 
     $cateMem = array();
     if(empty($term_index)){
         $term_index = array();
     }
    ?>
    <?php echo Html::activeLabel($model,'banner_relate_index').' <br>';?>
            <div style="width: 500px; height: 200px; overflow-y: scroll;">
    <?php
        
    foreach ($cate as $key => $value): 
        echo Html::checkBox('Banner[banner_relate_index][]', (in_array($value->term_id, $term_index))?TRUE:FALSE, array('value'=>$value->term_id));

        echo '<label>'.$value->name.'</label></br>';
        ?>
        <?php 
    endforeach 
        ?>
            </div>
        </div>
        <div class="col-md-6 img">
            <?php 
     $cateMem = array();
     if(empty($term_detail)){
         $term_detail = array();
     }
    ?>
    <?php echo Html::activeLabel($model,'banner_relate_detail').' <br>';?>
            <div style="width: 500px; height: 200px; overflow-y: scroll;">
    <?php
        
    foreach ($cate as $key => $value): 
        echo Html::checkBox('Banner[banner_relate_detail][]', (in_array($value->term_id, $term_detail))?TRUE:FALSE, array('value'=>$value->term_id));

        echo '<label>'.$value->name.'</label></br>';
        ?>
        <?php 
    endforeach 
        ?>
            </div>
        </div>
    </div>
    
    <div class="form-group hover_status" style="display:none">
        
        <?= $form->field($model, 'hover_status')->dropDownList([ 0 => 'ปิด', 1 => 'เปิด'], [ 'onchange' => 'ishover(this.value)']) ?>
    
    </div>
    
    <div class="banner-type" >
    <?= $form->field($model, 'banner_type')->dropDownList([ 'image' => 'รูปภาพ', 'video' => 'วิดีโอ' ], ['prompt' => 'เลือกประเภท', 'onchange' => 'type_file(this.value)']) ?>
    </div>
    
    <div class="row">
        <div class="col-md-5 img-hover" style="display:none">
        <label>รูปภาพ</label><br>
            <div class="slim" data-min-size="0,0">
                <input name="banner_pic_hover" type="file"/>
                <?php
                if ($model->banner_pic_hover != "" && $model->banner_type == 'image'){
                    echo Yii::$app->MData->showImage($model->banner_pic_hover,'','backend');
                }
                ?>
            </div>
        </div>

        <div class="col-md-5 vdo">
            <label for="">วีดีโอ <span style="color: red">(ไฟล์ mp4 เท่านั้น)</span></label>
           <?php if($model->banner_pic_file != "" && $model->banner_type == 'video'){
               $vdo = Yii::$app->MData->getFile($model->banner_pic_hover,'','backend');
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
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
        
    function ishover(val) {
        if(val == 1) {
            $('.banner-type').show();
        } else {
            $('.banner-type').hide();
            $('.img-hover').hide();
            $('.vdo').hide();
            $('#banner-banner_type').val('');
        }
    }
    
    function level_banner(val){
            $('#banner-hover_status').prop('selectedIndex',0);
            $('.img-hover').hide();
            $('.vdo').hide();
        if(val != '') {
            $('.img').show();
            $('.vdo').hide();
            $('.hover_status').hide();
            $('.banner-type').hide();
            $('.hover_status').show();
            $('#banner-banner_type').val('');
        } else if(val == ''){
            $('.img').hide();
            $('.vdo').hide();
            $('.hover_status').hide();
            $('.banner-type').hide();
            $('#banner-banner_type').val('');
        }
    }

    function type_file(val){
        if(val == 'image') {
            $('.img-hover').show();
            $('.vdo').hide();
        } else if(val == 'video'){
            $('.img-hover').hide();
            $('.vdo').show();
        }
    }

    function typeImg(val){
        if(val == '1') {
            $('#pic').show();
            $('#animate').hide();
        } else {
            $('#pic').hide();
            $('#animate').show();
        }
    }

<?php 
if(!$model->isNewRecord){
    if($model->level != ''){
        $this->registerJs(
            '$("document").ready(function(){ 
                checkBannerLevel(1); 
            });'
        );
        if($model->hover_status == 1){
            $this->registerJs(
                '$("document").ready(function(){ 
                    checkBannerLevel(1); 
                });'
            );
            if($model->banner_type == 'image'){
                $this->registerJs(
                    '$("document").ready(function(){ 
                        checkBannerType("image"); 
                    });'
                );
            } else {
                $this->registerJs(
                    '$("document").ready(function(){ 
                        checkBannerType("video"); 
                    });'
                );
            }
        } else {
            $this->registerJs(
                '$("document").ready(function(){ 
                    checkBannerLevel(0); 
                });'
            );
        }
    } else {

    }
}
?>
    
</script>
