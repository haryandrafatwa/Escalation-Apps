<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;

$this->title = 'Escalation App | Verifikasi';
?>
<div class="site-login">
  <div class="container-fluid" id="desktop-version" style="height: auto;width: auto;margin-left:5%;margin-right:5%">
    <div class="row">
      <div class="col-6">
        <div class="row">
          <div class="col-12 mt-5">
            <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:calc(50% + 0.5vw);','class'=>'']) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12" style="margin-top:10%">
            <span class="great-text">Bagus! <?php echo $model->name; ?>,</span>
          </div>
        </div>
        <div class="row" style="margin-top:-2%">
          <div class="col-8">
            <span class="great-text">semua sudah siap.</span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <span class="desc-text"><?= Yii::$app->session->getFlash('success'); ?></span>
          </div>
        </div>
        <div class="row mt-5" style="width:100%">
          <div class="col-6">
            <div class="row">
              <div class="col-3 d-flex align-items-center" style="padding:0px">
                <?= Html::img(Url::to('@web/images/user.svg'), ['alt' => 'My logo','style'=>'width:calc(50% + 0.5vw);','class'=>'mx-auto']) ?>
              </div>
              <div class="col-9">
                <div class="row">
                  <span class="sub-title">Nama Lengkap</span>
                </div>
                <div class="row">
                  <span class="desc-title"><?php echo $model->name; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="row">
              <div class="col-3 d-flex align-items-center" style="padding:0px">
                <?= Html::img(Url::to('@web/images/email.svg'), ['alt' => 'My logo','style'=>'width: calc(50% + 0.5vw);','class'=>'mx-auto']) ?>
              </div>
              <div class="col-9">
                <div class="row">
                  <span class="sub-title">Alamat Email</span>
                </div>
                <div class="row">
                  <span class="desc-title"><?php echo $model->email; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 mt-3">
            <div class="row">
              <div class="col-3 d-flex align-items-center" style="padding:0px">
                <?= Html::img(Url::to('@web/images/clock.svg'), ['alt' => 'My logo','style'=>'width:calc(50% + 0.5vw);','class'=>'mx-auto']) ?>
              </div>
              <div class="col-9">
                <div class="row">
                  <span class="sub-title">Tanggal dan Waktu</span>
                </div>
                <div class="row">
                  <span class="desc-title"><?php setlocale(LC_ALL, 'IND'); date_default_timezone_set("Asia/Jakarta"); $am = date("a"); echo strftime( "%d %b %Y, %H:%M", time())." ".strtoupper($am);?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-6">
            <a href="https://mail.google.com/mail" class="btn btn-primary">Cek Sekarang</a>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="row" style="min-height:100vh;">
            <?= Html::img(Url::to('@web/images/sent_mail.svg'), ['alt' => 'My logo','style'=>'width:40%;','class'=>'mx-auto']) ?>
        </div>
      </div>
    </div>
  </div>
  <div class="container" id="mobile-version" style="height: auto;width:auto;margin-right:10%;margin-left:10%">
    <div class="row">
      <div class="col-12">
        <div class="row mx-auto">
          <div class="col-12 mt-4 d-flex justify-content-center">
            <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:40%;','class'=>'']) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12" style="margin-top:10%">
            <span class="great-text">Bagus! <?php echo $model->name; ?>,</span>
          </div>
        </div>
        <div class="row" style="margin-top:-2%">
          <div class="col-8">
            <span class="great-text">semua sudah siap.</span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <span class="desc-text"><?= Yii::$app->session->getFlash('success'); ?></span>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12">
            <div class="row">
              <div class="col-3 d-flex align-items-center">
                <?= Html::img(Url::to('@web/images/user.svg'), ['alt' => 'My logo','style'=>'width:calc(50% + 0.5vw);','class'=>'mx-auto']) ?>
              </div>
              <div class="col-9">
                <div class="row">
                  <span class="sub-title">Nama Lengkap</span>
                </div>
                <div class="row">
                  <span class="desc-title"><?php echo $model->name; ?></span>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-3 d-flex align-items-center">
                <?= Html::img(Url::to('@web/images/email.svg'), ['alt' => 'My logo','style'=>'width:calc(50% + 0.5vw);','class'=>'mx-auto']) ?>
              </div>
              <div class="col-9">
                <div class="row">
                  <span class="sub-title">Alamat Email</span>
                </div>
                <div class="row">
                  <span class="desc-title"><?php echo $model->email; ?></span>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-3 d-flex align-items-center">
                <?= Html::img(Url::to('@web/images/clock.svg'), ['alt' => 'My logo','style'=>'width:calc(50% + 0.5vw);','class'=>'mx-auto']) ?>
              </div>
              <div class="col-9">
                <div class="row">
                  <span class="sub-title">Tanggal dan Waktu</span>
                </div>
                <div class="row">
                  <span class="desc-title"><?php setlocale(LC_ALL, 'IND'); date_default_timezone_set("Asia/Jakarta"); $am = date("a"); echo strftime( "%d %b %Y, %H:%M", time())." ".strtoupper($am);?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12 mb-5">
            <a href="https://mail.google.com/mail" class="btn btn-primary">Cek Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
