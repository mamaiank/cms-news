<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'โลโก้ลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?//= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'customer_title:ntext',
//            'customer_date',
//            'customer_modified',
//            'customer_pic',
            [
                'attribute' => 'customer_pic',
                'format' => 'html',
                'filter' => false,
                'value' => function($model){
                    if($model->customer_pic){
                        return Yii::$app->MData->showImage($model->customer_pic,['style'=>'height:200px;width:200px;'],'backend');
                    } else {
                        return 'ไม่มีรูปภาพ';
                    }
                }
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
                return '<button class="'.$class.'" id="status'.$data->ID.'" onClick="changeStatus('.$data->ID.')">'.$value.'</button>';
                },
            ],

            // 'create_by',
            // 'update_by',
            // 'active',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '<div class="text-center"> เมนูจัดการ </div>',
                'template'=>'<div class="text-center" role="group"> {update} </div>'
            ],
        ],
    ]); ?>
</div>
<script>
function changeStatus(val) {
    $.ajax({
        type: "POST",
        url: '<?=Url::to(["/customer/index"]);?>',
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