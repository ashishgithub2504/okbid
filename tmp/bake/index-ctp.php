<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<CakePHPBakeOpenTagphp
/**
  * @var \<?= $namespace ?>\View\AppView $this
  */
CakePHPBakeCloseTag>
<?php
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}

if (!empty($indexColumns)) {
    $fields = $fields->take($indexColumns);
}

?>
<section class="content-header">
    <h1>
        Manage <?= $pluralHumanName ?>

        <small>All <?= $pluralHumanName ?> List</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <CakePHPBakeOpenTagphp echo $this->Flash->render(); CakePHPBakeCloseTag>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-circle-o"></i> <span
                            class="caption-subject font-green bold uppercase"><?= $pluralHumanName ?></span></h3>
                    <div class="box-tools">
                        <CakePHPBakeOpenTagphp echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add <?= $singularHumanName ?>'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); CakePHPBakeCloseTag>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <CakePHPBakeOpenTagphp
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        CakePHPBakeCloseTag>
                        <div class="col-md-3">
                            <label for="keyword">Keyword</label>

                            <div class="input-group">
                                <CakePHPBakeOpenTagphp echo $this->Form->input('keyword', ['class' => 'form-control input-sm pull-right', 'placeholder' => 'Keyword', 'label' => false, 'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : '']); CakePHPBakeCloseTag>
                                <div class="input-group-btn">
                                    <CakePHPBakeOpenTagphp echo $this->Form->button('<i class="fa fa-search"></i>', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); CakePHPBakeCloseTag>
                                </div>
                            </div>
                        </div>
                        <CakePHPBakeOpenTag= $this->Form->end() CakePHPBakeCloseTag>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                <?php foreach ($fields as $field): ?>
                <th scope="col"><CakePHPBakeOpenTag= $this->Paginator->sort('<?= $field ?>') CakePHPBakeCloseTag></th>
                <?php endforeach; ?>
                <th scope="col" class="actions"><CakePHPBakeOpenTag= __('Actions') CakePHPBakeCloseTag></th>
                            </tr>
                        </thead>
                        <tbody>
                            <CakePHPBakeOpenTagphp if (count($<?= $pluralVar ?>) > 0):
                            foreach ($<?= $pluralVar ?> as $<?= $singularVar ?>): CakePHPBakeCloseTag>
                            <tr>
                <?php foreach ($fields as $field) {
                            $isKey = false;
                            if (!empty($associations['BelongsTo'])) {
                                foreach ($associations['BelongsTo'] as $alias => $details) {
                                    if ($field === $details['foreignKey']) {
                                        $isKey = true;
                ?>
                <td><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></td>
                <?php
                                        break;
                                    }
                                }
                            }
                            if ($isKey !== true) {
                                if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float', 'datetime'])) {
                ?>
                <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                <?php
                                } 
                                else if (in_array($schema->columnType($field), ['datetime'])) {
                ?>
                <td><CakePHPBakeOpenTagphp if ($<?= $singularVar ?>-><?= $field ?> != "") echo $<?= $singularVar ?>-><?= $field ?>->format('d-M-Y'); CakePHPBakeCloseTag></td>
                <?php
                                }
                                else {
                ?>
                <td><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                <?php
                                }
                            }
                        }

                        $pk = '$' . $singularVar . '->' . $primaryKey[0];
                ?>
                <td class="actions">
                                    <CakePHPBakeOpenTag= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', <?= $pk ?>], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) CakePHPBakeCloseTag>
                                    <CakePHPBakeOpenTag= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', <?= $pk ?>], ['class' => 'btn btn-success btn-sm', 'escape' => false]) CakePHPBakeCloseTag>
                                    <CakePHPBakeOpenTag= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', <?= $pk ?>], ['confirm' => __('Are you sure you want to delete # {0}?', <?= $pk ?>), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) CakePHPBakeCloseTag>
                                </td>
                            </tr>
                            <CakePHPBakeOpenTagphp endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No <?= $singularHumanName ?> Found</strong> </td> </tr>";
                            endif;
                            CakePHPBakeCloseTag>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <CakePHPBakeOpenTagphp echo $this->element('pagination'); CakePHPBakeCloseTag>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>