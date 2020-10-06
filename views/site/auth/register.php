<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;

$this->title = 'Escalation App | Daftar';
?>
<div class="site-login">
  <div class="container-fluid" id="desktop-version">
    <div class="row">
      <div class="col-6" style="background-color:#2F94C3;min-height:100vh">
        <?= Html::img(Url::to('@web/images/image_register.svg'), ['alt' => 'My logo','style'=>'','class'=>'img-register']) ?>
        <div class="container">
            <div class="row">
              <span class="app-name text-right">Escalation<span style="color:#FF6584;font-weight: normal;">Apps</span></span>
            </div>
            <div class="row">
              <span class="motto-1">Decide faster</span>
            </div>
            <div class="row">
              <span class="motto-2">so you can do more</span>
            </div>
            <div class="row">
              <p id="app-desc" class="app-desc text-justify">Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.</p>
            </div>
            <div class="row app-desc-btn" style="width:100%">
              <?= Html::button('<i class="fas fa-play fa-lg" id="ic-btn" style="color:white"></i>', ['id'=>'btn-circle','class' => 'btn btn-circle btn-md','data-toggle'=>"modal",'data-target'=>"#exampleModalCenter", 'onclick'=>"showAppDesc()" ]) ?>
              <span class="app-desc-text align-self-center btn" onclick="showAppDesc()" >Apa itu Escalation Apps?</span>
            </div>
        </div>
      </div>
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
                    <span class="welcome-string">Daftar</span>
              </div>
            </div>
            <div class="row">
                <span class="login-string">Selamat datang, silahkan daftar terlebih dahulu untuk menggunakan apps ini.</span>
            </div>
            <div class="row" style="margin-top:5%;">
              <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

                  <?= Alert::widget() ?>

                  <?= $form->field($model, 'name')->textInput(['style'=>'position:relative;z-index:3;width:100%'])->label('Nama Lengkap') ?>

                  <?= $form->field($model, 'email')->textInput(['style'=>'position:relative;z-index:3;width:100%'])->label('Alamat Email') ?>

                  <?= $form->field($model, 'password')->passwordInput()->label('Kata Sandi') ?>

                  <?= $form->field($model, 'repassword')->passwordInput()->label('Ulang Kata Sandi') ?>

                  <div class="form-group" style="margin-top:5%">
                      <?= Html::submitButton('Daftar<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-12', 'name' => 'login-button']) ?>
                  </div>

                  <div class="text-center" style="color:#999;margin:1em 0;margin-top:5%">
                      Sudah memiliki akun? <?= Html::a('Masuk sekarang', ['site/index']) ?>.
                  </div>

              <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
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
                      <span class="welcome-string">Daftar</span>
                </div>
              </div>
              <div class="row">
                  <span class="login-string">Selamat datang, silahkan daftar terlebih dahulu untuk menggunakan apps ini.</span>
              </div>
              <div class="row">
                <?php $form = ActiveForm::begin(['id' => 'register-form-mobile']); ?>

                    <?= Alert::widget() ?>

                    <?= $form->field($model, 'name')->textInput(['style'=>'position:relative;z-index:3;width:100%'])->label('Nama Lengkap') ?>

                    <?= $form->field($model, 'email')->textInput(['style'=>'position:relative;z-index:3;width:100%'])->label('Alamat Email') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('Kata Sandi') ?>

                    <?= $form->field($model, 'repassword')->passwordInput()->label('Ulang Kata Sandi') ?>

                    <div class="form-group" style="margin-top:5%">
                        <?= Html::submitButton('Daftar<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-12', 'name' => 'login-button']) ?>
                    </div>

                    <div class="text-center" style="color:#999;margin:1em 0;margin-top:5%">
                        Sudah memiliki akun? <?= Html::a('Masuk sekarang', ['site/index']) ?>.
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
