<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Galleries Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 */
class GalleriesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Images');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query, 'type' => 1]];

        $this->paginate = $options;
        $images = $this->paginate($this->Images);

        $this->set(compact('images'));
        $this->set('_serialize', ['images']);
    }

    /**
     * Add method
     *
     * @param string|null $id Image id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id)
            $image = $this->Images->get($id, [
                'contain' => []
            ]);
        else
            $image = $this->Images->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['type'] = 1; // 1 for gallery
            $image = $this->Images->patchEntity($image, $this->request->data);
            if ($this->Images->save($image)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__($this->Default->get_errors($image->errors())));
        }
        $this->set(compact('image'));
        $this->set('_serialize', ['image']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Image id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Images->get($id);
        // delete image from folder
        if (isset($image->image) && !empty($image->image))
            $this->Images->deleteImage($image->image, $image);
        
        if ($this->Images->delete($image)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
