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
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}
?>

<section class="content-header">
    <h1>
        Manage <?= $pluralHumanName ?> 
<?php if (strpos($action, 'add') === false): ?>
        <small>Update <?= $singularHumanName ?> Details</small>
<?php else: ?>
        <small>Create New <?= $singularHumanName ?></small>
<?php endif; ?>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <CakePHPBakeOpenTagphp echo $this->Flash->render(); CakePHPBakeCloseTag>
        </div>
    </div>
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><CakePHPBakeOpenTag= __('<?= Inflector::humanize($action) ?> <?= $singularHumanName ?>') CakePHPBakeCloseTag></h3>
        </div><!-- /.box-header -->
        <CakePHPBakeOpenTagphp echo $this->Form->create($<?= $singularVar ?>, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); CakePHPBakeCloseTag>
        <div class="box-body">
            <div class="row">
<?php
foreach ($fields as $field) {
 if (in_array($field, $primaryKey)) {
        continue;
    }
    if (isset($keyFields[$field])) {
        $fieldData = $schema->column($field);
        if (!empty($fieldData['null'])) {
?>
                <div class="col-md-6">
                    <div class="form-group">
                        <CakePHPBakeOpenTagphp echo $this->Form->input('<?= $field ?>', ['class' => 'form-control', 'options' => $<?= $keyFields[$field] ?>, 'empty' => true, 'label' => ['text' => ucfirst('<?= $field ?>')]]); CakePHPBakeCloseTag>
                    </div> 
                </div>
<?php
} else {
?>
                <div class="col-md-6">
                    <div class="form-group">
                        <CakePHPBakeOpenTagphp echo $this->Form->input('<?= $field ?>', ['class' => 'form-control', 'options' => $<?= $keyFields[$field] ?>, 'label' => ['text' => ucfirst('<?= $field ?>')]]); CakePHPBakeCloseTag>
                    </div>
                </div>
<?php
}
continue;
}
if (!in_array($field, ['created', 'modified', 'updated'])) {
$fieldData = $schema->column($field);
if (in_array($fieldData['type'], ['date', 'datetime', 'time']) && (!empty($fieldData['null']))) {
?>
                <div class="col-md-6">
                    <div class="form-group">        
                        <CakePHPBakeOpenTagphp echo $this->Form->input('<?= $field ?>', ['empty' => true, 'class' => 'form-control', 'placeholder' => ucfirst('<?= $field ?>'), 'label' => ['text' => ucfirst('<?= $field ?>'),'class'=>'req']]); CakePHPBakeCloseTag>
                </div>
                </div>
<?php
} else {
?>
                <div class="col-md-6">
                    <div class="form-group">         
                        <CakePHPBakeOpenTagphp echo $this->Form->input('<?= $field ?>', ['class' => 'form-control', 'placeholder' => ucfirst('<?= $field ?>'), 'label' => ['text' => ucfirst('<?= $field ?>'),'class'=>'req']]); CakePHPBakeCloseTag>
                    </div>
                </div>
<?php
}
} 
} ?>
<?php  if (!empty($associations['BelongsToMany'])) { 
foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
?>
                <div class="col-md-6">
                    <div class="form-group">
                        <CakePHPBakeOpenTagphp echo $this->Form->input('<?= $assocData['property'] ?>._ids', ['class' => 'form-control', 'options' => $<?= $assocData['variable'] ?>, 'label' => ['text' => ucfirst('<?= $field ?>')]]); CakePHPBakeCloseTag>
                    </div>
                </div>
<?php
} ?>
<?php  }
?>
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            <CakePHPBakeOpenTag= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) CakePHPBakeCloseTag>
            <CakePHPBakeOpenTag= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn default']) CakePHPBakeCloseTag>
        </div>
        <CakePHPBakeOpenTag= $this->Form->end() CakePHPBakeCloseTag>
    </div><!-- /.box -->
</section>