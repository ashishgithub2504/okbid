<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Conversations
        <small>All Conversations List</small>
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
            <div class="box minh750">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-circle-o"></i> <span
                            class="caption-subject font-green bold uppercase">Conversations</span></h3>
                   
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <?php
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        ?>
                        <div class="col-md-3">
                            <label for="keyword">Title</label>

                            <div class="input-group">
                                <?php echo $this->Form->input('title', ['class' => 'form-control input-sm pull-right','autocomplete'=>'off' ,'placeholder' => 'Title', 'label' => false, 'value' => !empty($this->request->query['title']) ? $this->request->query['title'] : '']); ?>
                                <div class="input-group-btn">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding" id="loadmessages">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($conversations) > 0):
                            foreach ($conversations as $conversation): ?>
                            <tr>
                                <td><?= $this->Number->format($conversation->id) ?></td>
                                <td><?= $conversation->has('user') ? $this->Html->link($conversation->user->name, ['controller' => 'Users', 'action' => 'view', $conversation->user->id]) : '' ?></td>
                                <td><?= h($conversation->title) ?></td>
                                <td><?= h($conversation->message) ?></td>
                                <td><?php if ($conversation->created != "") echo $conversation->created->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> Message'), ['action' => 'message', $conversation->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Conversation Found</strong> </td> </tr>";
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        <?php if($title == '0'){ ?>
        setInterval(function () {

            $.ajax({
                url: baseurl + "admin/conversations/indexload",
                cache: false,
                success: function (html) {
                    $("#loadmessages").html(html);
                }
            });
        }, 5000);
        <?php } ?>
    });
</script>