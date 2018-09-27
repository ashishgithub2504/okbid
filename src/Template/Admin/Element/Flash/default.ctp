<?php
$class = 'alert alert-success';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="<?= h($class) ?>">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button"></button> 
<?= h($message) ?>
</div>
