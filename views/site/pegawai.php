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
        <div class="col-12 m-0 p-0" style="">
            <div class="container-fluid container-profil p-3" style="width:100%">
                <div class="row d-flex">
                    <div class="col-9 align-self-center">
                      <span class="content-title">List Pegawai</span>
                    </div>
                    <div class="col-3 align-self-center">
                      <?php if($user->identity->role == 4 || $user->identity->role == 5): echo Html::submitButton('<b>Daftarkan Pegawai</b>', ['class' => 'btn btn-primary-outline col-12','onclick'=>'window.location = "'.Url::base(true).'/site/register"']); endif; ?>
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
                                  <th class="" scope="col">Line</th>
                                  <th class="" scope="col">Status</th>
                                  <th class="pr-4" scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  if($user->identity->role == 4 || $user->identity->role == 3){
                                    $users = User::find()->where(['not in','role' ,[1,2,5]])->all();
                                  }elseif($user->identity->role == 5 || $user->identity->role == 1 || $user->identity->role == 2){
                                    $users = User::find()->where(['not in','role' ,[4,3]])->all();
                                  }
                                  foreach ($users as $user) {
                                ?>
                                  <tr>
                                    <th class="pl-4 align-center"><?= Html::img(Url::to('@web'.Images::findIdentity($user->images_id)), ['alt' => 'My logo','width'=>'40','height'=>'40','class'=>'avatar']) ?></th>
                                    <th class="">
                                        <div class="p-0 m-0">
                                            <?= $user->name ?>
                                        </div>
                                        <div class="p-0 m-0 divisi-text">
                                            Divisi Manufacturing
                                        </div></th>
                                    <th class=""><?= Role::findIdentity($user->role)->name ?></th>
                                    <th class=""><?= $user->nip ?></th>
                                    <th class="">Liquid-01</th>
                                    <th class="">Online</th>
                                    <?php if((Role::findIdentity(Yii::$app->user->identity->role)->name == 'Superior MT') and ($user->username != Yii::$app->user->identity->username)): ?>
                    								   <th><a href="#"><i class="far fa-times-circle fa-lg" style="color: red"></i></a></th>
                    							  <?php elseif($user->username == Yii::$app->user->identity->username): ?>
                    								   <th><a href="#"><i class="far fa-edit fa-lg" style="color: #2F94C3"></i></a></th>
                    							  <?php else: ?>
                                        <th>-</th>
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
