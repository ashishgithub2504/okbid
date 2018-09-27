<section class="content-header">
    <h1>
        Manage Cms pages <small>Cms page info</small>
    </h1>
    <?php //echo $this->element('breadcrumb', array('pageName' => $this->request->params['controller'] . '_view')); ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($record->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Title') ?></th>
                            <td><?= h($record->title) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Alias') ?></th>
                            <td><?= h($record->alias) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Meta Title') ?></th>
                            <td><?= h($record->meta_title) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Meta Keyword') ?></th>
                            <td><?= h($record->meta_keyword) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td>
                                <?php
                                if ($record->created != "") {
                                    echo $record->created->format('d-M-Y');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td>
                                <?php
                                if ($record->modified != "") {
                                    echo $record->modified->format('d-M-Y');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?php
                                if ($record->status == 1) {
                                    echo '<span class="label label-success"> Active </span>';
                                } else {
                                    echo '<span class="label label-danger"> Inactive </span>';
                                }
                                ?></td>
                        </tr>
                    </table>
                </div>
                <div class="content">
                    <div class="row">
					<div class="col-xs-12">
                        <h5><strong><?= __('Description') ?></strong></h5>
                        <?= $this->Text->autoParagraph($record->description); ?>
                    </div>
					 </div>
                    <div class="row">
					<div class="col-xs-12">
                        <h5><strong><?= __('Meta Description') ?></strong></h5>
                        <?= $this->Text->autoParagraph($record->meta_description); ?>
                    </div>
					 </div>
                </div>
            </div>
        </div>
    </div>
</section>