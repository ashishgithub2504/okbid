<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Riders Controller
 *
 * @property \App\Model\Table\RidersTable $Riders
 */
class RidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries','Roles']
        ];
        $riders = $this->paginate($this->Riders);
        
        $this->set(compact('riders'));
        $this->set('_serialize', ['riders']);
    }

    /**
     * View method
     *
     * @param string|null $id Rider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rider = $this->Riders->get($id, [
            'contain' => ['Countries']
        ]);

        $this->set('rider', $rider);
        $this->set('_serialize', ['rider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rider = $this->Riders->newEntity();
        if ($this->request->is('post')) {
            $rider = $this->Riders->patchEntity($rider, $this->request->data);
            if ($this->Riders->save($rider)) {
                $this->Flash->success(__('The rider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rider could not be saved. Please, try again.'));
        }
        $countries = $this->Riders->Countries->find('list');
        $roles = $this->Riders->Roles->find('list')->where(['Roles.id !='=>'1'])->order(['name'=>'asc']);
        $this->set(compact('rider', 'countries','roles'));
        $this->set('_serialize', ['rider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Rider id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rider = $this->Riders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rider = $this->Riders->patchEntity($rider, $this->request->data);
            if ($this->Riders->save($rider)) {
                $this->Flash->success(__('The rider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rider could not be saved. Please, try again.'));
        }
        $countries = $this->Riders->Countries->find('list');
        $roles = $this->Riders->Roles->find('list')->where(['Roles.id !='=>'1'])->order(['name'=>'asc']);
        $this->set(compact('rider', 'countries','roles'));
        $this->set('_serialize', ['rider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Rider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rider = $this->Riders->get($id);
        if ($this->Riders->delete($rider)) {
            $this->Flash->success(__('The rider has been deleted.'));
        } else {
            $this->Flash->error(__('The rider could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
