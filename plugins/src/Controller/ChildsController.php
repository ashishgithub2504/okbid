<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Childs Controller
 *
 * @property \App\Model\Table\ChildsTable $Childs
 */
class ChildsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $childs = $this->paginate($this->Childs);

        $this->set(compact('childs'));
        $this->set('_serialize', ['childs']);
    }

    /**
     * View method
     *
     * @param string|null $id Child id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $child = $this->Childs->get($id, [
            'contain' => ['Users', 'Guardians']
        ]);

        $this->set('child', $child);
        $this->set('_serialize', ['child']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $child = $this->Childs->newEntity();
        if ($this->request->is('post')) {
            $child = $this->Childs->patchEntity($child, $this->request->data);
            if ($this->Childs->save($child)) {
                $this->Flash->success(__('The child has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The child could not be saved. Please, try again.'));
        }
        $users = $this->Childs->Users->find('list', ['limit' => 200]);
        $this->set(compact('child', 'users'));
        $this->set('_serialize', ['child']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Child id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $child = $this->Childs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $child = $this->Childs->patchEntity($child, $this->request->data);
            if ($this->Childs->save($child)) {
                $this->Flash->success(__('The child has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The child could not be saved. Please, try again.'));
        }
        $users = $this->Childs->Users->find('list', ['limit' => 200]);
        $this->set(compact('child', 'users'));
        $this->set('_serialize', ['child']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Child id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $child = $this->Childs->get($id);
        if ($this->Childs->delete($child)) {
            $this->Flash->success(__('The child has been deleted.'));
        } else {
            $this->Flash->error(__('The child could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
