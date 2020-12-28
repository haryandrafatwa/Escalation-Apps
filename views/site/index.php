<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\models\Task;
use app\models\Line;
use app\models\User;
use app\models\Riwayat;

$this->registerAssetBundle('app\assets\DashboardAsset');
?>
<div class="container-fluid p-0 main-container" id="desktop-version">
    <div class="row">
      <div class="col-7">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
          <div class="row d-flex">
            <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
              <?= Yii::$app->session->getFlash('success') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php endif; ?>
        <?php $unFinish = Task::find()->where(['status_id' => 5])->all(); if(count($unFinish) > 0 && Yii::$app->user->identity->role == 2):?>
          <div class="row">
            <div class="alert alert-danger fade show col-12" role="alert">
              Terdapat <?= count($unFinish); ?> task yang belum selesai. Segera periksa task tersebut!
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
        <div class="col-7">
            <div class="row">
                <span class="header-text" id="dashboard-txt">Dashboard</span>
            </div>
            <div class="row" style="margin-top: calc(1% + 0.5vw)">
                <div class="chart-container container" style="height:100%; width:100%;">
                  <div class="row">
                    <div class="col-1 p-0 align-self-center">
                        <?= Html::img(Url::to('@web/images/trophy.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress ml-3']) ?>
                    </div>
                    <div class="col-8 align-self-center">
                      <div class="row ml-3">
                          <span class="title-task-onprogress">Response Time Terbaik</span>
                      </div>
                      <div class="row ml-3">
                          <span class="content-task-onprogress">
                            <?php
                              $bestTime = 0;
                              $idBest = 0;
                              $task = Task::find()->where(['not', ['acc_time' => null]])->andWhere(['not', ['response_time' => null]])->all();
                              if (count($task) > 0) {
                                  $i = 0; foreach ($task as $item) {
                                  $timeAcc = strtotime($item->acc_time);
                                  $timeConf = strtotime($item->response_time);
                                  $diff = $timeConf - $timeAcc; ?>
                                  <?php if($i == 0){
                                    $bestTime = $diff;
                                    $idBest = $item->to_id;
                                  }else if($diff < $bestTime){
                                    $bestTime = $diff;
                                    $idBest = $item->to_id;
                                  }
                                  $i++;
                                }
                                echo '<i>'.User::findIdentity($idBest)->name.'</i>';
                              }else{
                                echo "<i>Belum Ada</i>";
                              }
                            ?>
                          </span>
                      </div>
                    </div>
                    <div class="col-3 align-self-center">
                      <div class="row float-right mr-4">
                        <?php if ($bestTime > 0){ ?>
                          <span class="nominal-text"><?= date('H:i:s',strtotime('-1 hours',$bestTime)) ?></span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row" style="margin-top: calc(1% + 0.5vw);">
              <div class="recent-task">
                <div class="container-fluid">
                  <div class="row" style="padding-left:1%;padding-top:2%;padding-right:2%;padding-bottom:2%">
                    <div class="col align-self-center">
                      <span class="sub-title" style="">Pengajuan Task</span>
                    </div>
                    <div class="col align-self-center">
                      <a href="<?= Url::base(true);?>/site/submission" class="view-all" style="float:right">Lihat Semua</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="table-responsive">
                        <table class="table table-hover text-center">
                          <thead class="table-secondary">
                            <tr>
                              <th class="pl-4 align-center" scope="col">Nama</th>
                              <th class="align-center" scope="col">Line</th>
                              <th class="align-center" scope="col">Jam Mulai</th>
                              <th class="align-center" scope="col">Deskripsi</th>
                              <th class="align-center" scope="col">Status</th>
                              <th class="pr-3 align-center" scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if(in_array(Yii::$app->user->identity->role,[2,5])){
                                $tasks = Task::find()->where(['status_id' => 1])->andWhere(['jenis_task' => 'Problem'])->orderBy(['created_at' => SORT_DESC])->all();
                              }else if(in_array(Yii::$app->user->identity->role,[3,4])){
                                $tasks = Task::find()->where(['status_id' => 1])->andWhere(['jenis_task' => 'Quality'])->orderBy(['created_at' => SORT_DESC])->all();
                              }else{
                                $tasks = Task::find()->where(['status_id' => 1])->orderBy(['created_at' => SORT_DESC])->all();
                              }

                              if(count($tasks) > 0){
                                $i = 1; foreach (array_slice($tasks,0,5) as $task) {
                            ?>
                            <tr id="row-<?= $task->id ?>">
                              <th class="pl-4 align-center"> <?= $task->requester ?></th>
                              <th class="align-center"><?= Line::findIdentity($task->line_id)->name ?></th>
                              <th class="align-center" id="startTime-<?= $task->id ?>"></th>
                              <th class="align-center"><?= $task->deskripsi ?></th>
                              <th class="align-center">Diajukan</th>
                              <th class="pr-3 align-center"><a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $task->id ?>"><i class="fas fa-eye fa-sm" style="color: #2F94C3"></i></a></th>
                            </tr>
                            <script type="text/javascript">
                              var date = new Date('<?= $task->created_at ?>');
                              var now = new Date();
                              var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                              date.setHours(date.getHours() + 6);
                              var startHour = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });
                              var startTime = date.toLocaleString('en-US', { year: 'numeric', day: 'numeric',month: 'numeric' });
                              document.getElementById("startTime-<?= $task->id ?>").innerHTML = startHour

                              var  batas_1 = 900000;
                              var  batas_2 = 1800000;

                              var diff = now.getTime() - date.getTime();
                              if(diff > batas_1 && diff <= batas_2){
                                document.getElementById('row-<?= $task->id ?>').className = "alert-warning"
                              }else if(diff > batas_2){
                                document.getElementById('row-<?= $task->id ?>').className = "alert-danger"
                              }
                            </script>
                            <?php
                              $i++; }
                            } else {
                            ?>
                            <tr>
                              <th colspan="6">
                                <?= Html::img(Url::to('@web/images/no_data_recent.svg'), ['alt' => 'My logo','style'=>'width:calc(12% + 1.2vw)','class'=>'d-flex ml-auto mr-auto mt-2 mb-2']) ?>
                                <span class="ml-auto mr-auto title-nominal-text">Tidak ada task terbaru</span>
                              </th>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="5"></th>
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
        <div class="col-5 pr-0">
            <div class="container-fluid pr-0">
                <div class="row" style="margin-top: calc(1% + 2.5vw);">
                    <!-- Total Task  -->
                    <div class="col-6" style="">
                      <div class="preview-layout">
                          <div class="row m-0 p-0" style="">
                            <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                              <?php echo count(Task::find()->all()); ?>
                            </span>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="title-nominal-text">Total Task</span>
                          </div>
                      </div>
                    </div>
                    <!-- Cek Kualitas  -->
                    <div class="col-6" style="">
                      <div class="preview-layout">
                          <div class="row m-0 p-0" style="">
                            <?= Html::img(Url::to('@web/images/cek_kualitas.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                              <?php echo count(Task::find()->where(['jenis_task' => "Quality"])->all()); ?>
                            </span>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="title-nominal-text">Cek Kualitas</span>
                          </div>
                      </div>
                    </div>
                    <!-- Task Selesai  -->
                    <div class="col-6" style="margin-top: calc(1% + 1vw);">
                      <div class="preview-layout">
                          <div class="row m-0 p-0" style="">
                            <?= Html::img(Url::to('@web/images/tasks_selesai.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                              <?php echo count(Task::find()->where(['status_id' => 4])->all()); ?>
                            </span>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="title-nominal-text">Task Selesai</span>
                          </div>
                      </div>
                    </div>
                    <!-- Task On progress  -->
                    <div class="col-6" style="margin-top: calc(1% + 1vw);">
                      <div class="preview-layout">
                          <div class="row m-0 p-0" style="">
                            <?= Html::img(Url::to('@web/images/tasks_onprogress.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                              <?php echo count(Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->all()); ?>
                            </span>
                          </div>
                          <div class="row m-0 p-0">
                            <span class="title-nominal-text">Sedang Berjalan</span>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: calc(1% + 0.5vw)">
        <div class="col-7">
            <div class="row">
                <div class="chart-container" style="height:100%; width:100%">
                    <span class="sub-title">Task di Minggu Ini</span>
                    <canvas id="myChartDesktop" style="margin-top: calc(0.5% + 0.5vw)"></canvas>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="row ml-0">
                <div class="task-onprogress" style="width:100%">
                    <div class="container-fluid pr-0">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <span class="sub-title" style="">Task Sedang Berjalan</span>
                            </div>
                            <div class="col-4 align-self-center">
                                <a href="<?= Url::base(true);?>/site/ongoing" class="view-all" style="float:right">Lihat Semua</a>
                            </div>
                        </div>
                        <?php
                          $onProgress = Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->orderBy(['created_at' => SORT_DESC])->all() ;
                          if(count($onProgress) > 0){
                            foreach (array_slice($onProgress,0,4) as $task) {
                        ?>
                        <div class="row m-0 task-onprogress-items mt-2" onclick="javascript:window.location='<?= Url::base(true);?>/site/detailtask?task_id='+<?= $task->id ?>">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-1 m-0">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress"><?= $task->jenis_task ?> | <?php $line = Line::findIdentity($task->line_id); echo $line->name;  ?></span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">
                                    <?php
                                      if($task->status_id == 1){
                                        echo "Mengajukan - Diajukan oleh ".User::findIdentity($task->from_id)->name;
                                      }else{
                                        echo "Memperbaiki - Ditugaskan kepada ".User::findIdentity($task->to_id)->name;
                                      }
                                    ?>
                                  </span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                      <?php
                          }
                        } else {
                      ?>
                      <div class="task-onprogress-items mt-2">
                        <div class="row">
                          <?= Html::img(Url::to('@web/images/no_data_ongoing.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto mt-4 mb-2']) ?>
                        </div>
                        <div class="row d-flex">
                          <span class="ml-auto mr-auto title-nominal-text">Tidak Ada Task yang Sedang Berjalan</span>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MOBILE VIEW -->
<div class="container-fluid p-0 main-container" id="mobile-version" style="display:none;width:100%">
    <div class="row">
      <div class="col-12">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
          <div class="row d-flex">
            <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
              <?= Yii::$app->session->getFlash('success') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php endif; ?>
        <?php $unFinish = Task::find()->where(['status_id' => 5])->all(); if(count($unFinish) > 0 && Yii::$app->user->identity->role == 5):?>
          <div class="row">
            <div class="alert alert-danger fade show" role="alert">
              Terdapat <?= count($unFinish); ?> task yang belum selesai. Segera periksa task tersebut!
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row" style="">
        <div class="col-12">
          <div class="row">
              <span class="header-text" id="dashboard-txt">Dashboard</span>
          </div>
          <div class="row" style="margin-top: calc(1% + 0.5vw)">
              <div class="chart-container container" style="height:100%; width:100%;">
                <div class="row">
                  <div class="col-1 p-0 align-self-center">
                      <?= Html::img(Url::to('@web/images/trophy.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress ml-3']) ?>
                  </div>
                  <div class="col-8 align-self-center">
                    <div class="row ml-3">
                        <span class="title-task-onprogress">Response Time Terbaik</span>
                    </div>
                    <div class="row ml-3">
                        <span class="content-task-onprogress">
                          <?php
                            $bestTime = 0;
                            $idBest = 0;
                            $task = Task::find()->where(['not', ['acc_time' => null]])->andWhere(['not', ['response_time' => null]])->all();
                            if (count($task) > 0) {
                                $i = 0; foreach ($task as $item) {
                                $timeAcc = strtotime($item->acc_time);
                                $timeConf = strtotime($item->response_time);
                                $diff = $timeConf - $timeAcc; ?>
                                <?php if($i == 0){
                                  $bestTime = $diff;
                                  $idBest = $item->to_id;
                                }else if($diff < $bestTime){
                                  $bestTime = $diff;
                                  $idBest = $item->to_id;
                                }
                                $i++;
                              }
                              echo '<i>'.User::findIdentity($idBest)->name.'</i>';
                            }else{
                              echo "<i>Belum Ada</i>";
                            }
                          ?>
                        </span>
                    </div>
                  </div>
                  <div class="col-3 align-self-center">
                    <div class="row float-right mr-4">
                      <?php if ($bestTime > 0){ ?>
                        <span class="nominal-text"><?= date('H:i:s',strtotime('-1 hours',$bestTime)) ?></span>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="row" style="margin-top: calc(1% + 2.5vw);">
            <div class="recent-task">
              <div class="container-fluid">
                <div class="row" style="padding-left:1%;padding-top:2%;padding-right:2%;padding-bottom:2%">
                  <div class="col align-self-center">
                    <span class="sub-title" style="">Pengajuan Task</span>
                  </div>
                  <div class="col align-self-center">
                    <a href="<?= Url::base(true);?>/site/submission" class="view-all" style="float:right">Lihat Semua</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 p-0">
                    <div class="table-responsive">
                      <table class="table table-hover text-center">
                        <thead class="table-secondary">
                          <tr>
                            <th class="pl-4 align-center" scope="col">Nama</th>
                            <th class="align-center" scope="col">Line</th>
                            <th class="align-center" scope="col">Jam Mulai</th>
                            <th class="align-center" scope="col">Deskripsi</th>
                            <th class="align-center" scope="col">Status</th>
                            <th class="pr-3 align-center" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if(in_array(Yii::$app->user->identity->role,[2,5])){
                              $tasks = Task::find()->where(['status_id' => 1])->andWhere(['jenis_task' => 'Problem'])->orderBy(['created_at' => SORT_DESC])->all();
                            }else if(in_array(Yii::$app->user->identity->role,[3,4])){
                              $tasks = Task::find()->where(['status_id' => 1])->andWhere(['jenis_task' => 'Quality'])->orderBy(['created_at' => SORT_DESC])->all();
                            }else{
                              $tasks = Task::find()->where(['status_id' => 1])->orderBy(['created_at' => SORT_DESC])->all();
                            }

                            if(count($tasks) > 0){
                              $i = 1; foreach (array_slice($tasks,0,5) as $task) {
                          ?>
                          <tr id="row-<?= $task->id ?>">
                            <th class="pl-4 align-center"> <?= $task->requester ?></th>
                            <th class="align-center"><?= Line::findIdentity($task->line_id)->name ?></th>
                            <th class="align-center" id="startHour-<?= $task->id ?>"></th>
                            <th class="align-center"><?= $task->deskripsi ?></th>
                            <th class="align-center">Diajukan</th>
                            <th class="pr-3 align-center"><a href="<?= Url::base(true);?>/site/detailtask?task_id=<?= $task->id ?>"><i class="fas fa-eye fa-sm" style="color: #2F94C3"></i></a></th>
                          </tr>
                          <script type="text/javascript">
                            var date = new Date('<?= $task->created_at ?>');
                            var now = new Date();
                            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                            date.setHours(date.getHours() + 6);
                            var startHour = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });
                            var startTime = date.toLocaleString('en-US', { year: 'numeric', day: 'numeric',month: 'numeric' });
                            document.getElementById("startHour-<?= $task->id ?>").appendChild(document.createTextNode(startHour))

                            var  batas_1 = 900000;
                            var  batas_2 = 1800000;

                            var diff = now.getTime() - date.getTime();
                            if(diff > batas_1 && diff <= batas_2){
                              document.getElementById('row-<?= $task->id ?>').className = "alert-warning"
                            }else if(diff > batas_2){
                              document.getElementById('row-<?= $task->id ?>').className = "alert-danger"
                            }
                          </script>
                          <?php
                            $i++; }
                          } else {
                          ?>
                          <tr>
                            <th colspan="6">
                              <?= Html::img(Url::to('@web/images/no_data_recent.svg'), ['alt' => 'My logo','style'=>'width:calc(12% + 1.2vw)','class'=>'d-flex ml-auto mr-auto mt-2 mb-2']) ?>
                              <span class="ml-auto mr-auto title-nominal-text">Tidak ada task terbaru</span>
                            </th>
                          </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="5"></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row" style="margin-top: calc(1% + 0.5vw);">
                <!-- Total Task  -->
                <div class="col p-0 m-0" style="">
                  <div class="preview-layout">
                      <div class="row p-0 m-0" style="">
                        <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                      </div>
                      <div class="row p-0 m-0">
                        <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                          <?php echo count(Task::find()->all()); ?>
                        </span>
                      </div>
                      <div class="row p-0 m-0">
                        <span class="title-nominal-text">Total Task</span>
                      </div>
                  </div>
                </div>
                <!-- Cek Kualitas  -->
                <div class="col p-0 m-0" style="margin-left:2%!important;margin-right:1%!important">
                  <div class="preview-layout">
                      <div class="row m-0 p-0" style="">
                        <?= Html::img(Url::to('@web/images/cek_kualitas.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                      </div>
                      <div class="row m-0 p-0">
                        <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                          <?php echo count(Task::find()->where(['jenis_task' => "Quality"])->all()); ?>
                        </span>
                      </div>
                      <div class="row m-0 p-0">
                        <span class="title-nominal-text">Cek Kualitas</span>
                      </div>
                  </div>
                </div>
                <!-- Task Selesai  -->
                <div class="col p-0 m-0" style="margin-left:1%!important;margin-right:2%!important">
                  <div class="preview-layout">
                      <div class="row m-0 p-0" style="">
                        <?= Html::img(Url::to('@web/images/tasks_selesai.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                      </div>
                      <div class="row m-0 p-0">
                        <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                          <?php echo count(Task::find()->where(['status_id' => 4])->all()); ?>
                        </span>
                      </div>
                      <div class="row m-0 p-0">
                        <span class="title-nominal-text">Task Selesai</span>
                      </div>
                  </div>
                </div>
                <!-- Task On progress  -->
                <div class="col p-0 m-0" style="">
                  <div class="preview-layout">
                      <div class="row m-0 p-0" style="">
                        <?= Html::img(Url::to('@web/images/tasks_onprogress.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                      </div>
                      <div class="row m-0 p-0">
                        <span class="nominal-text" style="margin-top: calc(7% + 1vw);">
                          <?php echo count(Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->all()); ?>
                        </span>
                      </div>
                      <div class="row m-0 p-0">
                        <span class="title-nominal-text">Sedang Berjalan</span>
                      </div>
                  </div>
                </div>
            </div>
          <div class="row" style="margin-top: calc(1% + 2.5vw);">
              <div class="chart-container" style="height:100%; width:100%">
                  <span class="sub-title">Task di Minggu Ini</span>
                  <canvas id="myChartMobile" style="margin-top: calc(0.5% + 0.5vw)"></canvas>
              </div>
          </div>
          <div class="row" style="margin-top: calc(1% + 2.5vw);">
            <div class="task-onprogress" style="width:100%">
                <div class="row m-0">
                  <div class="col-8 align-self-center p-0">
                    <span class="sub-title" style="">Task Sedang Berjalan</span>
                  </div>
                  <div class="col-4 align-self-center p-0">
                    <a href="<?= Url::base(true);?>/site/ongoing" class="view-all" style="float:right">Lihat Semua</a>
                  </div>
                </div>
                <?php
                $onProgress = Task::find()->where(['status_id' => 2])->orWhere(['status_id' => 3])->orderBy(['created_at' => SORT_DESC])->all() ;
                if(count($onProgress) > 0){
                  foreach (array_slice($onProgress,0,4) as $task) {
                ?>
                <div class="row m-0 task-onprogress-items mt-2" onclick="javascript:window.location='<?= Url::base(true);?>/site/detailtask?task_id='+<?= $task->id ?>">
                  <div class="col-1 p-0 m-0 align-self-center">
                    <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                  </div>
                  <div class="col-10 p-0 pl-1 m-0">
                    <div class="row p-0 m-0">
                      <span class="title-task-onprogress"><?= $task->jenis_task ?> | <?php $line = Line::findIdentity($task->line_id); echo $line->name;  ?></span>
                    </div>
                    <div class="row p-0 m-0">
                      <span class="content-task-onprogress">
                        <?php
                        if($task->status_id == 1){
                          echo "Mengajukan - Diajukan oleh ".User::findIdentity($task->from_id)->name;
                        }else{
                          echo "Memperbaiki - Ditugaskan kepada ".User::findIdentity($task->to_id)->name;
                        }
                        ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-1 p-0 m-0 pl-3 align-self-center">
                    <i class="fas fa-chevron-right ic-chevron"></i>
                  </div>
                </div>
                <?php
                }
              } else {
                ?>
                <div class="task-onprogress-items mt-2">
                  <div class="row">
                    <?= Html::img(Url::to('@web/images/no_data_ongoing.svg'), ['alt' => 'My logo','style'=>'width:calc(20% + 1vw)','class'=>'d-flex ml-auto mr-auto mt-4 mb-2']) ?>
                  </div>
                  <div class="row d-flex">
                    <span class="ml-auto mr-auto title-nominal-text">Tidak Ada Task yang Sedang Berjalan</span>
                  </div>
                </div>
              <?php } ?>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var ctxDesktop = document.getElementById('myChartDesktop');
  var ctxMobile = document.getElementById('myChartMobile');
  var myChart = new Chart(ctxDesktop, {
      type: 'line',
      data: {
          labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
          datasets: [{
              label: 'Task Minggu Ini',
              data:
              [
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("monday this week"))])->all()) ?>,
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("tuesday this week"))])->all()) ?>,
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("wednesday this week"))])->all()) ?>,
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("thursday this week"))])->all()) ?>,
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("friday this week"))])->all()) ?>,
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("saturday this week"))])->all()) ?>,
                <?= count(Task::find()->where(['like','created_at',date('Y-m-d', strtotime("sunday this week"))])->all()) ?>
              ],
              borderColor:'#2F94C3',
              borderWidth:3,
              backgroundColor:'#2F94C333',
              pointBackgroundColor:'#2F94C3',
              pointHoverBackgroundColor:'rgba(0, 0, 0, 0.1)',
              pointHoverRadius:6,
              pointHoverBorderWidth:3
          }],
      },
      options: {
          legend:{
            display:false
          },
          tooltips: {
              mode: 'point'
          },
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      fontColor:'#666',
                      fontSize:16,
                      fontStyle:'bold',
                      padding:20
                  },
                  gridLines:{
                      zeroLineWidth:2,
                      drawBorder: false,
                      color: '#F2F2F2'
                  },
              }],
              xAxes:[{
                gridLines:{
                    display: false
                },
                ticks: {
                    beginAtZero: true,
                    fontColor:'#666',
                    fontSize:16,
                    fontStyle:'bold'
                },
              }]
          }
      }
  });
  var myChart = new Chart(ctxMobile, {
      type: 'line',
      data: {
          labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
          datasets: [{
              label: 'Task Minggu Ini',
              data: [12, 19, 3, 5, 2, 3,10],
              borderColor:'#2F94C3',
              borderWidth:3,
              backgroundColor:'#2F94C333',
              pointBackgroundColor:'#2F94C3',
              pointHoverBackgroundColor:'rgba(0, 0, 0, 0.1)',
              pointHoverRadius:6,
              pointHoverBorderWidth:3
          }],
      },
      options: {
          legend:{
            display:false
          },
          tooltips: {
              mode: 'point'
          },
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      fontColor:'#666',
                      fontSize:16,
                      fontStyle:'bold',
                      padding:20
                  },
                  gridLines:{
                      zeroLineWidth:2,
                      drawBorder: false,
                      color: '#F2F2F2'
                  },
              }],
              xAxes:[{
                gridLines:{
                    display: false
                },
                ticks: {
                    beginAtZero: true,
                    fontColor:'#666',
                    fontSize:16,
                    fontStyle:'bold'
                },
              }]
          }
      }
  });
</script>
