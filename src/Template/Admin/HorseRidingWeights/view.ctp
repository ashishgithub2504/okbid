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
        <small>Horse Riding Weights info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Horse') ?></th>
                            <td><?= $horseRidingWeight->has('horse') ? $this->Html->link($horseRidingWeight->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseRidingWeight->horse->id]) : '' ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Riding Type') ?></th>
                            <td><?= $ridingType[$horseRidingWeight->riding_type] ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Before Weight') ?></th>
                            <td><?= $this->Number->format($horseRidingWeight->before_weight) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('After Weight') ?></th>
                            <td><?= $this->Number->format($horseRidingWeight->after_weight) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Weight Date') ?></th>
                            <td><?= h($horseRidingWeight->weight_date->format('d-M-Y')) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horseRidingWeight->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>