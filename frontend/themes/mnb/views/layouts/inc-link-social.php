<?php 
use common\models\Social;

	$social_facebook = Social::find()->where(['name' => 'facebook'])->one();
	$social_youtube = Social::find()->where(['name' => 'youtube'])->one();
	$social_twitter = Social::find()->where(['name' => 'twitter'])->one();
	$social_instagram = Social::find()->where(['name' => 'instagram'])->one();
?>
<a href="<?= $social_facebook->link != '' ? $social_facebook->link : 'javascript:void(0)' ?>" class="mb-icon-sc icon-facebook"><img src="<?= Yii::$app->request->baseUrl ?>/frontend/web/img/icon/fb.png" alt="facebook"></a>
<a href="<?= $social_youtube->link != '' ? $social_youtube->link : 'javascript:void(0)' ?>" class="mb-icon-sc icon-youtube"><img src="<?= Yii::$app->request->baseUrl ?>/frontend/web/img/icon/youtube.png" alt="youtube"></a>
<a href="<?= $social_twitter->link != '' ? $social_twitter->link : 'javascript:void(0)' ?>" class="mb-icon-sc icon-twitter"><img src="<?= Yii::$app->request->baseUrl ?>/frontend/web/img/icon/twitter.png" alt="twitter"></a>
<a href="<?= $social_instagram->link != '' ? $social_instagram->link : 'javascript:void(0)' ?>" class="mb-icon-sc icon-instagram"><img src="<?= Yii::$app->request->baseUrl ?>/frontend/web/img/icon/instagram.png" alt="instagram"></a>
