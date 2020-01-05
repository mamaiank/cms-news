<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'แก้ไขเนื้อหา: ' . $model->post_title;
$this->params['breadcrumbs'][] = ['label' => 'เนื้อหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->post_title, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'แก้ไขเนื้อหา';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cate'=>$cate,
        'term'=>$term,
        'array_tag' => $array_tag,
        'array_tag_post'=>$array_tag_post,
    ]) ?>

</div>
