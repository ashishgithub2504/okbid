<?php
/**
  * @var \App\View\AppView $this
  */
$loop = array(0,1,2,3,4);
$cmon = isset($_GET['month'])?$_GET['month']:'1';
?>
<section class="content-header">
    <h1>
        Manage Horse Weights
        <small>All Horse Weights List</small>
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
                            class="caption-subject font-green bold uppercase">Horse Weights</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Horse Weight'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <?php echo $this->Form->input('month', ['type'=>'select','options'=>$months,'value'=>$cmon,'class' => 'form-control input-sm pull-right', 'placeholder' => 'Keyword', 'label' => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('month','Month') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight','Horse Weight( 1st Friday)') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight','Horse Weight ( 2nd Friday)') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight','Horse Weight ( 3nd Friday)') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight','Horse Weight ( 4nd Friday)') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('weight','Horse Weight ( 5nd Friday)') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($horseWeights) > 0):
                            foreach ($horseWeights as $horseWeight): ?>
                            <?php $mweight = $this->Custom->getweightbymonth($cmon,$horseWeight['horse_id']); ?>
                            <?php if(!empty($mweight)){ ?>
                            <tr>
                                <td><?= $this->Number->format($horseWeight->id) ?></td>
                                <td><?= $horseWeight->has('horse') ? $this->Html->link($horseWeight->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseWeight->horse->id]) : '' ?></td>
                                <td><?= $months[$cmon]; ?></td>
                                <?php if(!empty($mweight)){
                                    $last = 0;
                                    foreach ($loop as $k=>$v){ ?>
                                <td>
                                    <?= $now = !empty($mweight[$k]['weight'])?$mweight[$k]['weight']:''; ?>
                                    <strong>(<?= ((int)$now - (int)$last)?>)</strong>
                                </td>
                                    <?php $last = $now; }
                                }else{
                                    echo "<td></td><td></td><td></td><td></td><td></td>";
                                } ?>
                                
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $horseWeight->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $horseWeight->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $horseWeight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horseWeight->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Horse Weight Found</strong> </td> </tr>";
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