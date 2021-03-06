<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Guardians Controller
 *
 * @property \App\Model\Table\GuardiansTable $Guardians
 */
class GuardiansController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Children']
        ];
        $guardians = $this->paginate($this->Guardians);

        $this->set(compact('guardians'));
        $this->set('_serialize', ['guardians']);
    }

    /**
     * View method
     *
     * @param string|null $id Guardian id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $guardian = $this->Guardians->get($id, [
            'contain' => ['Children']
        ]);

        $this->set('guardian', $guardian);
        $this->set('_serialize', ['guardian']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $guardian = $this->Guardians->newEntity();
        if ($this->request->is('post')) {
            $guardian = $this->Guardians->patchEntity($guardian, $this->request->data);
            if ($this->Guardians->save($guardian)) {
                $this->Flash->success(__('The guardian has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The guardian could not be saved. Please, try again.'));
        }
        $children = $this->Guardians->Children->find('list', ['limit' => 200]);
        $this->set(compact('guardian', 'children'));
        $this->set('_serialize', ['guardian']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Guardian id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $guardian = $this->Guardians->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $guardian = $this->Guardians->patchEntity($guardian, $this->request->data);
            if ($this->Guardians->save($guardian)) {
                $this->Flash->success(__('The guardian has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The guardian could not be saved. Please, try again.'));
        }
        $children = $this->Guardians->Children->find('list', ['limit' => 200]);
        $this->set(compact('guardian', 'children'));
        $this->set('_serialize', ['guardian']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Guardian id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guardian = $this->Guardians->get($id);
        if ($this->Guardians->delete($guardian)) {
            $this->Flash->success(__('The guardian has been deleted.'));
        } else {
            $this->Flash->error(__('The guardian could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
