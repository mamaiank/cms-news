<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Popup */

$this->title = $model->popup_name;
$this->params['breadcrumbs'][] = ['label' => 'ป๊อปอัพ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popup-view">

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
            'id',
            'popup_name',
            'popup_detail',
            'start_date',
            'end_date',
            'popup_link',
            'popup_pic_file',
            'create_date',
            'update_date',
            'active',
        ],
    ]) ?>

</div>
