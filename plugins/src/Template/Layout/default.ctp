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
<html class="no-js">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php
    if (isset($cssIncludes) && $cssIncludes != '') {
        foreach ($cssIncludes as $css) {
            echo $this->Html->css($css);
        }
    }
    echo $this->Html->css(['front/bootstrap.min.css','front/bootstrap-theme.min.css', 'front/fonts.css', 'front/royalslider.css', 'front/__packed.css','front/main_style.css', 'front/theme.css', 'front/responsive.css']);
    ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->meta('favicon.ico', '/uploads/settings/' . $SettingConfig['favicon'], ['type' => 'icon']); ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        <?php
          $this->Html->scriptStart(['block' => true]);
        ?>
        var baseurl = '<?php echo $this->request->webroot; ?>';

        <?php
         $this->Html->scriptEnd();
        ?>
    </script>
</head>
<body class="theme_skin_kinder">
    <div id="box_wrapper">
        <?= $this->Flash->render() ?>
        <?= $this->element('header') ?>
        <?= $this->fetch('content') ?>
        <?= $this->element('footer') ?>
    </div>
    <div id="preloader" class="preloader">
        <div id="preloader_image" class="preloader_image"></div>
    </div>
    <?php
        echo $this->Html->script(['front/vendor/jquery-1.11.3.min.js', 'front/vendor/bootstrap.min.js', 'front/vendor/jquery.ui.totop.js', 'front/main/__packed.js', 'front/main/shortcodes_init.js', 'front/main/_main.js','front/vendor/jquery.elevateZoom-3.0.8.min.js']);
    ?>

    <?php    
    if (isset($jsIncludes) && $jsIncludes != '') {
        foreach ($jsIncludes as $js) {
            echo $this->Html->script($js);
        }
    }
    ?>
    <?= $this->fetch('script') ?>
</body>
</html>
