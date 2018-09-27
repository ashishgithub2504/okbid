<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 */
class PagesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Default');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $options['order'] = ['id' => 'DESC'];
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
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
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
    public function add($id = null)
    {
        if ($id) {
            $record = $this->{$this->modelClass}->get($id, [
                'contain' => []
            ]);
        } else {
            $record = $this->{$this->modelClass}->newEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {

            if (trim($this->request->data['alias']) == "") {
                $alias = $this->Default->getUniqueAlias($this->request->data['title'], $this->modelClass, $id);
            } else {
                $alias = $this->Default->getUniqueAlias($this->request->data['alias'], $this->modelClass, $id);
            }
            $record = $this->{$this->modelClass}->patchEntity($record, $this->request->data);
            if ($this->{$this->modelClass}->save($record)) {
                $this->Flash->success(__('The page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('record'));
        $this->set('_serialize', ['record']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Change Status method
     *
     * @param string|null $id Model id|$status value|$field fieldname.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function status_change($id = null, $status = null, $field = 'status')
    {
        $this->autoRender = false;
        if ($id) {
            $record = $this->{$this->modelClass}->get($id, ['fields' => ['id', $field]]);
            if ($record) {
                $record[$field] = $status;
            }
            if ($this->{$this->modelClass}->save($record)) {

                $field_name = str_replace('_', ' ', $field);
                $field_name = ucwords($field_name);

                $message = $status ? $field_name . " activated successfully" : $field_name . " deactivated successfully";
                $this->Flash->success(__($message));
                return $this->redirect($this->referer());
            }
        }
    }
    
    
}
