<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
    $page="register"; 
?>
<?php include(__dir__."/../../themes/mnb/views/layouts/inc-header.php"); ?>
    <div class="pagenavi">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?= Url::to(['/site/index']) ?>">หน้าแรก</a></li>
                <li class="active">สมัครสมาชิก</li>
            </ol>
        </div>
    </div>

    <section class="mb-section">
        <div class="container">
            <div class="heding-all" style="margin-bottom: 5px;">
                <div class="title SukhumvitSetBold">สมัครสมาชิก</div>
            </div>
            <div class="site-signup">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>ป้อนข้อมูลด้านล่างให้ถูกต้อง :</p>

                <div class="row">
                    <div class="col-lg-5">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            
                            <?= $form->field($model, 'firstname')->textInput() ?>

                            <?= $form->field($model, 'lastname')->textInput() ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <div class="form-group">
                                <?= Html::submitButton('สมัครสมาชิก', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>