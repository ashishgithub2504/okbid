<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorseBarns Controller
 *
 * @property \App\Model\Table\HorseBarnsTable $HorseBarns
 */
class HorseBarnsController extends AppController
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
        $horseBarns = $this->paginate($this->HorseBarns);
        
        $this->set(compact('horseBarns'));
        $this->set('_serialize', ['horseBarns']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Barn id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseBarn = $this->HorseBarns->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseBarn', $horseBarn);
        $this->set('_serialize', ['horseBarn']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseBarn = $this->HorseBarns->newEntity();
        if ($this->request->is('post')) {
            $horseBarn = $this->HorseBarns->patchEntity($horseBarn, $this->request->data);
            if ($this->HorseBarns->save($horseBarn)) {
                $this->Flash->success(__('The horse barn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse barn could not be saved. Please, try again.'));
        }
        $horses = $this->HorseBarns->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseBarn', 'horses'));
        $this->set('_serialize', ['horseBarn']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Barn id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseBarn = $this->HorseBarns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseBarn = $this->HorseBarns->patchEntity($horseBarn, $this->request->data);
            if ($this->HorseBarns->save($horseBarn)) {
                $this->Flash->success(__('The horse barn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse barn could not be saved. Please, try again.'));
        }
        $horses = $this->HorseBarns->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseBarn', 'horses'));
        $this->set('_serialize', ['horseBarn']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Barn id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseBarn = $this->HorseBarns->get($id);
        if ($this->HorseBarns->delete($horseBarn)) {
            $this->Flash->success(__('The horse barn has been deleted.'));
        } else {
            $this->Flash->error(__('The horse barn could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
