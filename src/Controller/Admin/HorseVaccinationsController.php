<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorseVaccinations Controller
 *
 * @property \App\Model\Table\HorseVaccinationsTable $HorseVaccinations
 */
class HorseVaccinationsController extends AppController
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
        $horseVaccinations = $this->paginate($this->HorseVaccinations);

        $this->set(compact('horseVaccinations'));
        $this->set('_serialize', ['horseVaccinations']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Vaccination id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseVaccination = $this->HorseVaccinations->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseVaccination', $horseVaccination);
        $this->set('_serialize', ['horseVaccination']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseVaccination = $this->HorseVaccinations->newEntity();
        if ($this->request->is('post')) {
            $horseVaccination = $this->HorseVaccinations->patchEntity($horseVaccination, $this->request->data);
            if ($this->HorseVaccinations->save($horseVaccination)) {
                $this->Flash->success(__('The horse vaccination has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse vaccination could not be saved. Please, try again.'));
        }
        $horses = $this->HorseVaccinations->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseVaccination', 'horses'));
        $this->set('_serialize', ['horseVaccination']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Vaccination id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseVaccination = $this->HorseVaccinations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseVaccination = $this->HorseVaccinations->patchEntity($horseVaccination, $this->request->data);
            if ($this->HorseVaccinations->save($horseVaccination)) {
                $this->Flash->success(__('The horse vaccination has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse vaccination could not be saved. Please, try again.'));
        }
        $horses = $this->HorseVaccinations->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseVaccination', 'horses'));
        $this->set('_serialize', ['horseVaccination']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Vaccination id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseVaccination = $this->HorseVaccinations->get($id);
        if ($this->HorseVaccinations->delete($horseVaccination)) {
            $this->Flash->success(__('The horse vaccination has been deleted.'));
        } else {
            $this->Flash->error(__('The horse vaccination could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
