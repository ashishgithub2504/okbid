<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horses
        <small>All Horses List</small>
    </h1>
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
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-circle-o"></i> <span
                            class="caption-subject font-green bold uppercase">Horses</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Horse'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <?php
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        ?>
                        <div class="col-md-3">
                            <label for="keyword">Keyword</label>

                            <div class="input-group">
                                <?php echo $this->Form->input('keyword', ['class' => 'form-control input-sm pull-right', 'placeholder' => 'Keyword', 'label' => false, 'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : '']); ?>
                                <div class="input-group-btn">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('fei_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('eef_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('chipid') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('birth_name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('dob') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('height') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('sire') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('dam') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('color') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('breed') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('country_birth') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($horses) > 0):
                            foreach ($horses as $horse): ?>
                            <tr>
                                <td><?= $this->Number->format($horse->id) ?></td>
                                <td><?= h($horse->fei_number) ?></td>
                                <td><?= h($horse->eef_number) ?></td>
                                <td><?= h($horse->chipid) ?></td>
                                <td><?= h($horse->birth_name) ?></td>
                                <td><?= h($horse->name) ?></td>
                                <td><?= h($horse->image) ?></td>
                                <td><?php if ($horse->dob != "") echo $horse->dob->format('d-M-Y'); ?></td>
                                <td><?= h($horse->height) ?></td>
                                <td><?= h($horse->sire) ?></td>
                                <td><?= h($horse->dam) ?></td>
                                <td><?= $this->Number->format($horse->gender) ?></td>
                                <td><?= h($horse->color) ?></td>
                                <td><?= h($horse->breed) ?></td>
                                <td><?= h($horse->country_birth) ?></td>
                                <td><?= $this->Number->format($horse->status) ?></td>
                                <td><?php if ($horse->created != "") echo $horse->created->format('d-M-Y'); ?></td>
                                <td><?php if ($horse->modified != "") echo $horse->modified->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $horse->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $horse->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $horse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horse->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Horse Found</strong> </td> </tr>";
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>