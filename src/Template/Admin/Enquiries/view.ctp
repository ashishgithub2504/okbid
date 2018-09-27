<section class="content-header">
    <h1>
        Manage Enquiries
        <small>Enquiries info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td>#<?= h($enquiry->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($enquiry->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($enquiry->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Phone') ?></th>
                            <td><?= h($enquiry->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td>
                                <?php
                                if ($enquiry->created != "") {
                                    echo $enquiry->created->format($SettingConfig['admin_date_format']);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Message') ?></th>
                            <td><?= $this->Text->autoParagraph(h($enquiry->message)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>