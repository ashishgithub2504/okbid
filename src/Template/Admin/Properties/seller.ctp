<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Seller Properties
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
                            class="caption-subject font-green bold uppercase">Seller Properties</span></h3>

                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#pending">Pending</a></li>
                        <li><a data-toggle="tab" href="#action">Auction</a></li>
                        <li><a data-toggle="tab" href="#onsale">On Sale</a></li>
                        <li><a data-toggle="tab" href="#sold">Sold</a></li>
                        <li><a data-toggle="tab" href="#inactive">InActive</a></li>
                        
                    </ul>
                    
                    <div class="tab-content">
                        
                    <div id="pending" class="tab-pane fade in active">
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
                                                    echo Configure::read('PROTY' . LAN)[$property->propertytype_id];
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
                            if (!empty($propertiesauction)):
                                foreach ($propertiesauction as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property->city;
                                                if ($property->propertytype_id != 0) {
                                                    echo Configure::read('PROTY' . LAN)[$property->propertytype_id];
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
                        
                    <div id="onsale" class="tab-pane fade">
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
                            if (!empty($propertiesonsale)):
                                foreach ($propertiesonsale as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property->city;
                                                if ($property->propertytype_id != 0) {
                                                    echo Configure::read('PROTY' . LAN)[$property->propertytype_id];
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
                    
                    <div id="sold" class="tab-pane fade">
                        
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
                            if (!empty($propertiessold)):
                                foreach ($propertiessold as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property->city;
                                                if ($property->propertytype_id != 0) {
                                                    echo Configure::read('PROTY' . LAN)[$property->propertytype_id];
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
                    
                    <div id="inactive" class="tab-pane fade">
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
                            if (!empty($propertiesinactive)):
                                foreach ($propertiesinactive as $key => $property):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $this->Number->format($key + 1) ?></td>
                                            <td>
                                                <?php
                                                echo $property->city;
                                                if ($property->propertytype_id != 0) {
                                                    echo Configure::read('PROTY' . LAN)[$property->propertytype_id];
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