<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
$countries = $this->Custom->getCountry();

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<section class="content-header">
    <h1>
        Manage Properties 
        <small>Create New Property</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Add Property') ?></h3>
        </div><!-- /.box-header -->
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">Ownership</a></li>
            <li><a data-toggle="tab" href="#menu2">Images</a></li>
        </ul>
        <?php echo $this->Form->create($property, ['id' => 'validateform', 'role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">

            <div class="row">
                <div class="tab-content">

                    <div id="home" class="tab-pane fade in active">

                        <div class="col-md-6">
                            <div class="form-group">         
                                <?php echo $this->Form->input('category', ['class' => 'form-control', 'options' => Configure::read('CATEGORY' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('category'), 'label' => ['text' => ucfirst('category'), 'class' => 'req']]); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">         
                                <?php echo $this->Form->input('sub_category', ['class' => 'form-control', 'options' => [], 'empty' => 'Please select', 'placeholder' => ucfirst('sub category'), 'label' => ['text' => ucfirst('sub Category'), 'class' => 'req']]); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">         
                                <?php echo $this->Form->input('price', ['class' => 'form-control',"min"=>"0", 'placeholder' => ucfirst('price'), 'label' => ['text' => ucfirst('price'), 'class' => 'req']]); ?>
                            </div>
                        </div>

                        <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('6'))) { ?>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('project_id', ['class' => 'form-control', 'empty' => 'select', 'options' => $projects, 'label' => ['text' => ucfirst('Project name'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="divider">
                            <h3>Address</h3>

                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('country', ['class' => 'form-control','empty' => 'select country', 'options'=>$countries, 'placeholder' => ucfirst('country'),'label' => ['text' => ucfirst('country') ,'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('state', ['class' => 'form-control', 'options' => '', 'label' => ['text' => ucfirst('state'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('city', ['class' => 'form-control', 'placeholder' => ucfirst('city'), 'label' => ['text' => ucfirst('city'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('neighbourhood', ['class' => 'form-control', 'placeholder' => ucfirst('neighbourhood'), 'label' => ['text' => ucfirst('neighbourhood'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('street', ['class' => 'form-control', 'placeholder' => ucfirst('street'), 'label' => ['text' => ucfirst('street'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('number', ['class' => 'form-control', 'placeholder' => ucfirst('number'), 'label' => ['text' => ucfirst('number'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label>Type address</label>
                                    <input id="geocomplete" type="text" class="form-control" placeholder="Type in an address" />
                                </div>
                            </div>
<!--                                <input id="find" type="button" value="find" />-->

                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <?php echo $this->Form->input('lat', ['class' => 'form-control', 'placeholder' => ucfirst('Latitude'),'disabled', 'label' => ['text' => ucfirst('Latitude'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <?php echo $this->Form->input('lng', ['class' => 'form-control', 'placeholder' => ucfirst('Longitude'),'disabled', 'label' => ['text' => ucfirst('Latitude'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <div class="map_canvas" style="width:500px; height:250px;"></div>
                           
                        </div>

                        <div class="divider">
                            <h3>Property Type</h3>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('no_of_room', ['class' => 'form-control', 'placeholder' => ucfirst('no of room'), 'label' => ['text' => ucfirst('no of room'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('propertytype_id', ['class' => 'form-control', 'options' => Configure::read('PROTY' . LAN), 'empty' => 'select', 'label' => ['text' => ucfirst('property Type')]]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('area', ['class' => 'form-control', 'placeholder' => ucfirst('build area'), 'label' => ['text' => ucfirst('area'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                        </div>

                        <div class="divider">
                            <h3>Basic information</h3>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('air_direction', ['class' => 'form-control', 'options' => Configure::read('AIR' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('air Direction'), 'label' => ['text' => ucfirst('air Direction'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('balcony_type', ['class' => 'form-control', 'options' => Configure::read('BalconyType' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('balcony Type'), 'label' => ['text' => ucfirst('balcony Type'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('balcony_area', ['class' => 'form-control', 'placeholder' => ucfirst('balcony area'), 'label' => ['text' => ucfirst('balcony Area'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('no_of_floor', ['class' => 'form-control',"min"=>"0" ,'placeholder' => ucfirst('no of floor'), 'label' => ['text' => ucfirst('no Of Floor'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('number_of_parking', ['class' => 'form-control',"min"=>"0", 'placeholder' => ucfirst('number of parking'), 'label' => ['text' => ucfirst('number Of Parking'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('parking_type', ['class' => 'form-control', 'options' => Configure::read('PARTYPE' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('parking Type'), 'label' => ['text' => ucfirst('parking Type'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('no_of_elevator', ['class' => 'form-control', 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'empty' => 'select', 'placeholder' => ucfirst('no Of Elevator'), 'label' => ['text' => ucfirst('no Of Elevator'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                        </div>

                        <div class="divider">
                            <h3>More information</h3>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('ac', ['class' => 'form-control', 'options' => Configure::read('AIRCOND' . LAN), 'empty' => 'select', 'empty' => 'select', 'placeholder' => ucfirst('ac'), 'label' => ['text' => ucfirst('ac'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('bars', ['class' => 'form-control', 'options' => Configure::read('YN' . LAN), 'empty' => 'select', 'empty' => 'select', 'placeholder' => ucfirst('bars'), 'label' => ['text' => ucfirst('bars'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('secure_space', ['class' => 'form-control', 'options' => Configure::read('YN' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('secure_space'), 'label' => ['text' => ucfirst('secure Space'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('master_badroom', ['class' => 'form-control', 'options' => Configure::read('YN' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('master_badroom'), 'label' => ['text' => ucfirst('master Badroom'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('storage', ['class' => 'form-control', 'placeholder' => ucfirst('storage'), 'options' => Configure::read('YN' . LAN), 'empty' => 'select', 'label' => ['text' => ucfirst('storage'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('storage_area', ['class' => 'form-control', 'label' => ['text' => ucfirst('storage Area'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('no_of_shower', ['class' => 'form-control', 'options' => ['1' => '1', '2' => '2', '3' => '3'], 'empty' => 'select', 'placeholder' => ucfirst('no_of_shower'), 'label' => ['text' => ucfirst('no Of Shower'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('no_of_wc', ['class' => 'form-control', 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], 'placeholder' => ucfirst('no of wc'), 'label' => ['text' => ucfirst('no of wc'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('disabled', ['class' => 'form-control', 'options' => ['1' => 'Yes', '0' => 'No'], 'placeholder' => ucfirst('Disabled Access'), 'label' => ['text' => ucfirst('Disabled Access'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('want3dtour', ['class' => 'form-control12', 'id' => 'want3dtour', 'type' => 'checkbox', 'label' => ['text' => ucfirst('Want 3d tour'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('3dtour', ['class' => 'form-control', 'disabled','placeholder' => ucfirst('3d tour'), 'label' => ['text' => ucfirst('3d tour'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            
                        </div>



                        <div class="divider">
                            <h3>Property Condition</h3>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('property_condition', ['class' => 'form-control', 'options' => Configure::read('PROPCON' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('property_condition'), 'label' => ['text' => ucfirst('property Condition'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('condition_text', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => ucfirst('Specify the following places in the property'), 'label' => FALSE]); ?>
                                </div>
                            </div>
                        </div> 

                        <div class="divider">
                            <h3>Defects</h3>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('defects_text', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => ucfirst('Please write all the defect and demages'), 'label' => ['text' => false, 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('defects', ['class' => 'form-control12', 'id' => 'defect', 'type' => 'checkbox', 'label' => ['text' => ucfirst('No defect'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                        </div>

                        <div class="divider">
                            <h3>Evaculation date & Payments</h3>
                            <div class="col-md-6">
                                <div class="form-group">        
                                    <?php echo $this->Form->input('evaculation_date', ['type' => 'text', 'class' => 'form-control', 'placeholder' => ucfirst('evaculation date'), 'label' => ['text' => ucfirst('evaculation Date'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group top30">         
                                    <?php echo $this->Form->input('is_flexible_evaculation', ['class' => 'form-control12','type' =>'checkbox', 'label' => ['text' => ucfirst('flexible evaculation'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('no_of_payment', ['class' => 'form-control', 'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'], 'empty' => 'select', 'placeholder' => ucfirst('no_of_payment'), 'label' => ['text' => ucfirst('no Of Payment'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('is_flexible_payment', ['class' => 'form-control12','type' =>'checkbox', 'label' => ['text' => ucfirst('flexible payment'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('first_payment', ['class' => 'form-control', 'options' => Configure::read('FIRSTPAY' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('first_payment'), 'label' => ['text' => ucfirst('first Payment'), 'class' => 'req']]); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('first_payment_text', ['class' => 'form-control', 'placeholder' => ucfirst('first Payment Text'), 'label' => ['text' => ucfirst('first Payment'), 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">         
                                    <?php echo $this->Form->input('important_note', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => ucfirst('Write down important emphases on the property'), 'label' => ['text' => false, 'class' => 'req']]); ?>
                                </div>
                            </div>

                            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>
                                <div class="col-md-6">
                                    <div class="form-group">         
                                        <?php echo $this->Form->input('handling', ['class' => 'form-control', 'options' => Configure::read('HANDING' . LAN), 'placeholder' => ucfirst('HANDING status'), 'label' => ['text' => ucfirst('Handing Status'), 'class' => 'req']]); ?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </div>


                    <div id="menu1" class="tab-pane fade">

                        <div class="col-md-12">
                            <div class="form-group">     
                                <div class="box">
                                    <?php echo $this->Form->input('property_ownerships[][image_file]', ['class' => 'inputfile1 inputfile-41', 'id' => 'file-5', 'type' => 'file', 'multiple' => 'multiple', 'accept' => 'image/*', 'label' => ['text' => ucfirst('Property Ownership Images'), 'class' => 'req']]); ?>
<!--                                    <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg></figure> <span>Choose a file…</span></label>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">         
                                <div class="box">
                                    <?php echo $this->Form->input('property_ownerships[][file_file]', ['class' => 'inputfile1 inputfile-41', 'id' => 'file-5', 'type' => 'file', 'multiple' => 'multiple', 'accept' => 'doc/*', 'label' => ['text' => ucfirst('Property Ownership Document'), 'class' => 'req']]); ?>
<!--                                    <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg></figure> <span>Choose a file…</span></label>-->
                                </div>

                            </div>
                        </div>

                        <div class="divider">
                            <h3>Owners Detail</h3>

                            <div id="propowner">

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?= $this->Form->input('Add Owner', ['type' => 'button', 'label' => false, 'class' => 'btn btn-primary']); ?>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="menu2" class="tab-pane fade">

                        <div class="col-md-6">
                            <p style="font-size:16px;"><b>Upload a Picture (upload multiple images)</b> <br/>
                                <span style="font-size:14px;"> Important to upload clear and specific pictures from different angles </span>
                            </p>

                            <div class="form-group">         
                                <?php echo $this->Form->input('property_images[][image_file]', ['class' => 'form-control', 'type' => 'file', 'multiple' => 'multiple', 'label' => false]); ?>
                            </div>
                        </div>
                    </div>




                </div> 
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn default']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div><!-- /.box -->
</section>
<script type="text/javascript">
    $(document).ready(function () {

        $("#category").change(function () {
            var html = '';
            if ($(this).val() == 1) {
                html = '<option value="">Please select</option><option value="residence">residence</option><option value="commercial">commercial</option>';
            } else if ($(this).val() == 2) {
                html = '<option value="">Please select</option><option value="sell">sell</option><option value="Rent">Rent</option>';
            } else if ($(this).val() == 3) {
                html = '<option value="">Please select</option><option value="residence">residence</option><option value="commercial">commercial</option><option value="other">other</option>';
            } else if ($(this).val() == 5) {
                html = '<option value="">Please select</option><option value="residence">residence</option><option value="commercial">commercial</option><option value="Grounds">Grounds</option>';
            } else if ($(this).val() == 6) {
                html = '<option value="">Please select</option><option value="Grounds for saturated construction">Grounds for saturated construction</option><option value="Grounds for privet construction">Grounds for privet construction</option><option value="National Outline Plan 38">National Outline Plan 38</option>';
            }
            $("#sub-category").html(html);
        });
        
        $(document).on('change','#country',function(){            
            $.ajax({
                url: baseurl + "admin/properties/getstate",
                type:'POST',
                data:{'id':$(this).val()},
                cache: false,
                success: function (html) {
                    var ht = '';
                    var data = JSON.parse(html);
                    console.log(data);
                    for(i=0 ; i<data.length; i++){
                        ht += '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';
                    }
                    console.log(ht);
                    $("#state").html(ht);
                }
            });
        });

        $("#defect").click(function () {
            if ($(this).is(':checked') == true) {
                $("#defects-text").attr('disabled', true);
            } else {
                $("#defects-text").attr('disabled', false);
            }
        });
        
        $("#want3dtour").click(function () {
            if ($(this).is(':checked') == true) {
                $("#3dtour").attr('disabled', false);
            } else {
                $("#3dtour").attr('disabled', true);
            }
        });

        $("#evaculation-date").datepicker({});
    });
</script>
<style type="text/css">   
    .box {
        border-top:none !important;
    }
</style>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA7VsgVOAbB2BxoZI_xQ4iF97YbIL3_1yw&libraries=places&libraries=places" async defer></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<?php
echo $this->Html->script(['jquery.geocomplete.js']);
?>
<script>
    var jq = $.noConflict();
    jq(function () {
        jq("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form ",
            markerOptions: {
                draggable: true
            }
        });

        jq("#geocomplete").bind("geocode:dragged", function (event, latLng) {
            jq("input[name=lat]").val(latLng.lat());
            jq("input[name=lng]").val(latLng.lng());
            jq("#reset").show();
        });


        jq("#reset").click(function () {
            jq("#geocomplete").geocomplete("resetMarker");
            jq("#reset").hide();
            return false;
        });

        jq("#find").click(function () {
            jq("#geocomplete").trigger("geocode");
        }).click();
    });
</script>