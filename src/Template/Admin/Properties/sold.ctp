<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { 
    $fixedfilter = 'fixedfilter';
    $top180 = 'top180';
}else{
    $fixedfilter = '';
    $top180 = '';
}
?>
<section class="content-header topheader">
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
            <div class="box <?= $fixedfilter; ?>">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-circle-o"></i>
                        <span class="caption-subject font-green bold uppercase">Total Sold Properties : <?= count($properties); ?></span>
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
                                    echo $this->Form->input('fromdate', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'placeholder' => 'From time to sell the property',
                                        'label' => false,
                                        'value' => !empty($this->request->query['fromdate']) ? $this->request->query['fromdate'] : ''
                                    ]);

                                    echo $this->Form->input('todate', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Untill time to sell the property',
                                        'label' => false,
                                        'value' => !empty($this->request->query['todate']) ? $this->request->query['todate'] : ''
                                    ]);

                                    echo $this->Form->input('no_of_room', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'label' => false,
                                        'placeholder' => 'No Of Room',
                                        'value' => !empty($this->request->query['no_of_room']) ? $this->request->query['no_of_room'] : ''
                                    ]);

                                    echo $this->Form->input('city', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'placeholder' => 'City Name',
                                        'label' => false,
                                        'value' => !empty($this->request->query['city']) ? $this->request->query['city'] : ''
                                    ]);
                                    
                                    echo $this->Form->input('increase', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'label' => false,
                                        // 'options' => ['10'=>'up to 10%','20'=>'up to 20%','50'=>'Up to 50%'],
                                        'placeholder' => 'Enter Percentage of increase',
                                        'value' => !empty($this->request->query['role']) ? $this->request->query['role'] : ''
                                    ]);
                                    
                                    echo $this->Form->input('keyword', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'placeholder' => 'User Name',
                                        'label' => false,
                                        'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                    ]);
                                    
                                    echo $this->Form->input('role', [
                                        'class' => 'form-control input-sm pull-right',
                                        'templates' => [
                                            'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                        ],
                                        'autocomplete' => 'off',
                                        'label' => false,
                                        'options' => $list,
                                        'empty' => 'Select User',
                                        'value' => !empty($this->request->query['role']) ? $this->request->query['role'] : ''
                                    ]);

                                    
                                    ?>

                                    <div class="input-group-btn col-md-3 ">
                                    <?php echo $this->Form->button('<span class="glyphicon glyphicon-search"></span> Search', ['class' => 'btn btn-sm btn-primary top5', 'type' => 'Submit', 'escape' => false]); ?>
                                    </div>
                                </div>
                            </div>
    <?= $this->Form->end() ?>
                        </div>
                    </div>
<?php } ?>
            </div>

            <div class="box <?= $top180; ?>">
                <div class="box-body table-responsive no-padding tablescroll">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
<?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                    <th scope="col"><?= $this->Paginator->sort('user') ?></th>
<?php } ?>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th> 				
                                <th scope="col"><?= $this->Paginator->sort('Time to sell the property','Selling Time') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('seller"s name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('City') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Room') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
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
                                            echo $this->Custom->getPropertyType($property->propertytype_id);
                                        }
                                        echo ', ' . $property->no_of_room . ' '.Configure::read('ROOM')['en'];
                                        echo ', '.is_numeric($property->city)?$this->Custom->getCityName($property->city):$property->city;
                                        ?></td>
                                        <td><?= $this->Custom->getSellingTime($property->id); ?></td>
                                        <td><?= $this->Custom->getUserName($property->user_id); ?></td>
                                        <td><?= is_numeric($property->city)?$this->Custom->getCityName($property->city):$property->city; ?></td>
                                        <td><?= $property->no_of_room. ' Rooms'; ?></td>
                                        <td><?= h($property->price) ?></td>

                                        <td class="actions"  style="width:30%;">
        <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>

        <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false]) ?>
        <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Assign'), ['action' => 'assign', $property->id], ['data-toggle' => "modal", 'data-target' => "#myModal", 'class' => 'btn  btn-info btn-sm', 'escape' => false]) ?>
                                                <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>
                                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property->id,'sold'], ['confirm' => __('Are you sure you want to delete # {0}?', $property->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                                <?php } ?>
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

<!-- Calender js -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(function () {

        $("#fromdate").datepicker({
            autoclose: true,
            onClose: function () {
                $("#todate").datepicker(
                        "change",
                        {minDate: new Date($('#fromdate').val())}
                );
            }
        });

        $("#todate").datepicker({
            autoclose: true,
            onClose: function () {
                $("#fromdate").datepicker(
                        "change",
                        {maxDate: new Date($('#todate').val())}
                );
            }
        });

    });
</script>