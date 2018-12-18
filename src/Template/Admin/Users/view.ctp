<?php
/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;

?>

<section class="content">
    <div class="row">
        <section class="content-header">
            <h1>
                Manage Users
                <small>Users info</small>
            
                <p style="float: right;">
                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-success btn-sm', 'style' => 'float:right;', 'escape' => false]) ?>
                </p>
            </h1>            
        </section>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">

                        <tr>
                            <th scope="row"><?= __('Full Name') ?></th>
                            <td><?= h($user->name) ?></td>
                        </tr>
                        <?php if(in_array($user->role->id, ['3','4'])){ ?>
                        <tr>
                            <th scope="row"><?= __('License Number') ?></th>
                            <td><?= h($user->license); ?></td>
                        </tr>
                        <?php } ?>
                        
                        <?php if (!empty($user->company)) { ?>
                            <tr>
                                <th scope="row"><?= __('Company Name') ?></th>
                                <td><?= h($user->company); ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Phone') ?></th>
                            <td><?= !empty($user->prefix)?$user->prefix:''; echo ' '.$user->phone; ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('User') ?></th>
                            <td><?= $user->has('role') ? $user->role->name:''; ?></td>
                        </tr>
                          <?php if($user->role_id != 2){ ?>
                        
                          <?php } ?>
                        
                        <?php if (!empty($user->manager_id) && $user->role_id == 3) { ?>
                            <tr>
                                <th scope="row"><?= __('Manager Name') ?></th>
                                <td><?= $user->has('role') ? $this->Html->link($this->Custom->getUserName($user->manager_id), ['controller' => 'users', 'action' => 'view', $user->manager_id]) : '' ?></td>
                            </tr>
                        <?php } ?>

                        

                        <?php if (!in_array($user->role->id, array('6'))) { ?>
                            <tr>
                                <th scope="row"><?= __('Residence Address') ?></th>
                                <td><?= h($user->address); ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <th scope="row"><?= __('Company address') ?></th>
                                <td><?= h('okbid Uk'); ?></td>
                            </tr>
                        <?php } ?>    
                        
                         <tr>
                            <th scope="row"><?= __('City (where he works)') ?></th>
                            <td><?= h($user->city) ?></td>
                        </tr>
                        <?php if($user->role_id == 2){ ?>
                        <tr>
                            <th scope="row"><?= __('Last date on app') ?></th>
                            <td><?= h(date('d-m-Y', strtotime($user->modified))); ?></td>
                        </tr>
                        <?php }else{ ?>
                        <tr>
                            <th scope="row"><?= __('Last date connected') ?></th>
                            <td><?= h(date('d-m-Y', strtotime($user->modified))); ?></td>
                        </tr>
                        <?php } ?>
                       

                        <tr>
                            <th scope="row"><?= __('Profile Pic') ?></th>
                            <td><?= $this->Html->image(_BASE_ . 'uploads/users/' . $user->profile_pic, ['width' => '50px']); ?></td>
                        </tr>
                        
                        <?php if (!empty($user->last_login)) { ?>
                            <tr>
                                <th scope="row"><?= __('Last Login Date') ?></th>
                                <td><?= $user->last_login->format('d/M/Y') ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th scope="row"><?= __('Notes') ?></th>
                            <td><?= h($user->notes); ?></td>
                        </tr>
                        
                        <?php if (!in_array($user->role->id, array('5'))) { ?>
                            <tr>
                                <th scope="row"><?= __('Legal Department') ?></th>
                                <td><?= ($user->Legal == 1)?'Yes':'No'; ?></td>
                            </tr>
                        <?php } ?>
                        
                        <?php if($user->Legal == 1){ ?>
                        <tr>
                            <th scope="row"><?= __('Claim Status') ?></th>
                            <td><?= ($user->claim == 1)?'The plaintiff customer':'A customer is sued'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remarks') ?></th>
                            <td><?= $user->remark; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($user->status == 1) ? __('Active') : __('InActive'); ?></td>
                        </tr>
                        
                        <?php if (in_array($user->role->id, array('4','6'))) { ?>

                            <tr>
                                <th scope="row"><?= __('Amount of properties sold') ?></th>
                                <td><?= '$15000'; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Income that he made for the app') ?></th>
                                <td><?= '$25000'; ?></td>
                            </tr>
                            
                            <tr>
                                <th scope="row"><?= __('The number of properties sold through the app') ?></th>
                                <td><?= '150'; ?> <?= $this->Html->link('View',[$user->id]); ?></td>
                            </tr>
                            
                            
                            <tr>
                                <th scope="row"><?= __('Last date of publication of the property') ?></th>
                                <td><?= date('Y-m-d'); ?></td>
                            </tr>
                            
                        <?php } ?>
                        
                        <!--Only contractor-->

                        <?php if (in_array($user->role->id, array('6'))) { ?>
                            
                            <tr>
                                <th scope="row"><?= __('Number of projects published total') ?></th>
                                <td><?= h('150'); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Number of projects published total in the last month ') ?></th>
                                <td><?= h('10'); ?></td>
                            </tr>
                        <?php } ?>
                            
                        <tr>
                            <th scope="row"><?= __('amount of properties confirmed') ?></th>
                            <td><?= '250'; ?>  <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                        </tr>   
                        
                        <?php if (in_array($user->role->id, array('3'))) { ?>

                            <tr>
                                <th scope="row"><?= __('Amount of property that have been assigned to him at the last month') ?></th>
                                <td><?= '20'; ?>   <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>

                            <tr>
                                <th scope="row"><?= __('Quantity of property assigned') ?></th>
                                <td><?= '50';?>  <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>
                            
                            
                        <?php } ?>

                        <?php if (in_array($user->role->id, array('3', '4','6'))) { ?>
                            <tr>
                                <th scope="row"><?= __('Active properties') ?></th>
                                <td><?= '25'; ?>  <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Inactive  properties') ?></th>
                                <td><?= '10'; ?>   <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Amount of property published by himself') ?></th>
                                <td><?= '50'; ?>  <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Number of active properties in the app') ?></th>
                                <td><?= '50'; ?>  <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Quantity of inactive properties') ?></th>
                                <td><?= '50'; ?>  <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>',[$user->id],['escape' => false,'title'=>'View']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Amount of property that he published by himself in the last month') ?></th>
                                <td><?= '$50000'; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Quantity and amount of transactions closed in the last year') ?></th>
                                <td><?= '$20000'; ?></td>
                            </tr>
                        <?php } ?>

                        
                        <?php if (in_array($user->role->id, array('2'))) { ?>
                        <tr>
                            <td>
                                <div class="divider1">
                                    <h3>Seller</h3>
                                    <div>how many percent sell above its minimum price : 25%</div>
                                    <div>
                                        <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Seller Personal Area'), ['controller'=>'properties','action' => 'seller', $user->id], ['class' => 'btn btn-success btn-sm', 'style' => 'float:right;', 'escape' => false]) ?>
                                    </div>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="divider1">
                                    <h3>Buyer</h3>
                                    <p>how many properties view up to date : <?= $countview; ?></p>
                                    <p>how many properties signed: <?= $countsign; ?></p>
                                    <p>how many properties bid : <?= $countbid; ?></p>
                                    <p>how many auctions he won : <?= $countwon; ?></p>
                                    <p>how many percent purchased above the minimum price of sellers : 40%</p>
                                <div>
                                    <?= $this->Html->link(__('<i class="fa fa-eye"></i> Buyer Personal Area'), ['controller'=>'properties','action' => 'buyer', $user->id], ['class' => 'btn btn-success btn-sm', 'style' => 'float:right;', 'escape' => false]) ?>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<style>

</style>