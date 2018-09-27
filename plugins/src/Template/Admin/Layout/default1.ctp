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

use Cake\Core\Configure;
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
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php
        if (isset($cssIncludes) && $cssIncludes != '') {
            foreach ($cssIncludes as $css) {
                echo $this->Html->css($css);
            }
        }
        echo $this->Html->css(['/assets/bootstrap/css/bootstrap.min.css', '/assets/plugins/font-awesome/css/font-awesome.min.css', '/assets/plugins/ionicons/css/ionicons.min.css', '/assets/dist/css/AdminLTE.min.css', '/assets/dist/css/skins/_all-skins.min.css', '/assets/plugins/iCheck/square/blue.css', '/assets/plugins/morris/morris.css', '/assets/plugins/datepicker/datepicker3.css', '/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', '/assets/plugins/gritter/css/jquery.gritter.css']);
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
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php echo $this->element("header"); ?>
            <?php echo $this->element("sidebar"); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; <?php echo date("Y"); ?> <a
                        href="#"><?php echo $SettingConfig['sitename']; ?></a>.</strong> All rights reserved.
            </footer>
        </div>
        <?php
//echo $this->Html->script(['/assets/plugins/jQuery/jQuery-2.1.4.min.js', '/assets/bootstrap/js/bootstrap.min.js', '/assets/plugins/morris/morris.min', '/assets/plugins/sparkline/jquery.sparkline.min', '/assets/plugins/daterangepicker/daterangepicker', '/assets/plugins/datepicker/bootstrap-datepicker', '/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', '/assets/plugins/gritter/js/jquery.gritter', '/assets/plugins/slimScroll/jquery.slimscroll.min', '/assets/plugins/fastclick/fastclick.min', '/assets/dist/js/app.min.js', '/assets/dist/js/demo', '/assets/plugins/ckeditor/ckeditor', 'jquery.validate.min.js', 'additional-methods.js']);
        echo $this->Html->script(['/assets/plugins/jQuery/jQuery-2.1.4.min.js', '/assets/bootstrap/js/bootstrap.min.js', '/assets/plugins/morris/morris.min', '/assets/plugins/sparkline/jquery.sparkline.min', '/assets/plugins/datepicker/bootstrap-datepicker', '/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', '/assets/plugins/gritter/js/jquery.gritter', '/assets/plugins/slimScroll/jquery.slimscroll.min', '/assets/plugins/fastclick/fastclick.min', '/assets/dist/js/app.min.js', '/assets/dist/js/demo', '/assets/plugins/ckeditor/ckeditor']);
        ?>

        <?php
        if (isset($jsIncludes) && $jsIncludes != '') {
            foreach ($jsIncludes as $js) {
                echo $this->Html->script($js);
            }
        }
        ?>
        
        <?= $this->fetch('script') ?>
        <style type="text/css">
            .badge{     padding: 3px 6px; }
            .skin-blue .main-header .logo {
                background-color: #cc920e;
                color: #fff;
                border-bottom: 0 solid transparent;
            }
            .skin-blue .main-header .logo:hover {
                background-color: #cc920e;
                color: #fff;
                border-bottom: 0 solid transparent;
            }
            
            .divider{ float: left; }
            .main-sidebar{ position: fixed; }
        </style>
        
    </body>
</html>
