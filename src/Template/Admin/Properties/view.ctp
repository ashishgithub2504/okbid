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
                Manage Properties
                <small>Properties info</small>

                <p style="float: right;">
                    <?php
                    if ($this->request->session()->read('Auth.admin.id') == 1 || $this->request->session()->read('Auth.admin.id') == $property->user_id) {
                        echo $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $property->id], ['class' => 'btn btn-success btn-sm', 'style' => 'float:right;', 'escape' => false]);
                    }

                    if ($this->request->session()->read('Auth.admin.id') == 1 || $this->request->session()->read('Auth.admin.id') == $property->user_id) {
                        echo $this->Html->link(__('<i class="fa fa-edit"></i> Handling'), ['action' => 'handling', $property->id], ['class' => 'btn btn-success btn-sm', 'style' => 'float:right; margin-right:10px;', 'escape' => false]);
                    }
                    ?>

                    <?php
                    if (in_array($this->request->session()->read('Auth.admin.role_id'), ['1', '5'])) {
                        echo $this->Html->link(__('<i class="fa fa-edit"></i> Change Status'), ['action' => 'status', $property->id], ['class' => 'btn btn-success btn-sm', 'style' => 'float:right; margin-right:10px', 'escape' => false]);
                    }
                    ?>
                </p>
            </h1>
        </section>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <div class="divider">
                            <h3>Property Ownership Images</h3>

                            <?php
                            if (!empty($property['property_ownerships'])) {
                                foreach ($property['property_ownerships'] as $key => $val) {
                                    if (!empty($val['image'])) {
                                        echo ' <div class="col-md-3">
                            <div class="form-group">';
                                        echo $this->Html->image(_BASE_ . 'uploads' . DS . 'document' . DS . $val['image'], ['width' => '150px', 'height' => '100px']);
                                        //echo '&nbsp;&nbsp;'.$this->Html->link('delete',['controller'>'properties','action'=>'deletedocument/'.$val['id'].'/'.$id]);
                                        echo '</div></div>';
                                    }
                                }
                            }
                            ?>
                        </div> 
                        <div class="divider">
                            <h3>Property Ownership Document</h3>
                            <?php
                            if (!empty($property['property_ownerships'])) {
                                foreach ($property['property_ownerships'] as $key => $val) {
                                    if (!empty($val['file'])) {
                                        echo ' <div class="col-md-3">
                                        <div class="form-group">';
                                        echo $this->Html->link($val['file'], _BASE_ . 'uploads/document/' . $val['file']);

                                        //echo '&nbsp;&nbsp;'.$this->Html->link('delete',['controller'>'properties','action'=>'deletedocument/'.$val['id'].'/'.$id]);
                                        echo '</div></div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="divider">
                            <h3>Property images</h3>
                            <?php
                            if (!empty($property['property_images'])) {
                                foreach ($property['property_images'] as $key => $val) {
                                    if (!empty($val['image'])) {
                                        echo ' <div class="col-md-3">
                            <div class="form-group">';
                                        echo $this->Html->image(_BASE_ . 'uploads' . DS . 'document' . DS . $val['image'], ['width' => '150px', 'height' => '100px']);
                                        //echo '&nbsp;&nbsp;'.$this->Html->link('delete',['controller'>'properties','action'=>'deleteimage/'.$val['id'].'/'.$id]);
                                        echo '</div></div>';
                                    } else {
                                        
                                    }
                                }
                            }
                            ?>
                        </div>

                        <div class="divider">
                            <h3>Owners Detail</h3>
                            <?php
                            if (!empty($property['property_owners'])) {
                                echo '<div class="col-md-4"><div class="form-group"><b>Name</b></div></div><div class="col-md-4"><div class="form-group"><b>Cell No.</b></div></div><div class="col-md-4"><div class="form-group"><b>ID No.</b></div></div>';
                                foreach ($property['property_owners'] as $key => $val) {

                                    echo ' <div class="col-md-4">
                                            <div class="form-group">';
                                    echo!empty($val['name']) ? $val['name'] : '';
                                    echo '</div></div>';

                                    echo ' <div class="col-md-4">
                                            <div class="form-group">';
                                    echo!empty($val['cell']) ? $val['cell'] : '';
                                    echo '</div></div>';

                                    echo ' <div class="col-md-4">
                                            <div class="form-group">';
                                    echo!empty($val['idno']) ? $val['idno'] : '';
                                    echo '</div></div>';
                                }
                            }
                            ?>
                        </div>
                        <p class="saprator"></p>  
                        <?php if (in_array($property->status, [3])) { ?>
                            <tr>
                                <th scope="row"><?= __('Signed a Contract') ?></th>
                                <td><?= 'Checked'; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Paid') ?></th>
                                <td><?= 'Paid'; ?></td>
                            </tr>

                            <tr>
                                <th scope="row"><?= __('Percent - How many of those who watched the property') ?></th>
                                <td><?= $this->Custom->getwatchpro($property->id) . '%'; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Percent - How many of those who signed the property made a bid') ?></th>
                                <td><?= '15%'; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Percent - How many of those who viewed the property made a bid') ?></th>
                                <td><?= $this->Custom->viewbid($property->id) . '%'; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('A number of days from publishing the property until it was sold') ?></th>
                                <td><?= $this->Custom->getUntillSold($property->id); ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Percentage of increase - between the minimum amount offered and the amount purchased') ?></th>
                                <td><?= (($property->price / $property->updated_price)*100); ?></td>
                            </tr>

                        <?php } ?>

                        <tr>
                            <th scope="row"><?= __('User Name') ?></th>
                            <td><?= $this->Html->link($property['user']['name'], ['controller' => 'users', 'action' => 'view', $property['user']['id']]); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('User Type') ?></th>
                            <td><?= $this->Custom->getRole($property['user']['role_id']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Full Address') ?></th>
                            <td><?php 
                            echo is_numeric($property->country)? $this->Custom->getCountryName($property->country):$property->country .' '; 
                            echo '</t>'.is_numeric($property->state)? $this->Custom->getStateName($property->state):$property->state . ' ';
                            echo ' '.is_numeric($property->city)?$this->Custom->getCityName($property->city):$property->city . ' ';
                            echo ' '.is_numeric($property->street)? $this->Custom->getStreetName($property->street):$property->street.' '; 
                            echo ' '.$property->neighbourhood;
                            ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('City') ?></th>
                            <td><?php echo is_numeric($property->city)?$this->Custom->getCityName($property->city):$property->city . ' '; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('No Of Rooms') ?></th>
                            <td><?= $property->no_of_room; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Price') ?></th>
                            <td><?= h($property->price) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Category / Sub Category') ?></th>
                            <td>
                                <?php
                                if (!empty($property->category)) {
                                    echo $this->Custom->getCategory($property->category);
                                }
                                echo ' / ';
                                if (!empty($property->sub_category)) {
                                    echo $this->Custom->getsubcatagory($property->sub_category);
                                }
                                ?>
                            </td>
                        </tr>



                        <?php if (in_array($property->status, [0, 1, 2, 3, 4])) { ?>

                            <?php if (!empty($property->propertytype_id)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Propertytype') ?></th>
                                    <td><?= $this->Custom->getPropertyType($property->propertytype_id, LAN); ?></td>
                                </tr>
                            <?php } ?>

                            <?php if (in_array($property->status, [3])) { ?>
                                <tr>
                                    <th scope="row"><?= __('Selling time in the days') ?></th>
                                    <td><?= "80 days"; ?></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <th scope="row"><?= __('Area') ?></th>
                                <td><?= h($property->area) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Balcony Area') ?></th>
                                <td><?= h($property->balcony_area) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Secure Space') ?></th>
                                <td><?= h($property->secure_space) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Storage Area') ?></th>
                                <td><?= h($property->storage_area) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Storage') ?></th>
                                <td><?= h($property->storage) ?></td>
                            </tr>

                            <tr>
                                <th scope="row"><?= __('Number') ?></th>
                                <td><?= $property->number; ?></td>
                            </tr>


                            <?php if (!empty($property->balcony_type)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Balcony Type') ?></th>
                                    <td><?= Configure::read('BalconyType' . LAN)[$property->balcony_type]; ?></td>
                                </tr>
                            <?php } if (!empty($property->parking_type)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Parking Type') ?></th>
                                    <td><?= Configure::read('PARTYPE' . LAN)[$property->parking_type]; ?></td>
                                </tr>
                            <?php } ?> 
                            <tr>
                                <th scope="row"><?= __('No Of Floor') ?></th>
                                <td><?= $property->no_of_floor; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Number Of Parking') ?></th>
                                <td><?=  $property->number_of_parking; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('No Of Elevator') ?></th>
                                <td><?= $property->no_of_elevator; ?></td>
                            </tr>
                            <?php if (!empty($property->air_direction)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Air Direction') ?></th>
                                    <td><?= Configure::read('AIR' . LAN)[$property->air_direction]; ?></td>
                                </tr>
                            <?php } if (!empty($property->ac)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Ac') ?></th>
                                    <td><?= Configure::read('AIRCOND' . LAN)[$property->ac] ?></td>
                                </tr>
                            <?php } if (!empty($property->bars)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Bars') ?></th>
                                    <td><?= Configure::read('YN' . LAN)[$property->bars]; ?></td>
                                </tr>
                            <?php } if (!empty($property->secure_space)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Secure Space') ?></th>
                                    <td><?= Configure::read('YN' . LAN)[$property->secure_space]; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th scope="row"><?= __('Secure Area') ?></th>
                                <td><?= $property->storage_area; ?></td>
                            </tr>
                            <?php if (!empty($property->master_badroom)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Master Badroom') ?></th>
                                    <td><?= Configure::read('YN' . LAN)[$property->master_badroom]; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th scope="row"><?= __('No Of Shower') ?></th>
                                <td><?= $property->no_of_shower; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('No Of Wc') ?></th>
                                <td><?= $property->no_of_wc; ?></td>
                            </tr>
                            <?php if (!empty($property->property_condition)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Property Condition') ?></th>
                                    <td><?= Configure::read('PROPCON' . LAN)[$property->property_condition]; ?></td>
                                </tr>
                            <?php } if (!empty($property->storage)) { ?>
                                <tr>
                                    <th scope="row"><?= __('Storage') ?></th>
                                    <td><?= Configure::read('YN' . LAN)[$property->storage]; ?></td>
                                </tr>

                            <?php } ?>

                            <tr>
                                <th scope="row"><?= __('No Of Payment') ?></th>
                                <td><?= $property->no_of_payment; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('First Payment') ?></th>
                                <td><?= Configure::write('FIRSTPAY' . LAN)[$property->first_payment] ?></td>
                            </tr>

                            <tr>
                                <th scope="row"><?= __('Evaculation Date') ?></th>
                                <td><?= h($property->evaculation_date) ?></td>
                            </tr>

                            <?php if (in_array($property->status, [1, 2, 3, 4])) { ?>
                                <tr>
                                    <th scope="row"><?= __('Number of buyers who viewed the property') ?></th>
                                    <td><?= !empty($property->property_view_count) ? $property->property_view_count : 0; ?>  <?= $this->Html->link('View', ['controller'=>'properties','action'=>'viewusers',$property->id]); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Quantity of buyers who signed the property') ?></th>
                                    <td><?= !empty($property->property_signature_count) ? $property->property_signature_count : 0; ?>  <?= $this->Html->link('View', ['controller'=>'properties','action'=>'signusers',$property->id]); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Quantity of buyers bids to the property') ?></th>
                                    <td><?= !empty($property->property_bid_count) ? $property->property_bid_count : 0; ?>  <?= $this->Html->link('View', ['controller'=>'properties','action'=>'bidusers',$property->id]); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('How long (in days) since the property published') ?></th>
                                    <td><?= h($this->Custom->publishedDays($property->id)); ?> </td>
                                </tr>
                            <?php } ?>

                            <?php if ($property->status == 0) { ?>
                                <tr>
                                    <th scope="row"><?= __('Status') ?></th>
                                    <td><?= Configure::read('STATUS' . LAN)[$property->status]; ?></td>
                                </tr>

                                <?php if (!empty($property->handling)) { ?>
                                    <tr>
                                        <th scope="row"><?= __('Handling Status') ?></th>
                                        <td><?= Configure::read('HANDING' . LAN)[$property->handling]; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th scope="row"><?= __('Handling Status Update Date') ?></th>
                                    <td><?= $property->created->format('d/m/Y'); ?></td>
                                </tr>
                            <?php }
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(){

    $('body').append('<div class="product-image-overlay"><span class="product-image-overlay-close">x</span><img src="" /></div>');
        var productImage = $('img');
        var productOverlay = $('.product-image-overlay');
        var productOverlayImage = $('.product-image-overlay img');
        productImage.click(function () {

            var productImageSource = $(this).attr('src');
                    productOverlayImage.attr('src', productImageSource);
                    productOverlay.fadeIn(100);
                    $('body').css('overflow', 'hidden');
                    $('.product-image-overlay-close').click(function () {
            productOverlay.fadeOut(100);
                    $('body').css('overflow', 'auto');
            });
        });
        });
</script>
<style type="text/css">
    .product-image-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: none;
    }

    .product-image-overlay .product-image-overlay-close {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid #eee;
        line-height: 35px;
        font-size: 20px;
        color: #eee;
        text-align: center;
        cursor: pointer;
    }

    .product-image-overlay img {
        width: auto;
        max-width: 80%;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    img{
        cursor: pointer;
    }
</style>