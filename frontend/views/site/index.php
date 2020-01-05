<?php

use yii\helpers\Url;

$page = "index";

?>
<?php $this->title = 'Money&Banking'; ?>
<?php if ($AllPopup != null) { ?>
    <div class="modal fade" id="modal-index">
        <div class="modal-dialog">
            <!-- <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div> -->
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="
                            position: absolute;
                            z-index: 99999;
                            right: 10px;
                            top: 10px;
                            opacity: 1;
                            "><i class="fa fa-times" aria-hidden="true"></i></button>
                            <?php include(__dir__ . "/../../themes/mnb/views/layouts/inc-popup.php"); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include(__dir__ . "/../../themes/mnb/views/layouts/inc-header.php"); ?>
<title>Money&amp;Banking | การเงินธนาคาร</title> 

<div class="hotnews-slide-text">
    <div class="container">
        <div class="hotnews-wrap">
            <div class="hotnews-label SukhumvitSetBold">HOT NEWS</div>
            <ul class="bxslider-text">
                <?php
                foreach ($hotNewsIndex as $key => $data) {
                    ?>
                    <li>
                        <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>">
                            <span><?= Yii::$app->MData->changeFormatDate($data->post_date) ?> in <?= $data->name ?>: </span>
                            <?= $data->post_title ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div id="mb-banner-1" class="show">
    <div class="banner-size">
        <?php
        $i = 0;
        $v = 0;
        foreach ($bannerImgSuff as $key => $value) {
            if ($value->level == 1 && $i == 0) {
                $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                if(!$checkFile){
                    continue;
                }
                if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                    if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture">  
                        
                        <a id="bannerhover1" href="<?= $file_hover ?>" data-fancybox="images1"></a>
                        <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                    <?php
                } else {
                    ?>
                    <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                    <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                    </a>
                    <?php
                }
                $i++;
            }
        }
        ?>
    </div>
</div>



<?php include(__dir__ . "/../../themes/mnb/views/layouts/inc-hilight.php"); ?>

<div id="mb-banner-2" class="show">
    <div class="banner-size">
        <div class="container">
            <div class="heding-all">
                <div class="title SukhumvitSetBold">โปรโมชั่น</div>
                <div class="title-en SukhumvitSetBold">Promotions</div>
            </div>
            <div class="group-slide-promo">
                <div class="slide-promo">
                    <?php
                    foreach ($promotionImg as $key => $value) {
                        ?>
                        <div class="slide">
                            <h3 class="heading-bn SukhumvitSetBold"><?= $value->ads_name ?></h3>
                            <div class="picture">
                            <a href="<?= Url::to(['/promotions/detail', 'id' => $value->id]) ?>"><?= Yii::$app->MData->showImage($value->ads_pic_file, ['class' => 'img-responsive center-block', 'style' => 'height: 250px; width:360px;']) ?></a>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="mb-section bgc-ffffff">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <?php
                $i = 0;
                foreach ($newsUpdate as $key => $data) {
                    if ($i == 0) {
                        ?>
                        <div class="thumbnail thumbnail-news-update">
                            <h1 class="title-name">
                                <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>"><?= $data->post_title ?></a>
                            </h1>
                            <div class="pic">
                                <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>"><?= Yii::$app->MData->showImage($data->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                            </div>
                            <?php  ?>
                            <div class="caption">
                                <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($data->post_date) ?></div>
                                <div class="desc">
                                    <?= Yii::$app->MData->removeImgTag($data->post_content, 350) ?>
                                </div>
                                <div class="text-right">
                                    <a class="btn icon-link" href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>">
                                        อ่านต่อ <span class="glyphicon glyphicon-triangle-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $i++;
                        } else if ($i < 3) {
                            ?>
                            <div class="col-sm-6">
                                <div class="thumbnail thumbnail-news-update sm">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>"><?= Yii::$app->MData->showImage($data->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                    </div>
                                    <div class="caption">
                                        <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($data->post_date) ?></div>
                                        <div class="title-name">
                                            <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>"><?= Yii::$app->MData->removeImgTag($data->post_title, 80) ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($i == 2) {
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="heading-update SukhumvitSetBold">
                                News Update
                                <div class="line">
                                    <div class="icon"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <?php
                        }
                        $i++;
                    } else {
                        ?>
                        <div class="thumbnail thumbnail-news-update sm">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>"><?= Yii::$app->MData->showImage($data->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="caption">
                                        <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($data->post_date) ?></div>
                                        <div class="title-name">
                                            <a href="<?= Yii::$app->MData->getLinkNews($data->ID,$data->term_taxonomy_id,$data->post_title) ?>"><b><?= Yii::$app->MData->removeImgTag($data->post_title, 120) ?></b><?= Yii::$app->MData->removeImgTag($data->post_content, 100) ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                }
                ?>
                <div class="text-center more">
                    <a class="btn btn-more" href="<?= Url::to(['/news/index', 'id' => $data->term_taxonomy_id]) ?>">ดูทั้งหมด</a>
                </div>         
            </div>
        </div>
    </div>
</section>

<div id="mb-banner-3" class="show">
    <div class="banner-size">
        <div class="picture">
            <?php
            $i = 0;
            foreach ($bannerImgSuff as $key => $value) {
                if ($value->level == 3 && $i == 0) {
                    $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                    if(!$checkFile){
                        continue;
                    }
                    if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                        if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture">  
                        <a id="bannerhover3" href="<?= $file_hover ?>" data-fancybox="images3"></a>
                        <a id="banner3" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                        <?php
                    } else {
                        ?>
                        <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                        <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                        <?php
                    }
                    $i++;
                }
            }
            ?>
        </div>
    </div>
</div>

<section class="mb-section bgc-ffffff">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 plugin-left">
                <div class="heading-plugin color-white SukhumvitSetBold">หุ้น</div>
                <div class="line-3-pastelblue"></div>
                <div class="box" >
                    <iframe frameborder=0 scrolling=no width="200" height="206" src="https://weblink.settrade.com/banner/banner3.jsp"></iframe>
                    <!--<iframe src="http://www.settrade.com/banner/banner3.jsp" marginwidth="0" marginleft="0" height="210" width="200" scrolling=no frameborder=no></iframe>-->
                </div>
            </div>
            <div class="col-sm-4 plugin-center">
                <div class="heading-plugin color-black SukhumvitSetBold">ราคาทองคำ</div>
                <div class="line-3-gold"></div>
                <div class="box"><center>
                    <iframe marginWidth="0" marginHeight="0" src="http://www.thaigold.info/RealTimeDataV2/GTfairprice.php" frameBorder="0" width="auto" scrolling="no" height="165"></iframe>
                    <br>
                    <iframe src="http://www.namchiang.com/GoldPriceHistory/GoldPrice2015.html" width="172" height="165" frameborder="0" marginheight=0 marginwidth=0 scrolling="no"></iframe>
                    </center></div>
            </div>
            <div class="col-sm-4 plugin-right">
                <div class="heading-plugin color-black SukhumvitSetBold">อัตราแลกเปลี่ยน</div>
                <div class="line-3-gray"></div>
                <div class="box">
                    <iframe marginWidth="0" marginHeight="0" src="http://www.bangkokbank.com/fxbanner/banner1.htm" frameBorder="0" width="173" scrolling="no" height="165"></iframe>
                </div>
                <div class="line-1-gray"></div>
                <div class="logo-bank">
                    <ul class="bxslider-carousel">
                        <?php
                        foreach ($bankImg as $key => $value) {
                            ?>
                            <li><a target='_blank' href="<?= $value->bank_link != '' ? Url::to($value->bank_link) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->bank_pic_file, ['class' => 'img-responsive center-block']) ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="mb-banner-4" class="show">
    <div class="banner-size">
        <div class="picture">
            <?php
            $i = 0;
            foreach ($bannerImgSuff as $key => $value) {
                if ($value->level == 4 && $i == 0) {
                    $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                    if(!$checkFile){
                        continue;
                    }
                    if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                        if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture">  
                        <a id="bannerhover4" href="<?= $file_hover ?>" data-fancybox="images4"></a>
                        <a id="banner4" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                        <?php
                    } else {
                        ?>
                        <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                        <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                        <?php
                    }
                    $i++;
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="container"><hr class="line"></div>

<section class="mb-section">
    <div class="container">
        <div class="heding-all">
            <div class="title SukhumvitSetBold">วารสารการเงินธนาคาร</div>
            <div class="title-en SukhumvitSetBold">Money&Banking Magazine</div>
        </div>
        <div class="row">
            <?php
            $i = 0;
            foreach ($magazine as $key => $value) {
                if ($i == 0) {
                    ?>
                    <div class="col-sm-6">
                        <div class="thumbnail thumbnail-news">
                            <div class="pic">
                                <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 160px; width:100%;']) ?></a>
                            </div>
                            <div class="desc">
                                <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><b><?= Yii::$app->MData->removeImgTag($value->post_title, 100) ?></b></a>
                                <div class="line-3-gray"></div>
                                    <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                    
                                <?php //= strip_tags(iconv_substr($value->post_content, 0, 430, 'utf-8')) . '..' ?>
                            </div>
                            <div class="link">
                            	<a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>">อ่านต่อ</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                } else {
                    ?>
                    <div class="col-sm-3">
                        <div class="thumbnail thumbnail-news thumb-small">
                            <div class="pic">
                                <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>" style="max-height: 200px;"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                            </div>
                            <div class="type-name"><a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 80) ?></a></div>
                            <div class="line-1-gray"></div>
                            <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
<!--                            <div class="title-name">
                                <a href="<?= Url::to(['/magazine/detail', 'id' => $value->ID, 'category' => $value->term_taxonomy_id]) ?>"><?= htmlspecialchars_decode(iconv_substr($value->post_title, 0, 80, 'utf-8')); ?></a>
                            </div>-->
                        </div>
                    </div>
                    <?php
                    if($i == 2){
                        echo '<div class="clearfix"></div>';
                    }
                    $i++;
                }
            }
            if($reasearch_special_Pin){
                foreach ($reasearch_special_Pin as $key => $value) {
                    ?>
                    <div class="col-sm-3">
                        <div class="thumbnail thumbnail-news thumb-small">
                            <div class="pic">
                                <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>" style="max-height: 200px;"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                            </div>
                            <div class="type-name"><a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 80) ?></a></div>
                            <div class="line-1-gray"></div>
                            <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
<!--                            <div class="title-name">
                                <a href="<?= Url::to(['/magazine/detail', 'id' => $value->ID, 'category' => $value->term_taxonomy_id]) ?>"><?= htmlspecialchars_decode(iconv_substr($value->post_title, 0, 80, 'utf-8')); ?></a>
                            </div>-->
                        </div>
                    </div>
                    <?php
                        echo '<div class="clearfix"></div>';
                }
            }
            ?>
        </div>
        <div class="text-center padding-top-bottom-20">
            <a class="btn btn-regis" target='_blank' href="http://www.ma.co.th/th/bookstore.php?id=4">สมัครสมาชิก</a>
            <a class="btn btn-backissues" href="<?= Url::to(['/magazine/index', 'id' => 10]) ?>">ฉบับย้อนหลัง</a>
        </div>
    </div>
</section>

<div class="container"><hr class="line"></div>

<div id="mb-banner-5" class="show">
    <div class="banner-size">
        <?php
        $i = 0;
        foreach ($bannerImgSuff as $key => $value) {
            if ($value->level == 5 && $i == 0) {
                $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                if(!$checkFile){
                    continue;
                }
                if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                    if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture"> 
                        <a id="bannerhover5" href="<?= $file_hover ?>" data-fancybox="images5"></a>
                        <a id="banner5" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                    <?php
                } else {
                    ?>
                    <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                    <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                    </a>
                    <?php
                }
                $i++;
            }
        }
        ?>
    </div>
