<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RiderLeaves Controller
 *
 * @property \App\Model\Table\RiderLeavesTable $RiderLeaves
 */
class RiderLeavesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Riders']
        ];
        $riderLeaves = $this->paginate($this->RiderLeaves);

        $this->set(compact('riderLeaves'));
        $this->set('_serialize', ['riderLeaves']);
    }

    /**
     * View method
     *
     * @param string|null $id Rider Leave id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $riderLeave = $this->RiderLeaves->get($id, [
            'contain' => ['Riders']
        ]);

        $this->set('riderLeave', $riderLeave);
        $this->set('_serialize', ['riderLeave']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $riderLeave = $this->RiderLeaves->newEntity();
        if ($this->request->is('post')) {
            $riderLeave = $this->RiderLeaves->patchEntity($riderLeave, $this->request->data);
            if ($this->RiderLeaves->save($riderLeave)) {
                $this->Flash->success(__('The rider leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rider leave could not be saved. Please, try again.'));
        }
        $riders = $this->RiderLeaves->Riders->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('riderLeave', 'riders'));
        $this->set('_serialize', ['riderLeave']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rider Leave id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $riderLeave = $this->RiderLeaves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $riderLeave = $this->RiderLeaves->patchEntity($riderLeave, $this->request->data);
            if ($this->RiderLeaves->save($riderLeave)) {
                $this->Flash->success(__('The rider leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rider leave could not be saved. Please, try again.'));
        }
        $riders = $this->RiderLeaves->Riders->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('riderLeave', 'riders'));
        $this->set('_serialize', ['riderLeave']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rider Leave id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $riderLeave = $this->RiderLeaves->get($id);
        if ($this->RiderLeaves->delete($riderLeave)) {
            $this->Flash->success(__('The rider leave has been deleted.'));
        } else {
            $this->Flash->error(__('The rider leave could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
