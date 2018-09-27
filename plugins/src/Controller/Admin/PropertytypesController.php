<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Propertytypes Controller
 *
 * @property \App\Model\Table\PropertytypesTable $Propertytypes
 */
class PropertytypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $propertytypes = $this->paginate($this->Propertytypes);

        $this->set(compact('propertytypes'));
        $this->set('_serialize', ['propertytypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Propertytype id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertytype = $this->Propertytypes->get($id, [
            'contain' => ['Categories', 'Properties']
        ]);

        $this->set('propertytype', $propertytype);
        $this->set('_serialize', ['propertytype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $propertytype = $this->Propertytypes->newEntity();
        if ($this->request->is('post')) {
            $propertytype = $this->Propertytypes->patchEntity($propertytype, $this->request->data);
            if ($this->Propertytypes->save($propertytype)) {
                $this->Flash->success(__('The propertytype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The propertytype could not be saved. Please, try again.'));
        }
        $categories = $this->Propertytypes->Categories->find('list', ['limit' => 200]);
        $this->set(compact('propertytype', 'categories'));
        $this->set('_serialize', ['propertytype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Propertytype id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propertytype = $this->Propertytypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertytype = $this->Propertytypes->patchEntity($propertytype, $this->request->data);
            if ($this->Propertytypes->save($propertytype)) {
                $this->Flash->success(__('The propertytype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The propertytype could not be saved. Please, try again.'));
        }
        $categories = $this->Propertytypes->Categories->find('list', ['limit' => 200]);
        $this->set(compact('propertytype', 'categories'));
        $this->set('_serialize', ['propertytype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Propertytype id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertytype = $this->Propertytypes->get($id);
        if ($this->Propertytypes->delete($propertytype)) {
            $this->Flash->success(__('The propertytype has been deleted.'));
        } else {
            $this->Flash->error(__('The propertytype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
