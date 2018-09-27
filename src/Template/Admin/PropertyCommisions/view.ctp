<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Property Commisions
        <small>Property Commisions info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Sub Category') ?></th>
                            <td><?= h($propertyCommision->sub_category) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($propertyCommision->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Category') ?></th>
                            <td><?= $this->Number->format($propertyCommision->category) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Commision') ?></th>
                            <td><?= $this->Number->format($propertyCommision->commision) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($propertyCommision->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($propertyCommision->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($propertyCommision->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>