<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;
?>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-12 m-0 p-0" style="">
            <div class="container-fluid container-profil" style="width:100%">
                <div class="row header">
                    <div class="col-4 d-flex justify-content-center">
                        <a href="profile" class="content-title p-2 pt-4">Ubah Profil</a>
                    </div>
                    <div class="col-4 d-flex justify-content-center sub-title-active">
                        <a href="notifsetting" class="content-title p-2 pt-4">Notifikasi</a>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <a href="notifsetting" class="content-title p-2 pt-4">Ubah Kata Sandi</a>
                    </div>
                </div>
                <div class="row contents">
                    <div class="col-12 m-0 p-0">
                          <div class="row align-items-center m-0 p-0" style="margin-top:calc(1% + 1vw)!important">
                              <div class="col-6">
                                  <span class="content-title">Push Notifications</span>
                              </div>
                              <div class="col-6">
                                <div class="toggle-switch">
                                  <input type="checkbox" id="toggle-switch-1">
                                  <label for="toggle-switch-1"></label>
                                </div>
                              </div>
                          </div>
                          <div class="row  m-0 p-0 detail-content">
                              <div class="col-12">
                                  <p class="content-desc text-justify">Gunakan <i><b>Push Notifications</b></i> untuk mencari tahu apa yang terjadi saat Anda tidak menggunakan Escalation Apps. Anda dapat mematikannya kapan saja.</p>
                              </div>
                          </div>
                          <div class="detail-push-notif">
                            <div class="row detail-content m-0 p-0">
                                <div class="col-12">
                                    <span class="d-inline-block text-center content-title" style="width:100%;"><b>Nyalakan push notifications</b></span>
                                    <p class="d-inline-block text-center mt-2 content-desc">Untuk menerima notifikasi saat terjadi, aktifkan notifikasi push. Anda juga akan menerimanya saat Anda tidak menggunakan Twitter. Matikan mereka kapan saja.</p>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="col-12 d-flex justify-content-center ">
                                    <?= Html::submitButton('<b>Nyalakan</b>', ['class' => 'btn btn-primary', 'id' => 'turn-on-pn']) ?>
                                </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
