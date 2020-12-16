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
<div class="container-fluid m-0 p-0">
   <div class="row">
      <div class="col-12 m-0 p-0" style="">
         <div class="container-fluid container-profil p-3" style="width:100%">
            <div class="row d-flex">
               <div class="col-9 align-self-center">
                  <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                    <span class="content-title">Task Sedang Berjalan</span>
                  <?php elseif($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                    <span class="content-title">Task Selesai</span>
                  <?php elseif($this->params['title'] == 'Escalation Apps | Task Tidak Selesai'): ?>
                    <span class="content-title">Task Tidak Selesai</span>
                  <?php elseif($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                    <span class="content-title">Pengajuan Task</span>
                  <?php endif; ?>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-12 p-0">
                 <?php
                 if($userNow->identity->role == 2 || $userNow->identity->role == 5){
                   if(count($taskProblem) != 0){
                 ?>
                 <div class="table-responsive">
                    <table class="table table-hover text-center">
                       <thead class="table-secondary">
                          <tr>
                             <th class="pl-4" scope="col">Nama</th>
                             <th class="" scope="col">Assigned To</th>
                             <th class="" scope="col">Task</th>
                             <th class="" scope="col">Line</th>
                             <th class="" scope="col">Jam Mulai</th>
                             <th class="" scope="col">Deskripsi</th>
                             <th class="" scope="col">Status</th>
                             <th class="pr-4" scope="col">Action</th>
                          </tr>
                       </thead>
                       <tbody id="tableBody">
                         <?php
                         for ($i=0; $i < count($taskProblem); $i++) {
                            $users = new User();
                            $userFrom = $users->findIdentity($taskProblem[$i]->from_id);
                            $userTo = $users->findIdentity($taskProblem[$i]->to_id);
                            $lines = new Line(); $line = $lines->findIdentity($taskProblem[$i]->line_id);
                        ?>
                        <tr id="row-<?= $i ?>">
                           <th class="pl-4 align-center"><?= $taskProblem[$i]->requester; ?></th>
                           <th class="align-center"><?php if(empty($userTo->name)){echo "-";}else{echo $userTo->name;} ?></th>
                           <th class="align-center"><?= $taskProblem[$i]->jenis_task; ?></th>
                           <th class="align-center"><?= $line->name ?></th>
                           <th class="align-center" id="startTime-<?= $i ?>">
                           </th>
                           <th class="align-center">
                              <?= $out = strlen($taskProblem[$i]->deskripsi) > 40 ? substr($taskProblem[$i]->deskripsi,0,40)."..." :  $out=$taskProblem[$i]->deskripsi;?>
                           </th>
                           <th class="align-center"><?php if($taskProblem[$i]->status_id == 1){echo "Diajukan";}elseif($taskProblem[$i]->status_id == 2){echo "Diterima";}elseif($taskProblem[$i]->status_id == 3){echo "Dikerjakan";}
                           elseif($taskProblem[$i]->status_id == 4){echo "Selesai";}elseif($taskProblem[$i]->status_id == 5){echo "Belum Selesai";} ?></th>
                           <?php if($userNow->identity->name == $userFrom->name && $taskProblem[$i]->status_id == 1): ?>
                           <th class="pr-4 align-center">
                              <a href="#"><i class="far fa-times-circle fa-sm" style="color: red"></i></i></a>
                              <a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $taskProblem[$i]->id ?>"><i class="fas fa-eye fa-sm ml-1" style="color: #2F94C3"></i></a>
                           </th>
                           <?php else: ?>
                           <th class="pr-4 align-center"><a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $taskProblem[$i]->id ?>"><i class="fas fa-eye fa-sm" style="color: #2F94C3"></i></a></th>
                           <?php endif; ?>
                        </tr>
                           <script type="text/javascript">
                              var date = new Date('<?= $taskProblem[$i]->created_at ?>');
                              var now = new Date();
                              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                              date.setHours(date.getHours() + 6);
                              var startTime = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });
                              document.getElementById("startTime-<?= $i ?>").appendChild(document.createTextNode(startTime))

                              <?php if($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                                var  batas_1 = 900000;
                                var  batas_2 = 1800000;

                                var diff = now.getTime() - date.getTime();
                                if(diff > batas_1 && diff <= batas_2){
                                  document.getElementById('row-<?= $i ?>').className = "alert-warning"
                                }else if(diff > batas_2){
                                  document.getElementById('row-<?= $i ?>').className = "alert-danger"
                                }
                              <?php endif; ?>
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
                 }else{ ?>
                   <div class="row d-flex mt-3">
                      <div class="col-12 p-0 mt-4">
                        <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_ongoing.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php elseif($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_done.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php elseif($this->params['title'] == 'Escalation Apps | Task Tidak Selesai'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_undone.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php elseif($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_recent.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php endif; ?>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-12 p-0 mt-4">
                         <span class="notif-title justify-content-center d-flex">Anda sedang tidak memiliki task.</span>
                      </div>
                   </div>
                 <?php
               }
             } elseif($userNow->identity->role == 3 || $userNow->identity->role == 4){
               if(count($taskQuality) != 0){ ?>
                 <div class="table-responsive">
                    <table class="table table-hover text-center">
                       <thead class="table-secondary">
                          <tr>
                             <th class="pl-4" scope="col">Nama</th>
                             <th class="" scope="col">Assigned To</th>
                             <th class="" scope="col">Task</th>
                             <th class="" scope="col">Line</th>
                             <th class="" scope="col">Jam Mulai</th>
                             <th class="" scope="col">Deskripsi</th>
                             <th class="" scope="col">Status</th>
                             <th class="pr-4" scope="col">Action</th>
                          </tr>
                       </thead>
                       <tbody id="tableBody">
                         <?php
                         for ($i=0; $i < count($taskQuality); $i++) {
                            $users = new User();
                            $userFrom = $users->findIdentity($taskQuality[$i]->from_id);
                            $userTo = $users->findIdentity($taskQuality[$i]->to_id);
                            $lines = new Line(); $line = $lines->findIdentity($taskQuality[$i]->line_id);
                        ?>
                        <tr id="row-<?= $i ?>">
                           <th class="pl-4 align-center"><?= $taskQuality[$i]->requester; ?></th>
                           <th class="align-center"><?php if(empty($userTo->name)){echo "-";}else{echo $userTo->name;} ?></th>
                           <th class="align-center"><?= $taskQuality[$i]->jenis_task; ?></th>
                           <th class="align-center"><?= $line->name ?></th>
                           <th class="align-center" id="startTime-<?= $i ?>">
                           </th>
                           <th class="align-center"><b>
                              <?= $out = strlen($taskQuality[$i]->deskripsi) > 40 ? substr($taskQuality[$i]->deskripsi,0,40)."..." :  $out=$taskQuality[$i]->deskripsi;?></b>
                           </th>
                           <th class="align-center"><?php if($taskQuality[$i]->status_id == 1){echo "Diajukan";}elseif($taskQuality[$i]->status_id == 2){echo "Diterima";}elseif($taskQuality[$i]->status_id == 3){echo "Dikerjakan";}
                           elseif($taskQuality[$i]->status_id == 4){echo "Selesai";}elseif($taskQuality[$i]->status_id == 5){echo "Belum Selesai";} ?></th>
                           <?php if($userNow->identity->name == $userFrom->name && $taskQuality[$i]->status_id == 1): ?>
                           <th class="pr-4 align-center">
                              <a href="#"><i class="far fa-times-circle fa-sm" style="color: red"></i></i></a>
                              <a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $taskQuality[$i]->id ?>"><i class="fas fa-eye fa-sm ml-1" style="color: #2F94C3"></i></a>
                           </th>
                           <?php else: ?>
                           <th class="pr-4 align-center"><a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $taskQuality[$i]->id ?>"><i class="fas fa-eye fa-sm" style="color: #2F94C3"></i></a></th>
                           <?php endif; ?>
                        </tr>
                           <script type="text/javascript">
                              var date = new Date('<?= $taskQuality[$i]->created_at ?>');
                              var now = new Date();
                              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                              date.setHours(date.getHours() + 6);
                              var startTime = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });
                              document.getElementById("startTime-<?= $i ?>").appendChild(document.createTextNode(startTime))

                              <?php if($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                                var  batas_1 = 900000;
                                var  batas_2 = 1800000;

                                var diff = now.getTime() - date.getTime();
                                if(diff > batas_1 && diff <= batas_2){
                                  document.getElementById('row-<?= $i ?>').className = "alert-warning"
                                }else if(diff > batas_2){
                                  document.getElementById('row-<?= $i ?>').className = "alert-danger"
                                }
                              <?php endif; ?>
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
                 }else{ ?>
                   <div class="row d-flex mt-3">
                      <div class="col-12 p-0 mt-4">
                        <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_ongoing.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php elseif($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_done.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php elseif($this->params['title'] == 'Escalation Apps | Task Tidak Selesai'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_undone.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php elseif($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                          <?= Html::img(Url::to('@web/images/no_data_recent.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                        <?php endif; ?>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-12 p-0 mt-4">
                         <span class="notif-title justify-content-center d-flex">Anda sedang tidak memiliki task.</span>
                      </div>
                   </div>
                   <?php
                 }
               } else {
                 if(count($task) != 0){ ?>
                   <div class="table-responsive">
                      <table class="table table-hover text-center">
                         <thead class="table-secondary">
                            <tr>
                               <th class="pl-4" scope="col">Nama</th>
                               <th class="" scope="col">Assigned To</th>
                               <th class="" scope="col">Task</th>
                               <th class="" scope="col">Line</th>
                               <th class="" scope="col">Jam Mulai</th>
                               <th class="" scope="col">Deskripsi</th>
                               <th class="" scope="col">Status</th>
                               <th class="pr-4" scope="col">Action</th>
                            </tr>
                         </thead>
                         <tbody id="tableBody">
                           <?php
                           for ($i=0; $i < count($task); $i++) {
                              $users = new User();
                              $userFrom = $users->findIdentity($task[$i]->from_id);
                              $userTo = $users->findIdentity($task[$i]->to_id);
                              $lines = new Line(); $line = $lines->findIdentity($task[$i]->line_id);
                          ?>
                          <tr id="row-<?= $i ?>">
                             <th class="pl-4 align-center"><?= $task[$i]->requester; ?></th>
                             <th class="align-center"><?php if(empty($userTo->name)){echo "-";}else{echo $userTo->name;} ?></th>
                             <th class="align-center"><?= $task[$i]->jenis_task; ?></th>
                             <th class="align-center"><?= $line->name ?></th>
                             <th class="align-center" id="startTime-<?= $i ?>">
                             </th>
                             <th class="align-center"><b>
                                <?= $out = strlen($task[$i]->deskripsi) > 40 ? substr($task[$i]->deskripsi,0,40)."..." :  $out=$task[$i]->deskripsi;?></b>
                             </th>
                             <th class="align-center"><?php if($task[$i]->status_id == 1){echo "Diajukan";}elseif($task[$i]->status_id == 2){echo "Diterima";}elseif($task[$i]->status_id == 3){echo "Dikerjakan";}
                             elseif($task[$i]->status_id == 4){echo "Selesai";}elseif($task[$i]->status_id == 5){echo "Belum Selesai";} ?></th>
                             <?php if($userNow->identity->name == $userFrom->name && $task[$i]->status_id == 1): ?>
                             <th class="pr-4 align-center">
                                <a href="#"><i class="far fa-times-circle fa-sm" style="color: red"></i></i></a>
                                <a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $task[$i]->id ?>"><i class="fas fa-eye fa-sm ml-1" style="color: #2F94C3"></i></a>
                             </th>
                             <?php else: ?>
                             <th class="pr-4 align-center"><a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $task[$i]->id ?>"><i class="fas fa-eye fa-sm" style="color: #2F94C3"></i></a></th>
                             <?php endif; ?>
                          </tr>
                             <script type="text/javascript">
                                var date = new Date('<?= $task[$i]->created_at ?>');
                                var now = new Date();
                                var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                date.setHours(date.getHours() + 6);
                                var startTime = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });
                                document.getElementById("startTime-<?= $i ?>").appendChild(document.createTextNode(startTime))

                                <?php if($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                                  var  batas_1 = 900000;
                                  var  batas_2 = 1800000;

                                  var diff = now.getTime() - date.getTime();
                                  if(diff > batas_1 && diff <= batas_2){
                                    document.getElementById('row-<?= $i ?>').className = "alert-warning"
                                  }else if(diff > batas_2){
                                    document.getElementById('row-<?= $i ?>').className = "alert-danger"
                                  }
                                <?php endif; ?>
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
                   }else{ ?>
                     <div class="row d-flex mt-3">
                        <div class="col-12 p-0 mt-4">
                          <?php if($this->params['title'] == 'Escalation Apps | Sedang Berjalan'): ?>
                            <?= Html::img(Url::to('@web/images/no_data_ongoing.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                          <?php elseif($this->params['title'] == 'Escalation Apps | Task Selesai'): ?>
                            <?= Html::img(Url::to('@web/images/no_data_done.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                          <?php elseif($this->params['title'] == 'Escalation Apps | Task Tidak Selesai'): ?>
                            <?= Html::img(Url::to('@web/images/no_data_undone.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                          <?php elseif($this->params['title'] == 'Escalation Apps | Pengajuan'): ?>
                            <?= Html::img(Url::to('@web/images/no_data_recent.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                          <?php endif; ?>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 p-0 mt-4">
                           <span class="notif-title justify-content-center d-flex">Anda sedang tidak memiliki task.</span>
                        </div>
                     </div>
                   <?php
                 }
               } ?>
            </div>
         </div>
      </div>
   </div>
</div>
