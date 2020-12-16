<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
use app\models\User;
use app\models\Role;
use app\models\Line;
use app\models\Images;
?>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12 m-0 pl-0 pr-0 " style="">
          <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="row d-flex pl-3 pr-3 pt-3" style="margin-bottom:-1.9vw" role="alert">
              <div class="alert alert-success alert-dismissible fade show col-12">
                <?= Yii::$app->session->getFlash('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          <?php endif; ?>
            <div class="container-fluid container-profil p-3" style="width:100%">
                <div class="row d-flex">
                    <div class="col-9 align-self-center">
                      <span class="content-title">List Line</span>
                    </div>
                    <div class="col-3 align-self-center">
                      <?php if($user->identity->role == 4 || $user->identity->role == 5): echo Html::submitButton('<b>Daftarkan Line</b>', ['class' => 'btn btn-primary-outline col-12','onclick'=>'window.location = "'.Url::base(true).'/site/register?type=line"']); endif; ?>
                    </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 p-0">
                      <div class="table-responsive">
                          <table class="table table-hover text-center">
                              <thead class="table-secondary">
                                <tr>
                                  <th class="pl-4" scope="col">#</th>
                                  <th class="" scope="col">Name</th>
                                  <th class="" scope="col">Status Akun</th>
                                  <th class="pr-4" scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody id="tableBody">
                                <?php
                                  $i = 1;
                                  $lines = Line::find()->orderBy(['is_created' => SORT_DESC,'name' => SORT_ASC])->all();
                                  foreach ($lines as $line) {
                                ?>
                                  <tr>
                                    <th class="pl-4 align-center"><?= $i ?></th>
                                    <th class="align-center"><?= $line->name ?></th>
                                    <th class="align-center"><?php if($line->is_created){echo "Sudah dibuat";}else{echo "Belum dibuat";} ?></th>
                                    <?php if($user->identity->role == 4 || $user->identity->role == 5): ?>
                    								   <th class="pr-4 align-center"><a href="javascript:delLine(<?= $line->id ?>)"><i class="far fa-times-circle fa-lg" style="color: red"></i></a></th>
                    							  <?php else: ?>
                                        <th class="pr-4 align-center">-</th>
                    							  <?php endif; ?>
                                  </tr>
                                <?php $i++;} ?>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th colspan="6"></th>
                                </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

  function delLine(lineID){
    swalWithBootstrapButtons.fire({
      title: 'Apakah Anda yakin?',
      text: "Semua task serta akun yang berhubungan dengan line ini akan dihapus juga.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Lanjutkan',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      allowOutsideClick: false
    }).then((result) => {
      if (result.isConfirmed) {
        window.location="<?= Url::base(true) ?>/site/delline?id="+lineID;
      }
    })
  }

</script>
