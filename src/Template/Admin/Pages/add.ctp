<section class="content-header">
    <h1>
        Manage Content <small><?php echo empty($record->id) ? "add page" : "edit page"; ?></small>
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
            <h3 class="box-title"><?= __(empty($record->id) ? 'Add Page' : "Edit Page") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($record, ['role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => 'Title', 'label' => ['text' => "Title"]]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('alias', ['class' => 'form-control', 'placeholder' => 'Alias', 'label' => ['text' => "Alias"]]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label>Status</label>
                        <?php
                        echo $this->Form->select(
                                'status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control']
                        );
                        ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('meta_description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Meta Description', 'label' => ['text' => "Meta Description"]]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('meta_title', ['class' => 'form-control', 'placeholder' => 'Meta Title', 'label' => ['text' => "Meta Title"]]); ?>

                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('meta_keyword', ['class' => 'form-control', 'placeholder' => 'Meta Keyword', 'label' => ['text' => "Meta Keyword"]]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
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
            <?php echo $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn default']); ?>
        </div>
        <?= $this->Form->end() ?>
    </div><!-- /.box -->
</section>