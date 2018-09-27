<section class="content-header">
    <h1>
        Site Settings  <small>Here you can manage the site settings</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">General Settings</h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create('Settings', ['role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body" >
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab">General</a></li> 
                    <li><a href="#social" data-toggle="tab">Social</a></li> 
                </ul>
                <div class="tab-content" style="background-color:#ECF0F5;">
                    <?php
                    $num = 0;
                    $section = 0;
                    $count = 0;
                    foreach ($setting as $row) {
                        if ($row->section == 1) {
                            $sectionId = 'general';
                            $sectionClass = 'active tab-pane';
                        } else if ($row->section == 2) {
                            $sectionId = 'social';
                            $sectionClass = 'tab-pane';
                        }
                        if ($section != 0 && $section != $row->section) {
                            echo ' </div>';
                            if($num == 1){
                            echo ' </div>'; 
                            $num = 0;
                            }
                        }
                        if ($section == 0 || $section != $row->section) {
                            echo ' <div class="'.$sectionClass.'" id="' . $sectionId . '">';
                            $section = $row->section;
                        }
                        if ($num == 0) {
                            ?>
                            <div class="row">
                            <?php } ?>       
                            <div class="col-md-6" style="<?php echo ($row->type == 'file') ? 'margin-bottom:20px;' : '' ?>">
                                <!-- Site Logo -------------------------------------------------->
                                <div class="form-group">

                                    <?php if ($row->type == 'file') { ?>
                                        <div class="col-md-3">
                                            <?php
                                            if (file_exists("uploads/settings/" . $row->value) && $row->value != "") {
                                                echo $this->Html->image('/uploads/settings/' . $row->value, ['class' => 'img-responsive', 'id' => 'logo_responce']);
                                            } else {
                                                echo $this->Html->image("no_image.gif", ['class' => 'img-responsive', 'id' => 'logo_responce']);
                                            }
                                            ?>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo $this->Form->input($row->name . '.id', array('type' => 'hidden', 'value' => $row->id)); ?>
                                                <?php echo $this->Form->input($row->name . '.typename', array('type' => 'hidden', 'value' => $row->type)); ?>
                                                <?php echo $this->Form->input($row->name . '.old_file', array('type' => 'hidden', 'value' => $row->value)); ?>
                                                <?php echo $this->Form->input($row->name . '.image', ['type' => 'file', 'label' => ['text' => $row->label], 'div' => false]); ?>

                                            </div><!-- /.form-group -->
                                        </div>
                                    <?php } else if ($row->type == 'textarea') { ?>
                                        <?php echo $this->Form->input($row->name . '.id', array('type' => 'hidden', 'value' => $row->id)); ?>
                                        <?php echo $this->Form->input($row->name . '.typename', array('type' => 'hidden', 'value' => $row->type)); ?>
                                        <?php echo $this->Form->input($row->name . '.value', ['type'=>'textarea','class' => 'form-control', 'placeholder' => $row->label, 'value' => $row->value, 'label' => ['text' => $row->label]]); ?>
                                    <?php } else { ?>
                                        <?php echo $this->Form->input($row->name . '.id', array('type' => 'hidden', 'value' => $row->id)); ?>
                                        <?php echo $this->Form->input($row->name . '.typename', array('type' => 'hidden', 'value' => $row->type)); ?>
                                        <?php echo $this->Form->input($row->name . '.value', ['class' => 'form-control', 'placeholder' => $row->label, 'value' => $row->value, 'label' => ['text' => $row->label]]); ?>
                                    <?php } ?>
                                </div>
                                <!-- //Site Logo -------------------------------------------------->
                            </div>
                            <?php if ($num == 1) { ?>        
                            </div>
                            <?php
                            $num = -1;
                        }
                        $num++;
                        $count++;
                        if ($count == count($setting)) {
                            echo ' </div>';
                        }
                    }
                    ?>
                </div> <!-- /.tab content -->
            </div> <!-- /.nav tabs -->
        </div><!-- /.box-body -->

        <div class="box-footer">
            <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>
            &nbsp; &nbsp;
            <?php echo $this->Form->button(__('Cancel'), ['type' => 'button', 'class' => 'btn default', "onClick" => "window.location.href='" . $this->request->webroot . "admin/" . strtolower($this->request->controller) . "'"]); ?>
        </div>
        <?= $this->Form->end() ?>
    </div><!-- /.box -->
</section>