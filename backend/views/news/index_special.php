<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\CategoryNews;
use common\models\PostViews;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เนื้อหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'news_title',
            [
                'attribute' => 'post_title',
                'value' => function($model){
                        return htmlspecialchars_decode(iconv_substr($model->post_title,0,40,'utf-8'));
                }
            ],
            // [
            //     'attribute' => 'post_content',
            //     'value' => function($model){
            //             return htmlspecialchars_decode(iconv_substr($model->post_content,0,40,'utf-8'));
            //     }
            // ],
            'post_date',
            // 'post_modified',
            // 'news_detail:ntext',
            // [
            //     'attribute' => 'news_type_tag',
            //     'filter' => Html::activeDropDownList($searchModel, 'news_type_tag', ArrayHelper::map(CategoryNews::find()->all(), 'id','cate_news_name'),['class'=>'form-control']),
            //     'format' => 'html',
            //     'value' => function($model){
            //             $output = $model->getCategotyNews($model->news_type_tag);
            //             return $output;
            //     }
            // ],
            [
                'attribute' => 'post_pic',
                'format' => 'html',
                'filter' => false,
                'value' => function($model){
                    if($model->post_pic){
                        return Yii::$app->MData->showImage($model->post_pic,['style'=>'height:200px;width:200px;'],'backend');
                    } else {
                        return 'ไม่มีรูปภาพ';
                    }
                }
            ],
            [
                'header' => 'จำนวนเข้าชม',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'contentOptions' => ['class'=>'text-center'],
                'value' => function($model){
                        $pv = PostViews::find()->where(['id'=>$model->ID,'period'=>'total'])->one();
                        // var_dump($pv['count']);exit();
                        return $pv['count'];
                }
            ],
            [
                'header' => 'ปักหมุด',
                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                'contentOptions' => ['class'=>'text-center'],
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->post_pin == 1) {
                            $value = "เปิด";
                            $class = "fa fa-check-square-o";
                    } else {
                            $value = "ปิด";
                            $class = "fa fa-square-o";
                    }
                return '<a onClick="changePin('.$data->ID.')"><i id="pin'.$data->ID.'" class="'.$class.'"></i></a>';
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
                return '<button class="'.$class.'" id="status'.$data->ID.'" onClick="changeStatus('.$data->ID.')">'.$value.'</button>';
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
        url: '<?=Url::to(["/news/index"]);?>',
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

function changePin(val) {
        $.ajax({
            type: "POST",
            url: '<?=Url::to(["/news/index"]);?>',
            data:'pin_id='+val,
            success: function(data){
                // $("#status"+val).text(data);
                if(data == 1){
                    $("#pin"+val).removeClass('fa fa-square-o').addClass('fa fa-check-square-o');
                } else {
                    $("#pin"+val).removeClass('fa fa-check-square-o').addClass('fa fa-square-o');
                }
            }
        });               
}
</script>
