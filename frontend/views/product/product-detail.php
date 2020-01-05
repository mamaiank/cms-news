<?php 

use yii\helpers\Url;

$page="newsupdate";
// var_dump($category); 

?>
<?php include(__dir__."/../../themes/mnb/views/layouts/inc-header.php"); ?>
    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
                <li><a href="<?= Url::to(['/magazine/index','id'=> $category->id ]) ?>"><?= $category->cate_news_name ?></a></li>
                <li class="active"><?= $model->post_title ?></li>
            </ol>
        </div>
    </div>

    <div id="mb-banner-news" class="show">
        <div class="banner-size">
            <div class="picture">
                <a href=""><img class="img-responsive center-block" src="<?= Yii::$app->request->baseUrl ?>/../themes/mnb/uploads/banner/Yamaha_Grand-Filano_950x120_GIF.gif" /></a>
            </div>
        </div>
    </div>

    <div class="container"><hr class="line"></div>

    <section class="mb-section">
        <div class="container">
            <div class="heding-all" style="margin-bottom: 5px;">
                <div class="title SukhumvitSetBold"><?= $category->cate_news_name ?></div>
            </div>
            <div class="title-page"><?= $model->post_title ?></div>
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
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">แชร์</a></div>
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
                    </div>
                    <div class="back">
                        <button onclick="goBack()" class="btn btn-default btn-lg">
                            <i class="fa fa-angle-left" aria-hidden="true"></i> ย้อนกลับ
                        </button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div id="mb-banner-300x250" class="show">
                        <div class="banner-size">
                            <div class="picture">
                                <a href=""><img class="img-responsive center-block" src="<?= Yii::$app->request->baseUrl ?>/../themes/mnb/uploads/banner/Banner300x250.jpg" /></a>
                            </div>
                        </div>
                    </div>
                    <div id="mb-banner-300x250" class="show">
                        <div class="banner-size">
                            <div class="picture">
                                <a href=""><img class="img-responsive center-block" src="<?= Yii::$app->request->baseUrl ?>/../themes/mnb/uploads/banner/Banner300x250.jpg" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>