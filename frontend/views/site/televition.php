<?php 

use yii\widgets\LinkPager;
use yii\helpers\Url;
$page="televition"; 
?>
<?php include(__dir__ . "/../../themes/mnb/views/layouts/inc-header.php"); ?>
    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
                <li class="active">Money&Banking TELEVISION</li>
            </ol>
        </div>
    </div>

    <section class="mb-section bgc-024da1">
        <div class="container">
          <div style="max-width: 800px;margin-right: auto;margin-left: auto;">
            <div class="heading-youchannel SukhumvitSetBold">Money&Banking Live</div>
            <div class="line-3-red"></div>
            <div class="text-date">วีดีโอล่าสุด</div>
            <?php
              $i = 0;
                  foreach ($youtube as $key => $value) {
                      if($value->link_type == 'youtube'){
                          $new_link = str_replace("watch?v=", "embed/", $value->youtube_link);
                          $show = '<iframe class="embed-responsive-item" src="'.$new_link.'" allowfullscreen></iframe>';
                      } else if($value->link_type == 'facebook'){
                          $show = $value->youtube_link;
                      }
                      if($i == 0) {
                        ?>
            <div class="panel-youchannel">
              <div class="embed-responsive embed-responsive-16by9">
                <?= $show ?>
              </div>
              <i class="time-post mb-icon icon-clock-calendar"><?= Yii::$app->MData->changeFormatDate($value->create_date) ?></i><br>
              <p style="font-size: 18px;"><strong><?= strip_tags(iconv_substr($value->youtube_name, 0, 100, 'utf-8')) . '..' ?></strong></p>
            </div>
            </div>
          <div class="space20"></div>
          <div class="heading-youchannel SukhumvitSetBold" style="text-align: left;">รายการวีดีโอ</div>
          <div class="row">
                        <?php
                        $i++;
                      } else if($i > 0){
                        ?>
            <div class="col-xs-4">
              <div class="embed-responsive embed-responsive-16by9">
                <?= $show ?>
              </div>
              <i class="time-post mb-icon icon-clock-calendar" style="color: white;"><?= Yii::$app->MData->changeFormatDate($value->create_date) ?></i><br>
              <p style="font-size: 18px; color: white;"><strong><?= strip_tags(iconv_substr($value->youtube_name, 0, 100, 'utf-8')) . '..' ?></strong></p>
              <div class="space20"></div>
            </div>
                        <?php
                      }
                  }
            ?>
          </div>
        </div>
    </section>
    <div class="container">
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