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
use app\models\Images;
?>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12 m-0 p-0" style="">
            <div class="container-fluid container-profil p-3" style="width:100%">
                <div class="row">
                  <div class="col-8">
                    <div class="container-fluid container-profil p-0" style="width:100%">
                        <div class="row mt-4">
                          <div class="col-6">
                            <h5><b><?= $task->jenis_task; ?></b></h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-12">
                            <span id="tgl=task"></span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <span>Nama</span>
                          </div>
                          <div class="col-1">
                            <span>:</span>
                          </div>
                          <div class="col-8">
                            <span><b><?= $task->requester; ?></b></span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <span>Assigned To</span>
                          </div>
                          <div class="col-1">
                            <span>:</span>
                          </div>
                          <div class="col-8">
                            <span><b><?php $users = new User(); $userTo = $users->findIdentity($task->to_id); if(!empty($userTo->name)){ echo $userTo->name; }else{ echo "-";}?></b></span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <span>Jam</span>
                          </div>
                          <div class="col-1">
                            <span>:</span>
                          </div>
                          <div class="col-8">
                            <span id="detaik-task-start-time"><b><?= $task->requester; ?></b></span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <span>Line</span>
                          </div>
                          <div class="col-1">
                            <span>:</span>
                          </div>
                          <div class="col-8">
                            <span><b><?php $lines = new Line(); $line = $lines->findIdentity($task->line_id); echo $line->name; ?></b></span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <span>Status</span>
                          </div>
                          <div class="col-1">
                            <span>:</span>
                          </div>
                          <div class="col-8">
                            <span><b><?php if($task->status_id == 1){echo "Diajukan";}elseif($task->status_id == 2){echo "Diterima";}elseif($task->status_id == 3){echo "Dikerjakan";}elseif($task->status_id == 4){echo "Selesai";}elseif($task->status_id == 5){echo "Tidak Selesai";} ?></b></span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <span>Deskripsi</span>
                          </div>
                          <div class="col-1">
                            <span>:</span>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-12">
                            <textarea readonly><?= $task->deskripsi ?></textarea>
                          </div>
                        </div>
                        <?php if($task->suggestion != null): ?>
                          <div class="row mt-2">
                            <div class="col-3">
                              <span>Suggestion</span>
                            </div>
                            <div class="col-1">
                              <span>:</span>
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                              <textarea readonly><?= $task->suggestion ?></textarea>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if($task->solution != null): ?>
                          <div class="row mt-2">
                            <div class="col-3">
                              <span>Solution</span>
                            </div>
                            <div class="col-1">
                              <span>:</span>
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                              <textarea readonly><?= $task->solution ?></textarea>
                            </div>
                          </div>
                        <?php endif; ?>
                        <div class="row mt-1">
                          <div class="col-12">
                            <?php
                            if(in_array($userNow->identity->role,[1,2,3])){
                              if(in_array($task->status_id,[1,2,3])){
                                if(($userNow->id != $task->from_id) && $task->to_id == null){ ?>
                                  <span class="btn-title">Task ini belum ada yang menerima, Apakah anda ingin menerimanya?</span>
                                  <button type="button" class="btn btn-primary acc-now col-12 mt-2" id="acc-now">Terima Sekarang</button>
                                <?php }elseif(($userNow->id != $task->from_id) && $task->to_id != $userNow->id){ ?>
                                  <span class="btn-title">Sepertinya task ini sudah ada yang menerima.</span>
                                  <button type="button" class="btn btn-secondary btn-lg disabled col-12 mt-2" id="acc-now" disabled>Terima Sekarang</button>
                                <?php }elseif(($userNow->id == $task->from_id) && $task->to_id == null){ ?>
                                  <span class="btn-title">Task ini belum ada yang menerima, Apakah anda ingin menghapus task?</span>
                                  <button type="button" class="btn btn-danger btn-lg col-12 mt-2" id="del-now">Hapus Task</button>
                                <?php }elseif(($userNow->id != $task->from_id) && $task->to_id == $userNow->id){ ?>
                                  <span class="btn-title">Anda telah menerima task ini. Silahkan mengujungi line tersebut untuk melanjutkan proses.</span>
                                  <button type="button" class="btn btn-secondary btn-lg col-12 mt-2 disabled" disabled id="acc-now">Sudah diterima</button>
                                <?php }elseif(($userNow->id == $task->from_id) && $task->status_id == 2){ if($task->jenis_task == "Problem"){?>
                                  <span class="btn-title">Apakah rekan MT sudah sampai di tempat Anda?</span> <?php }else{ ?>
                                  <span class="btn-title">Apakah rekan QC sudah sampai di tempat Anda?</span> <?php } ?>
                                  <button type="button" class="btn btn-primary btn-lg col-12 mt-2" id="process-now">Sudah sampai</button>
                                <?php }elseif(($userNow->id == $task->from_id) && $task->status_id == 3){ if($task->jenis_task == "Problem"){?>
                                  <span class="btn-title">Apakah rekan MT telah menyelesaikan task?</span>
                                  <div class="row">
                                      <div class="col-6">
                                        <button type="button" class="btn btn-secondary btn-lg col-12 mt-2" id="unfinish">Tidak</button>
                                      </div>
                                        <div class="col-6">
                                          <button type="button" class="btn btn-primary btn-lg col-12 mt-2" id="finish">Iya</button>
                                        </div>
                                  </div>
                                  <?php }else{ ?>
                                  <span class="btn-title">Apakah rekan QC telah menyelesaikan task?</span>
                                  <button type="button" class="btn btn-primary btn-lg col-12 mt-2" id="finish">Iya, sudah selesai</button><?php } ?>
                            <?php }
                          }else{ if($task->status_id == 4){ if($task->jenis_task == "Problem"){ if(Yii::$app->user->identity->id != $task->to_id){?>
                            <span class="btn-title text-primary-color">Task telah dilakukan pemeriksaan oleh rekan MT.</span> <?php }else{ if(empty($task->suggestion) && !empty($task->solution)){?>
                            <span class="btn-title text-primary-color">Task telah dilakukan pemeriksaan oleh Anda.</span> <?php }else{ ?>
                            <span class="btn-title text-primary-color">Task telah dilakukan pemeriksaan oleh rekan Supervisor.</span> <?php } } } else{ if(Yii::$app->user->identity->id != $task->to_id){?>
                            <span class="btn-title text-primary-color">Task telah dilakukan pemeriksaan oleh rekan QC.</span> <?php }else{?>
                            <span class="btn-title text-primary-color">Task telah dilakukan pemeriksaan oleh Anda.</span> <?php } }?>
                          <?php }else{ ?>
                            <span class="btn-title text-primary-color">Task sedang dilakukan pemeriksaan lebih lanjut oleh rekan Supervisor.</span>
                          <?php } }
                        }else{ if($task->status_id == 5){?>
                          <span class="btn-title">Task ini belum terselesaikan. Apakah Anda telah mengetahui solusi dari task tersebut?</span>
                          <button type="button" class="btn btn-primary acc-now col-12 mt-2" id="give-solution">Berikan solusi sekarang</button>
                        <?php }} ?>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="container-fluid container-profil p-0" style="width:100%">
                        <div class="row mt-4">
                          <div class="col-12">
                            <h5><b>Response Time</b></h5>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-12 pl-2 pr-2">
                            <?php if(empty($task->conf_time_1)){ ?>
                            <div class="tick" data-did-init="handleTickInit1" id="response-time-temp">
                                <div data-repeat="true" data-layout="horizontal fit" data-transform="preset(h, m, s) -> delay">
                                    <div class="tick-group">
                                        <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">
                                            <span data-view="flip"></span>
                                        </div>
                                        <span data-key="label" data-view="text" class="tick-label"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tick d-none" data-did-init="handleTickInit2" id="response-time-real">
                                <div data-repeat="true" data-layout="horizontal fit" data-transform="preset(h, m, s) -> delay">
                                    <div class="tick-group">
                                        <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">
                                            <span data-view="flip"></span>
                                        </div>
                                        <span data-key="label" data-view="text" class="tick-label"></span>
                                    </div>
                                </div>
                            </div>
                          <?php }else{?>
                            <div class="tick" data-did-init="handleTickInit3" id="response-time-done">
                              <div data-layout="horizontal fit">
                                  <span data-key="hours" data-transform="pad(00)" data-view="flip"></span>
                                  <span data-view="text" data-key="sep" class="tick-text-inline"></span>
                                  <span data-key="minutes" data-transform="pad(00)" data-view="flip"></span>
                                  <span data-view="text" data-key="sep" class="tick-text-inline"></span>
                                  <span data-key="seconds" data-transform="pad(00)" data-view="flip"></span>
                              </div>
                            </div>
                          <?php } ?>
                          </div>
                        </div>
                        <?php if($task->jenis_task == "Problem"){ ?>
                        <div class="row mt-4">
                          <div class="col-12">
                            <h5><b>Work Time</b></h5>
                          </div>
                        </div>
                      <?php } ?>
                        <div class="row mt-2">
                          <div class="col-12 pl-2 pr-2">
                            <?php if(empty($task->conf_time_2)){ ?>
                            <div class="tick" data-did-init="handleTickInit1" id="work-time-temp">
                                <div data-repeat="true" data-layout="horizontal fit" data-transform="preset(h, m, s) -> delay">
                                    <div class="tick-group">
                                        <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">
                                            <span data-view="flip"></span>
                                        </div>
                                        <span data-key="label" data-view="text" class="tick-label"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tick d-none" data-did-init="workInit2" id="work-time-real">
                                <div data-repeat="true" data-layout="horizontal fit" data-transform="preset(h, m, s) -> delay">
                                    <div class="tick-group">
                                        <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">
                                            <span data-view="flip"></span>
                                        </div>
                                        <span data-key="label" data-view="text" class="tick-label"></span>
                                    </div>
                                </div>
                            </div>
                          <?php }else{?>
                            <div class="tick" data-did-init="workInit3" id="work-time-done">
                              <div data-layout="horizontal fit">
                                  <span data-key="hours" data-transform="pad(00)" data-view="flip"></span>
                                  <span data-view="text" data-key="sep" class="tick-text-inline"></span>
                                  <span data-key="minutes" data-transform="pad(00)" data-view="flip"></span>
                                  <span data-view="text" data-key="sep" class="tick-text-inline"></span>
                                  <span data-key="seconds" data-transform="pad(00)" data-view="flip"></span>
                              </div>
                            </div>
                          <?php } ?>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
  if ($userNow->id == $task->from_id){
    if(!empty($task->work_time) && (!empty($task->done_time)) && (empty($task->suggestion))){?>
      <script>
      var deadline = new Date('<?= $task->work_time ?>');
      var done_time = new Date('<?= $task->done_time ?>');
      deadline.setHours(deadline.getHours() + 6);
      done_time.setHours(done_time.getHours() + 6);
      </script>
<?php
    }
  }?>
