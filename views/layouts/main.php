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

$this->registerAssetBundle('app\assets\AppAsset');
$this->registerAssetBundle('app\assets\DashboardAsset');
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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <div class="container-fluid">
      <div class="row min-vh-100 flex-column flex-md-row">
          <!-- Sidebar -->
          <aside class="col-12 col-md-2 p-0 bg-light flex-shrink-1">
              <nav class="navbar navbar-expand-md navbar-light bg-light flex-md-column flex-row align-items-start py-2">
                  <button class="navbar-toggler align-self-center" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="profil-toggler">
                    <a href="#" class="ml-auto"><?= Html::img(Url::to('@web/images/avatar.png'), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar']) ?></a>
                    <div class="profil-btn ml-1" style="float:right;"  data-toggle="collapse" data-target="#navbarProfil" aria-controls="navbarProfil" aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fas fa-chevron-down p-3"></i>
                    </div>
                  </div>

                  <div class="collapse navbar-collapse">
                      <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                          <li class="nav-item">
                              <a class="nav-link pl-0 text-nowrap text-center mt-5" href="<?= Url::base(true) ?>">
                                  <?= Html::img(Url::to('@web/images/logo.svg'), ['alt' => 'My logo','style'=>'width:70%;','class'=>'']) ?>
                              </a>
                          </li>
                          <li class="nav-item">
                              <?= Html::submitButton('Buat Task Baru<i class="fas fa-plus" style="float:right;margin-top:calc(1% + 0.3vw);margin-right:4%"></i>', ['class' => 'btn btn-primary col-11 nav-link pl-0 mt-5', 'onclick' => "openForm('".Url::base(true)."')", 'id' => 'form-btn']) ?>
                          </li>
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
                              <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                                <a class="nav-link pl-0 active-tag" href="#">
                                    <?= Html::img(Url::to('@web/images/clock_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Sdg. Berjalan</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/clock_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Sdg. Berjalan</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Cek Kualitas'): ?>
                                <a class="nav-link pl-0 active-tag" href="#">
                                    <?= Html::img(Url::to('@web/images/quality_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Cek Kualitas</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/quality_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Cek Kualitas</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                                <a class="nav-link pl-0 active-tag" href="#">
                                    <?= Html::img(Url::to('@web/images/tasks_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Task Selesai</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/tasks_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Task Selesai</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item"><hr style="background-color:#8A9499;margin-top: 5%;"></li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Semua Riwayat'): ?>
                                <a class="nav-link pl-0 active-tag" href="#">
                                    <?= Html::img(Url::to('@web/images/file_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Semua Riwayat</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/file_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Semua Riwayat</span>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link nav-item-margin">
                              <?php if($this->params['title'] == 'Escalation Apps | Profil'): ?>
                                <a class="nav-link pl-0 active-tag" href="#">
                                    <?= Html::img(Url::to('@web/images/user_active.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="active d-none d-md-inline">Profil</span>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/user_passive.svg'), ['alt' => 'My logo','style'=>'width:calc(3% + 1vw);','class'=>'']) ?>
                                    <span class="d-none d-md-inline">Profil</span>
                                </a>
                              <?php endif; ?>
                          </li>
                      </ul>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between mt-4" style="text-align:center!important">
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Dashboard">
                              <?php if($this->params['title'] == 'Escalation Apps | Dashboard'): ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/dashboard_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/dashboard_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Sedang Berjalan">
                              <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/clock_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/clock_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Cek Kualitas">
                              <?php if($this->params['title'] == 'Escalation Apps | Cek Kualitas'): ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/quality_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/quality_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Task Selesai">
                              <?php if($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/tasks_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/tasks_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Semua Riwayat">
                              <?php if($this->params['title'] == 'Escalation Apps | Semua Riwayat'): ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/file_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/file_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                          <li class="nav-item nav-item-link" data-toggle="tooltip" title="Profil">
                              <?php if($this->params['title'] == 'Escalation Apps | Profil'): ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/user_active.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php else: ?>
                                <a class="nav-link pl-0" href="#">
                                    <?= Html::img(Url::to('@web/images/user_passive.svg'), ['alt' => 'My logo','width'=>'24','height'=>'24','class'=>'']) ?>
                                </a>
                              <?php endif; ?>
                          </li>
                      </ul>
                  </div>
                  <div class="collapse navbar-collapse " id="navbarProfil">
                      <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between mt-4" style="text-align:center!important;">
                          <li class="nav-item nav-item-profil" style="width:100%;">
                              <a class="nav-link pl-0" href="#"><i class="fas fa-bell fa-md mr-2"></i>Notifikasi</a>
                          </li>
                          <li class="nav-item nav-item-profil" style="width:100%;">
                              <a class="nav-link pl-0" href="#"><i class="fas fa-sign-out-alt fa-md mr-2"></i>Keluar</a>
                          </li>
                      </ul>
                  </div>
              </nav>
          </aside>

          <!-- Content -->
          <main class="col bg-faded py-3 flex-grow-1 main-style mt-4">
              <?php if($this->params['title'] == 'Escalation Apps | Dashboard'): ?>
                <div class="container-fluid p-0" style="">
                  <div class="row">
                    <div class="col p-0">
                      <span class="welcome-message">Selamat datang kembali, <?= Yii::$app->user->identity->name; ?>!</span>
                    </div>
                    <div class="col-5" style="">
                        <div class="row" style="">
                          <?= Html::img(Url::to('@web/images/notif.svg'), ['alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center']) ?>
                          <div class="ml-4 profil-btn" style="display:none">
                            <?= Html::img(Url::to('@web/images/avatar.png'), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar' ,'id'=>"ava-profil"]) ?>
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
                  <div class="row">
                    <div class="col search-layout input-group align-self-center p-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text form-control" id="btnGroupAddon"><i class="fas fa-search"></i></div>
                      </div>
                      <input type="text" class="form-control" placeholder="Cari berdasarkan Task, Line, Deskripsi, atau lain-lain." aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                    <div class="col-5" style="">
                        <div class="row" style="">
                          <?= Html::img(Url::to('@web/images/notif.svg'), ['alt' => 'My logo','width'=>'25','height'=>'25','class'=>'ml-auto ic-notif align-self-center']) ?>
                          <div class="ml-4 profil-btn" style="display:none">
                            <?= Html::img(Url::to('@web/images/avatar.png'), ['alt' => 'My logo','width'=>'50','height'=>'50','class'=>'avatar' ,'id'=>"ava-profil"]) ?>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
