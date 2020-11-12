<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
$this->registerAssetBundle('app\assets\auth\LoginAsset');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.0/socket.io.js" integrity="sha512-FPJNGVqbetcAGvuJTpWqVuaOim5C5pyV+JaiAOxtBgsOWy0aiOLM9k5Nh7ikpSzUoz2Tb9Ue6zYWICDr9zZ5+g==" crossorigin="anonymous"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    //$this->registerCssFile("@web/css/login.css",['media' => 'screen']);
    ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
  <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
