<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
use app\models\Line;
use app\models\User;
use yii\helpers\ArrayHelper;

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
                              <h4 class="display-5"><b>Ajukan Task Baru</b></h4>
                          </div>
                          <div class="row justify-content-center mt-0">
                              <h5 class="display-5"><b>Pastikan Informasi yang akan diisi sesuai</b></h5>
                          </div>
                          <div class="row mt-4">
                              <?php $line=new Line; $lines = $line->getLines(); $listData=ArrayHelper::map($lines,'id','name'); $form = ActiveForm::begin(['id' => 'task-form','action' => ['site/addtask']]); ?>

                                  <?= $form->field($model, 'nameFrom')->textInput(['class'=>'form-control',''=>'','style'=>'']) ->label('Nama Lengkap') ?>

                                  <?= $form->field($model, 'jenis')->dropDownList(["Problem"=>"Problem","Quality"=>"Quality"],['prompt'=>['text' => 'Pilih Jenis Task','options'=> ['disabled' => true, 'selected' => true]]]);;?>

                                  <?php if(in_array($user->identity->name,$listData)){ $key = array_search($user->identity->name,$listData); ?>
                                    <?= $form->field($model, 'lineName')->dropDownList($listData,['prompt'=>['text' => 'Pilih line','options'=> ['disabled' => true]],'options'=> [$key=>['selected'=> true]]]); ?>
                                  <?php } else { ?>
                                    <?= $form->field($model, 'lineName')->dropDownList($listData,['prompt'=>['text' => 'Pilih line','options'=> ['disabled' => true, 'selected' => true]]]); ?>
                                  <?php } ?>


                                  <?= $form->field($model, 'deskripsi')->textarea(['rows'=>'3'])->label('Deskripsi') ?>

                                  <div class="form-group col-12 m-0 p-0 d-flex" style="margin-top:5%">
                                      <?= Html::a('Kembali',['site/index'],['class' => 'mr-auto align-self-center']) ?>
                                      <?= Html::submitButton('Ajukan<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-4', 'name' => 'register-button']) ?>
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
