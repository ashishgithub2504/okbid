<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Horses Controller
 *
 * @property \App\Model\Table\HorsesTable $Horses
 */
class HorsesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $horses = $this->paginate($this->Horses);

        $this->set(compact('horses'));
        $this->set('_serialize', ['horses']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horse = $this->Horses->get($id, [
            'contain' => []
        ]);

        $this->set('horse', $horse);
        $this->set('_serialize', ['horse']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horse = $this->Horses->newEntity();
        if ($this->request->is('post')) {
            $horse = $this->Horses->patchEntity($horse, $this->request->data);
            if ($this->Horses->save($horse)) {
                $this->Flash->success(__('The horse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse could not be saved. Please, try again.'));
        }
        $this->set(compact('horse'));
        $this->set('_serialize', ['horse']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horse = $this->Horses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horse = $this->Horses->patchEntity($horse, $this->request->data);
            
            if ($this->Horses->save($horse)) {
                $this->Flash->success(__('The horse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse could not be saved. Please, try again.'));
        }
        $this->set(compact('horse'));
        $this->set('_serialize', ['horse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horse = $this->Horses->get($id);
        if ($this->Horses->delete($horse)) {
            $this->Flash->success(__('The horse has been deleted.'));
        } else {
            $this->Flash->error(__('The horse could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
