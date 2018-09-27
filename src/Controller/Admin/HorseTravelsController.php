<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorseTravels Controller
 *
 * @property \App\Model\Table\HorseTravelsTable $HorseTravels
 */
class HorseTravelsController extends AppController
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
        $horseTravels = $this->paginate($this->HorseTravels);

        $this->set(compact('horseTravels'));
        $this->set('_serialize', ['horseTravels']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Travel id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseTravel = $this->HorseTravels->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseTravel', $horseTravel);
        $this->set('_serialize', ['horseTravel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseTravel = $this->HorseTravels->newEntity();
        if ($this->request->is('post')) {
            $horseTravel = $this->HorseTravels->patchEntity($horseTravel, $this->request->data);
            if ($this->HorseTravels->save($horseTravel)) {
                $this->Flash->success(__('The horse travel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse travel could not be saved. Please, try again.'));
        }
        $horses = $this->HorseTravels->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseTravel', 'horses'));
        $this->set('_serialize', ['horseTravel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Travel id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseTravel = $this->HorseTravels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseTravel = $this->HorseTravels->patchEntity($horseTravel, $this->request->data);
            if ($this->HorseTravels->save($horseTravel)) {
                $this->Flash->success(__('The horse travel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse travel could not be saved. Please, try again.'));
        }
        $horses = $this->HorseTravels->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseTravel', 'horses'));
        $this->set('_serialize', ['horseTravel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Travel id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseTravel = $this->HorseTravels->get($id);
        if ($this->HorseTravels->delete($horseTravel)) {
            $this->Flash->success(__('The horse travel has been deleted.'));
        } else {
            $this->Flash->error(__('The horse travel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
