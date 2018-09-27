<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 */
class NewsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $options['order'] = ['id' => 'DESC'];
        $options['contain'] = ['Categories'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];

        $this->paginate = $options;
        $news = $this->paginate($this->News);
        $categories = $this->News->Categories->find('list')->where(['status' => 1]);
        $this->set(compact('news','categories'));
        $this->set('_serialize', ['news','categories']);
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $news = $this->News->get($id, [
            'contain' => ['Categories']
        ]);

        $this->set('news', $news);
        $this->set('_serialize', ['news']);
    }

    /**
     * Add method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id)
            $news = $this->News->get($id, [
                'contain' => []
            ]);
        else
            $news = $this->News->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->data);
            if ($this->News->save($news)) {
                $this->Flash->success(__('The news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news could not be saved. Please, try again.'));
        }
        $categories = $this->News->Categories->find('list', ['limit' => 200, 'conditions' => ['status' => 1]]);
        $this->set(compact('news', 'categories'));
        $this->set('_serialize', ['news']);
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $news = $this->News->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->data);
            if ($this->News->save($news)) {
                $this->Flash->success(__('The news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news could not be saved. Please, try again.'));
        }
        $categories = $this->News->Categories->find('list', ['limit' => 200]);
        $this->set(compact('news', 'categories'));
        $this->set('_serialize', ['news']);
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $news = $this->News->get($id);
        // delete image from folder
        if (isset($news->image) && !empty($news->image))
            $this->News->deleteImage($news->image, $news);
        
        if ($this->News->delete($news)) {
            $this->Flash->success(__('The news has been deleted.'));
        } else {
            $this->Flash->error(__('The news could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
