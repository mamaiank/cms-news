<?php 

use yii\helpers\Url;
use common\models\Terms;
use common\models\VwPosts;
use common\models\VwTag;
use common\components\MData;

$page=$page;
// var_dump($category); 

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<?php $this->title = $model->post_title; ?>
<?php include(__dir__."/../../themes/mnb/views/layouts/inc-header.php"); ?>
    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
                <li><a href="<?= Url::to(['/magazine/index','id'=>$_GET['category']]) ?>"><?= $name ?></a></li>
                <li class="active"><?= $model->post_title ?></li>
            </ol>
        </div>
    </div>

    <div id="mb-banner-news" class="show">
        <div class="banner-size">
        <?php
        $i = 0;
        foreach ($ads as $key => $value) {
            if (($value->level != 7 && $value->level != 2)  && ($i == 0)) {
                $checkBannerTerm = BannerRelationships::find()->select('term_taxonomy_id')->where(['banner_id'=>$value->id,'term_type'=>'detail'])->all();
                foreach ($checkBannerTerm as $key => $databanner) {
                    if(in_array($databanner->term_taxonomy_id, $checkTerm) && ($i == 0)){
                ?>
                <div class="picture">
                    <a target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block','style'=>'max-height: 250px;']) ?></a>
                </div>
                <?php
                    $i++;
                    }
                }
            }
        }
        ?>
        </div>
    </div>

    <div class="container"><hr class="line"></div>

    <section class="mb-section">
        <div class="container">
            <div class="heding-all" style="margin-bottom: 5px;">
                <div class="title SukhumvitSetBold"><?= $name ?></div>
            </div>
            <div class="title-page"><?= $model->post_title ?></div>
            <!--show category-->
            <p class="meta post-meta">Posted on <span class="updated"><?= Yii::$app->MData->changeFormatDate($model->post_date) ?></span>  
            in 
            <?php
            $loop_cat = VwPosts::find()->select(['term_taxonomy_id','name'])->where(['ID'=>$model->ID])->all();
            foreach($loop_cat as $loop => $val){
                if($loop>0){
                    echo " , ";
                }
            ?>
            <a href="<?=Url::to(["/news/index?id="]).$val->term_taxonomy_id;?>"><?= $val->name ?></a>
            <?php
            }
            ?>
            </p>
            <!-- end show category -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="share-social clearfix">
                        <div class="share-item">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="https://www.facebook.com/moneyandbanking/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
                        </div>
                        <div class="share-item">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="<?= $actual_link ?>" data-layout="button" data-size="small" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">แชร์</a></div>
                        </div>
                        <div class="share-item">
                            <a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a>
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>
                        </div>
                    </div>
                    <div class="detail-news clearfix">
                        <p><?= $model->post_content ?></p>
                        <!-- Show tag -->
                        <p class="meta post-meta">Tag : 
                            <?php
                            $loop_tag = VwTag::find()->select(['id_tag', 'name_tag'])->where(['ID' => $model->ID])->all();
                            foreach ($loop_tag as $loop => $val) {
                                if ($loop > 0) {
                                    echo " , ";
                                }
                                ?>
                                <a href="<?= Url::to(["/news/index?id=&tag="]) . $val->id_tag; ?>"><?= $val->name_tag ?></a>
                            <?php
                            }
                            ?>
                        </p>
                        <!-- End Show tag -->
                    </div>
                    <div class="back">
                        <button onclick="goBack()" class="btn btn-default btn-lg">
                            <i class="fa fa-angle-left" aria-hidden="true"></i> ย้อนกลับ
                        </button>
                    </div>
                    <hr class="line">
                    <?php if($model->contributor == 'active'){ ?>
                    <div class="heding-all">
                        <div class="title SukhumvitSetBold">Contributor</div>
                    </div>
                    <div class="thumbnail thumbnail-contributor">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="pic"><?= Yii::$app->MData->showImage($model->contributor_pic) ?></div>
                            </div>
                            <div class="col-sm-9">
                                <div class="caption">
                                    <h4><?= $model->contributor_title ?></h4>
                                    <p><?= $model->contributor_detail ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="line">
                    <?php } ?>
                    <div class="heding-all">
                        <div class="title SukhumvitSetBold">Related News</div>
                    </div>
                    <div class="row">
                        <?php 
                        $i = 0;
                        if($related){
                            foreach ($related as $key => $value) {
                                ?>
                            <div class="col-sm-4">
                                <div class="thumbnail thumbnail-related">
                                    <div class="pic">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic,['class'=>'img-responsive center-block','style'=>'height: 180px; width:auto;']) ?>
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                        <div class="title-name">
                                            <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= strip_tags(iconv_substr($value->post_title, 0, 100, 'utf-8')) . '..' ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
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
                <?php
                $i = 0;
                foreach ($ads as $key => $value) {
                    if (($value->level == 7) && ($i < 2)) {
                        $setContinue = false;
                        foreach ($checkBannerTerm as $key => $databanner) {
                            if ($setContinue) {
                              continue;  // exit if and goto loop again
                            } else {
                                if(in_array($databanner->term_taxonomy_id, $checkTerm) && ($i < 2)){
                                ?>
                                <div id="mb-banner-300x250" class="show">
                                    <div class="banner-size">
                                        <div class="picture">
                                            <a target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block','style'=>'height: 250px; width:300px;']) ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                $setContinue = true;
                                }
                            }
                        }
                    }
                }
                ?>
                <?php include(__dir__."/../../themes/mnb/views/layouts/inc-search-category.php"); ?>
                </div>
            </div>
        </div>
    </section>
    