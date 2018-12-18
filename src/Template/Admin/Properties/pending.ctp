<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
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
            <td><?= $this->Number->format($paginate + ($key + 1)) ?></td>
            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                <td><?= $this->Html->link($property->user->name, ['controller' => 'users', 'action' => 'view', $property->user->id]) . ' ' . ($role) ?></td>
            <?php } ?>
            <td>
                <?php
                
                if ($property->propertytype_id != 0) {
                    echo $this->Custom->getPropertyType($property->propertytype_id);
                }
                echo ', ' . $property->no_of_room . ' '.Configure::read('ROOM')['en'].' ';
                echo ',  '.is_numeric($property->city)?$this->Custom->getCityName($property->city):$property->city;
                ?>
            </td>

            <td><?php echo is_numeric($property->city)?$this->Custom->getCityName($property->city):$property->city; ?></td>
            <td><?php echo $property->no_of_room; ?></td>
            <td><?= h($property->price) ?></td>
            <td><?= isset($property->handling) ? Configure::read('HANDING' . LAN)[$property->handling] : 'Pending'; ?></td>
            <td><?= $property->created->format('d/m/Y'); ?></td>
            <td class="actions"  style="width:30%;">
                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>

                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false]) ?>
                <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Assign'), ['action' => 'assign', $property->id], ['data-toggle' => "modal", 'data-target' => "#myModal", 'class' => 'btn  btn-info btn-sm', 'escape' => false]) ?>
                    <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>
                        <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property->id], ['confirm' => __('Are you sure you want to delete # {0}?', $property->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
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

<!-- /.box-body -->
<div class="box-footer clearfix">
    <?php echo $this->element('pagination'); ?>
</div>

<!-- /.box -->


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

    });
</script>