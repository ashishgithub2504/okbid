<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Buyer Properties
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
                            class="caption-subject font-green bold uppercase">Buyer Properties</span></h3>

                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#favourite">Favourite</a></li>
                        <li><a data-toggle="tab" href="#signed">Signed</a></li>
                        <li><a data-toggle="tab" href="#proposals">Proposals</a></li>
<!--                        <li><a data-toggle="tab" href="#action">Auction</a></li>-->
                        <li><a data-toggle="tab" href="#myproperty">My Property</a></li>
                        <li><a data-toggle="tab" href="#viewproperty">Property View</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        
                    <div id="favourite" class="tab-pane fade in active">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
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
                            <?php
                            if (!empty($favourites)):
                                
                                foreach ($favourites as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property['property']['city'];
                                                if ($property['property']['propertytype_id'] != 0) {
                                                    echo $this->Custom->getPropertyType($property['property']['propertytype_id']);
                                                }
                                                echo ' ' . $property['property']['no_of_room'] . ' Rooms';
                                                ?></td>
                                            <td><?= h($property['property']['price']) ?></td>
                                            <td><?= h(25) ?></td>
                                            <td><?= h(50) ?></td>
                                            <td><?= $property['property']['created']->format('d/m/Y'); ?></td>
                                            <td><?= $property['property']['modified']->format('d/m/Y'); ?></td>
                                            <td><?= Configure::read('PSTATUS' . LAN)[$property['property']['status']]; ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property['property']['id']], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property['property']['id']], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property['property']['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $property['property']['id']), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <?php
                                endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
                            endif;
                            ?>
                            </tbody>
                        </table>
                        
                    </div>
                    
                    <div id="signed" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
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
                            <?php
                            if (!empty($signatures)):
                                
                                foreach ($signatures as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property['property']['city'];
                                                if ($property['property']['propertytype_id'] != 0) {
                                                    echo $this->Custom->getPropertyType($property['property']['propertytype_id']);
                                                }
                                                echo ' ' . $property['property']['no_of_room'] . ' Rooms';
                                                ?></td>
                                            <td><?= h($property['property']['price']) ?></td>
                                            <td><?= h(25) ?></td>
                                            <td><?= h(50) ?></td>
                                            <td><?= $property['property']['created']->format('d/m/Y'); ?></td>
                                            <td><?= $property['property']['modified']->format('d/m/Y'); ?></td>
                                            <td><?= Configure::read('PSTATUS' . LAN)[$property['property']['status']]; ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property['property']['id']], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property['property']['id']], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property['property']['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $property['property']['id']), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <?php
                                endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="proposals" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
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
                            <?php
                            if (!empty($proposals)):
                                
                                foreach ($proposals as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property['property']['city'];
                                                if ($property['property']['propertytype_id'] != 0) {
                                                    echo $this->Custom->getPropertyType($property['property']['propertytype_id']);
                                                }
                                                echo ' ' . $property['property']['no_of_room'] . ' Rooms';
                                                ?></td>
                                            <td><?= h($property['property']['price']) ?></td>
                                            <td><?= h(25) ?></td>
                                            <td><?= h(50) ?></td>
                                            <td><?= $property['property']['created']->format('d/m/Y'); ?></td>
                                            <td><?= $property['property']['modified']->format('d/m/Y'); ?></td>
                                            <td><?= Configure::read('PSTATUS' . LAN)[$property['property']['status']]; ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property['property']['id']], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property['property']['id']], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property['property']['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $property['property']['id']), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <?php
                                endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="action" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
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
                            <?php
                            if (!empty($auction)):
                                
                                foreach ($auction as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property['property']['city'];
                                                if ($property['property']['propertytype_id'] != 0) {
                                                    echo $this->Custom->getPropertyType($property['property']['propertytype_id']);
                                                }
                                                echo ' ' . $property['property']['no_of_room'] . ' Rooms';
                                                ?></td>
                                            <td><?= h($property['property']['price']) ?></td>
                                            <td><?= h(25) ?></td>
                                            <td><?= h(50) ?></td>
                                            <td><?= $property['property']['created']->format('d/m/Y'); ?></td>
                                            <td><?= $property['property']['modified']->format('d/m/Y'); ?></td>
                                            <td><?= Configure::read('PSTATUS' . LAN)[$property['property']['status']]; ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property['property']['id']], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property['property']['id']], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property['property']['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $property['property']['id']), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <?php
                                endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="myproperty" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
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
                            <?php
                            if (!empty($properties)):
                                foreach ($properties as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
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
                                            <td><?= $property->modified->format('d/m/Y'); ?></td>
                                            <td><?= Configure::read('PSTATUS' . LAN)[$property->status]; ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property->id], ['confirm' => __('Are you sure you want to delete # {0}?', $property->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <?php
                                endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                        
                    <div id="viewproperty" class="tab-pane fade">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
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
                            <?php
                            if (!empty($views)):
                                foreach ($views as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property->property->city;
                                                if ($property->property->propertytype_id != 0) {
                                                    echo $this->Custom->getPropertyType($property->property->propertytype_id);
                                                }
                                                echo ' ' . $property->property->no_of_room . ' Rooms';
                                                ?></td>
                                            <td><?= h($property->property->price) ?></td>
                                            <td><?= h(25) ?></td>
                                            <td><?= h(50) ?></td>
                                            <td><?= $property->created->format('d/m/Y'); ?></td>
                                            <td><?= $property->modified->format('d/m/Y'); ?></td>
                                            <td><?= Configure::read('PSTATUS' . LAN)[$property->property->status]; ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $property->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Graph'), ['action' => 'graph', $property->id], ['class' => 'btn btn-info btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $property->id], ['confirm' => __('Are you sure you want to delete # {0}?', $property->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <?php
                                endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Found</strong> </td> </tr>";
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                   
                    </div>
                    
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