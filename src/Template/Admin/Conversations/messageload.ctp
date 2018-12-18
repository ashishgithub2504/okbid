<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
    if (!empty($mess)) {
        foreach ($mess['chats'] as $key => $val) {
            $class = 'darker';
            $time = 'time-left';
            if ($auth != $val['sender_id']) {
                $class = '';
                $time = 'time-right';
            }
            ?>
            <div class="containernew <?= $class; ?>">
                <p><?= !empty($val['chat']) ? $val['chat'] : ''; ?>
                <b>(<?= $this->Custom->getUserName($val['sender_id']); ?>)</b>
                </p>
                <span class="<?= $time; ?>"><?= date('d-M-Y H:i A', strtotime($val['created'])); ?></span>
            </div>
        <?php }
    }
    ?>    