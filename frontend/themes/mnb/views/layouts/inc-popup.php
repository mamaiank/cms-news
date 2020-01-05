<?php 

?>
<div id="carousel-id" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php 
        $i=0;
        foreach ($AllPopup as $key => $Popup) { 
            if($Popup == end($AllPopup)){
                $value = 'active';
            } else {
                $value = '';
            }
    ?>
        <li data-target="#carousel-id" data-slide-to="<?= $i ?>" class="<?= $value ?>"></li>
    <?php 
    $i++;
        }
    ?>
    </ol>
    <div class="carousel-inner">
    <?php
        $i=0;
        foreach ($AllPopup as $key => $Popup) { 
            if($Popup->popup_type == 'image'){
                $imageShow = Yii::$app->MData->showImage($Popup->popup_pic_file);
            } else if($Popup->popup_type == 'video') {
                $vdo = Yii::$app->MData->getFile($Popup->popup_pic_file);
                $imageShow = '<video width="auto" height="350px" controls>
                    <source src="'.$vdo.'?>" type="video/mp4">
                </video>';
            }
            if($Popup == end($AllPopup)){
                $value = 'active';
            } else {
                $value = '';
            }
            ?>
            <div class="item <?= $value ?>">
            <a href="<?= $Popup->popup_link != '' ? $Popup->popup_link : 'javascript:void(0)' ?>">
                <?php echo $imageShow; ?>
            </a>
                <div class="container">
                    <div class="carousel-caption">
                    </div>
                </div>
            </div>
        <?php
        $i++;
        }
        ?>
    </div>
    <style>
        .popup-left{
            left: 5%;
            display: block;
            position: absolute;
            height: 40px;
            width: 40px;
            top: 45%;
            border: 3px solid #fff;
            border-radius: 50%;
            text-align: center;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .popup-right{
            right: 5%;
            display: block;
            position: absolute;
            height: 40px;
            width: 40px;
            top: 45%;
            border: 3px solid #fff;
            border-radius: 50%;
            text-align: center;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .fa-chevron-left{
            position: absolute;
            left: 4px;
            top: 4px;
        }
        .fa-chevron-right{
            position: absolute;
            right: 4px;
            top: 4px;
        }
    </style>
    <a class="popup-left" href="#carousel-id" data-slide="prev"><span class="fa fa-chevron-left fa-2x"></span></a>
    <a class="popup-right" href="#carousel-id" data-slide="next"><span class="fa fa-chevron-right fa-2x"></span></a>
</div>