<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message success" onclick="this.classList.add('hidden')"><?= $message ?></div>-->
<div class="alert alert-success toaster alert-dismissable" onclick="this.classList.add('hidden');"><?= $message ?></div>
