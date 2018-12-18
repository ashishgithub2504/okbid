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
                            class="caption-subject font-green bold uppercase">Assign Properties</span></h3>
                    
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <?php
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        ?>
                        <div class="col-md-12">

                            <div class="input-group" style="display:inline;">
                                <?php
                                echo $this->Form->input('keyword', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'autocomplete' => 'off',
                                    'placeholder' => 'User Name',
                                    'label' => false,
                                    'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                ]);
                                ?>

                                <?php
                                echo $this->Form->input('status', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'label' => false,
                                    'options' => Configure::read('STATUS' . LAN),
                                    'empty' => 'Select Status',
                                    'value' => !empty($this->request->query['handling']) ? $this->request->query['handling'] : ''
                                ]);
                                ?>
                                <div class="input-group-btn col-md-4">
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
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
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
                                        <td><?= $this->Html->link($property->user->name,['controller'=>'users','action'=>'view',$property->user->id]) . ' ' . ($role) ?></td>
                                        <td>
                                            <?php
                                            echo $property->city;
                                            if ($property->propertytype_id != 0) {
                                                echo $this->Custom->getPropertyType($property->propertytype_id);
                                            }
                                            echo ' ' . $property->no_of_room . ' Rooms';
                                            ?></td>
                                        <td><?= h($property->price) ?></td>
                                        <td><?= h(25) ?></td>
                                        <td><?= h(50) ?></td>
                                        <td><?= $property->created->format('d/m/Y'); ?></td>
                                        <td><?= Configure::read('PSTATUS' . LAN)[$property->status]; ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Assign'), ['action' => 'assign', $property->id], ['data-toggle' => "modal", 'data-target' => "#myModal", 'class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                            <?php } ?>
                                            <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>
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

<!-- Calender js -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(function () {

        $("#fromdate").datepicker({
            onClose: function () {
                $("#todate").datepicker(
                        "change",
                        {minDate: new Date($('#fromdate').val())}
                );
            }
        });
        
        $("#todate").datepicker({
            onClose: function () {
                $("#fromdate").datepicker(
                        "change",
                        {maxDate: new Date($('#todate').val())}
                );
            }
        });

//        $("#fromdate").datepicker();
//        $('#todate').datepicker({dateFormat: 'yy:mm:dd'});
//
//        $("#fromdate").on("dp.change", function (e) {
//            $('#todate').data("DatePicker").minDate(e.date);
//        });
//
//        $("#todate").on("dp.change", function (e) {
//            $('#fromdate').data("DatePicker").maxDate(e.date);
//        });
    });
</script>
<!--<script type="text/javascript">
    $(function () {                
                //$('#fromdate').datepicker();
                
                $('#datetimepicker2').datetimepicker({
                  useCurrent: false //Important! See issue #1075
                });
                
                $("#datetimepicker1").on("dp.change", function (e) {
                  $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                });      
                
                $("#datetimepicker2").on("dp.change", function (e) {
                    $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                });
            });

    </script>-->