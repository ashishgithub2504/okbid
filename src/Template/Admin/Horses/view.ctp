<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1 style="float: left;">
        Manage Horses
        <small>Horses info</small>
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
                            <th scope="row"><?= __('Horse Name') ?></th>
                            <td><?= h($horse->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Branch Name') ?></th>
                            <td><?= unserialize(BRANCH)[$horse->branch_id] ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Year Of Birth') ?></th>
                            <td><?= h($horse->dob->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('First Image') ?></th>
                            <td><?= $this->Html->image(_BASE_.'uploads/images/'.$horse->image,['width'=>'50px']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Second Image') ?></th>
                            <td><?= $this->Html->image(_BASE_.'uploads/images/'.$horse->image1,['width'=>'50px']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Third Image') ?></th>
                            <td><?= $this->Html->image(_BASE_.'uploads/images/'.$horse->image2,['width'=>'50px']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Gender') ?></th>
                            <td><?php $search_array = Configure::read('SEX_HORSE');
                                if (array_key_exists($horse->gender,$search_array )) {
                                    echo $search_array[$horse->gender ];
                                }?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Color') ?></th>
                            <td><?php $search_array = Configure::read('COLOR_HORSE');
                                if (array_key_exists($horse->color,$search_array )) {
                                    echo $search_array[$horse->color];
                                }?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Country Of Birth') ?></th>
                            <td><?= h(isset($horse->country->name)?$horse->country->name:'') ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($horse->status == 1)?'Active':'InActive'; ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horse->created->format('d-M-Y')) ?></td>
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