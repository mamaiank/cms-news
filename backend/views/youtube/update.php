<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Youtube */

$this->title = 'แก้ไขลิงค์ยูทูป: ' . $model->youtube_name;
$this->params['breadcrumbs'][] = ['label' => 'ยูทูป', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->youtube_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="youtube-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
