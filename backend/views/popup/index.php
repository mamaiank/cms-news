<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use richardfan\sortable\SortableGridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PopupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ป๊อปอัพ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'sortUrl' => Url::to(['sortItem']), 
        'sortingPromptText' => 'กำลังประมวลผล...', 
        'failText' => 'ไม่สามารถเรียงลำดับได้',
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'popup_name',
            // 'popup_detail',
            [
                'attribute' => 'popup_pic_file',
                'format' => 'html',
                'filter' => false,
                'value' => function($model){
                    if($model->popup_pic_file){
                        return Yii::$app->MData->showImage($model->popup_pic_file,['class'=>'thumbnail','style'=>'width:200px;'],'backend');
                    } else {
                        return 'ไม่มีรูปภาพ';
                    }
                }
            ],
            [
                'attribute' => 'start_date',
                'filter'=>false,
            ],
            [
                'attribute' => 'end_date',
                'filter'=>false,
            ],
            'popup_link',
            // 'create_date',
            // 'update_date',
            [
                'header' => 'ย้าย',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'contentOptions' => ['class'=>'text-center'],
                'format' => 'raw',
                'value' => function ($data) {
                    return '<i class="fa fa-sort" aria-hidden="true"></i>';
                },
            ],
            [
                'header' => 'เปิด/ปิด',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'contentOptions' => ['class'=>'text-center'],
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->active == 'active') {
                            $value = "เปิด";
                            $class = "btn btn-success btn-xs";
                    } else {
                            $value = "ปิด";
                            $class = "btn btn-primary btn-xs";
                    }
                return '<button class="'.$class.'" id="status'.$data->id.'" onClick="changeStatus('.$data->id.')">'.$value.'</button>';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<script>
    function changeStatus(val) {
        $.ajax({
            type: "POST",
            url: '<?=Url::to(["/popup/index"]);?>',
            data:'status_id='+val,
            success: function(data){
                $("#status"+val).text(data);
                if(data == 'เปิด'){
                    $("#status"+val).removeClass('btn btn-primary btn-xs').addClass('btn btn-success btn-xs');
                } else {
                    $("#status"+val).removeClass('btn btn-success btn-xs').addClass('btn btn-primary btn-xs');
                }
            }
        });               
}
</script>