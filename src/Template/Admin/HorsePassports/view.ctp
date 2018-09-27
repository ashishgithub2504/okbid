<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Passports
        <small>Horse Passports info</small>
    </h1>
    <p onclick="myPrint()" title="Print this page"><i class="fa fa-print" aria-hidden="true" style="font-size: 35px; float: right; cursor: pointer;"></i></p>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Horse') ?></th>
                            <td><?= $horsePassport->has('horse') ? $this->Html->link($horsePassport->horse->name, ['controller' => 'Horses', 'action' => 'view', $horsePassport->horse->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Passport Number') ?></th>
                            <td><?= h($horsePassport->passport_number) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                             <td><?= ($horsePassport->status == '1')?'Active':'Inactive' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Renue Date') ?></th>
                            <td><?= h($horsePassport->renue_date->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horsePassport->created->format('d-M-Y')) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Remarks') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horsePassport->remarks)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function myPrint() {
    window.print();
}
</script>