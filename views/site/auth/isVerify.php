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
  <div class="container-fluid" id="desktop-version" style="height: 100vh;">
    <div class="row align-items-center h-100">
        <div class="col-8 mx-auto">
            <div class="jumbotron">
              <?php if(Yii::$app->session->hasFlash('success')):?>
                <div class="container">
                  <div class="row">
                    <div class="col-12 text-center">
                      <span style="color:#999">Terima kasih telah melakukan verifikasi</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <i class="far fa-check-circle fa-4x my-4" style="color:#2F94C3"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <span class="title"><?= Yii::$app->session->getFlash('success'); ?></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <span style="color:#999">Akun anda telah berhasil kami verifikasi. Silahkan melanjutkan ke halaman beranda.</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <a href="site/index" class="beranda"><i class="fas fa-chevron-left fa-lgx mt-5 mr-3" style="color:#999"></i>Kembali ke beranda</a>
                    </div>
                  </div>
                </div>
              <?php endif; if(Yii::$app->session->hasFlash('error')):?>
                <div class="container">
                  <div class="row">
                      <div class="col-12 text-center">
                        <span style="color:#999">Token telah kadaluwarsa</span>
                      </div>
                    </div>
                  <div class="row">
                      <div class="col-12 text-center">
                        <i class="far fa-times-circle fa-4x my-4" style="color:#2F94C3"></i>
                      </div>
                    </div>
                  <div class="row">
                      <div class="col-12 text-center">
                        <span class="title"><?= Yii::$app->session->getFlash('error') ?></span>
                      </div>
                    </div>
                  <div class="row">
                      <div class="col-12 text-center">
                        <span style="color:#999">Akun anda sudah terverifikasi. Silahkan melanjutkan ke halaman beranda.</span>
                      </div>
                    </div>
                  <div class="row">
                      <div class="col-12 text-center">
                        <a href="site/index" class="beranda"><i class="fas fa-chevron-left fa-lgx mt-5 mr-3" style="color:#999"></i>Kembali ke beranda</a>
                      </div>
                    </div>
                </div>
              <?php endif;?>
            </div>
        </div>
    </div>
  </div>
</div>
