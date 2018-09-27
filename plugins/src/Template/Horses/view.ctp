<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horses
        <small>Horses info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Fei Number') ?></th>
                            <td><?= h($horse->fei_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Eef Number') ?></th>
                            <td><?= h($horse->eef_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Chipid') ?></th>
                            <td><?= h($horse->chipid) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Birth Name') ?></th>
                            <td><?= h($horse->birth_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($horse->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Image') ?></th>
                            <td><?= h($horse->image) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Height') ?></th>
                            <td><?= h($horse->height) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Sire') ?></th>
                            <td><?= h($horse->sire) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Dam') ?></th>
                            <td><?= h($horse->dam) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Color') ?></th>
                            <td><?= h($horse->color) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Breed') ?></th>
                            <td><?= h($horse->breed) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Country Birth') ?></th>
                            <td><?= h($horse->country_birth) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($horse->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Gender') ?></th>
                            <td><?= $this->Number->format($horse->gender) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($horse->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Dob') ?></th>
                            <td><?= h($horse->dob) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horse->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($horse->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>