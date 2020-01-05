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
    <?= $form->field($model, 'post_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'post_content')->textArea(['class'=>'tinymce']); ?>
        
    <label>รูปภาพหน้าปก</label>
    <div class="row">
        <div class="col-md-5">
            <div class="slim">
                <input type="file"/>
                <?php
                if ($model->post_pic != ""){
                    echo Yii::$app->MData->showImage($model->post_pic,'','backend');
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
    <?php echo Html::activeLabel($model,'news_type_tag').'<br>';?>
            <div style="width: 500px; height: 200px; overflow-y: scroll;">
    <?php
        
    foreach ($cate as $key => $value): 
        $dis = '';
        if($value->term_id == "64" && isset($special) && $special==1){
            $dis = 'disabled checked ';
        }
        echo Html::checkBox('Posts[news_type_tag][]', (in_array($value->term_id, $term))?TRUE:FALSE, array('value'=>$value->term_id,$dis=>""));

        echo '<label>'.$value->name.'</label></br>';
        ?>
        <?php 
    endforeach 
        ?>
            </div>
        </div>
    </div>

    <?php 
$select = [];
$tagPost = [];
if(isset($array_tag)){
    foreach ($array_tag as $key => $value) {
        $select[$value] = $value;
    }
}
if(isset($array_tag_post)){
    foreach ($array_tag_post as $key => $value) {
        $tagPost[$value] = $value;
    }
}
        ?>
        <?= $form->field($model, 'tag')->dropDownList($select,['multiple'=>'multiple','value'=>$tagPost]) ?>

        <?= $form->field($model, 'contributor')->dropDownList([ 'un_active' => 'ปิด', 'active' => 'เปิด'], [ 'onchange' => 'isContributor(this.value)']) ?>
        <div class="contributor">
        <?= $form->field($model, 'contributor_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="contributor">
        <?= $form->field($model,'contributor_detail')->textArea(); ?>
        </div>
        <label class="contributor">รูปภาพประกอบ</label><br>            
        <div class="row contributor">
        <div class="col-md-5">
            <div class="slim" data-min-size="0,0">
                <input name="contributor_pic" type="file"/>
                <?php
                if ($model->contributor_pic != ""){
                    echo Yii::$app->MData->showImage($model->contributor_pic,'','backend');
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

<script>
    function isContributor(val){
        if(val == 'active'){
            $(".contributor").show();
        } else if(val == 'un_active'){
            $(".contributor").hide();
        }
    }
</script>

<?php 
if(!$model->isNewRecord){
    $this->registerJs(
        '$("document").ready(function(){ 
            init_tinymce_update();
        });'
    );
    if($model->contributor != ''){
        if($model->contributor == 'active'){
            $this->registerJs(
                '$("document").ready(function(){ 
                    $(".contributor").show();
                });'
            );
        } else {
            $this->registerJs(
                '$("document").ready(function(){ 
                    $(".contributor").hide();
                });'
            );
        }
    } else {

    }
} else {
    $this->registerJs(
        '$("document").ready(function(){ 
            init_tinymce_create();
            $(".contributor").hide();
        });'
    );
}
?>
