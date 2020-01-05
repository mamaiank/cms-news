<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Youtube */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="youtube-form">

    <?php $form = ActiveForm::begin(['options'=>['class'=>'well']]); ?>
    <?= Html::errorSummary($model); ?>
    <?= $form->field($model, 'youtube_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtube_detail')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'link_type')->dropDownList([ 'youtube' => 'youtube', 'facebook'=> 'facebook' ], ['prompt' => 'เลือกประเภท', 'onchange' => 'type_link_video(this.value)']) ?>

    <div class="form-group facebook">
        <?= $form->field($model, 'linkF')->textInput(['maxlength' => true,'onchange'=>'cutStyle(this.value)']) ?>
        <span style="color: red;">ตัวอย่าง : < iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fmoneyandbanking%2Fvideos%2F1333748480018547%2F&show_text=0&width=560" width="560" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true">< /iframe>
        </span><br><br>
    </div>

    <div class="form-group youtube">
        <?= $form->field($model, 'linkY')->textInput(['maxlength' => true]) ?>
        <span style="color: red;">ตัวอย่าง : https://www.youtube.com/watch?v=84Wen9FuXCE&t=6190s
        </span><br><br>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$this->registerJs(
    '$("document").ready(function(){ 
        $(".facebook").hide();
        $(".youtube").hide();
    });'
);

?>

<script>
    function cutStyle(val){
        var res = val.replace("overflow:hidden", "");
        document.getElementById("youtube-linkf").value = res;
        // alert(res);
    }
    function type_link_video(val){
        if(val == 'youtube'){
            $(".youtube").show();
            $(".facebook").hide();
            $('#youtube-linkf').val('');
        } else if(val == 'facebook'){
            $(".youtube").hide();
            $(".facebook").show();
            $('#youtube-linky').val('');
        } else {
            $('#youtube-linkf').val('');
            $('#youtube-linky').val('');
            $(".youtube").hide();
            $(".facebook").hide();
        }
    }
</script>

<?php 
if(!$model->isNewRecord){
    if($model->link_type == 'youtube'){
        $this->registerJs(
            '$("document").ready(function(){ 
                $(".youtube").show();
            });'
        );
    } else if($model->link_type == 'facebook'){
        $this->registerJs(
            '$("document").ready(function(){ 
                $(".facebook").show();
            });'
        );
    } else {
        $this->registerJs(
            '$("document").ready(function(){ 
                $(".youtube").hide(); 
                $(".facebook").hide(); 
            });'
        );
    }
}
?>