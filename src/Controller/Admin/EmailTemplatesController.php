<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;

/**
 * EmailTemplates Controller
 *
 * @property \App\Model\Table\EmailTemplatesTable $EmailTemplates
 */
class EmailTemplatesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $options['order'] = ['id' => 'DESC'];
        $options['contain'] = [];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $this->paginate = $options;
        $records = $this->paginate($this->{$this->modelClass});
        $this->set(compact('records'));
        $this->set('_serialize', ['records']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $record = $this->{$this->modelClass}->get($id, [
            'contain' => []
        ]);

        $this->set('record', $record);
        $this->set('_serialize', ['record']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null) {
        if ($id) {
            $record = $this->{$this->modelClass}->get($id, [
                'contain' => []
            ]);
        } else {
            $record = $this->{$this->modelClass}->newEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $record = $this->{$this->modelClass}->patchEntity($record, $this->request->data);
            if ($this->{$this->modelClass}->save($record)) {
                $this->Flash->success(__('The email template has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__($this->Default->get_errors($record->errors())));
            }
        }
        $this->set(compact('record'));
        $this->set('_serialize', ['record']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $record = $this->{$this->modelClass}->get($id);
        if ($this->{$this->modelClass}->delete($record)) {
            $this->Flash->success(__('The email template has been deleted.'));
        } else {
            $this->Flash->error(__('The email template could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
