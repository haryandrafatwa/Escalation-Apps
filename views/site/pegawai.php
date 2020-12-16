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
                      <span class="content-title">List Akun</span>
                    </div>
                    <div class="col-3 align-self-center">
                      <?php if($user->identity->role == 4 || $user->identity->role == 5): echo Html::submitButton('<b>Daftarkan Akun</b>', ['class' => 'btn btn-primary-outline col-12','onclick'=>'window.location = "'.Url::base(true).'/site/register?type=akun"']); endif; ?>
                    </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 p-0">
                      <div class="table-responsive">
                          <table class="table table-hover text-center">
                              <thead class="table-secondary">
                                <tr>
                                  <th class="pl-4" scope="col">Avatar</th>
                                  <th class="" scope="col">Nama</th>
                                  <th class="" scope="col">Role</th>
                                  <th class="" scope="col">NIP</th>
                                  <th class="pr-4" scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody id="tableBody">
                                <?php
                                  if($user->identity->role == 4 || $user->identity->role == 3){
                                    $users = User::find()->where(['not in','role' ,[2,5]])->orderBy(['role' => SORT_DESC,'name' => SORT_ASC])->all();
                                  }elseif($user->identity->role == 5 || $user->identity->role == 2){
                                    $users = User::find()->where(['not in','role' ,[4,3]])->orderBy(['role' => SORT_DESC,'name' => SORT_ASC])->all();
                                  }elseif($user->identity->role == 1){
                                    $users = User::find()->orderBy(['role' => SORT_DESC])->orderBy(['role' => SORT_DESC,'name' => SORT_ASC])->all();
                                  }
                                  foreach ($users as $user) {
                                ?>
                                  <tr>
                                    <th class="pl-4 align-center"><?= Html::img(Url::to('@web'.Images::findIdentity($user->images_id)), ['alt' => 'My logo','width'=>'40','height'=>'40','class'=>'avatar']) ?></th>
                                    <th class=""><?= $user->name ?></th>
                                    <th class=""><?= Role::findIdentity($user->role)->name ?></th>
                                    <th class=""><?php if($user->nip != ''){ echo $user->nip; }else{ echo '-'; } ?></th>
                                    <?php if((Role::findIdentity(Yii::$app->user->identity->role)->name == 'Superior MT') and ($user->username != Yii::$app->user->identity->username)): ?>
                    								   <th class="pr-4 align-center"><a href="javascript:delUser(<?= $user->id ?>,'<?= $user->name ?>','<?= $user->role ?>')"><i class="far fa-times-circle fa-lg" style="color: red"></i></a></th>
                    							  <?php elseif($user->username == Yii::$app->user->identity->username): ?>
                    								   <th class="pr-4 align-center"><a href="#"><i class="far fa-edit fa-lg" style="color: #2F94C3"></i></a></th>
                    							  <?php else: ?>
                                        <th class="pr-4 align-center">-</th>
                    							  <?php endif; ?>
                                  </tr>
                                <?php } ?>
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

  function delUser(userID,userName,userRole){
    swalWithBootstrapButtons.fire({
      title: 'Apakah Anda yakin?',
      text: "Semua task yang berhubungan dengan akun ini akan dihapus juga.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Lanjutkan',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      allowOutsideClick: false
    }).then((result) => {
      if (result.isConfirmed) {
        window.location="<?= Url::base(true); ?>/site/deluser?id="+userID+"&name="+userName+"&role="+userRole;
      }
    })
  }

</script>
