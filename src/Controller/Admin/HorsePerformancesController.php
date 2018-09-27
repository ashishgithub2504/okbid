<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorsePerformances Controller
 *
 * @property \App\Model\Table\HorsePerformancesTable $HorsePerformances
 */
class HorsePerformancesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Horses','Riders']
        ];
        $horsePerformances = $this->paginate($this->HorsePerformances);
        
        $this->set(compact('horsePerformances'));
        $this->set('_serialize', ['horsePerformances']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Performance id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horsePerformance = $this->HorsePerformances->get($id, [
            'contain' => ['Horses', 'Riders']
        ]);

        $this->set('horsePerformance', $horsePerformance);
        $this->set('_serialize', ['horsePerformance']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horsePerformance = $this->HorsePerformances->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->data); die;
            $horsePerformance = $this->HorsePerformances->patchEntity($horsePerformance, $this->request->data);
            //pr($horsePerformance); die;
            if ($this->HorsePerformances->save($horsePerformance)) {
                $this->Flash->success(__('The horse performance has been saved.'));
                return $this->redirect(['action' => 'index']);
            }else{
                pr($horsePerformance->errors());
                die;
            }
            $this->Flash->error(__('The horse performance could not be saved. Please, try again.'));
        }
        $horses = $this->HorsePerformances->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $users = $this->HorsePerformances->Users->find('list', ['limit' => 200]);
        $riders = $this->HorsePerformances->Riders->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
       
        $this->set(compact('horsePerformance', 'horses', 'users','riders'));
        $this->set('_serialize', ['horsePerformance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Performance id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horsePerformance = $this->HorsePerformances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horsePerformance = $this->HorsePerformances->patchEntity($horsePerformance, $this->request->data);
           
            if ($this->HorsePerformances->save($horsePerformance)) {
                $this->Flash->success(__('The horse performance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse performance could not be saved. Please, try again.'));
        }
        $horses = $this->HorsePerformances->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $users = $this->HorsePerformances->Users->find('list', ['limit' => 200]);
        $riders = $this->HorsePerformances->Riders->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
       
        $this->set(compact('horsePerformance', 'horses', 'users','riders'));
        $this->set('_serialize', ['horsePerformance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Performance id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horsePerformance = $this->HorsePerformances->get($id);
        if ($this->HorsePerformances->delete($horsePerformance)) {
            $this->Flash->success(__('The horse performance has been deleted.'));
        } else {
            $this->Flash->error(__('The horse performance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
