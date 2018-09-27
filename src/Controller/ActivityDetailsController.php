<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ActivityDetails Controller
 *
 * @property \App\Model\Table\ActivityDetailsTable $ActivityDetails
 */
class ActivityDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Activities', 'Categories']
        ];
        $activityDetails = $this->paginate($this->ActivityDetails);

        $this->set(compact('activityDetails'));
        $this->set('_serialize', ['activityDetails']);
    }

    /**
     * View method
     *
     * @param string|null $id Activity Detail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityDetail = $this->ActivityDetails->get($id, [
            'contain' => ['Activities', 'Categories']
        ]);

        $this->set('activityDetail', $activityDetail);
        $this->set('_serialize', ['activityDetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityDetail = $this->ActivityDetails->newEntity();
        if ($this->request->is('post')) {
            $activityDetail = $this->ActivityDetails->patchEntity($activityDetail, $this->request->data);
            if ($this->ActivityDetails->save($activityDetail)) {
                $this->Flash->success(__('The activity detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity detail could not be saved. Please, try again.'));
        }
        $activities = $this->ActivityDetails->Activities->find('list', ['limit' => 200]);
        $categories = $this->ActivityDetails->Categories->find('list', ['limit' => 200]);
        $this->set(compact('activityDetail', 'activities', 'categories'));
        $this->set('_serialize', ['activityDetail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity Detail id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityDetail = $this->ActivityDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activityDetail = $this->ActivityDetails->patchEntity($activityDetail, $this->request->data);
            if ($this->ActivityDetails->save($activityDetail)) {
                $this->Flash->success(__('The activity detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity detail could not be saved. Please, try again.'));
        }
        $activities = $this->ActivityDetails->Activities->find('list', ['limit' => 200]);
        $categories = $this->ActivityDetails->Categories->find('list', ['limit' => 200]);
        $this->set(compact('activityDetail', 'activities', 'categories'));
        $this->set('_serialize', ['activityDetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity Detail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityDetail = $this->ActivityDetails->get($id);
        if ($this->ActivityDetails->delete($activityDetail)) {
            $this->Flash->success(__('The activity detail has been deleted.'));
        } else {
            $this->Flash->error(__('The activity detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
