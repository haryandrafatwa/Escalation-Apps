<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use app\models\Images;
use yii\helpers\ArrayHelper;
use app\models\Notifikasi;
use app\models\Task;

$this->registerAssetBundle('app\assets\AppAsset');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <?php $this->registerCsrfMetaTags() ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->params['title']; ?></title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <script src="<?= Url::base(true) ?>/js/push.js" charset="utf-8"></script>
    <script src="<?= Url::base(true) ?>/js/serviceWorker.min.js" charset="utf-8"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://unpkg.com/@pqina/flip/dist/flip.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@pqina/flip/dist/flip.min.js"></script>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php $images = new Images(); $path = $images->findIdentity(Yii::$app->user->identity->images_id); ?>
<span id="role-user" hidden><?= Yii::$app->user->identity->role; ?></span>
<span id="name-user" hidden><?= Yii::$app->user->identity->name; ?></span>
<span id="notif-url" hidden><?= Yii::$app->urlManager->createAbsoluteUrl('site/addtask') ?></span>
<div class="wrap">
  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
          <!-- Sidebar -->
          <aside class="col-12 col-md-2 p-0 bg-light flex-shrink-1">
              <nav class="navbar navbar-expand-md navbar-light bg-light flex-md-column flex-row align-items-start py-2 m-0 p-0">
                  <div class="container-fluid" style="height:auto;width: 100%;">
                    <div class="row m-0 p-0">
                      <div class="col-3 align-self-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                      </div>
                      <div class="col-6 d-flex justify-content-center align-self-center" style="width:100%;">
                        <a class="brand-logo d-flex justify-content-center" href="<?= Url::base(true) ?>">
                            <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'']) ?>
                        </a>
                      </div>
                      <div class="col-3 align-self-center m-0 p-0">
                        <div class="profil-toggler d-flex justify-content-end">
                          <a href="<?= Url::base(true);?>/site/profile" class=" d-flex justify-content-center"><?= Html::img(Url::to('@web'.$path), ['alt' => 'My logo','width'=>'40','height'=>'40','class'=>'avatar d-flex align-self-center']) ?></a>
                          <div class="profil-btn align-self-center" style="float:right;padding:12px!important"  data-toggle="collapse" data-target="#navbarProfil" aria-controls="navbarProfil" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-chevron-down"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="collapse navbar-collapse">
                      <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                          <li class="nav-item">
                              <a class="nav-link pl-0 text-nowrap text-center mt-5" href="<?= Url::base(true) ?>">
                                  <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:70%;','class'=>'']) ?>
                              </a>
                          </li>
                          <?php if (Yii::$app->user->identity->role == 1): ?>
                          <li class="nav-item">
                              <?= Html::Button('Buat Task Baru<i class="fas fa-plus" style="position:absolute;right: 10%; top: 35%"></i>', ['class' => 'btn btn-primary col-11 nav-link pl-0 mt-5', 'onclick' => "openForm('".Url::base(true)."/site/addtask')", 'id' => 'form-btn']) ?>
                          </li>
                        <?php endif; ?>
                          <li class="nav-item nav-item-link mt-5 nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Dashboard'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true) ?>">
                                    <?= Html::img(Url::to('@web/images/dashboard_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Dashboard</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>">
                                    <?= Html::img(Url::to('@web/images/dashboard_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Dashboard</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true) ?>/site/submission">
                                    <?= Html::img(Url::to('@web/images/pin_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Pengajuan</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/submission">
                                    <?= Html::img(Url::to('@web/images/pin_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Pengajuan</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true) ?>/site/ongoing">
                                    <?= Html::img(Url::to('@web/images/clock_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Sdg. Berjalan</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/ongoing">
                                    <?= Html::img(Url::to('@web/images/clock_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Sdg. Berjalan</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true) ?>/site/taskdone">
                                    <?= Html::img(Url::to('@web/images/finish_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Task Selesai</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/taskdone">
                                    <?= Html::img(Url::to('@web/images/finish_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Task Selesai</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <?php if (in_array(Yii::$app->user->identity->role,[1,2,5])): ?>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Task Belum Selesai'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true) ?>/site/taskundone">
                                    <?= Html::img(Url::to('@web/images/unfinish_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Task Belum Selesai</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/taskundone">
                                    <?= Html::img(Url::to('@web/images/unfinish_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Task Belum Selesai</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <?php endif; ?>
                          <li class="nav-item"><hr style="background-color:#8A9499;margin-top: 5%;"></li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Semua Riwayat' || $this->params['title'] == 'Escalation Apps | Riwayat Saya'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true) ?>/site/allhistory">
                                    <?= Html::img(Url::to('@web/images/file_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Riwayat</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/allhistory">
                                    <?= Html::img(Url::to('@web/images/file_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Riwayat</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Akun'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true);?>/site/akun">
                                    <?= Html::img(Url::to('@web/images/user_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Akun</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/akun">
                                    <?= Html::img(Url::to('@web/images/user_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Akun</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Line'): ?>
                                <a class="nav-link pl-0 active-tag" href="<?= Url::base(true);?>/site/line">
                                    <?= Html::img(Url::to('@web/images/flatbed_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Line</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/line">
                                    <?= Html::img(Url::to('@web/images/flatbed_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Line</span>
                                </a>
                              <?php endif; ?>
                          </li>
                      </ul>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between mt-4" style="text-align:center!important">
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Dashboard">
                              <?php if($this->params['title'] == 'Escalation Apps | Dashboard'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>">
                                    <?= Html::img(Url::to('@web/images/dashboard_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>">
                                    <?= Html::img(Url::to('@web/images/dashboard_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Sedang Berjalan">
                              <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/ongoing">
                                    <?= Html::img(Url::to('@web/images/clock_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/ongoing">
                                    <?= Html::img(Url::to('@web/images/clock_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Task Selesai">
                              <?php if($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/taskdone">
                                    <?= Html::img(Url::to('@web/images/finish_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/taskdone">
                                    <?= Html::img(Url::to('@web/images/finish_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <?php if (in_array(Yii::$app->user->identity->role,[1,2,5])): ?>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Task Belum Selesai">
                              <?php if($this->params['title'] == 'Escalation Apps | Task Belum Selesai'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/taskundone">
                                    <?= Html::img(Url::to('@web/images/unfinish_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/taskundone">
                                    <?= Html::img(Url::to('@web/images/unfinish_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <?php endif; ?>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Riwayat">
                              <?php if($this->params['title'] == 'Escalation Apps | Semua Riwayat' || $this->params['title'] == 'Escalation Apps | Riwayat Saya'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/allhistory">
                                    <?= Html::img(Url::to('@web/images/file_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true) ?>/site/allhistory">
                                    <?= Html::img(Url::to('@web/images/file_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Akun">
                              <?php if($this->params['title'] == 'Escalation Apps | Akun'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/akun">
                                    <?= Html::img(Url::to('@web/images/user_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/akun">
                                    <?= Html::img(Url::to('@web/images/user_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Line">
                              <?php if($this->params['title'] == 'Escalation Apps | Line'): ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/line">
                                    <?= Html::img(Url::to('@web/images/flatbed_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/line">
                                    <?= Html::img(Url::to('@web/images/flatbed_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                      </ul>
                  </div>
                  <div class="collapse navbar-collapse " id="navbarProfil">
                      <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between mt-4" style="text-align:center!important;">
                          <li class="nav-item nav-item-profil" style="width:100%;">
                            <?php
                              $notifikasi = Notifikasi::find()->where(['for_id'=> Yii::$app->user->identity->id,'is_read'=>false])->all();
                              if(count($notifikasi) > 1){
                            ?>
                              <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/notifikasi" name="btn-notif"><?= Html::img(Url::to('@web/images/notif_active.svg'), ['alt' => 'My logo','width'=>'12','height'=>'12','class'=>'mr-1']) ?>
                              Notifikasi</a>
                            <?php }else{ ?>
                              <a class="nav-link pl-0" href="<?= Url::base(true);?>/site/notifikasi" name="btn-notif-active">
                                <?= Html::img(Url::to('@web/images/notif.svg'), ['alt' => 'My logo','width'=>'12','height'=>'12','class'=>'mr-1']) ?>
                                Notifikasi</a>
                            <?php } ?>
                          </li>
                          <li class="nav-item nav-item-profil" style="width:100%;">
                            <?php $form = ActiveForm::begin(['id' => 'logout-form','action' => ['site/logout'],'options' => ['method' => 'post']]); ?>
                                <?= Html::submitButton('<i class="fas fa-sign-out-alt fa-md mr-2"></i>Keluar', ['class' => 'dropdown-item text-center', 'name' => 'logout-button']) ?>
                            <?php ActiveForm::end(); ?>
                          </li>
                      </ul>
                  </div>
              </nav>
          </aside>

          <!-- Content -->
          <main class="col bg-faded py-3 flex-grow-1 main-style mt-4">
              <?php if($this->params['title'] == 'Escalation Apps | Dashboard'): ?>
                <div class="container-fluid p-0" style="">
                  <?php if (Yii::$app->user->identity->role == 1): ?>
                  <div class="row" style="width:30%">
                    <?= Html::Button('Buat Task Baru<i class="fas fa-plus" style="position:absolute;right: 10%; top: 35%"></i>', ['class' => 'btn btn-primary col-12 nav-link d-none', 'onclick' => "openForm('".Url::base(true)."/site/addtask')", 'id' => 'form-btn']) ?>
                  </div>
                <?php endif; ?>
                  <div class="row">
                    <div class="col p-0 header-title">
                      <span class="welcome-message">Selamat datang kembali, <?= Yii::$app->user->identity->name; ?>!</span>
                    </div>
                    <div class="col-5 profile-items d-none">
                        <div class="row" style="">
                          <?php
                            $notifikasi = Notifikasi::find()->where(['for_id'=> Yii::$app->user->identity->id,'is_read'=>false])->all();
                            if(count($notifikasi) >= 1){
                          ?>
                            <?= Html::img(Url::to('@web/images/notif_active.svg'), ['name'=>"btn-notif-active", 'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                          <?php }else{ ?>
                            <?= Html::img(Url::to('@web/images/notif.svg'), ['name'=>"btn-notif",'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                          <?php } ?>
                          <div class="ml-4 profil-btn">
                            <?= Html::img(Url::to('@web'.$path), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar' ,'id'=>"ava-profil",'onclick'=>'window.location = "'.Url::base(true).'/site/profile"']) ?>
                            <span class="ml-3" style="font-size: calc(50% + 0.4vw);" id="dropdown-profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?= Yii::$app->user->identity->name; ?><i class="fas fa-chevron-down ml-4"></i>
                            </span>
                            <div class="dropdown-menu mt-4" style="margin-right:5%" aria-labelledby="dropdown-profil">
                              <!-- <a class="dropdown-item text-center" href="index.php?r=site/logout">Keluar</a> -->
                              <?php $form = ActiveForm::begin(['id' => 'logout-form','action' => ['site/logout'],'options' => ['method' => 'post']]); ?>
                                  <?= Html::submitButton('<i class="fas fa-sign-out-alt fa-md mr-2"></i>Keluar', ['class' => 'dropdown-item text-center', 'name' => 'logout-button']) ?>
                              <?php ActiveForm::end(); ?>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              <?php elseif($this->params['title'] == 'Escalation Apps | Profil' || $this->params['title'] == 'Escalation Apps | Pengaturan Notifikasi' || $this->params['title'] == 'Escalation Apps | Ubah Kata Sandi'): ?>
                  <div class="container-fluid p-0" style="">
                    <div class="row">
                      <div class="col p-0 header-title">
                        <span class="welcome-message">Profil Saya
                        </span>
                      </div>
                      <div class="col-5 profile-items" style="display:none">
                          <div class="row" style="">
                            <?php
                              $notifikasi = Notifikasi::find()->where(['for_id'=> Yii::$app->user->identity->id,'is_read'=>false])->all();
                              if(count($notifikasi) >= 1){
                            ?>
                              <?= Html::img(Url::to('@web/images/notif_active.svg'), ['name'=>"btn-notif-active", 'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                            <?php }else{ ?>
                              <?= Html::img(Url::to('@web/images/notif.svg'), ['name'=>"btn-notif",'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                            <?php } ?>
                            <div class="ml-4 profil-btn">
                              <?= Html::img(Url::to('@web'.$path), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar' ,'id'=>"ava-profil",'onclick'=>'window.location = "'.Url::base(true).'/site/profile"']) ?>
                              <span class="ml-3" style="font-size: calc(50% + 0.4vw);" id="dropdown-profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= Yii::$app->user->identity->name; ?><i class="fas fa-chevron-down ml-4"></i>
                              </span>
                              <div class="dropdown-menu mt-4" style="margin-right:5%" aria-labelledby="dropdown-profil">
                                <!-- <a class="dropdown-item text-center" href="index.php?r=site/logout">Keluar</a> -->
                                <?php $form = ActiveForm::begin(['id' => 'logout-form','action' => ['site/logout'],'options' => ['method' => 'post']]); ?>
                                    <?= Html::submitButton('<i class="fas fa-sign-out-alt fa-md mr-2"></i>Keluar', ['class' => 'dropdown-item text-center', 'name' => 'logout-button']) ?>
                                <?php ActiveForm::end(); ?>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                <?php elseif($this->params['title'] == 'Escalation Apps | Detail Task'): ?>
                    <div class="container-fluid p-0" style="">
                      <div class="row">
                        <div class="col p-0 header-title">
                          <span class="welcome-message">Detail Task
                          </span>
                        </div>
                        <div class="col-5 profile-items" style="display:none">
                            <div class="row" style="">
                              <?php
                                $notifikasi = Notifikasi::find()->where(['for_id'=> Yii::$app->user->identity->id,'is_read'=>false])->all();
                                if(count($notifikasi) >= 1){
                              ?>
                                <?= Html::img(Url::to('@web/images/notif_active.svg'), ['name'=>"btn-notif-active", 'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                              <?php }else{ ?>
                                <?= Html::img(Url::to('@web/images/notif.svg'), ['name'=>"btn-notif",'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                              <?php } ?>
                              <div class="ml-4 profil-btn">
                                <?= Html::img(Url::to('@web'.$path), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar' ,'id'=>"ava-profil",'onclick'=>'window.location = "'.Url::base(true).'/site/profile"']) ?>
                                <span class="ml-3" style="font-size: calc(50% + 0.4vw);" id="dropdown-profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <?= Yii::$app->user->identity->name; ?><i class="fas fa-chevron-down ml-4"></i>
                                </span>
                                <div class="dropdown-menu mt-4" style="margin-right:5%" aria-labelledby="dropdown-profil">
                                  <!-- <a class="dropdown-item text-center" href="index.php?r=site/logout">Keluar</a> -->
                                  <?php $form = ActiveForm::begin(['id' => 'logout-form','action' => ['site/logout'],'options' => ['method' => 'post']]); ?>
                                      <?= Html::submitButton('<i class="fas fa-sign-out-alt fa-md mr-2"></i>Keluar', ['class' => 'dropdown-item text-center', 'name' => 'logout-button']) ?>
                                  <?php ActiveForm::end(); ?>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
              <?php else: ?>
                <div class="container-fluid p-0" style="">
                <?php if (Yii::$app->user->identity->role == 1): ?>
                  <div class="row" style="width:30%">
                    <?= Html::submitButton('Buat Task Baru<i class="fas fa-plus" style="position:absolute;right: 10%; top: 35%"></i>', ['class' => 'btn btn-primary col-12 nav-link d-none', 'onclick' => "openForm('".Url::base(true)."/site/addtask')", 'id' => 'form-btn']) ?>
                  </div>
                <?php endif; ?>
                  <div class="row">
                    <div class="col header-title search-layout input-group align-self-center p-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text form-control" id="btnGroupAddon"><i class="fas fa-search"></i></div>
                      </div>
                      <input id="search" type="text" class="form-control" placeholder="Cari berdasarkan Task, Line, Deskripsi, atau lain-lain." aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                    <div class="col-5 profile-items" style="display:none">
                        <div class="row" style="">
                          <?php
                            $notifikasi = Notifikasi::find()->where(['for_id'=> Yii::$app->user->identity->id,'is_read'=>false])->all();
                            if(count($notifikasi) >= 1){
                          ?>
                            <?= Html::img(Url::to('@web/images/notif_active.svg'), ['name'=>"btn-notif-active", 'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                          <?php }else{ ?>
                            <?= Html::img(Url::to('@web/images/notif.svg'), ['name'=>"btn-notif",'alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center','onclick'=>'window.location = "'.Url::base(true).'/site/notifikasi"']) ?>
                          <?php } ?>
                          <div class="ml-4 profil-btn">
                            <?= Html::img(Url::to('@web'.$path), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar' ,'id'=>"ava-profil",'onclick'=>'window.location = "'.Url::base(true).'/site/profile"']) ?>
                            <span class="ml-3" style="font-size: calc(50% + 0.4vw);color:#999;font-weight:600" id="dropdown-profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?= Yii::$app->user->identity->name; ?><i class="fas fa-chevron-down ml-4"></i>
                            </span>
                            <div class="dropdown-menu mt-4" style="margin-right:5%" aria-labelledby="dropdown-profil">
                              <!-- <a class="dropdown-item text-center" href="index.php?r=site/logout">Keluar</a> -->
                              <?php $form = ActiveForm::begin(['id' => 'logout-form','action' => ['site/logout'],'options' => ['method' => 'post']]); ?>
                                  <?= Html::submitButton('<i class="fas fa-sign-out-alt fa-md mr-2"></i>Keluar', ['class' => 'dropdown-item text-center', 'name' => 'logout-button']) ?>
                              <?php ActiveForm::end(); ?>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <?= $content ?>
          </main>
      </div>
  </div>
</div>
<script type="text/javascript">
var pusher = new Pusher('61793d530781baf0985a', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('channel-task');
channel.bind('acc-task-<?= Yii::$app->user->identity->id ?>',function(data){
  Push.create("Hai, "+document.getElementById('name-user').innerHTML+"!", {
    body: data.name+" telah menerima task yang telah Anda ajukan. Cek task pada halaman task sedang berlangsung.",
    icon: '/images/small_logo.png',
    onClick: function () {
        window.focus();
        this.close();
        window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/detailtask') ?>?task_id='+data.task_id;
    }
  });
});

channel.bind('conf-task-<?= Yii::$app->user->identity->id ?>',function(data){
  localStorage.removeItem('countdown-offset-'+data.task_id);
  Push.create("Hai, "+document.getElementById('name-user').innerHTML+"!", {
    body: data.name+" telah mengkonfirmasi kedatangan Anda. Silahkan perbaiki masalah yang ada.",
    icon: '/images/small_logo.png',
    onClick: function () {
        window.focus();
        this.close();
        window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/detailtask') ?>?task_id='+data.task_id;
    }
  });
    var rtt = document.getElementById("response-time-temp")
    var rtr = document.getElementById("response-time-real")
    var rtd = document.getElementById("response-time-done")
    if((typeof(rtt) != 'undefined' && rtt != null) && (typeof(rtr) != 'undefined' && rtr != null) && (typeof(rtd) != 'undefined' && rtd != null)){
      rtt.className = "tick d-none";
      rtr.className = "tick d-none";
      rtd.className = "tick";
    }
});

channel.bind('done-task-<?= Yii::$app->user->identity->id ?>',function(data){
  localStorage.removeItem('worktime-offset-'+data.task_id);
  Push.create("Hai, "+document.getElementById('name-user').innerHTML+"!", {
    body: data.name+" telah mengkonfirmasi pekerjaan Anda. Silahkan cek detail task.",
    icon: '/images/small_logo.png',
    onClick: function () {
        window.focus();
        this.close();
        window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/detailtask') ?>?task_id='+data.task_id;
    }
  });
    var rtt = document.getElementById("work-time-temp")
    var rtr = document.getElementById("work-time-real")
    var rtd = document.getElementById("work-time-done")
    if((typeof(rtt) != 'undefined' && rtt != null) && (typeof(rtr) != 'undefined' && rtr != null) && (typeof(rtd) != 'undefined' && rtd != null)){
      rtt.className = "tick d-none";
      rtr.className = "tick d-none";
      rtd.className = "tick";
    }
});
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
  $(document).ready(function() {
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tableBody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  <?php
    $tasks = Task::findByFrom(Yii::$app->user->identity->id);
    foreach ($tasks as $task){
      if($task->done_time != null && $task->status_id == 3 && $task->is_escalated == false){ ?>
        var done_time = new Date('<?= $task->done_time ?>');
        done_time.setHours(done_time.getHours() + 6);
        var work_time = new Date('<?= $task->work_time ?>');
        work_time.setHours(work_time.getHours() + 6);
        diff = done_time-work_time;
        var batas_sendNotif = 60000;
        if(diff > batas_sendNotif){
          function sendNotifNow(){
            $.ajax({
              type: "POST",
              url: "<?= Yii::$app->urlManager->createAbsoluteUrl('site/sendnotifsupv?taskID='.$task->id) ?>",
              success: function() {
              }
            });
            return false;
          }
          sendNotifNow()
        }
  <?php
      }else if($task->done_time != null && $task->status_id == 3 && $task->is_escalated == true){ ?>
        var done_time = new Date('<?= $task->done_time ?>');
        done_time.setHours(done_time.getHours() + 6);
        var work_time = new Date('<?= $task->work_time ?>');
        work_time.setHours(work_time.getHours() + 6);
        diff = done_time-work_time;
        var batas_max = 120000;
        if(diff > batas_max){
          function sendNotifNow(){
            $.ajax({
              type: "POST",
              url: "<?= Yii::$app->urlManager->createAbsoluteUrl('site/tasktimeout?taskID='.$task->id) ?>",
              success: function() {
                localStorage.removeItem('worktime-offset');
              }
            });
            return false;
          }
          sendNotifNow()
        }
    <?php
      }
    }
  ?>
</script>
