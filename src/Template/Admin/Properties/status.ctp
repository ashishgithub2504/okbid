<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        Properties
        <small>Change Properties Status</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="height:500px;">
                <div class="box-body table-responsive">
                     <?php echo $this->Form->create(); ?>
                    <table class="table">
                      
                        <tr>
                            <th scope="row"><?= __('Property Status') ?></th>
                            <td><?php echo $this->Form->input('status', 
                                        [
                                            'class' => 'form-control input-sm pull-right',
                                            'templates' => [
                                                'inputContainer' => '<div class="col-md-6 input {{type}}{{required}}">{{content}}</div>',
                                            ],
                                            'label'=>false,
                                            'type' =>'select',
                                            'options' => ['0'=>'Pending','1'=>'For Sale','2'=>'Auction','3'=>'Sold','4'=>'InActive'],
                                            'empty'=>'Change Status',
                                            'value' => isset($property['status']) ? $property['status'] : ''
                                        ]);  
                            
                            ?></td>
                            <td><?php echo $this->Form->button('<i class="fa fa-search"></i> Submit', ['class' => 'btn btn-sm btn-success', 'type' => 'Submit', 'escape' => false]); ?></td>
							<td><?php echo $this->Html->link('Back',['controller'=>'properties','action'=>'view',$property['id']],['class' => 'btn btn-sm btn-warning']); ?></td>
                        </tr>
                       
                    </table>
                     <?php echo $this->Form->end(); ?>
					 
                </div>
            </div>
        </div>
    </div>
</section>