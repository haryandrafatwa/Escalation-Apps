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
            <div class="container-fluid p-3" style="width:100%">
                <div class="row d-flex">
                    <div class="col-9 p-0 mt-4 d-flex justify-content-between">
                      <span class="notif-title">Notifikasi</span>
                      <span class="read-all d-flex align-items-center">Baca Semua</span>
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col-9 p-0 mt-3 notif-content">
                        <div class="container">
                            <div class="row">
                              <div class="col-1 p-0 m-0 align-self-center">
                                  <?= Html::img(Url::to('@web/images/total_tasks.svg'), ['alt' => 'My logo','style'=>'width:100%','class'=>'ic-task-onprogress']) ?>
                              </div>
                              <div class="col-9 p-0 pl-3 pr-3 m-0">
                                <div class="row p-0 m-0 d-flex">
                                    <span class="notif-item-date">11 November 2020 | 10:23</span>
                                </div>
                                <div class="row p-0 m-0">
                                    <span class="notif-item-content line-clamp">Memperbaiki - Ditugaskan kepada Aditya Maulana Ditugaskan kepada Aditya Maulana Ditugaskan kepada Aditya Maulana Ditugaskan kepada Aditya Maulana Ditugaskan kepada Aditya Maulana</span>
                                </div>
                              </div>
                              <div class="col-1 p-0 m-0 align-self-center">
                                  <?= Html::img(Url::to('@web/images/circle_blue.svg'), ['alt' => 'My logo','style'=>'width:calc(10% + 1vw)','class'=>'d-flex ml-auto mr-auto']) ?>
                              </div>
                              <div class="col-1 p-0 m-0 align-self-center">
                                  <i class="fas fa-chevron-right ic-chevron d-flex justify-content-center"></i>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
