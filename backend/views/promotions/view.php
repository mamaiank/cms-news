<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Promotions */

$this->title = $model->ads_name;
$this->params['breadcrumbs'][] = ['label' => 'โปรโมชั่น', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'ads_name',
            'ads_detail:ntext',
            'start_date',
            'end_date',
            'ads_pic_file',
            'ads_click',
            'ads_link',
            'create_date',
            'update_date',
            // 'level',
            'active',
            'sort_order',
            'create_by',
            'update_by',
        ],
    ]) ?>

</div>
