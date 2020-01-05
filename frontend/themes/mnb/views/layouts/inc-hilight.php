<?php 
use yii\helpers\Url;

if ($bannerImg != null) { 
?>
	<div id="carousel-mb-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	  	<?php
        	$i = 0;
            foreach ($bannerImg as $key => $value) {
                if(($value->level == 2)){
                $active = ($i == 0) ? 'active' : '';
    	?>
            <li data-target="#carousel-mb-generic" data-slide-to="<?= $i ?>" class="<?= $active ?>"></li>
    	<?php
    				$i++;
                }
			}
      	?>
	  </ol>
	  	<!-- Wrapper for slides -->
	  	<div class="carousel-inner" role="listbox">
        <?php
        	$i = 0;
            foreach ($bannerImg as $key => $value) {
                if(($value->level == 2)){
                	if ($value->hover_status == '1' && $value->banner_pic_hover != '') {
                    if($value->banner_type == 'video'){
                        $file_hover = Yii::$app->MData->getFile($value->banner_pic_hover);
                    }else{
                        $file_hover = Yii::$app->request->baseUrl.'/upload/slim/'.$value->banner_pic_hover;
                    }
                    ?>
			<div class="item <?= $active ?>">
		      	<div class="item-pc hidden-xs">
		      		<a id="bannerhover2" href="<?= $file_hover ?>" data-fancybox="images1"></a>
                        <a id="banner2" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>">
                            <?= Yii::$app->MData->showImage($value->banner_pic_file, ['class'=>'img-responsive center-block', 'style' => 'height: 220px; width:auto;']) ?>
                        </a>
		      	</div>
		      	<div class="item-mobile visible-xs">
		      		<a id="bannerhovermob2" href="<?= $file_hover ?>" data-fancybox="images1"></a>
		      		<a id="bannermob2" target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block', 'style' => 'height: 180px; width:auto;']) ?></a>
		      	</div>
		    </div>
                    <?php
                } else {
                	?>
        	<div class="item <?= $active ?>">
		      	<div class="item-pc hidden-xs">
		      		<a target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block', 'style' => 'height: 420px; width:auto;']) ?></a>
		      	</div>
		      	<div class="item-mobile visible-xs">
		      		<a target='_blank' href="<?= $value->banner_link != '' ? Url::to(['/site/banner', 'id' => $value->id]) : 'javascript:void(0)' ?>"><?= Yii::$app->MData->showImage($value->banner_pic_file,['class'=>'img-responsive center-block', 'style' => 'height: 180px; width:auto;']) ?></a>
		      	</div>
		    </div>
                	<?php
                }
                $active = ($i == 0) ? 'active' : '';
    	?>
            
    	<?php
    				$i++;
                }
			}
      	?>
	  	</div>
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-mb-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-mb-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
<?php } ?>