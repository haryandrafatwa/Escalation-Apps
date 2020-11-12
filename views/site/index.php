<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;

$this->registerAssetBundle('app\assets\DashboardAsset');
?>
<div class="container-fluid p-0 main-container" id="desktop-version">
    <div class="row">
        <div class="col-7">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= Yii::$app->session->getFlash('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <div class="row">
                <span class="header-text" id="dashboard-txt">Dashboard</span>
            </div>
            <div class="row" style="margin-top: calc(1% + 0.5vw)">
                <div class="chart-container" style="height:100%; width:100%">
                    <span class="sub-title">Task di Minggu Ini</span>
                    <canvas id="myChartDesktop" style="margin-top: calc(0.5% + 0.5vw)"></canvas>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                <div class="recent-task">
                    <div class="container-fluid">
                        <div class="row" style="padding-left:1%;padding-top:2%;padding-right:2%;padding-bottom:2%">
                            <div class="col align-self-center">
                                <span class="sub-title" style="">Task Terkini</span>
                            </div>
                            <div class="col align-self-center">
                                <span class="view-all" style="float:right">Lihat Semua</span>
                            </div>
                        </div>
                        <div class="row" style="">
                            <div class="col-12 p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-secondary">
                                          <tr>
                                            <th class="pl-4" scope="col">Nama</th>
                                            <th class="" scope="col">Task</th>
                                            <th class="" scope="col">Line</th>
                                            <th class="" scope="col">Jam Mulai</th>
                                            <th class="" scope="col">Deskripsi</th>
                                            <th class="pr-4" scope="col">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th class="pl-4">
                                                <div class="row p-0 m-0">
                                                    Haryandra Fatwa
                                                </div>
                                                <div class="row p-0 m-0 divisi-text">
                                                    Divisi Manufacturing
                                                </div></th>
                                            <th class="">Problem</th>
                                            <th class="">Liquid-01</th>
                                            <th class="">10.00 AM</th>
                                            <th class="">Mesin tidak mau menyala.</th>
                                            <th class="pr-4">Diterima</th>
                                          </tr>
                                            <tr>
                                              <th class="pl-4">
                                                  <div class="row p-0 m-0">
                                                      Haryandra Fatwa
                                                  </div>
                                                  <div class="row p-0 m-0" style="font-size:calc(1% + 0.7vw);color:#999">
                                                      Divisi Manufacturing
                                                  </div></th>
                                              <th class="">Problem</th>
                                              <th class="">Liquid-01</th>
                                              <th class="">10.00 AM</th>
                                              <th class="">Mesin tidak mau menyala.</th>
                                              <th class="pr-4">Diterima</th>
                                            </tr>
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
        <div class="col-5">
            <div class="row ml-0">
                <div class="task-onprogress" style="width:100%">
                    <div class="container-fluid pr-0">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <span class="sub-title" style="">Task Sedang Berlangsung</span>
                            </div>
                            <div class="col-4 align-self-center">
                                <span class="view-all" style="float:right">Lihat Semua</span>
                            </div>
                        </div>
                        <div class="row m-0 task-onprogress-items mt-2">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-1 m-0">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress">Problem | Liquid-01</span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                        <div class="row m-0 task-onprogress-items mt-2">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-1 m-0">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress">Problem | Liquid-01</span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                        <div class="row m-0 task-onprogress-items mt-2">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-1 m-0">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress">Problem | Liquid-01</span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-0 main-container" id="mobile-version" style="display:none;width:100%">
    <div class="row" style="">
        <div class="col-12">
            <div class="row">
                <span class="header-text">Dashboard</span>
            </div>
            <div class="row" style="margin-top: calc(1% + 0.5vw);">
                <div class="chart-container" style="height:100%; width:100%">
                    <span class="sub-title">Task di Minggu Ini</span>
                    <canvas id="myChartMobile" style="margin-top: calc(0.5% + 0.5vw)"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="container-fluid p-0 m-0">
                <div class="row" style="margin-top: calc(1% + 2.5vw);">
                    <!-- Total Task  -->
                    <div class="col p-0 m-0" style="">
                      <div class="preview-layout">
                          <div class="row p-0 m-0" style="">
                            <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:20%','class'=>'']) ?>
                          </div>
                          <div class="row p-0 m-0">
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
                            <span class="nominal-text" style="margin-top: calc(7% + 1vw);">74</span>
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
    <div class="row" style="margin-top: calc(1% + 2.5vw);">
        <div class="col-12">
            <div class="row">
                <div class="recent-task">
                    <div class="container-fluid">
                        <div class="row" style="padding-left:1%;padding-top:2%;padding-right:2%;padding-bottom:2%">
                            <div class="col align-self-center">
                                <span class="sub-title" style="">Task Terkini</span>
                            </div>
                            <div class="col align-self-center">
                                <span class="view-all" style="float:right">Lihat Semua</span>
                            </div>
                        </div>
                        <div class="row" style="">
                            <div class="col-12 p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-secondary">
                                          <tr>
                                            <th class="pl-4" scope="col">Nama</th>
                                            <th class="" scope="col">Task</th>
                                            <th class="" scope="col">Line</th>
                                            <th class="" scope="col">Jam Mulai</th>
                                            <th class="" scope="col">Deskripsi</th>
                                            <th class="pr-4" scope="col">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th class="pl-4">
                                                <div class="row p-0 m-0">
                                                    Haryandra Fatwa
                                                </div>
                                                <div class="row p-0 m-0 divisi-text">
                                                    Divisi Manufacturing
                                                </div></th>
                                            <th class="">Problem</th>
                                            <th class="">Liquid-01</th>
                                            <th class="">10.00 AM</th>
                                            <th class="">Mesin tidak mau menyala.</th>
                                            <th class="pr-4">Diterima</th>
                                          </tr>
                                            <tr>
                                              <th class="pl-4">
                                                  <div class="row p-0 m-0">
                                                      Haryandra Fatwa
                                                  </div>
                                                  <div class="row p-0 m-0 divisi-text">
                                                      Divisi Manufacturing
                                                  </div></th>
                                              <th class="">Problem</th>
                                              <th class="">Liquid-01</th>
                                              <th class="">10.00 AM</th>
                                              <th class="">Mesin tidak mau menyala.</th>
                                              <th class="pr-4">Diterima</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="task-onprogress" style="width:100%">
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0 mb-2">
                            <div class="col-8 align-self-center p-0">
                                <span class="sub-title">Task Sedang Berlangsung</span>
                            </div>
                            <div class="col-4 align-self-center p-0">
                                <span class="view-all" style="float:right">Lihat Semua</span>
                            </div>
                        </div>
                        <div class="row m-0 p-0 task-onprogress-items">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-3 m-0 align-self-center">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress">Problem | Liquid-01</span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                        <div class="row m-0 task-onprogress-items mt-2">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-3 m-0 align-self-center">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress">Problem | Liquid-01</span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                        <div class="row m-0 task-onprogress-items mt-2">
                            <div class="col-1 p-0 m-0 align-self-center">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                            </div>
                            <div class="col-10 p-0 pl-3 m-0 align-self-center">
                              <div class="row p-0 m-0">
                                  <span class="title-task-onprogress">Problem | Liquid-01</span>
                              </div>
                              <div class="row p-0 m-0">
                                  <span class="content-task-onprogress">Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 p-0 m-0 pl-3 align-self-center">
                                <i class="fas fa-chevron-right ic-chevron"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
