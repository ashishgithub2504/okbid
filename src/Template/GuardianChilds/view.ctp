<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Guardian Childs
        <small>Guardian Childs info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Guardian') ?></th>
                            <td><?= $guardianChild->has('guardian') ? $this->Html->link($guardianChild->guardian->name, ['controller' => 'Guardians', 'action' => 'view', $guardianChild->guardian->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($guardianChild->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Child Id') ?></th>
                            <td><?= $this->Number->format($guardianChild->child_id) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>