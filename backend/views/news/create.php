<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'สร้างเนื้อหา';
$this->params['breadcrumbs'][] = ['label' => 'เนื้อหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cate'=>$cate,
        'array_tag' => $array_tag,
        'special' => $special,
    ]) ?>

</div>
