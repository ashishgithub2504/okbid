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
                        <span class="caption-subject font-green bold uppercase">Total Number Of Contractor : <?= count($users); ?></span>
                    </h3>
                
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add User'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                    
                </div>
                
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <?php
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        ?>
                        <div class="col-md-12">
                            
                            
                            <div class="input-group" style="display:inline;">
                                <?php echo $this->Form->input('keyword', 
                                        [
                                            'class' => 'form-control input-sm pull-right', 
                                            'templates' => [
                                                'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'placeholder' => 'Contractor Name', 
                                            'label' => false, 
                                            'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                    ]); ?>
                                <?php
                                echo $this->Form->input('city', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'City Name',
                                    'label' => false,
                                    'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                ]);
                                ?>
                                <?php
                                echo $this->Form->input('company', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Company Name',
                                    'label' => false,
                                    'value' => !empty($this->request->query['company']) ? $this->request->query['company'] : ''
                                ]);
                                ?>
                                <?php
                                echo $this->Form->input('project', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="top5 col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Project Name',
                                    'label' => false,
                                    'value' => !empty($this->request->query['project']) ? $this->request->query['project'] : ''
                                ]);
                                
                                echo $this->Form->input('status', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'options' => ['1'=>'Active','0'=>'In Active'],
                                    'label' => false,
                                    'value' => isset($this->request->query['status']) ? $this->request->query['status'] : ''
                                ]);
                                ?>
                                <div class="input-group-btn col-md-4">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', ['class' => 'top5 btn btn-sm btn-default', 'title'=>'Search','type' => 'Submit', 'escape' => false]); ?>
                                    
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

                                <th scope="col"><?= $this->Paginator->sort('Full name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('company') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Quantity of active properties published') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0):
                            foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td>
                                <?= $this->Html->link($user->name, ['controller' => 'Users', 'action' => 'view', $user->id]);?>
                                </td>
                                <td><?= h($user->email) ?></td>
                                 <td><?= $this->Number->format($user->phone) ?></td>
                                 <td><?= h($user->company) ?></td>
                                 <td><?= h(30) ?></td>
                                 
                                <td><?= ($user->status == 1)?'Active':'Inactive'; ?></td>
                                <td class="actions"  style="width:35%;">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Property'), ['controller'=>'properties','action' => 'user-pro', $user->id], ['class' => 'btn btn-warning  btn-sm', 'escape' => false]) ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-comments-o"></i> Message'), ['action' => 'message', $user->id], ['class' => 'btn btn-sm btn-info','title'=>'Send message' ,'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
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
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>