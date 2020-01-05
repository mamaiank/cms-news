<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Partner */

$this->title = 'สร้างลิงค์พาร์ทเนอร์';
$this->params['breadcrumbs'][] = ['label' => 'พาร์ทเนอร์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