</div>

<div class="container"><hr class="line"></div>

<section class="mb-section">
    <div class="container">
        <!-- START row -->
        <div class="row">
            <div class="col-md-6">
                <div class="heding-all">
                    <div class="title SukhumvitSetBold">ผลิตภัณฑ์การเงิน / Money Product</div>
                </div>
                <div class="row">
                    <?php
                    foreach ($moneyProduct as $key => $value) {
                        ?>
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a></a>
                                </div>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>
            </div>
            <div class="col-md-6">
                <div class="heding-all">
                    <div class="title SukhumvitSetBold">เทคนิคการออม การลงทุน / Money Tips</div>
                </div>
                <div class="row">
                    <?php
                    foreach ($moneyTipsIndex as $key => $value) {
                        ?>
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a></a>
                                </div>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>
            </div>
        </div>
        <!-- END row -->
        <!-- START row -->
        <div class="row">
            <div class="col-md-6">
                <div class="heding-all">
                    <div class="title SukhumvitSetBold">วางแผนการเงิน การออม เกษียณ / FINANCIAL PLAN</div>
                </div>
                <div class="row">
                    <?php
                    foreach ($moneySaveTipsIndex as $key => $value) {
                        ?>
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a>
                                </div>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
//                            $i++;
//                            }
//                        }
                    }
                    ?>
                </div>
                <div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>
            </div>
            <div class="col-md-6">
                <div class="heding-all">
                    <div class="title SukhumvitSetBold">ประกันชีวิต ประกันภัย ประกันสุขภาพ / Insurance</div>
                </div>
                <div class="row">
                    <?php
                    foreach ($insuranceIndex as $key => $value) {
                        ?>
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a></a>
                                </div>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>
            </div>
        </div>
        <!-- END row -->
        <!-- START row -->
        <div class="row">
            <div class="col-md-6">
                <div class="heding-all">
                    <div class="title SukhumvitSetBold">บทวิเคราะห์ / RESEARCH</div>
                </div>
                <?php 
                $col_sm = 6;
                $col_md = 12;
                    if($reasearch_special_Index && $customer){
                        $col_sm = 12;
                        $col_md = 6;
                        $logo_c='';
                        $title_c='';
//                        if($customer){
                            foreach ($customer as $key => $value) {
                                $logo_c = $value->customer_pic;
                                $title_c = $value->customer_title;
                            }
//                        }
                ?>
                <div class="col-md-6">
                <div class="row">
                    <?php
                    foreach ($reasearch_special_Index as $key => $value) {
                        ?>
                        <div class="col-sm-12">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>"><?= Yii::$app->MData->showImage($logo_c, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a></a>
                                </div>
                                <div class="time-post" style="height:34px;"> <br></div>
                                <!--<div class="time-post mb-icon icon-clock-calendar"><?//= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>-->
                                <div class="title-name">
                                    <a href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>"><?= Yii::$app->MData->removeImgTag($title_c, 60) ?></a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <!--<div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>-->
                </div>
                <?php } ?>
                
                <div class="col-md-<?=$col_md?>">
                <div class="row">
                    <?php
                    foreach ($reasearchIndex as $key => $value) {
                        ?>
                        <div class="col-sm-<?=$col_sm?>">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a></a>
                                </div>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="heding-all">
                    <div class="title SukhumvitSetBold">เทคโนโลยีการเงิน / FinTech</div>
                </div>
                <div class="row">
                    <?php
                    foreach ($fintechIndex as $key => $value) {
                        ?>
                        <div class="col-sm-6">
                            <div class="thumbnail thumbnail-news thumb-small">
                                <div class="pic">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'min-height: 180px; max-height:300px; width:auto;']) ?></a></a>
                                </div>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="link-all text-right"><a class="link-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a></div>
            </div>
        </div>
        <!-- END row -->
    </div>
</section>

<div class="container"><hr class="line"></div>

<div id="mb-banner-6" class="show">
    <div class="banner-size">
        <?php
        $i = 0;
        foreach ($bannerImgSuff as $key => $value) {
            if ($value->level == 6 && $i == 0) {
                $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                if(!$checkFile){
                    continue;
                }
                if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                    if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture">  
                        <a id="bannerhover6" href="<?= $file_hover ?>" data-fancybox="images6"></a>
                        <a id="banner6" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                    <?php
                } else {
                    ?>
                    <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                    <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                    </a>
                    <?php
                }
                $i++;
            }
        }
        ?>
    </div>
</div>

<section class="mb-section bgc-024da1">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="heading-youchannel SukhumvitSetBold">Money&Banking Live</div>
                <div class="line-3-red" style="margin-bottom: 0px;"></div>
                <div class="panel-youchannel">
                    <?php
                    $i = 0;
                    foreach ($youtube as $key => $value) {
                        if($value->link_type == 'youtube'){
                            $new_link = str_replace("watch?v=", "embed/", $value->youtube_link);
                            $show = '<iframe class="embed-responsive-item" src="'.$new_link.'" allowfullscreen></iframe>';
                        } else if($value->link_type == 'facebook'){
                            $show = $value->youtube_link;
                        }
                        if ($i == 0) {
                            ?>
                            <div class="embed-responsive embed-responsive-16by9">
                            <?php 
                                echo $show;
                            ?>
                            </div>
                            <div class="caption">
                                <div class="desc">
                                    <i class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->create_date) ?></i><br>
                                    <p style="font-size: 18px;"><strong><?= strip_tags(iconv_substr($value->youtube_name, 0, 100, 'utf-8')) . '..' ?></strong></p>
                                </div>
                            </div>
                            <div class="space20"></div>
                            <div class="row">
                                <?php
                                $i++;
                            } else if ($i < 3) {
                                ?>
                                <div class="col-xs-6">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <?php 
                                            echo $show;
                                        ?>
                                    </div>
                                    <div class="caption">
                                        <div class="desc">
                                            <i class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->create_date) ?></i><br>
                                             <p style="font-size: 18px;"><strong><?= strip_tags(iconv_substr($value->youtube_name, 0, 100, 'utf-8')) . '..' ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="link-all link-color-white text-right"><a href="<?= Url::to(['/site/televition', 'id' => $value->id]) ?>">ดูทั้งหมด</a></div>
            </div>
            <div class="col-md-5">
                <?php
                $i = 0;
                foreach ($bannerImgSuff as $key => $value) {
                    if ($value->level == 7 && ($i < 2)) {
                        $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                        if(!$checkFile){
                            continue;
                        }
                        if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                            if($i == 0){
                                $style = 'padding-top: 60px;padding-bottom: 15px;';
                            } else {
                                $style = 'padding-top: 15px;padding-bottom: 10px;';
                            }
                            if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                            }else{
                                $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                            }
                            ?>
                            <a id="bannerhover7<?=$i?>" href="<?= $file_hover ?>" data-fancybox="images7<?=$i?>"></a>
                            <div id="mb-banner-300x250" class="show">
                                <div class="banner-size" style="<?= $style ?>">
                                    <div class="picture" style="max-width: 300px;margin-right: auto;margin-left: auto;">
                                        <a id="banner7<?=$i?>" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                                    <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                                </a>
                                    </div>
                                </div>
                            </div>

                            <?php
                        } else {
                            ?>
                            <div id="mb-banner-300x250" class="show">
                                <div class="banner-size" style="padding-top: 60px;padding-bottom: 15px;">
                                    <div class="picture" style="max-width: 300px;margin-right: auto;margin-left: auto;">
                                        <a id="banner7<?=$i?>" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        $i++;
                    }
                }
                ?>                    
            </div>
        </div>
    </div>
</section>

<div id="mb-banner-8" class="show">
    <div class="banner-size">
        <?php
        $i = 0;
        foreach ($bannerImgSuff as $key => $value) {
            if ($value->level == 8 && $i == 0) {
                $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                if(!$checkFile){
                    continue;
                }
                if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                    if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture">  
                        <a id="bannerhover8" href="<?= $file_hover ?>" data-fancybox="images8"></a>
                        <a id="banner8" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                                <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                    <?php
                } else {
                    ?>
                    <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                    <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                    </a>
                    <?php
                }
                $i++;
            }
        }
        ?>
    </div>
</div>

<div class="container"><hr class="line"></div>

<section class="mb-section">
    <div class="container">
        <div class="heding-all">
            <div class="title SukhumvitSetBold">ข่าวประชาสัมพันธ์</div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <?php
                $i = 0;
                foreach ($newsPrIndex as $key => $value) {
                    if ($i == 0) {
                        ?>
                        <div class="thumbnail thumbnail-news thumb-large">
                            <div class="pic">
                                <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                            </div>
                            <div class="line-3-lightblue"></div>
                            <div class="caption">
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                </div>
                                <div class="desc">
                                    <?= strip_tags(iconv_substr($value->post_content, 0, 450, 'utf-8')) . '..' ?>
                                </div>
                                <div class="link"><a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>">อ่านต่อ</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">

                        <?php
                        $i++;
                    } else {
                        ?>
                        <div class="thumbnail thumbnail-news thumb-small sm-v">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                    <div class="title-name">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 140) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="text-center more">
                    <a class="btn btn-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container"><hr class="line"></div>

<div id="mb-banner-9" class="show">
    <div class="banner-size">
        <?php
        $i = 0;
        foreach ($bannerImgSuff as $key => $value) {
            if ($value->level == 9 && $i == 0) {
                $checkFile = Yii::$app->MData->checkHaveFile($value->banner_pic_file);
                if(!$checkFile){
                    continue;
                }
                if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                    if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
                    <div class="picture">  
                        <a id="bannerhover9" href="<?= $file_hover ?>" data-fancybox="images9"></a>
                        <a id="banner9" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                                <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                        </a>
                    </div>

                    <?php
                } else {
                    ?>
                    <a id="banner1" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                    <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class' => 'img-responsive center-block', 'style' => 'max-height: 250px;']) ?>
                    </a>
                    <?php
                }
                $i++;
            }
        }
        ?>
    </div>
</div>

<div class="container"><hr class="line"></div>

<section class="mb-section">
    <div class="container">
        <div class="heding-all">
            <div class="title SukhumvitSetBold">Who’s who in Business&Finance</div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                $i = 0;
                foreach ($whoNewsIndex as $key => $value) {
                    if ($i < 4) {
                        ?>
                        <div class="thumbnail thumbnail-news thumb-small sm-v">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                    <div class="title-name">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($i == 3) {
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                        }
                        $i++;
                    } else {
                        ?>
                        <div class="thumbnail thumbnail-news thumb-small sm-v">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                    <div class="title-name">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 60) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($i == 7) {
                        ?>
                            <div class="text-center more">
                                <a class="btn btn-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a>
                            </div>
                <?php
                        }
                    $i++; 
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>

<!-- /////////////////////Events///////////////////// -->
<section class="mb-section">
    <div class="container">
        <div class="heding-all">
            <div class="title SukhumvitSetBold">Events</div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <?php
                $i = 0;
                foreach ($eventNewsIndex as $key => $value) {
                    if ($i == 0) {
                        ?>
                        <div class="thumbnail thumbnail-news thumb-large">
                            <div class="pic">
                                <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                            </div>
                            <div class="line-3-lightblue"></div>
                            <div class="caption">
                                <div class="title-name">
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 100) ?></a>
                                </div>
                                <div class="desc">
                                    <?= Yii::$app->MData->removeImgTag($value->post_content, 200) ?>
                                </div>
                                <div class="link"><a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>">อ่านต่อ</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <?php
                        $i++;
                    } else {
                        ?>
                        <div class="thumbnail thumbnail-news thumb-small sm-v">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic, ['style' => 'max-height: 300px; width:auto;']) ?></a>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                    <div class="post_date-name">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->removeImgTag($value->post_title, 150) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- /thumbnail -->
                <div class="text-center more">
                    <a class="btn btn-more" href="<?= Url::to(['/news/index', 'id' => $value->term_taxonomy_id]) ?>">ดูทั้งหมด</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /////////////////////Partner///////////////////// -->
<section class="mb-section bgc-024da1">
    <div class="container">
        <div class="heading-partner SukhumvitSetBold"><span>Partner</span></div>
        <ul class="list-partner">
            <?php
            foreach ($partner as $key => $value) {
                ?>
                <li><a target='_blank' href="<?= $value->partner_link != '' ? Yii::$app->MData->getLink($value->partner_link) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->partner_pic, ['class' => '', 'style' => 'height: 110px; width:160px;']) ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</section>

<!-- /////////////////////Connect with us on Facebook===Youtube Channel///////////////////// -->
<section class="mb-section bgc-ffffff">
    <div class="container">
        <div class="row">
            <div class="col-md-6 line-dash-h">
                <div class="box-fb">
                    <div class="heading-fb SukhumvitSetBold">Connect with us on Facebook</div>
                    <div class="line-3-blue-fb"></div>
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmoneyandbanking%2F&tabs=timeline&width=340&height=210&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1267000180023494" width="340" height="210" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </div>
            </div>
            <div class="col-md-6 line-dash-v">
                <div class="box-youtube">
                    <div class="heading-youtube SukhumvitSetBold">Youtube Channel</div>
                    <div class="line-3-red"></div>
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <div class="g-ytsubscribe" data-channelid="UCCP3UThwaz7TxIXWKvGSeaA" data-layout="full" data-count="default"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<script>-->
<?php
$this->registerJs(
        "
        $(document).ready(function () {
        var delay = 3000, setTimeoutConst;
        
        $('#banner1').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover1\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });

        $('#banner2').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover2\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });

        $('#bannermob2').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhovermob2\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner3').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover3\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner4').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover4\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner5').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover5\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner6').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover6\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner70').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover70\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner71').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover71\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner8').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover8\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });
        
        $('#banner9').hover(function () {
            setTimeoutConst = setTimeout(function () {
                document.getElementById(\"bannerhover9\").click();
            }, delay);
        }, function () {
            clearTimeout(setTimeoutConst);
        });

    });"
);
?>
<!--</script>-->