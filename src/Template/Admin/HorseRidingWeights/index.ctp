<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
$ridingType = Configure::read('RIDING_TYPE');

?>
<section class="content-header">
    <h1>
        Manage Horse Riding Weights
        <small>All Horse Riding Weights List</small>
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
                            class="caption-subject font-green bold uppercase">Horse Riding Weights</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Horse Riding Weight'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('horse_id','Horse Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('riding_type') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('before_weight') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('after_weight') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight_date','Weight diffrence') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($horseRidingWeights) > 0):
                            foreach ($horseRidingWeights as $horseRidingWeight): ?>
                            <tr>
                                <td><?= $this->Number->format($horseRidingWeight->id) ?></td>
                                <td><?= $horseRidingWeight->has('horse') ? $this->Html->link($horseRidingWeight->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseRidingWeight->horse->id]) : '' ?></td>
                                <td><?= $ridingType[$horseRidingWeight->riding_type]; ?></td>
                                <td><?= $this->Number->format($horseRidingWeight->before_weight) ?></td>
                                <td><?= $this->Number->format($horseRidingWeight->after_weight) ?></td>
                                <td><?= h($horseRidingWeight->weight_date->format('d-M-Y')) ?></td>
                                <td><?= $this->Number->format($horseRidingWeight->after_weight - $horseRidingWeight->before_weight) ?></td>
                                
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $horseRidingWeight->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $horseRidingWeight->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $horseRidingWeight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horseRidingWeight->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Horse Riding Weight Found</strong> </td> </tr>";
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