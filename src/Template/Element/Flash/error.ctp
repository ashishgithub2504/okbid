<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>-->
<div class="alert alert-danger toaster alert-dismissable" onclick="this.classList.add('hidden');"><?= $message ?></div>
