<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Youtube */

$this->title = $model->youtube_name;
$this->params['breadcrumbs'][] = ['label' => 'ยูทูป', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="youtube-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบข้อมูล', ['delete', 'id' => $model->id], [
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
            'youtube_name',
            'youtube_detail',
            'youtube_link',
            'create_date',
            'update_date',
            'active:boolean',
        ],
    ]) ?>

</div>
