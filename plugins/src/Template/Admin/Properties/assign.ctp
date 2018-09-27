<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Assign Properties
        <small>Assign Properties to Leader</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                     <?php echo $this->Form->create(); ?>
                    <table class="table">
                      
                        <tr>
                            <th scope="row"><?= __('Leader') ?></th>
                            <td><?php echo $this->Form->input('role', 
                                        [
                                            'class' => 'form-control input-sm pull-right',
                                            'templates' => [
                                                'inputContainer' => '<div class="col-md-6 input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'label'=>false,
                                            'type' =>'select',
                                            'options' => $roles,
                                            'empty'=>'Select Leader',
                                            'value' => !empty($this->request->query['role']) ? $this->request->query['role'] : ''
                                        ]);  
                            
                            ?></td>
                            <td><?php echo $this->Form->button('<i class="fa fa-search"></i> Submit', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); ?></td>
                        </tr>
                       
                    </table>
                     <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>