<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;

$this->title = 'Escalation App | Masuk';
?>
<div class="site-login">
  <div class="container-fluid" id="desktop-version">
    <div class="row">
      <div class="col-6">
        <div class="row">
          <div class="col-12 text-center mt-5">
              <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:40%;','class'=>'']) ?>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-8" style="margin-top:5%;">

            <div class="row">
              <div class="">
                    <span class="welcome-string">Masuk</span>
              </div>
            </div>
            <div class="row">
                <span class="login-string">Selamat datang kembali, silahkan masuk menggunakan akun anda.</span>
            </div>
            <div class="row" style="margin-top:5%;">
              <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                  <?= Alert::widget() ?>

                  <?= $form->field($model, 'email')->textInput(['style'=>'position:relative;z-index:3;'])->label('Alamat Email') ?>

                  <?= $form->field($model, 'password')->passwordInput(['style'=>'position:relative;z-index:3;'])->label('Kata Sandi') ?>

                  <?= $form->field($model, 'rememberMe')->checkbox(['checked' => false,'class' => 'custom-control-input'])->label('Ingat Saya') ?>

                  <div style="color:#999;margin:1em 0;">
                      Kamu lupa kata sandi kamu? <?= Html::a('Atur ulang sekarang', ['site/request-password-reset']) ?>.
                  </div>

                  <div class="form-group" style="margin-top:8%">
                      <?= Html::submitButton('Masuk<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-12', 'name' => 'login-button']) ?>
                  </div>

                  <div class="text-center" style="color:#999;margin:1em 0;margin-top:10%">
                      Belum memiliki akun? <?= Html::a('Daftar sekarang', ['site/register']) ?>.
                  </div>

              <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6" style="background-color:#2F94C3;min-height:100vh">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <span class="app-name">Escalation<span style="color:#FF6584;font-weight: normal;">Apps</span></span>
            </div>
          </div>
          <div class="row">
            <p class="app-desc text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
          </div>
        </div>
        <?= Html::img(Url::to('@web/images/image_login.svg'), ['alt' => 'My logo','style'=>'width:112%;margin-left:-14%;margin-top:-8%;','class'=>'img-login']) ?>
      </div>
    </div>
  </div>
  <div class="container-fluid" id="mobile-version">
    <div class="row">
      <div class="col-12 d-flex align-items-center" style="height:100vh;">
        <div class="">
          <div class="row">
            <div class="col-12 text-center mt-5">
                <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:50%;','class'=>'']) ?>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-10" style="margin-top:5%">

              <div class="row">
                <div class="">
                      <span class="welcome-string">Masuk</span>
                </div>
              </div>
              <div class="row">
                  <span class="login-string">Selamat datang kembali,</span>
              </div>
              <div class="row">
                <?php $form = ActiveForm::begin(['id' => 'login-form-mobile']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'style'=>'position:relative;z-index:3']) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox(['checked' => false,'class' => 'custom-control-input']) ?>

                    <div style="color:#999;margin:1em 0;">
                        Kamu lupa kata sandi kamu? <?= Html::a('Atur ulang sekarang', ['site/request-password-reset']) ?>.
                    </div>

                    <div class="form-group" style="margin-top:8%">
                        <?= Html::submitButton('Masuk<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-12', 'name' => 'login-button']) ?>
                    </div>

                    <div class="text-center" style="color:#999;margin:1em 0;margin-top:10%">
                        Belum memiliki akun? <?= Html::a('Daftar sekarang', ['site/register']) ?>.
                    </div>

                <?php ActiveForm::end(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
