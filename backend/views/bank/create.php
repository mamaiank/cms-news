<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Bank */

$this->title = 'สร้างข้อมูลธนาคาร';
$this->params['breadcrumbs'][] = ['label' => 'ธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
