<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
$page = isset($_GET['page'])?$_GET['page']:'0';
$number = $page*10;
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
                                <?php echo $this->Form->input('keyword', ['class' => 'form-control input-sm pull-right',
                                    'placeholder' => 'Keyword', 'label' => false, 
                                    'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : '']); ?>
                                
                                <?php echo $this->Form->year('dob', [
                                                'name'=>'dob',
                                                'minYear'   => MINYEAR,
                                                'maxYear'   => date('Y'),
                                                'label' => false, 
                                                'class'     => 'form-control input-sm pull-right',
                                                'value' => isset($get['dob']['year'])?$get['dob']['year']:'',
                                                'empty'     => 'All Birth Years',
                                                'orderYear' => 'desc'
                                            ]); ?>
                                
                                <?php echo $this->Form->input('branch_id', [
                                                'name'=>'branch_id',
                                                'label' => false, 
                                                'type'=>'select',
                                                'options'=> unserialize(BRANCH),
                                                'class'     => 'form-control input-sm pull-right',
                                                'value' => isset($get['branch_id'])?$get['branch_id']:'',
                                                'empty'     => 'All Stables',
                                            ]); ?>
                                
                                <?php echo $this->Form->input('status', [
                                                'name'=>'status',
                                                'label' => false, 
                                                'type'=>'select',
                                                'options'=> ['1'=>'Active','2'=>'Gifted','3'=>'Deceased'],
                                                'value' => isset($get['status'])?$get['status']:'',
                                                'class'     => 'form-control input-sm pull-right'
                                            ]); ?>
                                <div class="input-group-btn">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('S No.') ?></th>
                              <th scope="col"><?= $this->Paginator->sort('branch_id') ?></th>
   <!--                               <th scope="col"><?= $this->Paginator->sort('eef_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('chipid') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('birth_name') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('First Image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Second Image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Third Image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('dob') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('height') ?></th>
<!--                                <th scope="col"><?= $this->Paginator->sort('sire') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('dam') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('Sex') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('color') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('breed') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('country_birth') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($horses) > 0):
                            foreach ($horses as $key=>$horse): ?>
                            <tr>
                                <td><?= $number+($key+1); ?></td>
                                <td><?= unserialize(BRANCH)[$horse->branch_id] ?></td>
  <!--                                        <td><?= h($horse->eef_number) ?></td>
                                <td><?= h($horse->chipid) ?></td>
                                <td><?= h($horse->birth_name) ?></td>-->
                                <td><?= h($horse->name) ?></td>
                                <td><?= $this->Html->image(_BASE_.'/uploads/images/'.$horse->image,array('width'=>'100','class'=>'cursor')) ?></td>
                                <td><?= $this->Html->image(_BASE_.'/uploads/images/'.$horse->image1,array('width'=>'100','class'=>'cursor')) ?></td>
                                <td><?= $this->Html->image(_BASE_.'/uploads/images/'.$horse->image2,array('width'=>'100','class'=>'cursor')) ?></td>
                                <td><?php if ($horse->dob != "") { echo $horse->dob->format('d-M-Y'); }else{ echo ''; }?></td>
                                <td><?= h($horse->height) ?></td>
<!--                                <td><?= h($horse->sire) ?></td>
                                <td><?= h($horse->dam) ?></td>-->
                                <td><?php if($horse->gender == 1){
                                    echo 'Mare';
                                }else if($horse->gender == 2){
                                    echo 'Gelding';
                                }else{
                                    echo 'Stallion';
                                } ?></td>
                                <td><?php 
                                echo $horse->color;
//                                $search_array = Configure::read('COLOR_HORSE');
//                                if (array_key_exists($horse->color,$search_array )) {
//                                    echo $search_array[$horse->color];
//                                }
                                ?></td>
                                <td><?= h($horse->breed) ?></td>
                                <td><?= h(isset($horse->country->name)?$horse->country->name:'') ?></td>
                                <td><?= ($horse->status == 1)?'Active':'Deactive'; ?></td>
                                
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
