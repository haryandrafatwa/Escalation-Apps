<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
use app\models\User;
use app\models\Line;
use app\models\Role;
use app\models\Task;
use app\models\Notifikasi;
?>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12 m-0 p-0" style="">
            <div class="container-fluid p-3" style="width:100%">
                <?php
                  if(count($notifikasi) != 0){?>
                    <div class="row d-flex mb-1">
                        <div class="col-9 p-0 mt-4 d-flex justify-content-between">
                          <span class="notif-title">Notifikasi</span>
                          <span class="read-all d-flex align-items-center" id="read-all" onclick="window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/readall') ?>'">Baca Semua</span>
                        </div>
                    </div>
                    <?php for ($i=0; $i < count($notifikasi); $i++) {
                      if($i < (count($notifikasi)-1)){
                        if($notifikasi[$i]->created_at != $notifikasi[$i+1]->created_at){
                          $tasks = new Task(); $task = $tasks->findIdentity($notifikasi[$i]->task_id);
                          $users = new User(); $user = $users->findIdentity($task->from_id);
                          $lines = new Line(); $line = $lines->findIdentity($task->line_id);
                    ?>
                          <div class="row d-flex" id="content-notif">
                        <div class="col-9 p-0 mt-2 notif-content content-notif-item" id="notif-item-<?= $i; ?>">
                            <div class="container">
                              <div class="row">
                                <div class="col-1 p-0 m-0 align-self-center">
                                    <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                                </div>
                                <div class="col-9 p-0 pl-3 pr-3 m-0">
                                  <div class="row p-0 m-0 d-flex">
                                      <span class="notif-item-date">
                                        <?php
                                          date_default_timezone_set('UTC');
                                          setlocale(LC_ALL,'in_ID');
                                          $time = strftime( "%A, %d %B %Y %H:%M", strtotime($task->created_at));
                                          echo date('d F Y | H:i',strtotime('+6 hour',strtotime($time)));
                                        ?>
                                      </span>
                                  </div>
                                  <div class="row p-0 m-0">
                                        <span class="notif-item-content line-clamp"><b><?= $notifikasi[$i]->deskripsi ?></b></span>
                                  </div>
                                </div>
                                <div class="col-1 p-0 m-0 align-self-center">
                                    <?php if(!$notifikasi[$i]->is_read): ?>
                                      <?= Html::img(Url::to('@web/images/circle_blue.svg'), ['alt' => 'My logo','style'=>'width:calc(10% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-1 p-0 m-0 align-self-center">
                                    <i class="fas fa-chevron-right ic-chevron d-flex justify-content-center"></i>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                      }elseif ($i == (count($notifikasi)-1)){
                        $tasks = new Task(); $task = $tasks->findIdentity($notifikasi[$i]->task_id);
                        $users = new User(); $user = $users->findIdentity($task->from_id);
                        $lines = new Line(); $line = $lines->findIdentity($task->line_id);?>
                        <div class="row d-flex" id="content-notif">
                          <div class="col-9 p-0 mt-2 notif-content content-notif-item" id="notif-item-<?= $i; ?>">
                                    <div class="container">
                                      <div class="row">
                                        <div class="col-1 p-0 m-0 align-self-center">
                                            <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                                        </div>
                                        <div class="col-9 p-0 pl-3 pr-3 m-0">
                                          <div class="row p-0 m-0 d-flex">
                                              <span class="notif-item-date">
                                                <?php
                                                  date_default_timezone_set('UTC');
                                                  setlocale(LC_ALL,'in_ID');
                                                  $time = strftime( "%A, %d %B %Y %H:%M", strtotime($task->created_at));
                                                  echo date('d F Y | H:i',strtotime('+6 hour',strtotime($time)));
                                                ?>
                                              </span>
                                          </div>
                                          <div class="row p-0 m-0">
                                                <span class="notif-item-content line-clamp"><b><?= $notifikasi[$i]->deskripsi ?></b></span>
                                          </div>
                                        </div>
                                        <div class="col-1 p-0 m-0 align-self-center">
                                            <?php if(!$notifikasi[$i]->is_read): ?>
                                              <?= Html::img(Url::to('@web/images/circle_blue.svg'), ['alt' => 'My logo','style'=>'width:calc(10% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-1 p-0 m-0 align-self-center">
                                            <i class="fas fa-chevron-right ic-chevron d-flex justify-content-center"></i>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                    <script type="text/javascript">
                      $(document).on("click", "#notif-item-<?= $i; ?>", function () {
                          window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/readdetailtask') ?>?task_id=<?= $task->id ?>';
                      });
                      $(document).ready(function() {
                        $("#search").on("keyup", function() {
                          var value = $(this).val().toLowerCase();
                          $("#content-notif .container").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                          });
                        });
                      });
                    </script>
                  <?php }}else{
                    ?>
                    <div class="row d-flex mb-1">
                        <div class="col-9 p-0 mt-4 d-flex justify-content-between">
                          <span class="notif-title">Notifikasi</span>
                        </div>
                    </div>
                    <div class="row d-flex mt-3">
                        <div class="col-9 p-0 mt-4">
                          <?= Html::img(Url::to('@web/images/no_data_notif.svg'), ['alt' => 'My logo','style'=>'width:calc(30% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-9 p-0 mt-4">
                        <span class="notif-title justify-content-center d-flex">Anda sedang tidak memiliki notifikasi.</span>
                      </div>
                    </div>
                  <?php } ?>
            </div>
        </div>
    </div>
</div>
