<?php

use yii\helpers\Html;
use richardfan\sortable\SortableGridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoryNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'หมวดหมู่เนื้อหา';
$this->params['breadcrumbs'][] = $this->title;
$date_active = ['1'=>'เปิดการใช้งาน','0'=>'ปิดการใช้งาน'];
?>
<div class="category-news-index">

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
            'name',
            // 'create_date',
            // 'update_date',
            // [
            //     'attribute' => 'create_date',
            //     'filter'=>false,
            // ],
            // [
            //     'attribute' => 'update_date',
            //     'filter'=>false,
            // ],
            // 'active:boolean',

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
                return '<button class="'.$class.'" id="status'.$data->term_id.'" onClick="changeStatus('.$data->term_id.')">'.$value.'</button>';
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '<div class="text-center"> เมนูจัดการ </div>',
                'template'=>'<div class="text-center" role="group"> {view} {update} </div>'
            ],
        ],
    ]); ?>

</div>

<script>
    function changeStatus(val) {
        $.ajax({
            type: "POST",
            url: '<?=Url::to(["/category-news/index"]);?>',
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