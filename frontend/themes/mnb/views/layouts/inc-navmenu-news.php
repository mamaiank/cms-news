<?php 
	use yii\helpers\Url;
?>
                  <div class="list-group list-group-menu SukhumvitSetBold">
                        <a href="#" class="list-group-item active">News Update</a>
                        <a href="<?= Url::to(['/news/index','id'=> 8]) ?>" class="list-group-item"><i class="fa fa-angle-right"></i> เศรษฐกิจ</a>
                        <a href="<?= Url::to(['/news/index','id'=> 22]) ?>" class="list-group-item"><i class="fa fa-angle-right"></i> ตลาดเงิน-ตลาดทุน</a>
                        <a href="<?= Url::to(['/news/index','id'=> 23]) ?>" class="list-group-item"><i class="fa fa-angle-right"></i> ประกัน</a>
                        <a href="<?= Url::to(['/news/index','id'=> 27]) ?>" class="list-group-item"><i class="fa fa-angle-right"></i> เทคโนโลยี</a>
                        <a href="<?= Url::to(['/news/index','id'=> 25]) ?>" class="list-group-item"><i class="fa fa-angle-right"></i> ธนาคาร/องค์กรธุรกิจ</a>
                  </div>