<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
/**
 * HorseWeights Controller
 *
 * @property \App\Model\Table\HorseWeightsTable $HorseWeights
 */
class HorseWeightsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'fields' => array('HorseWeights.horse_id','HorseWeights.id'),
            'group' => 'HorseWeights.horse_id',
            'order' => ['HorseWeights.horse_id'=>'asc','HorseWeights.weight_date' => 'asc'],
            'contain' => ['Horses'=>function($q){
                return $q->select(['name','id']);
            }]
        ];
        $months = Configure::read('RIDING_MONTH');
        $horseWeights = $this->paginate($this->HorseWeights);
        
        $this->set(compact('horseWeights','months'));
        $this->set('_serialize', ['horseWeights']);
    }

    /**
     * View method =>
     *
     * @param string|null $id Horse Weight id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseWeight = $this->HorseWeights->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseWeight', $horseWeight);
        $this->set('_serialize', ['horseWeight']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseWeight = $this->HorseWeights->newEntity();
        if ($this->request->is('post')) {
            $horseWeight = $this->HorseWeights->patchEntity($horseWeight, $this->request->data);
            if ($this->HorseWeights->save($horseWeight)) {
                $this->Flash->success(__('The horse weight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse weight could not be saved. Please, try again.'));
        }
        $horses = $this->HorseWeights->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseWeight', 'horses'));
        $this->set('_serialize', ['horseWeight']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Weight id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseWeight = $this->HorseWeights->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseWeight = $this->HorseWeights->patchEntity($horseWeight, $this->request->data);
            if ($this->HorseWeights->save($horseWeight)) {
                $this->Flash->success(__('The horse weight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse weight could not be saved. Please, try again.'));
        }
        $horses = $this->HorseWeights->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseWeight', 'horses'));
        $this->set('_serialize', ['horseWeight']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Weight id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseWeight = $this->HorseWeights->get($id);
        if ($this->HorseWeights->delete($horseWeight)) {
            $this->Flash->success(__('The horse weight has been deleted.'));
        } else {
            $this->Flash->error(__('The horse weight could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
