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
        $conditions = [];
        $get = $this->request->query;
        
        if(isset($get['status'])&& !empty($get['status'])){
            $conditions['Horses.status'] = $get['status'];
        }
        if(isset($get['dob']['year']) && !empty($get['dob']['year'])){
            $conditions['YEAR(Horses.dob)'] = $get['dob']['year'];
        }
        
        $this->paginate = [
        'conditions' => $conditions,
        'order' => [
            'Horses.name' => 'asc'
            ],
            'contain' =>['Countries'=>function($q){
                return $q->select(['name']);
            }]
        ];
        
        $horses = $this->paginate($this->Horses);
        
        $this->set(compact('horses','get'));
        $this->set('_serialize', ['horses','get']);
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
            'contain' => ['Countries']
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
            }else{
                $errors = $this->Default->get_errors($horse->errors());
                $this->Flash->error(__($errors));
            }
            
        }
        $countries = $this->Horses->Countries->find('list')->order('name','desc');
       
        $this->set(compact('horse','countries'));
        $this->set('_serialize', ['horse','countries']);
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
            }else{
                $errors = $this->Default->get_errors($horse->errors());
                $this->Flash->error(__($errors));
            }
        }
        $countries = $this->Horses->Countries->find('list')->order('name','desc');
        $this->set(compact('horse','countries'));
        $this->set('_serialize', ['horse','countries']);
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
