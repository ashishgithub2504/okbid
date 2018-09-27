<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PropertyCommisions Controller
 *
 * @property \App\Model\Table\PropertyCommisionsTable $PropertyCommisions
 */
class PropertyCommisionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $propertyCommisions = $this->paginate($this->PropertyCommisions);

        $this->set(compact('propertyCommisions'));
        $this->set('_serialize', ['propertyCommisions']);
    }

    /**
     * View method
     *
     * @param string|null $id Property Commision id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertyCommision = $this->PropertyCommisions->get($id, [
            'contain' => []
        ]);

        $this->set('propertyCommision', $propertyCommision);
        $this->set('_serialize', ['propertyCommision']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $propertyCommision = $this->PropertyCommisions->newEntity();
        if ($this->request->is('post')) {
            $propertyCommision = $this->PropertyCommisions->patchEntity($propertyCommision, $this->request->data);
            if ($this->PropertyCommisions->save($propertyCommision)) {
                $this->Flash->success(__('The property commision has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property commision could not be saved. Please, try again.'));
        }
        $this->set(compact('propertyCommision'));
        $this->set('_serialize', ['propertyCommision']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Property Commision id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propertyCommision = $this->PropertyCommisions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyCommision = $this->PropertyCommisions->patchEntity($propertyCommision, $this->request->data);
            if ($this->PropertyCommisions->save($propertyCommision)) {
                $this->Flash->success(__('The property commision has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The property commision could not be saved. Please, try again.'));
        }
        $this->set(compact('propertyCommision'));
        $this->set('_serialize', ['propertyCommision']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Commision id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyCommision = $this->PropertyCommisions->get($id);
        if ($this->PropertyCommisions->delete($propertyCommision)) {
            $this->Flash->success(__('The property commision has been deleted.'));
        } else {
            $this->Flash->error(__('The property commision could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
