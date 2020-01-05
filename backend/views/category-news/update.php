<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryNews */

$this->title = 'แก้ไขหมวดหมู่เนื้อหา: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'หมวดหมู่เนื้อหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->term_id]];
$this->params['breadcrumbs'][] = 'แก้ไขหมวดหมู่เนื้อหา';
?>
<div class="category-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
