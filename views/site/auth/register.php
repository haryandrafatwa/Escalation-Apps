<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
use kartik\date\DatePicker;
use app\models\Role;
use yii\helpers\ArrayHelper;

$this->title = 'Escalation App | Daftar';
?>
<div class="site-login">
    <div class="container mt-5 mb-5">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="row justify-content-center">
              <div class="jumbotron w-50 align-self-center m-0 pt-0 pb-0">
                  <div class="container-fluid mt-4 mb-4">
                      <div class="col-12">
                          <div class="row justify-content-center ">
                              <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:50%;','class'=>'']) ?>
                          </div>
                          <div class="row justify-content-center mt-4">
                              <h4 class="display-5"><b>Daftar Akun</b></h4>
                          </div>
                          <div class="row justify-content-center mt-0">
                              <h5 class="display-5"><b>Pastikan Informasi yang akan diisi sesuai</b></h5>
                          </div>
                          <div class="row mt-4">
                              <?php $role=new Role; $roles = $role->getRoles($user->identity->role); $listData=ArrayHelper::map($roles,'id','name'); $form = ActiveForm::begin(['id' => 'register-form','action' => ['site/register']]); ?>

                                  <?= $form->field($model, 'name')->textInput(['style'=>''])->label('Nama Lengkap') ?>

                                  <?= $form->field($model, 'nip')->textInput(['style'=>''])->label('NIP') ?>

                                  <?= $form->field($model, 'role')->dropDownList($listData,['prompt'=>['text' => 'Pilih role pegawai','options'=> ['disabled' => true, 'selected' => true]]]); ?>

                                  <?= $form->field($model, 'tgl_lahir')->widget(DatePicker::classname(),['options' => ['placeholder' => 'Start date'],'type' => DatePicker::TYPE_COMPONENT_PREPEND,'pluginOptions' => ['autoclose'=>true,'format' => 'dd/mm/yyyy','todayHightlight'=>true]])->label('Tanggal Lahir') ?>

                                  <div class="form-group col-12 m-0 p-0 d-flex" style="margin-top:5%">
                                      <?= Html::a('Kembali',['site/pegawai'],['class' => 'mr-auto align-self-center']) ?>
                                      <?= Html::submitButton('Daftar<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-4', 'name' => 'register-button']) ?>
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
