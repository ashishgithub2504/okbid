<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorseRidingWeights Controller
 *
 * @property \App\Model\Table\HorseRidingWeightsTable $HorseRidingWeights
 */
class HorseRidingWeightsController extends AppController
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
        $horseRidingWeights = $this->paginate($this->HorseRidingWeights);

        $this->set(compact('horseRidingWeights'));
        $this->set('_serialize', ['horseRidingWeights']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Riding Weight id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseRidingWeight = $this->HorseRidingWeights->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseRidingWeight', $horseRidingWeight);
        $this->set('_serialize', ['horseRidingWeight']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseRidingWeight = $this->HorseRidingWeights->newEntity();
        if ($this->request->is('post')) {
            $horseRidingWeight = $this->HorseRidingWeights->patchEntity($horseRidingWeight, $this->request->data);
            if ($this->HorseRidingWeights->save($horseRidingWeight)) {
                $this->Flash->success(__('The horse riding weight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse riding weight could not be saved. Please, try again.'));
        }
        $horses = $this->HorseRidingWeights->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseRidingWeight', 'horses'));
        $this->set('_serialize', ['horseRidingWeight']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Riding Weight id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseRidingWeight = $this->HorseRidingWeights->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseRidingWeight = $this->HorseRidingWeights->patchEntity($horseRidingWeight, $this->request->data);
            if ($this->HorseRidingWeights->save($horseRidingWeight)) {
                $this->Flash->success(__('The horse riding weight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse riding weight could not be saved. Please, try again.'));
        }
        $horses = $this->HorseRidingWeights->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseRidingWeight', 'horses'));
        $this->set('_serialize', ['horseRidingWeight']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Riding Weight id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseRidingWeight = $this->HorseRidingWeights->get($id);
        if ($this->HorseRidingWeights->delete($horseRidingWeight)) {
            $this->Flash->success(__('The horse riding weight has been deleted.'));
        } else {
            $this->Flash->error(__('The horse riding weight could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
