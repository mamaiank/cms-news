<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use richardfan\sortable\SortableGridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แบนเนอร์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'sortUrl' => Url::to(['sortItem']), 
        'sortingPromptText' => 'กำลังประมวลผล...', 
        'failText' => 'ไม่สามารถเรียงลำดับได้',
        'columns' => [
            'banner_name',
            // 'banner_detail',
            [
                'attribute' => 'banner_pic_file',
                'format' => 'raw',
                'filter' => false,
                'value' => function($model){
                    if($model->banner_pic_file != ''){
                            return Yii::$app->MData->showImage($model->banner_pic_file,['style'=>'width:200px;'],'backend');
                    } else {
                        return 'ไม่มีรูปภาพ';
                    }
                }
            ],
            // 'banner_click',
            [
                'header' => 'จำนวนคลิก',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 150px'],
                'contentOptions' => ['class'=>'text-center', 'style'=>'width: 150px'],
                'attribute' => 'banner_click',
                'filter'=>false,
            ],
            // [
            //     'attribute' => 'start_date',
            //     'filter'=>false,
            // ],
            // [
            //     'attribute' => 'end_date',
            //     'filter'=>false,
            // ],
            'banner_link',
            [
                'attribute' => 'level',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'contentOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
            ],
            // 'level',
            [
                'header' => 'ย้าย',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'contentOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'format' => 'raw',
                'value' => function ($data) {
                    return '<i class="fa fa-sort" aria-hidden="true"></i>';
                },
            ],
            // 'level',
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
            url: '<?=Url::to(["/banner/index"]);?>',
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