<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Properties
        <small>Change Properties Handling</small>
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
                            <td><?php echo $this->Form->input('handling', 
                                        [
                                            'class' => 'form-control',
                                            'templates' => [
                                                'inputContainer' => '<div class="input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'label'=>'Handling Status',
                                            'type' =>'select',
                                            'options' => Configure::read('HANDING' . LAN),
                                            'empty'=>'Change Status',
                                            'value' => isset($property['status']) ? $property['status'] : ''
                                        ]);  
                                        
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><?= $this->Form->input('message',['class' => 'form-control','type'=>'textarea']); ?></td>
                        </tr>
                        
                        <tr>
                            <td><?php echo $this->Form->button('Submit', ['class' => 'btn btn-sm btn-success', 'type' => 'Submit', 'escape' => false]); ?></td>
                        </tr>
                       
                    </table>
                     <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>