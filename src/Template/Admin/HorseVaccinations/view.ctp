<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Vaccinations
        <small>Horse Vaccinations info</small>
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
                            <td><?= $horseVaccination->has('horse') ? $this->Html->link($horseVaccination->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseVaccination->horse->id]) : '' ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Vaccination Date') ?></th>
                            <td><?= h($horseVaccination->vaccination_date->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($horseVaccination->status == 1)?'Active':'InActive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horseVaccination->created->format('d-M-Y')) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>