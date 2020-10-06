<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
?>
<div class="container-fluid p-0 main-container">
    <div class="row">
        <div class="col-7">
            <div class="row">
                <span class="header-text">Dashboard</span>
            </div>
            <div class="row" style="margin-top: calc(1% + 0.5vw)">
                <div class="chart-container" style="height:100%; width:100%">
                    <span class="sub-title">Task di Minggu Ini</span>
                    <canvas id="myChart" style="margin-top: calc(0.5% + 0.5vw)"></canvas>
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
                                            <th class="pl-4" scope="col">Task</th>
                                            <th class="pl-4" scope="col">Line</th>
                                            <th class="pl-4" scope="col">Jam Mulai</th>
                                            <th class="pl-4" scope="col">Deskripsi</th>
                                            <th class="pr-4" scope="col">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th class="pl-4" >
                                                <div class="row p-0 m-0">
                                                    Haryandra Fatwa
                                                </div>
                                                <div class="row p-0 m-0" style="font-size:10px;color:#999">
                                                    Divisi Manufacturing
                                                </div>
                                            </th>
                                            <th class="pl-4" >Problem</th>
                                            <th class="pl-4" >Liquid-01</th>
                                            <th class="pl-4" >10.00 AM</th>
                                            <th class="pl-4" >Mesin tidak mau menyala.</th>
                                            <th class="pr-4" >Diterima</th>
                                          </tr>
                                          <tr>
                                            <th class="pl-4" >
                                                <div class="row p-0 m-0">
                                                    Haryandra Fatwa
                                                </div>
                                                <div class="row p-0 m-0" style="font-size:10px;color:#999">
                                                    Divisi Manufacturing
                                                </div>
                                            </th>
                                            <th class="pl-4" >Problem</th>
                                            <th class="pl-4" >Liquid-01</th>
                                            <th class="pl-4" >10.00 AM</th>
                                            <th class="pl-4" >Mesin tidak mau menyala.</th>
                                            <th class="pr-4" >Diterima</th>
                                          </tr>
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th colspan="6"></th>
                                          </tr>
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
                            <div class="col align-self-center">
                                <span class="sub-title" style="">Task Sedang Berlangsung</span>
                            </div>
                            <div class="col align-self-center">
                                <span class="view-all" style="float:right">Lihat Semua</span>
                            </div>
                        </div>
                        <div class="row m-0 task-onprogress-items mt-2">
                            <div class="col-1 p-0">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'']) ?>
                            </div>
                            <div class="col-10" style="padding-left:5%">
                              <div class="row">
                                  <span>Problem | Liquid-01</span>
                              </div>
                              <div class="row">
                                  <span>Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 align-self-center">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                        <div class="row m-1 task-onprogress-items mt-2">
                            <div class="col-1 p-0">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'']) ?>
                            </div>
                            <div class="col-10" style="padding-left:5%">
                              <div class="row">
                                  <span>Problem | Liquid-01</span>
                              </div>
                              <div class="row">
                                  <span>Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 align-self-center">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                        <div class="row m-1 task-onprogress-items mt-2">
                            <div class="col-1 p-0">
                                <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'']) ?>
                            </div>
                            <div class="col-10" style="padding-left:5%">
                              <div class="row">
                                  <span>Problem | Liquid-01</span>
                              </div>
                              <div class="row">
                                  <span>Memperbaiki - Ditugaskan kepada Aditya Maulana</span>
                              </div>
                            </div>
                            <div class="col-1 align-self-center">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
