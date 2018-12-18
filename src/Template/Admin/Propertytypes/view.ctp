<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Propertytypes
        <small>Propertytypes info</small>
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
                            <td><?= h($propertytype->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Namehr') ?></th>
                            <td><?= h($propertytype->namehe) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Category') ?></th>
                            <td><?= $propertytype->has('category') ? $this->Html->link($propertytype->category->name, ['controller' => 'Categories', 'action' => 'view', $propertytype->category->id]) : '' ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($propertytype->status == '1')?'Active':'InActive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($propertytype->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($propertytype->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>