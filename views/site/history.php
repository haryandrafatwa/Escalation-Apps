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
?>
<div class="d-flex justify-content-center mt-4">
  <div class="d-flex" style="border:3px solid #2F94C3;border-radius:1.5vw">
    <?php if($this->params['title'] == 'Escalation Apps | Semua Riwayat'): ?>
      <div class="p-2 text-center" style="width: 10vw; background:#2F94C3;border-radius:1vw 0vw 0vw 1vw">
        <a href="<?= Url::base(true) ?>/site/allhistory" style="color:white">Semua Riwayat</a>
      </div>
      <div class="p-2 text-center" style="width: 10vw">
        <a href="<?= Url::base(true) ?>/site/userhistory" style="color:#2F94C3">Riwayat Saya</a>
      </div>
    <?php elseif($this->params['title'] == 'Escalation Apps | Riwayat Saya'): ?>
      <div class="p-2 text-center" style="width: 10vw">
        <a href="<?= Url::base(true) ?>/site/allhistory" style="color:#2F94C3">Semua Riwayat</a>
      </div>
      <div class="p-2 text-center" style="width: 10vw;background:#2F94C3;border-radius:0vw 1vw 1vw 0vw">
        <a href="<?= Url::base(true) ?>/site/userhistory" style="color:white">Riwayat Saya</a>
      </div>
    <?php endif; ?>

  </div>
</div>
<div class="container-fluid m-0 p-0">
   <div class="row">
      <div class="col-12 m-0 p-0" style="">
         <div class="container-fluid container-profil p-3" style="width:100%">
            <div class="row d-flex">
               <div class="col-9 align-self-center">
                  <?php if($this->params['title'] == 'Escalation Apps | Semua Riwayat'): ?>
                    <span class="content-title">Semua Riwayat</span>
                  <?php elseif($this->params['title'] == 'Escalation Apps | Riwayat Saya'): ?>
                    <span class="content-title">Riwayat Saya</span>
                  <?php endif; ?>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-12 p-0">
                 <?php
                   if(count($riwayat) != 0){
                 ?>
                 <div class="table-responsive">
                    <table class="table table-hover text-center">
                       <thead class="table-secondary">
                          <tr>
                             <th class="pl-4" scope="col">Aktivitas</th>
                             <th class="" scope="col">User</th>
                             <th class="" scope="col">Jam</th>
                             <th class="" scope="col">Tanggal</th>
                             <th class="" scope="col">Keterangan</th>
                          </tr>
                       </thead>
                       <tbody id="tableBody">
                         <?php
                         for ($i=0; $i < count($riwayat); $i++) {
                            $users = new User();
                            $user = $users->findIdentity($riwayat[$i]->user_id);
                        ?>
                        <tr id="row-<?= $i ?>">
                           <th class="pl-4 align-center"><?= $riwayat[$i]->aktivitas; ?></th>
                           <th class="align-center"><?= $user->name ?></th>
                           <th class="align-center" id="startTime-<?= $i ?>"></th>
                           <th class="align-center" id="startDate-<?= $i ?>"></th>
                           <th class="align-center">
                              <?= $riwayat[$i]->keterangan?>
                           </th>
                        </tr>
                           <script type="text/javascript">
                              var date = new Date('<?= $riwayat[$i]->created_at ?>');
                              var now = new Date();
                              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                              date.setHours(date.getHours() + 6);
                              var startTime = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });
                              var startDate = date.toLocaleString('id-ID', options);
                              document.getElementById("startTime-<?= $i ?>").appendChild(document.createTextNode(startTime))
                              document.getElementById("startDate-<?= $i ?>").appendChild(document.createTextNode(startDate))
                           </script>
                        <?php
                        }
                        ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="8"></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                 <?php
                 } ?>
            </div>
         </div>
      </div>
   </div>
</div>
