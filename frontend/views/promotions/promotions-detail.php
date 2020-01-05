<?php

use yii\helpers\Url;
use common\models\VwPosts;
use common\models\VwTag;

$page = $page;
// var_dump($category); 

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $actual_link = "https://www.google.co.th/?gws_rd=cr&ei=ytzHWJKPN4eEvQTeupyAAQ";
// var_dump($actual_link);exit();

?>
<?php include(__dir__ . "/../../themes/mnb/views/layouts/inc-header.php"); ?>
<div class="pagenavi">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
            <li class="active"><?= $model->ads_name ?></li>
        </ol>
    </div>
</div>

<div id="mb-banner-news" class="show">
    <div class="banner-size">
        <?php
        $i = 0;
        foreach ($ads as $key => $value) {
            if (($value->level != 7 && $value->level != 2) && ($i == 0)) {
                ?>
                <div class="picture">
                    <a target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block','style'=>'max-height: 250px;']) ?></a>
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
        <div class="heding-all" style="margin-bottom: 5px;">
            <div class="title SukhumvitSetBold"><?= $name ?></div>
        </div>
        <div class="title-page"><?= $model->ads_name ?></div>
        <!--show category-->
        <p class="meta post-meta">Posted on <span class="updated"><?= Yii::$app->MData->changeFormatDate($model->create_date) ?></span>  
        </p>

        <!-- end show category-->
        <div class="row">
            <div class="col-sm-8">
                <div class="share-social clearfix">
                    <div class="share-item">
                        <div id="fb-root"></div>
                        <script>(function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id))
                                    return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-like" data-href="https://www.facebook.com/moneyandbanking/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
                    </div>
                    <div class="share-item">
                        <div id="fb-root"></div>
                        <script>(function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id))
                                    return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-share-button" data-href="<?= $actual_link ?>" data-layout="button" data-size="small" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">แชร์</a></div>
                    </div>
                    <div class="share-item">
                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a>
                        <script>window.twttr = (function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0],
                                        t = window.twttr || {};
                                if (d.getElementById(id))
                                    return t;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "https://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);

                                t._e = [];
                                t.ready = function (f) {
                                    t._e.push(f);
                                };

                                return t;
                            }(document, "script", "twitter-wjs"));</script>
                    </div>
                </div>
                <div class="detail-news clearfix">
                    <!-- <p class="text-center"><?//= Yii::$app->MData->showImage('news',$model->ID,$model->news_pic) ?></p> -->
                    <p><?= $model->ads_detail ?></p>

                </div>
                <div class="back">
                    <button onclick="goBack()" class="btn btn-default btn-lg">
                        <i class="fa fa-angle-left" aria-hidden="true"></i> ย้อนกลับ
                    </button>
                </div>
                <hr class="line">
                
            </div>
            <div class="col-sm-4">
<!--             <?php
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
                    }
                }
                ?>
                <?php include(__dir__."/../../themes/mnb/views/layouts/inc-search-category.php"); ?>
            </div>
        </div>
    </div>
</section>