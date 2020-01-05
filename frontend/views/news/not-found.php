<?php $page='';
use yii\widgets\LinkPager;
use yii\helpers\Url;
use common\models\Postmeta;
use common\models\Posts;
use common\models\Terms;
?>
<?php $this->title = 'Money&Banking'; ?>
<?php include(__dir__."/../../themes/mnb/views/layouts/inc-header.php"); ?>
    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
            </ol>
        </div>
    </div>

    <div id="mb-banner-news" class="show">
        <div class="banner-size">
                <?php 
            $i = 0;
            foreach ($ads as $key => $value) {
                if(($value->level != 7 && $value->level != 2) && ($i == 0)){
                    ?>
            <div class="picture">
                <a href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block','style'=>'height: 120px; width:950px;']) ?></a>
            </div>
                    <?php
                    $i++;
                }
            }
        ?>
        </div>
    </div>

    <div class="container"><hr class="line"></div>

    <section class="mb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="heding-all" style="margin-bottom: 5px;">
                        <div class="title SukhumvitSetBold"></div>
                    </div>
                    <div class="col-md-12">
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong><?= Yii::t('app', 'Alert');?></strong> <?= isset($alert) ? $alert : 'ไม่พบข่าว...';?>
                        <a href="<?= Url::to(['/site/index'])?>"> กลับหน้าแรก </a>
                    </div></div>
                </div>
                <div class="col-sm-4">
<!--                 <?php
                    $i = 0;
                    foreach ($youtube as $key => $value) {
                        if($value->link_type == 'youtube'){
                            $new_link = str_replace("watch?v=", "embed/", $value->youtube_link);
                            $show = '<iframe class="embed-responsive-item" src="'.$new_link.'" allowfullscreen></iframe>';
                        } else if($value->link_type == 'facebook'){
                            $show = $value->youtube_link;
                        }
                        if ($i < 2) {
                            ?>
                            <div id="mb-banner-300x250" class="show">
                                <div class="banner-size">
                                    <div class="embed-responsive embed-responsive-16by9">
                            <?php 
                                echo $show;
                            ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                ?> -->
                    <div id="mb-banner-300x250" class="show">
                        <div class="banner-size">
                        <?php 
                            $i = 0;
                            foreach ($ads as $key => $value) {
                                if(($value->level == 7) && ($i == 0)){
                                    ?>
                            <div class="picture">
                                <a href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block','style'=>'height: 250px; width:300px;']) ?></a>
                            </div>
                                    <?php
                                    $i++;
                                }
                            }
                        ?>
                        </div>
                    </div>
                    
                <?php include(__dir__."/../../themes/mnb/views/layouts/inc-search-category.php"); ?>
                </div>
            </div>
        </div>
    </section>