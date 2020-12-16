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
use app\models\Line;
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
                          <?php if($type == 'akun'){ ?>
                          <div class="row justify-content-center mt-4">
                              <h4 class="display-5"><b>Daftar Akun</b></h4>
                          </div>
                          <div class="row justify-content-center mt-0">
                              <h5 class="display-5"><b>Pastikan Informasi yang akan diisi sesuai</b></h5>
                          </div>
                          <div class="row mt-4">
                              <?php $line=new Line; $lines = Line::find()->where(['is_created'=>false])->orderBy(['name' => SORT_ASC])->all(); $listLine=ArrayHelper::map($lines,'id','name'); $role=new Role; $roles = $role->getRoles($user->identity->role); $listRole=ArrayHelper::map($roles,'id','name'); $form = ActiveForm::begin(['id' => 'register-form','action' => ['site/register?type='.$type]]); ?>

                                  <?= $form->field($model, 'type',['options' => ['hidden'=>true,'class' => 'form-group field-registerform-type','id'=>'type']])->textInput(['value'=>$type])->label('Type') ?>

                                  <?= $form->field($model, 'role',['options' => ['class' => 'form-group field-registerform-role required','id'=>'roleSelect']])->dropDownList($listRole,['prompt'=>['text' => 'Pilih role akun','options'=> ['disabled' => true, 'selected' => true,'value'=>null]]]); ?>

                                  <?= $form->field($model, 'namaLengkap',['options' => ['hidden'=>true,'class' => 'form-group field-registerform-namaLengkap','id'=>'namaLengkap']])->textInput(['style'=>''])->label('Nama Lengkap') ?>

                                  <?= $form->field($model, 'nip',['options' => ['hidden'=>true,'class' => 'form-group field-registerform-nip','id'=>'nip']])->textInput(['style'=>''])->label('NIP') ?>

                                  <?= $form->field($model, 'lineName',['options' => ['hidden'=>true,'class' => 'form-group field-registerform-lineName','id'=>'lineName']])->dropDownList($listLine,['prompt'=>['text' => 'Pilih line','options'=> ['disabled' => true, 'selected' => true,'value'=>null]]]); ?>

                                  <?= $form->field($model, 'tgl_lahir',['options' => ['hidden'=>true,'class' => 'form-group field-registerform-tgl_lahir','id'=>'tgl_lahir']])->widget(DatePicker::classname(),['options' => ['placeholder' => 'Start date'],'type' => DatePicker::TYPE_COMPONENT_PREPEND,'pluginOptions' => ['autoclose'=>true,'format' => 'dd/mm/yyyy','todayHightlight'=>true]])->label('Tanggal Lahir') ?>

                                  <div class="form-group col-12 m-0 p-0 d-flex" style="margin-top:5%">
                                      <?= Html::a('Kembali',['site/akun'],['class' => 'mr-auto align-self-center']); ?>
                                      <?= Html::submitButton('Daftar<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-4', 'name' => 'register-button', 'id' => 'register-button']) ?>
                                  </div>

                              <?php ActiveForm::end(); ?>
                          </div>
                        <?php } else { ?>
                          <div class="row justify-content-center mt-4">
                              <h4 class="display-5"><b>Daftar Line</b></h4>
                          </div>
                          <div class="row justify-content-center mt-0">
                              <h5 class="display-5"><b>Pastikan Informasi yang akan diisi sesuai</b></h5>
                          </div>
                          <div class="row mt-4">
                            <?php $form = ActiveForm::begin(['id' => 'register-form','action' => ['site/register?type='.$type]]); ?>
                              <?= $form->field($model, 'type',['options' => ['hidden'=>true,'class' => 'form-group field-registerform-type','id'=>'type']])->textInput(['value'=>$type])->label('Type') ?>
                              <?= $form->field($model, 'namaLengkap')->textInput(['style'=>''])->label('Nama Lengkap') ?>
                              <div class="form-group col-12 m-0 p-0 d-flex" style="margin-top:5%">
                                  <?= Html::a('Kembali',['site/line'],['class' => 'mr-auto align-self-center']); ?>
                                  <?= Html::submitButton('Daftar<i class="fas fa-long-arrow-alt-right" style="float:right;margin-top:6px"></i>', ['class' => 'btn btn-primary col-4', 'name' => 'register-button', 'id' => 'register-button']) ?>
                              </div>
                            <?php ActiveForm::end(); ?>
                          </div>
                        <?php } ?>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var roleSel = document.getElementById('registerform-role');
  var lineName = document.getElementById('registerform-linename');
  var namaLengkap = document.getElementById('registerform-namalengkap');
  var nip = document.getElementById('registerform-nip');
  var tgl_lahir = document.getElementById('registerform-tgl_lahir');

  $(document).ready(function(){
    $("#roleSelect").change(function(){
      $(this).find("option:selected").each(function(){
        var ln = document.getElementById('lineName');
        var nm = document.getElementById('namaLengkap');
        var ni = document.getElementById('nip');
        var tl = document.getElementById('tgl_lahir');
        var optionValue = $(this).attr("value");
        if(optionValue == 1){
          ln.hidden = false;
          nm.hidden = true;
          ni.hidden = true;
          tl.hidden = true;
        }else{
          ln.hidden = true;
          nm.hidden = false;
          ni.hidden = false;
          tl.hidden = false;
        }
      })
    })

    // document.getElementById("regisBtn").onclick = function(){
    //   if(roleSel.value == 1){
    //     if(lineName.value.length == 0){
    //       Swal.fire(
    //         'Upss..',
    //         'Silahkan pilih <b>Line Name</b> terlebih dahulu!',
    //         'error'
    //       )
    //     }else{
    //       document.getElementById("register-button").click()
    //     }
    //   }else if(roleSel.value == 2){
    //     if(namaLengkap.value.length == 0){
    //       Swal.fire(
    //         'Upss..',
    //         'Silahkan masukkan <b>Nama Lengkap</b> terlebih dahulu!',
    //         'error'
    //       )
    //     }else if(nip.value.length == 0){
    //       Swal.fire(
    //         'Upss..',
    //         'Silahkan masukkan <b>NIP</b> terlebih dahulu!',
    //         'error'
    //       )
    //     }else if(tgl_lahir.value.length == 0){
    //       Swal.fire(
    //         'Upss..',
    //         'Silahkan masukkan <b>Tanggal Lahir</b> terlebih dahulu!',
    //         'error'
    //       )
    //     }else{
    //       document.getElementById("register-button").click()
    //     }
    //   }else{
    //     Swal.fire(
    //       'Upss..',
    //       'Silahkan pilih <b>Role</b> terlebih dahulu!',
    //       'error'
    //     )
    //   }
    // }

  })
</script>
