<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Default');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $setting = $this->Settings->find()->order(['type' => 'ASC','section'=>'ASC'])->toArray();
        //pr($setting);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            foreach ($this->request->data as $key => $value) {
                $setArr = array();
                if ($value['typename'] == 'file') {
                   
                    if (isset($value['image']['name']) && $value['image']['name'] != '') {
                        $imagename = $this->Default->createImageName($value['image']['name'], BASE_PATH_SETTING, current(explode(".", $value['image']['name'])));
                        if (move_uploaded_file($value['image']['tmp_name'], BASE_PATH_SETTING . $imagename)) {
                            if ($value['old_file'] != $imagename) {
                                @unlink(BASE_PATH_SETTING . $value['old_file']);
                            }
                        }
                        $setArr['value'] = $imagename;
                    }
                } else {
                    $setArr['value'] = $value['value'];
                }

                if (!empty($setArr)) {
                    $settings = $this->Settings->get($value['id'], [
                        'contain' => []
                    ]);
                    $settings = $this->Settings->patchEntity($settings, $setArr);
                    $this->Settings->save($settings);
                }
            }
            $this->Flash->success(__('The setting has been saved.'));
            $this->redirect(['action' => 'index']);
        }

        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

}
