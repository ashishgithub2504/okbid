<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorseTransfers Controller
 *
 * @property \App\Model\Table\HorseTransfersTable $HorseTransfers
 */
class HorseTransfersController extends AppController
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
        $horseTransfers = $this->paginate($this->HorseTransfers);

        $this->set(compact('horseTransfers'));
        $this->set('_serialize', ['horseTransfers']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Transfer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horseTransfer = $this->HorseTransfers->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horseTransfer', $horseTransfer);
        $this->set('_serialize', ['horseTransfer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horseTransfer = $this->HorseTransfers->newEntity();
        if ($this->request->is('post')) {
            $horseTransfer = $this->HorseTransfers->patchEntity($horseTransfer, $this->request->data);
            if ($this->HorseTransfers->save($horseTransfer)) {
                $this->Flash->success(__('The horse transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse transfer could not be saved. Please, try again.'));
        }
        $horses = $this->HorseTransfers->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseTransfer', 'horses'));
        $this->set('_serialize', ['horseTransfer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Transfer id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horseTransfer = $this->HorseTransfers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horseTransfer = $this->HorseTransfers->patchEntity($horseTransfer, $this->request->data);
            if ($this->HorseTransfers->save($horseTransfer)) {
                $this->Flash->success(__('The horse transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse transfer could not be saved. Please, try again.'));
        }
        $horses = $this->HorseTransfers->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horseTransfer', 'horses'));
        $this->set('_serialize', ['horseTransfer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Transfer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horseTransfer = $this->HorseTransfers->get($id);
        if ($this->HorseTransfers->delete($horseTransfer)) {
            $this->Flash->success(__('The horse transfer has been deleted.'));
        } else {
            $this->Flash->error(__('The horse transfer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
