<?php
/**
  * @var \App\View\AppView $this
  */
?>
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
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($enquiry->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($enquiry->email) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($enquiry->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Phone') ?></th>
                            <td><?= $this->Number->format($enquiry->phone) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($enquiry->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Message') ?></th>
                            <td><?= $this->Text->autoParagraph(h($enquiry->message)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>