<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Event Riders
        <small>Event Riders info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Event') ?></th>
                            <td><?= $eventRider->has('event') ? $this->Html->link($eventRider->event->name, ['controller' => 'Events', 'action' => 'view', $eventRider->event->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Rider') ?></th>
                            <td><?= $eventRider->has('rider') ? $this->Html->link($eventRider->rider->name, ['controller' => 'Riders', 'action' => 'view', $eventRider->rider->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Horse') ?></th>
                            <td><?= $eventRider->has('horse') ? $this->Html->link($eventRider->horse->name, ['controller' => 'Horses', 'action' => 'view', $eventRider->horse->id]) : '' ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($eventRider->status == 1)?'Active':'InActive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($eventRider->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($eventRider->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>