<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorseMedicals Controller
 *
 * @property \App\Model\Table\HorseMedicalsTable $HorseMedicals
 */
class HorseMedicalsController extends AppController
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
        $horseMedicals = $this->paginate($this->HorseMedicals);

        $this->set(compact('horseMedicals'));
        $this->set('_serialize', ['horseMedicals']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Medical id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseMedical = $this->HorseMedicals->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseMedical', $horseMedical);
        $this->set('_serialize', ['horseMedical']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseMedical = $this->HorseMedicals->newEntity();
        if ($this->request->is('post')) {
            $horseMedical = $this->HorseMedicals->patchEntity($horseMedical, $this->request->data);
            if ($this->HorseMedicals->save($horseMedical)) {
                $this->Flash->success(__('The horse medical has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse medical could not be saved. Please, try again.'));
        }
        $horses = $this->HorseMedicals->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseMedical', 'horses'));
        $this->set('_serialize', ['horseMedical']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Medical id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseMedical = $this->HorseMedicals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseMedical = $this->HorseMedicals->patchEntity($horseMedical, $this->request->data);
            if ($this->HorseMedicals->save($horseMedical)) {
                $this->Flash->success(__('The horse medical has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse medical could not be saved. Please, try again.'));
        }
        $horses = $this->HorseMedicals->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseMedical', 'horses'));
        $this->set('_serialize', ['horseMedical']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Medical id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseMedical = $this->HorseMedicals->get($id);
        if ($this->HorseMedicals->delete($horseMedical)) {
            $this->Flash->success(__('The horse medical has been deleted.'));
        } else {
            $this->Flash->error(__('The horse medical could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
