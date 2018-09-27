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
                    <h3 class="box-title"><i class="fa fa-fw fa-circle-o"></i> 
                        <span class="caption-subject font-green bold uppercase">Total InActive Properties : <?= count($properties); ?></span>
                    </h3>
                    <div class="box-tools">
<?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Property'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                </div>
                <!-- /.box-header -->
<?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                    <div class="box-body">
                        <div class="row">
                            <?php
                            echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                            ?>

                            <div class="col-md-12">

                                <div class="input-group">

                                    <?php
                                    echo $this->Form->input('city', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'placeholder' => 'City Name',
                                        'label' => false,
                                        'value' => !empty($this->request->query['city']) ? $this->request->query['city'] : ''
                                    ]);
                                    
                                    
                                    echo $this->Form->input('no_of_room', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'label' => false,
                                        'placeholder' => 'No Of Room',
                                        'value' => !empty($this->request->query['no_of_room']) ? $this->request->query['no_of_room'] : ''
                                    ]);
                                   
                                    echo $this->Form->input('fromprice', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'placeholder' => 'From price',
                                        'label' => false,
                                        'value' => !empty($this->request->query['fromprice']) ? $this->request->query['fromprice'] : ''
                                    ]);

                                    echo $this->Form->input('toprice', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'placeholder' => 'To Price',
                                        'label' => false,
                                        'value' => !empty($this->request->query['toprice']) ? $this->request->query['toprice'] : ''
                                    ]);
                                    
                                    echo $this->Form->input('days', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'placeholder' => 'User Name',
                                        'options' => ['10' => 'Up to 10 days', '30' => 'Up to 30 days', '50' => 'Up to 50 days', '70' => 'Up to 70 days'],
                                        'empty' => 'How long (in days) since the property published',
                                        'label' => false,
                                        'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                    ]);
                                    
                                    
                                    echo $this->Form->input('role', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'label' => false,
                                        'options' => $list,
                                        'empty' => 'Select User',
                                        'value' => !empty($this->request->query['role']) ? $this->request->query['role'] : ''
                                    ]);
                                    
                                    ?>

                                    <div class="input-group-btn col-md-3 ">
                                        <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-sm btn-default top5', 'type' => 'Submit', 'escape' => false]); ?>
                                    </div>
                                </div>
                            </div>

                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                    <th scope="col"><?= $this->Paginator->sort('user') ?></th>
                                <?php } ?>
                                <th scope="col"><?= $this->Paginator->sort('Poperty Type') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Address') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('City') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Rooms') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Size') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Property Published (in days)') ?></th>
                                <th scope="col" class="actions"><?= __('') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($properties) > 0):
                                foreach ($properties as $key => $property):
                                    if ($property->user->role_id == 2) {
                                        $role = '(buyer/seller) ';
                                    } else if ($property->user->role_id == 3) {
                                        $role = '(Leader) ';
                                    } else if ($property->user->role_id == 4) {
                                        $role = '(Agent) ';
                                    } else if ($property->user->role_id == 5) {
                                        $role = '(Manager) ';
                                    } else if ($property->user->role_id == 6) {
                                        $role = '(Building contractor) ';
                                    } else {
                                        $role = '(Admin)';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($key + 1) ?></td>
                                        <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                            <td><?= $this->Html->link($property->user->name, ['controller' => 'users', 'action' => 'view', $property->user->id]) . ' ' . ($role) ?></td>
                                            <?php } ?>
                                        <td>
                                            <?php
                                            if ($property->propertytype_id != 0) {
                                                echo Configure::read('PROTY' . LAN)[$property->propertytype_id];
                                            }
                                            ?></td>
                                        <td><?= $property->country . ' ,' . $property->state . ' ,' . $property->city . ' ,' . $property->neighbourhood . ' ,' . $property->street; ?></td>
                                        <td><?= $property->city; ?></td>
                                        <td><?= $property->no_of_room . ' Rooms'; ?></td>
                                        <td><?= $property->area; ?></td>
                                        <td><?= $property->price; ?></td>
                                        <td>20</td>
                                        <td class="actions"  style="width:30%;">
                                            <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>

                                            <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false]) ?>
                                            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Assign'), ['action' => 'assign', $property->id], ['data-toggle' => "modal", 'data-target' => "#myModal", 'class' => 'btn  btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property->id], ['confirm' => __('Are you sure you want to delete # {0}?', $property->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php
                                endforeach;
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