<section class="content-header">
    <h1>
        Manage Email Templates <small> Template Detail</small>
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
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Title') ?></th>
                            <td><?= h($record->title) ?></td>
                            <th><?= __('Subject') ?></th>
                            <td><?= h($record->subject) ?></td>
                        </tr>
                       

                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?php
                                if ($record->status == 1) {
                                    echo '<span class="label label-success"> Active </span>';
                                } else {
                                    echo '<span class="label label-danger"> Inactive </span>';
                                }
                                ?></td>
                            <th><?= __('Html') ?></th>
                            <td><?php
                                if ($record->is_html == 1) {
                                    echo '<span class="label label-success"> YES </span>';
                                } else {
                                    echo '<span class="label label-danger"> NO </span>';
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Description') ?></th>
                            <td colspan="3"><?php
                                if ($record->is_html == 1) {
                                    echo $record->description;
                                } else {
                                    echo strip_tags($record->description);
                                }
                                ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>