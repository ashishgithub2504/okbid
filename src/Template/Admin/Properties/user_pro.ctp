<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Manage Properties
        <small>All Properties List</small>
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
                            class="caption-subject font-green bold uppercase">User Properties</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Property'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <?php
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        ?>
                        <div class="col-md-12">
                            <label for="keyword">Keyword</label>

                            <div class="input-group">
                                <?php echo $this->Form->input('keyword', 
                                        [
                                            'class' => 'form-control input-sm pull-right', 
                                            'templates' => [
                                                'inputContainer' => '<div class="col-md-3 input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'placeholder' => 'Keyword', 
                                            'label' => false, 
                                            'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                    ]); ?>
                                
                                 <?php echo $this->Form->input('status', 
                                        [
                                            'class' => 'form-control input-sm pull-right',
                                            'templates' => [
                                                'inputContainer' => '<div class="col-md-3 input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'label'=>false,
                                            'options' => ['0'=>'Inactive','1'=>'Onsale','2'=>'Auction','3'=>'Sold'],
                                            'empty'=>'Select Status',
                                            'value' => !empty($this->request->query['status']) ? $this->request->query['status'] : ''
                                        ]); ?>
                                
                                <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1','5'))) { 
                                    echo $this->Form->input('role', 
                                        [
                                            'class' => 'form-control input-sm pull-right',
                                            'templates' => [
                                                'inputContainer' => '<div class="col-md-3 input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'label'=>false,
                                            'options' => $list,
                                            'empty'=>'Select User',
                                            'value' => !empty($this->request->query['role']) ? $this->request->query['role'] : ''
                                        ]); 
                                    } ?>
                                
                                <div class="input-group-btn col-md-3 ">
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
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('user') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th> 				
                                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('view count') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('signature count') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($properties) > 0):
                            foreach ($properties as $key=>$property): 
                                    if($property->user->role_id ==2){
                                            $role = '(buyer/seller) ';
                                    }else if($property->user->role_id ==3){
                                            $role = '(Leader) ';
                                    }else if($property->user->role_id ==4){
                                            $role = '(Agent) ';
                                    }else if($property->user->role_id ==5){
                                            $role = '(Manager) ';
                                    }else if($property->user->role_id ==6){
                                            $role = '(Building contractor) ';
                                    }else{
                                            $role = '(Admin)';
                                    }
                            ?>
                            <tr>
                                <td><?= $this->Number->format($key+1) ?></td>
				<td><?= ($property->user->name).' '.($role) ?></td>
                                <td>
                                    <?php 
                                    echo $property->city;
                                    if($property->propertytype_id != 0){
                                        echo Configure::read('PROTY'.LAN)[$property->propertytype_id];
                                    } 
                                    echo ' '.$property->no_of_room.' Rooms';
                                    ?></td>
                                <td><?= h($property->price) ?></td>
                                <td><?= h(25) ?></td>
                                <td><?= h(50) ?></td>
                                <td><?= $property->created->format('d/m/Y'); ?></td>
                                <td><?= $property->modified->format('d/m/Y'); ?></td>
                                <td><?= Configure::read('PSTATUS'.LAN)[$property->status]; ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1','5'))) { ?>
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Assign'), ['action' => 'assign', $property->id], ['data-toggle'=>"modal", 'data-target'=>"#myModal",'class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?php } ?>
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property->id], ['confirm' => __('Are you sure you want to delete # {0}?', $property->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
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