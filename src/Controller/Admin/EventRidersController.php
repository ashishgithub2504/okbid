<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * EventRiders Controller
 *
 * @property \App\Model\Table\EventRidersTable $EventRiders
 */
class EventRidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Riders', 'Horses']
        ];
        $eventRiders = $this->paginate($this->EventRiders);
        
        $this->set(compact('eventRiders'));
        $this->set('_serialize', ['eventRiders']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Rider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventRider = $this->EventRiders->get($id, [
            'contain' => ['Events', 'Riders', 'Horses']
        ]);

        $this->set('eventRider', $eventRider);
        $this->set('_serialize', ['eventRider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventRider = $this->EventRiders->newEntity();
        if ($this->request->is('post')) {
            $eventRider = $this->EventRiders->patchEntity($eventRider, $this->request->data);
            if ($this->EventRiders->save($eventRider)) {
                $this->Flash->success(__('The event rider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event rider could not be saved. Please, try again.'));
        }
        $events = $this->EventRiders->Events->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ],['limit' => 200]);
        $riders = $this->EventRiders->Riders->find('list', ['limit' => 200]);
        $horses = $this->EventRiders->Horses->find('list', ['limit' => 200]);
        $this->set(compact('eventRider', 'events', 'riders', 'horses'));
        $this->set('_serialize', ['eventRider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Rider id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventRider = $this->EventRiders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventRider = $this->EventRiders->patchEntity($eventRider, $this->request->data);
            if ($this->EventRiders->save($eventRider)) {
                $this->Flash->success(__('The event rider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event rider could not be saved. Please, try again.'));
        }
        $events = $this->EventRiders->Events->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ], ['limit' => 200]);
        $riders = $this->EventRiders->Riders->find('list', ['limit' => 200]);
        $horses = $this->EventRiders->Horses->find('list', ['limit' => 200]);
        $this->set(compact('eventRider', 'events', 'riders', 'horses'));
        $this->set('_serialize', ['eventRider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Rider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventRider = $this->EventRiders->get($id);
        if ($this->EventRiders->delete($eventRider)) {
            $this->Flash->success(__('The event rider has been deleted.'));
        } else {
            $this->Flash->error(__('The event rider could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
