<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Groups
        <small>Groups info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($group->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($group->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($group->status == 1)?'Active':'DeActive'; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>