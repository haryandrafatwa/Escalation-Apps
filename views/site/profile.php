<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
?>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12 m-0 p-0" style="">
            <div class="container-fluid container-profil" style="width:100%">
                <div class="row header">
                    <div class="col-4 d-flex justify-content-center sub-title-active">
                        <a href="profile" class="content-title p-2 pt-4">Ubah Profil</a>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="notifsetting" class="content-title p-2 pt-4">Notifikasi</a>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="notifsetting" class="content-title p-2 pt-4">Ubah Kata Sandi</a>
                    </div>
                </div>
                <div class="row contents" style="margin-top:calc(1% + 1vw)!important">
                    <div class="col-4 d-flex justify-content-center">
                      <div class="align-self-center">
                        <?= Html::img(Url::to('@web/images/avatar.png'), ['alt' => 'My logo','width'=>'200','height'=>'200','class'=>'avatar align-self-center' ,'id'=>"avatar-profil"]) ?>
                        <?= Html::img(Url::to('@web/images/hover.png'), ['alt' => 'My logo','width'=>'200','height'=>'200','class'=>'avatar align-self-center' ,'id'=>"avatar-hover"]) ?>
                      </div>
                    </div>
                    <div class="col-8">
                      <?php $form = ActiveForm::begin(['id' => 'register-form','class'=>'form-group']); ?>
                        <?= Alert::widget() ?>

                        <?= $form->field($model, 'username')->textInput(['class'=>'form-control','readonly'=>'','style'=>'','value'=>$user->identity->username]) ?>

                        <?= $form->field($model, 'name')->textInput(['class'=>'form-control','style'=>'','value'=>$user->identity->name])->label('Nama Lengkap') ?>

                        <?= $form->field($model, 'nip')->textInput(['class'=>'form-control','style'=>'','value'=>$user->identity->nip])->label('NIP') ?>

                        <div class="form-group" style="margin-top:5%">
                            <?= Html::submitButton('Daftar<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-12', 'name' => 'login-button']) ?>
                        </div>
                      <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
