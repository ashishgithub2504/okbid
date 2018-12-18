<?php
/**
 * @var \App\View\AppView $this
 */
?>
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
        <?php
        if (count($conversations) > 0):
            foreach ($conversations as $conversation):
                ?>
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
                <?php
            endforeach;
        else:
            echo "<tr> <td colspan='6' align='center'> <strong>No Conversation Found</strong> </td> </tr>";
        endif;
        ?>
    </tbody>
</table>