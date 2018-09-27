<section class="content-header">
    <h1>
        Manage Email Templates <small><?php echo empty($record->id) ? "add new template" : "edit template"; ?></small>
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
            <h3 class="box-title"><?= __(empty($record->id) ? 'Add Templates' : "Edit Templates") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($record, ['role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => 'Title', 'label' => ['text' => "Title"]]); ?>

                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <?php echo $this->Form->input('subject', ['class' => 'form-control', 'placeholder' => 'Subject', 'label' => ['text' => "Subject"]]); ?>

                    </div><!-- /.form-group -->
                </div>
               
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <?php
                        echo $this->Form->select(
                                'status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control']
                        );
                        ?>
                    </div><!-- /.form-group -->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Html</label>
                        <?php
                        echo $this->Form->select(
                                'is_html', [1 => "Yes", 0 => "No"], ['class' => 'form-control']
                        );
                        ?>
                    </div><!-- /.form-group -->
                </div>

            </div><!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $this->Form->input('description', ['type' => 'textarea', 'class' => 'form-control ckeditor', 'placeholder' => 'Description', 'label' => ['text' => "Description"]]); ?>

                    </div><!-- /.form-group -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>
            &nbsp; &nbsp;
            <?php echo $this->Form->button(__('Cancel'), ['type' => 'button', 'class' => 'btn default', "onClick" => "window.location.href='" . $this->request->webroot . "admin/" . $this->request->controller . "'"]); ?>

        </div>
        <?= $this->Form->end() ?>
    </div><!-- /.box -->
</section>