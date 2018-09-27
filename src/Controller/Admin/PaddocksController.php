<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Paddocks Controller
 *
 * @property \App\Model\Table\PaddocksTable $Paddocks
 */
class PaddocksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Horses']
        ];
        $paddocks = $this->paginate($this->Paddocks);

        $this->set(compact('paddocks'));
        $this->set('_serialize', ['paddocks']);
    }

    /**
     * View method
     *
     * @param string|null $id Paddock id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paddock = $this->Paddocks->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('paddock', $paddock);
        $this->set('_serialize', ['paddock']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paddock = $this->Paddocks->newEntity();
        if ($this->request->is('post')) {
            $paddock = $this->Paddocks->patchEntity($paddock, $this->request->data);
            if ($this->Paddocks->save($paddock)) {
                $this->Flash->success(__('The paddock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paddock could not be saved. Please, try again.'));
        }
        $horses = $this->Paddocks->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('paddock', 'horses'));
        $this->set('_serialize', ['paddock']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Paddock id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paddock = $this->Paddocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paddock = $this->Paddocks->patchEntity($paddock, $this->request->data);
            if ($this->Paddocks->save($paddock)) {
                $this->Flash->success(__('The paddock has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The paddock could not be saved. Please, try again.'));
        }
        $horses = $this->Paddocks->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('paddock', 'horses'));
        $this->set('_serialize', ['paddock']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Paddock id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paddock = $this->Paddocks->get($id);
        if ($this->Paddocks->delete($paddock)) {
            $this->Flash->success(__('The paddock has been deleted.'));
        } else {
            $this->Flash->error(__('The paddock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
