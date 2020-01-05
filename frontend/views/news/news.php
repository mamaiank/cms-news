<?php $page=$page; 
use yii\widgets\LinkPager;
use yii\helpers\Url;
use common\models\BannerRelationships;
?>
<?php $this->title = 'Money&Banking'; ?>
<?php include(__dir__."/../../themes/mnb/views/layouts/inc-header.php"); ?>
    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
                <li class="active"><?= $name ?></li>
            </ol>
        </div>
    </div>

    <div id="mb-banner-news" class="show">
        <div class="banner-size">
        <?php
        $i = 0;
        foreach ($ads as $key => $value) {
            if (($value->level != 7 && $value->level != 2) && ($i == 0)) {
                $checkBannerTerm = BannerRelationships::find()->select('term_taxonomy_id')->where(['banner_id'=>$value->id,'term_type'=>'index'])->all();
                foreach ($checkBannerTerm as $key => $databanner) {
                    if(($databanner->term_taxonomy_id == $_GET['id']) && ($i == 0)){
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
            <div class="row">
                <div class="col-sm-8">
                    <div class="heding-all" style="margin-bottom: 5px;">
                        <div class="title SukhumvitSetBold"><?= $name ?></div>
                    </div>
                    <div class="number-of-pages"><small>พบข่าวทั้งหมดจำนวน <?= $countQuery->count() ?> รายการ</small></div>
                    <?php 
                        foreach ($news as $key => $value) {
                            // var_dump($value);exit();
                            ?>
                    <div class="thumbnail thumbnail-newsall">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pic"><a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= Yii::$app->MData->showImage($value->post_pic,['style'=>'height: 250px;']) ?></a></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="caption">
                                    <div class="time-post mb-icon icon-clock"><?= Yii::$app->MData->changeFormatDate($value->post_date) ?></div>
                                    <h1 class="title-name">
                                        <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>"><?= $value->post_title ?></a>
                                    </h1>
                                    <div class="desc">
                                    <?= strip_tags(iconv_substr($value->post_content,0,450,'utf-8')).'..' ?>
                                    <a href="<?= Yii::$app->MData->getLinkNews($value->ID,$value->term_taxonomy_id,$value->post_title) ?>" class="navbar-link">[อ่านต่อ]</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <?php
                        }
                    ?>
                    <nav aria-label="Page navigation" class="text-center">
                  <?php 
                      if($pages->totalCount > 10) {
                        echo LinkPager::widget([
                        'pagination' => $pages,
                  ]);
                      } else {
                        ?>
                        <ul class="pagination">
                            <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                          </ul>
                  <?php
                      }
                  ?>
                    </nav>
                </div>
                <div class="col-sm-4">
                    <?php 
                    if($page == 'newsupdate'){
                    include(__dir__."/../../themes/mnb/views/layouts/inc-navmenu-news.php"); 
                    }
                    ?>
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
                                if(($databanner->term_taxonomy_id == $_GET['id']) && ($i < 2)){
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