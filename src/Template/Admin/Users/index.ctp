<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Users Management
        <small>All Seller/buyer List</small>
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
                        <span class="caption-subject font-green bold uppercase">Total Number Of Seller / buyer : <?= count($users); ?></span>
                    </h3>
                
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add User'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                    
                </div>
                
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row" id="search">
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
                                            'placeholder' => 'Name', 
                                            'autocomplete' => 'off',
                                            'label' => false, 
                                            'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : ''
                                    ]); ?>
                                <?php
                                echo $this->Form->input('from', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Date of property published',
                                    'id' => 'fromdate',
                                    'label' => false,
                                    'value' => !empty($this->request->query['from']) ? $this->request->query['from'] : ''
                                ]);
                                
                                echo $this->Form->input('upto', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Last date to sign anproperty',
                                    'id' => 'todate',
                                    'label' => false,
                                    'value' => !empty($this->request->query['upto']) ? $this->request->query['upto'] : ''
                                ]);
                                
                                
                                echo $this->Form->input('city', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'City Name',
                                    'label' => false,
                                    'value' => !empty($this->request->query['city']) ? $this->request->query['city'] : ''
                                ]);
                                
                                
                                
//                                echo $this->Form->input('register_from', [
//                                    'class' => 'form-control input-sm pull-right',
//                                    'templates' => [
//                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
//                                    ],
//                                    'placeholder' => 'Register date from',
//                                    'label' => false,
//                                    'value' => !empty($this->request->query['register_from']) ? $this->request->query['register_from'] : ''
//                                ]);
//                                
//                                echo $this->Form->input('register_to', [
//                                    'class' => 'form-control input-sm pull-right',
//                                    'templates' => [
//                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
//                                    ],
//                                    'placeholder' => 'Register date to',
//                                    'label' => false,
//                                    'value' => !empty($this->request->query['register_to']) ? $this->request->query['register_to'] : ''
//                                ]);
                                
                                echo $this->Form->input('publish_from', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Property publish from',
                                    'label' => false,
                                    'value' => !empty($this->request->query['publish_from']) ? $this->request->query['publish_from'] : ''
                                ]);
                                
                                echo $this->Form->input('publish_to', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Property publish to',
                                    'label' => false,
                                    'value' => !empty($this->request->query['publish_to']) ? $this->request->query['publish_to'] : ''
                                ]);
                                
                                echo $this->Form->input('sign_from', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Property Sign from',
                                    'label' => false,
                                    'value' => !empty($this->request->query['sign_from']) ? $this->request->query['sign_from'] : ''
                                ]);
                                
                                echo $this->Form->input('sign_to', [
                                    'class' => 'form-control input-sm pull-right',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-md-4 top5 input {{type}}{{required}}">{{content}}</div>',
                                    ],
                                    'placeholder' => 'Property sign to',
                                    'label' => false,
                                    'value' => !empty($this->request->query['sign_to']) ? $this->request->query['sign_to'] : ''
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
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-sm btn-default top5', 'title'=>'Search','type' => 'Submit', 'escape' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    
                    
                </div>
            </div>
            
            <div class="box">
                <div class="box-body table-responsive no-padding tablescroll">
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>

                                <th scope="col"><?= $this->Paginator->sort('Full name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('role_id','User type') ?></th>
                                
                                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
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
                                <td><?= isset($user->role->name)?$user->role->name:''; ?></td>
                                
                                <td><?= !empty($user->prefix)?$user->prefix:''; echo ' '. $user->phone ?></td>
                                <td><?= ($user->status == 1)?'Active':'Inactive'; ?></td>
                                <td class="actions">
                                    <?php //$this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['controller'=>'properties','action' => 'view', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?php // $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Seller'), ['controller'=>'properties','action' => 'seller', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-comments-o"></i> Send Notification'), ['action' => 'message', $user->id], ['class' => 'btn btn-sm btn-info','title'=>'Send message' ,'escape' => false]) ?>
                                    <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>
                                        <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                    <?php } ?>
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
<script type="text/javascript">
    $(function () {
        $(document).on('click','.hidesearch',function(){
            $("#search").slideUp();
            $(this).removeClass('hidesearch').addClass('showsearch');
            $("#listing").css('margin-top','50px');
        });
        
        $(document).on('click','.showsearch',function(){
            $("#search").slideDown();
            
            $(this).addClass('hidesearch').removeClass('showsearch');
            $("#listing").css('margin-top','180px');
        });
        
        $("#register-from, #register-to , #publish-from , #publish-to , #sign-from, #sign-to").datepicker({
        });
    });
</script>