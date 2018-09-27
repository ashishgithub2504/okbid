<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Reports
        <small>Reports info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Fei Number') ?></th>
                            <td><?= h($report->fei_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Eef Number') ?></th>
                            <td><?= h($report->eef_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Chipid') ?></th>
                            <td><?= h($report->chipid) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Birth Name') ?></th>
                            <td><?= h($report->birth_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($report->id) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>