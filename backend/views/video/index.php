<?php

use yii\helpers\Html;
use yii\helpers\Url;
use richardfan\sortable\SortableGridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\YoutubeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'วีดีโอ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="youtube-index">

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
            'youtube_name',
            // 'youtube_detail',
            // 'youtube_link',
            [
                'header' => 'ลิงค์',
                // 'headerOptions' => ['class'=>'text-center', 'style'=>'max-width: 50px'],
                // 'contentOptions' => ['class'=>'text-center', 'style'=>'max-width: 50px'],
                'format' => 'raw',
                'value' => function ($data) {
                    if($data->link_type == 'facebook'){
                        return $data->youtube_link;
                    } else {
                        $new_link = str_replace("watch?v=", "embed/", $data->youtube_link);
                        return '<iframe class="embed-responsive-item" src="'.$new_link.'" allowfullscreen></iframe>';
                    }
                },
            ],
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
            url: '<?=Url::to(["/youtube/index"]);?>',
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