<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Popup */

$this->title = 'สร้างป๊อปอัพ';
$this->params['breadcrumbs'][] = ['label' => 'ป๊อปอัพ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