<script type="text/javascript">

  const minuteTimer = 10;
  const minuteToMillis = 600000;

  var date = new Date("<?= $task->created_at ?>");
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  date.setHours(date.getHours() + 6);
  var startTime = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric',hour12: true });

  document.getElementById("tgl=task").innerHTML = date.toLocaleDateString("id-ID", options);
  document.getElementById("detaik-task-start-time").innerHTML = "<b>"+startTime+"</b>"

  var status_id = "<?= $task->status_id ?>"
  <?php if(!empty($task->acc_time)){ ?>
    var acc_time = new Date('<?= $task->acc_time ?>');
    acc_time.setHours(acc_time.getHours() + 6);
    if(acc_time != null && status_id == 2){
      document.getElementById("response-time-temp").className = "tick d-none";
      document.getElementById("response-time-real").className = "tick";
    }
    function handleTickInit2(tick) {

        var localization = {
          HOUR_PLURAL: 'Jam',
          HOUR_SINGULAR: 'Jam',
          MINUTE_PLURAL: 'Menit',
          MINUTE_SINGULAR: 'Menit',
          SECOND_PLURAL: 'Detik',
          SECOND_SINGULAR: 'Detik'
        };

        // loop over localization object and call setConstant method
        for (var key in localization) {
          if (!localization.hasOwnProperty(key)){continue;}
          Tick.options.setConstant(key, localization[key]);
        }

        var offset = new Date( localStorage.getItem('countdown-offset') || acc_time );

        // store the offset (not really necessary but saves some if statements)
        if(status_id == 2){
          localStorage.setItem('countdown-offset', offset);
        }
        var timer = Tick.count.up(offset, { format: ['h','m','s']}).onupdate = function (value) {
          tick.value = value;
          if(localStorage.getItem('countdown-offset') !== null){
            $.ajax({
              type: "POST",
              url: "<?= Yii::$app->urlManager->createAbsoluteUrl('site/updateresponsetime?task_id='.$task->id) ?>",
              success: function() {
              }
            });
            return false;
          }
        };
    }

    function handleTickInit3(tick) {
      var response_time = new Date('<?= $task->response_time ?>');
      response_time.setHours(response_time.getHours() + 6);

      var interval = Tick.helper.duration(acc_time,response_time,['h','m','s']);
      Tick.helper.interval(function(){
          tick.value = {
              sep: ':',
              hours: interval[0],
              minutes: interval[1],
              seconds: interval[2]
          };
      });
    }

  <?php } ?>

  <?php if(!empty($task->work_time)){ ?>
    var work_time = new Date('<?= $task->work_time ?>');
    work_time.setHours(work_time.getHours() + 6);
    if(work_time != null && status_id == 3){
      document.getElementById("work-time-temp").className = "tick d-none";
      document.getElementById("work-time-real").className = "tick";
    }

    function workInit2(tick) {

          var localization = {
            HOUR_PLURAL: 'Jam',
            HOUR_SINGULAR: 'Jam',
            MINUTE_PLURAL: 'Menit',
            MINUTE_SINGULAR: 'Menit',
            SECOND_PLURAL: 'Detik',
            SECOND_SINGULAR: 'Detik'
          };

          // loop over localization object and call setConstant method
          for (var key in localization) {
            if (!localization.hasOwnProperty(key)){continue;}
            Tick.options.setConstant(key, localization[key]);
          }

          var offset = new Date( localStorage.getItem('worktime-offset') || work_time );

          // store the offset (not really necessary but saves some if statements)
          if(status_id == 3){
            localStorage.setItem('worktime-offset', offset);
          }
          var timer = Tick.count.up(offset, { format: ['h','m','s']}).onupdate = function (value) {
            tick.value = value;
            if(localStorage.getItem('worktime-offset') !== null){
              $.ajax({
                type: "POST",
                url: "<?= Yii::$app->urlManager->createAbsoluteUrl('site/updateworktime?task_id='.$task->id) ?>",
                success: function() {
                }
              });
              return false;
            }
          };
      }

    function workInit3(tick) {
      var conf_time_2 = new Date('<?= $task->conf_time_2 ?>');
      conf_time_2.setHours(conf_time_2.getHours() + 6);

      var interval = Tick.helper.duration(work_time,conf_time_2,['h','m','s']);
      Tick.helper.interval(function(){
          tick.value = {
              sep: ':',
              hours: interval[0],
              minutes: interval[1],
              seconds: interval[2]
          };
      });
    }
  <?php } ?>

    function handleTickInit1(tick) {
      var counter = Tick.count.down(new Date(), { format: ['h' ,'m', 's'] } );
      counter.onupdate = function(value) {
          tick.value = value;
      };
      counter.onended = function() {
      };
  }

    $(document).on("click", "#acc-now", function () {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary ml-2 col-4',
          cancelButton: 'btn btn-secondary mr-2 col-4'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Apakah Anda yakin?',
        text: "Setelah menerima task ini, Anda tidak dapat merubah keputusan ini. Dan respone time akan secara otomatis berjalan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Terima sekarang',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        allowOutsideClick: false
      }).then((result) => {
        if (result.isConfirmed) {
          swalWithBootstrapButtons.fire(
            {
              allowOutsideClick: false,
              title: 'Berhasil!',
              text: "Anda berhasil menerima task ini. Silahkan mengunjungi line tersebut untuk melanjutkan proses.",
              icon: 'success',
            }
          ).then((result) => {
            if (result.isConfirmed) {
              window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/accnow') ?>?task_id=<?= $task->id; ?>';
            }
          })
        }
      })
    });

    $(document).on("click", "#process-now", function () {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary ml-2 col-4',
          cancelButton: 'btn btn-secondary mr-2 col-4'
        },
        buttonsStyling: false
      })

      <?php if($task->jenis_task == "Problem"){ ?>
        swalWithBootstrapButtons.fire({
          title: 'Apakah Anda yakin?',
          text: "Setelah mengkonfirmasi pesan ini, aksi tidak dapat diubah kembali. Response time akan berhenti dan work time akan secara otomatis berjalan.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Lanjutkan',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
              {
                allowOutsideClick: false,
                title: 'Berhasil!',
                text: "Konfirmasi berhasil disimpan!",
                icon: 'success',
              }
            ).then((result) => {
              if (result.isConfirmed) {
                  window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/worknow') ?>?task_id=<?= $task->id; ?>';
                  localStorage.removeItem('countdown-offset');
              }
            })
          }
        <?php } else { ?>
          swalWithBootstrapButtons.fire({
            title: 'Apakah Anda yakin?',
            text: "Setelah mengkonfirmasi pesan ini, aksi tidak dapat diubah kembali. Response time akan berhenti.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            allowOutsideClick: false
          }).then((result) => {
            if (result.isConfirmed) {
              swalWithBootstrapButtons.fire(
                {
                  allowOutsideClick: false,
                  title: 'Berhasil!',
                  text: "Konfirmasi berhasil disimpan!",
                  icon: 'success',
                }
              ).then((result) => {
                if (result.isConfirmed) {
                    window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/checknow') ?>?task_id=<?= $task->id; ?>';
                    localStorage.removeItem('countdown-offset');
                }
              })
            }
        <?php } ?>
      })
    });

    $(document).on("click", "#unfinish", function () {
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-primary ml-2 col-4',
              cancelButton: 'btn btn-secondary mr-2 col-4'
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Apakah Anda yakin?',
            text: "Setelah mengkonfirmasi pesan ini, aksi tidak dapat diubah kembali.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            allowOutsideClick: false
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: 'Kotak Pesan',
                html: `<textarea id="suggestion" class="form-control" placeholder="Masukkan pesan rekan Maintener..." rows="3"></textarea>`,
                confirmButtonText: 'Simpan',
                focusConfirm: false,
                allowOutsideClick: false,
                preConfirm: () => {
                  const suggestion = Swal.getPopup().querySelector('#suggestion').value
                  if (!suggestion) {
                    Swal.showValidationMessage(`Silahkan berikan pesan terlebih dahulu!`)
                  }
                  return { suggestion: suggestion }
                }
              }).then((result) => {

                swalWithBootstrapButtons.fire(
                  {
                    allowOutsideClick: false,
                    title: 'Berhasil!',
                    text: "Konfirmasi berhasil disimpan!",
                    icon: 'success',
                    preConfirm:() => {
                      const suggestion = result.value.suggestion
                      return{suggestion:suggestion,result:false}
                    }
                  }
                ).then((result) => {
                  if (result.isConfirmed) {
                    window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/finishnow') ?>?task_id=<?= $task->id; ?>&suggestion='+result.value.suggestion+'&result='+result.value.result;
                    localStorage.removeItem('worktime-offset');
                  }
                })
              })
            }
          })
        });

    $(document).on("click", "#give-solution", function () {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary ml-2 col-4',
          cancelButton: 'btn btn-secondary mr-2 col-4'
        },
        buttonsStyling: false
      })
      swalWithBootstrapButtons.fire({
        title: 'Kotak Solusi',
        html: `<textarea id="solution" class="form-control" placeholder="Masukkan solusi problem pada task..." rows="3"></textarea>`,
        confirmButtonText: 'Simpan',
        focusConfirm: false,
        allowOutsideClick: false,
        preConfirm: () => {
          const solution = Swal.getPopup().querySelector('#solution').value
          if (!solution) {
            Swal.showValidationMessage(`Silahkan berikan solusi terlebih dahulu!`)
          }
          return { solution: solution }
        }
      }).then((result) => {
        swalWithBootstrapButtons.fire({
          title: 'Apakah Anda yakin?',
          text: "Setelah mengkonfirmasi pesan ini, aksi tidak dapat diubah kembali.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Lanjutkan',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          allowOutsideClick: false,
          preConfirm:() => {
            const solution = result.value.solution
            return{solution:solution}
          }
        }).then((result) => {
          if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
            {
              allowOutsideClick: false,
              title: 'Berhasil!',
              text: "Konfirmasi berhasil disimpan!",
              icon: 'success',
              preConfirm:() => {
                const solution = result.value.solution
                return{solution:solution,result:true}
              }
            }
          ).then((result) => {
            if (result.isConfirmed) {
              window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/finishnow') ?>?task_id=<?= $task->id; ?>&solution='+result.value.solution+'&result='+result.value.result;
              localStorage.removeItem('worktime-offset');
            }
          })
        }
        })
      })
    })

    $(document).on("click", "#finish", function () {
      <?php if($task->jenis_task == "Problem"){ ?>
        swalWithBootstrapButtons.fire({
          title: 'Apakah Anda yakin?',
          text: "Setelah mengkonfirmasi pesan ini, aksi tidak dapat diubah kembali.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Lanjutkan',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Kotak Solusi',
              html: `<textarea id="solution" class="form-control" placeholder="Masukkan solusi problem pada task..." rows="3"></textarea>`,
              confirmButtonText: 'Simpan',
              focusConfirm: false,
              allowOutsideClick: false,
              preConfirm: () => {
                const solution = Swal.getPopup().querySelector('#solution').value
                if (!solution) {
                  Swal.showValidationMessage(`Silahkan berikan solusi terlebih dahulu!`)
                }
                return { solution: solution }
              }
            }).then((result) => {
              swalWithBootstrapButtons.fire(
              {
                allowOutsideClick: false,
                title: 'Berhasil!',
                text: "Konfirmasi berhasil disimpan!",
                icon: 'success',
                preConfirm:() => {
                  const solution = result.value.solution
                  return{solution:solution,result:true}
                }
              }
            ).then((result) => {
              if (result.isConfirmed) {
                window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/finishnow') ?>?task_id=<?= $task->id; ?>&solution='+result.value.solution+'&result='+result.value.result;
                localStorage.removeItem('worktime-offset');
              }
              })
            })
          }
        })
      <?php } else { ?>
        swalWithBootstrapButtons.fire({
          title: 'Apakah Anda yakin?',
          text: "Setelah mengkonfirmasi pesan ini, aksi tidak dapat diubah kembali.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Lanjutkan',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Kotak Saran',
              html: `<textarea id="saran" class="form-control" placeholder="Masukkan saran rekan QC..." rows="3"></textarea>`,
              confirmButtonText: 'Simpan',
              focusConfirm: false,
              allowOutsideClick: false,
              preConfirm: () => {
                const saran = Swal.getPopup().querySelector('#saran').value
                if (!saran) {
                  Swal.showValidationMessage(`Silahkan berikan saran terlebih dahulu!`)
                }
                return { saran: saran }
              }
            }).then((result) => {
              swalWithBootstrapButtons.fire(
              {
                allowOutsideClick: false,
                title: 'Berhasil!',
                text: "Konfirmasi berhasil disimpan!",
                icon: 'success',
                preConfirm:() => {
                  const saran = result.value.saran
                  return{saran:saran}
                }
              }
            ).then((result) => {
              if (result.isConfirmed) {
                window.location='<?= Yii::$app->urlManager->createAbsoluteUrl('site/checkdone') ?>?task_id=<?= $task->id; ?>&saran='+result.value.saran;
              }
              })
            })
          }
        })
      <?php } ?>
    });
</script>
