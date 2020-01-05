<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Youtube */

$this->title = 'สร้างลิงค์วีดีโอ';
$this->params['breadcrumbs'][] = ['label' => 'วีดีโอ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="youtube-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
