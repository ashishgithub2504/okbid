<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RiderDocuments Controller
 *
 * @property \App\Model\Table\RiderDocumentsTable $RiderDocuments
 */
class RiderDocumentsController extends AppController
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
        $riderDocuments = $this->paginate($this->RiderDocuments);

        $this->set(compact('riderDocuments'));
        $this->set('_serialize', ['riderDocuments']);
    }

    /**
     * View method
     *
     * @param string|null $id Rider Document id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $riderDocument = $this->RiderDocuments->get($id, [
            'contain' => ['Riders']
        ]);

        $this->set('riderDocument', $riderDocument);
        $this->set('_serialize', ['riderDocument']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $riderDocument = $this->RiderDocuments->newEntity();
        if ($this->request->is('post')) {
            $riderDocument = $this->RiderDocuments->patchEntity($riderDocument, $this->request->data);
            if ($this->RiderDocuments->save($riderDocument)) {
                $this->Flash->success(__('The rider document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rider document could not be saved. Please, try again.'));
        }
        $riders = $this->RiderDocuments->Riders->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('riderDocument', 'riders'));
        $this->set('_serialize', ['riderDocument']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rider Document id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $riderDocument = $this->RiderDocuments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $riderDocument = $this->RiderDocuments->patchEntity($riderDocument, $this->request->data);
            if ($this->RiderDocuments->save($riderDocument)) {
                $this->Flash->success(__('The rider document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rider document could not be saved. Please, try again.'));
        }
        $riders = $this->RiderDocuments->Riders->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('riderDocument', 'riders'));
        $this->set('_serialize', ['riderDocument']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rider Document id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $riderDocument = $this->RiderDocuments->get($id);
        if ($this->RiderDocuments->delete($riderDocument)) {
            $this->Flash->success(__('The rider document has been deleted.'));
        } else {
            $this->Flash->error(__('The rider document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
