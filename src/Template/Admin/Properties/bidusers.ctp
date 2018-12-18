<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Users Management
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
                        <span class="caption-subject font-green bold uppercase">Total Number Of Seller / Buyers : <?= count($users); ?></span>
                    </h3>
                
                </div>
                
                <!-- /.box-header -->

            </div>
            
            <div class="box">
                <div class="box-body table-responsive no-padding tablescroll">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>

                                <th scope="col"><?= $this->Paginator->sort('Full name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Seniority') ?></th>
                                
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0):
                            foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->user->id) ?></td>
                                <td>
                                <?= $this->Html->link($user->user->name, ['controller' => 'Users', 'action' => 'view', $user->user->id]);?>
                                </td>
                                <td><?= h($user->user->email) ?></td>
                                <td><?= $user->user->phone; ?></td>
                                
                                <td><?php 
                                    $datetime1 = new DateTime($user->user->created);
                                    $datetime2 = new DateTime();
                                    $interval = $datetime1->diff($datetime2);
                                    echo $interval->format('%y years %m months and %d days');
                                 ?></td>
                                
                                <td><?= ($user->user->status == 1)?'Active':'Inactive'; ?></td>
                                <td class="actions"  style="width:35%;">
                                    <?php echo $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $user->user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-comments-o"></i> Send message'), ['action' => 'message', $user->user->id], ['class' => 'btn btn-sm btn-info','title'=>'Send message' ,'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No User Found</strong> </td> </tr>";
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
               
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>