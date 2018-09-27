<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = $SettingConfig['sitename'];
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
        <?php echo $this->Html->css(['/assets/bootstrap/css/bootstrap.min.css', '/assets/plugins/font-awesome/css/font-awesome.min.css', '/assets/plugins/ionicons/ionicons.min.css', '/assets/dist/css/AdminLTE.min.css', '/assets/plugins/iCheck/square/blue.css']); ?>
          <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->Html->meta('favicon.ico', '/uploads/settings/' . $SettingConfig['favicon'], ['type' => 'icon']); ?>
        <?= $this->fetch('script') ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122212886-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122212886-1');
</script>

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <?php //echo $SettingConfig['sitename']; ?>
               <?php  echo $this->Html->image('/uploads/settings/'.$SettingConfig['sitelogo'], ["class" => "logo-default", "alt" => "","width"=>360]);
            ?>
            </div>
             <?= $this->Flash->render() ?>
             <?= $this->fetch('content') ?>
        </div>
        <?php
        echo $this->Html->script(['/assets/plugins/jQuery/jQuery-2.1.4.min.js', '/assets/bootstrap/js/bootstrap.min.js', '/assets/plugins/iCheck/icheck.min.js']);
        ?>
        <style type="text/css">
    .hold-transition.login-page {
        background-image:   url("img/filter.png");
    }
</style>
    </body>
</html>
