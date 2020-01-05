<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ads */

$this->title = 'แก้ไข โฆษณา: ' . $model->ads_name;
$this->params['breadcrumbs'][] = ['label' => 'โฆษณา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ads_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="ads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
