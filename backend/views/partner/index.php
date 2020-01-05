<?php

use yii\helpers\Html;
use yii\helpers\Url;
use richardfan\sortable\SortableGridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'พาร์ทเนอร์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index">

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
            'partner_name',
            'partner_link',
            [
                'attribute' => 'partner_pic',
                'format' => 'html',
                'filter' => false,
                'value' => function($model){
                    if($model->partner_pic){
                        return Yii::$app->MData->showImage($model->partner_pic,['class'=>'thumbnail','style'=>'width:200px;'],'backend');
                    } else {
                        return 'ไม่มีรูปภาพ';
                    }
                }
            ],
            'create_date',
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
            url: '<?=Url::to(["/partner/index"]);?>',
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