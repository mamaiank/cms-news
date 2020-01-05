<?php
    use common\models\Terms;
?>
<div class="col-sm-12">
    <select class="form-control" id="cat" name="cat" onchange="onCatChange();">
        <option>เลือกหมวดหมู่</option>
    <?php
    $category_all = Terms::find()->distinct('name')->where(['active'=>'active'])->orderBy(['sort_order'=>SORT_ASC])->all();
    foreach($category_all as $index => $value){
        ?>
        <option value="<?=$value['term_id']?>"><?=$value['name']?></option>
        <?php
    }
    ?>
    </select>
</div>