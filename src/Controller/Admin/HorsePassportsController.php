<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HorsePassports Controller
 *
 * @property \App\Model\Table\HorsePassportsTable $HorsePassports
 */
class HorsePassportsController extends AppController
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
        $horsePassports = $this->paginate($this->HorsePassports);

        $this->set(compact('horsePassports'));
        $this->set('_serialize', ['horsePassports']);
    }

    /**
     * View method
     *
     * @param string|null $id Horse Passport id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horsePassport = $this->HorsePassports->get($id, [
            'contain' => ['Horses']
        ]);

        $this->set('horsePassport', $horsePassport);
        $this->set('_serialize', ['horsePassport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horsePassport = $this->HorsePassports->newEntity();
        if ($this->request->is('post')) {
            $horsePassport = $this->HorsePassports->patchEntity($horsePassport, $this->request->data);
            if ($this->HorsePassports->save($horsePassport)) {
                $this->Flash->success(__('The horse passport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse passport could not be saved. Please, try again.'));
        }
        $horses = $this->HorsePassports->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horsePassport', 'horses'));
        $this->set('_serialize', ['horsePassport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Horse Passport id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horsePassport = $this->HorsePassports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horsePassport = $this->HorsePassports->patchEntity($horsePassport, $this->request->data);
            if ($this->HorsePassports->save($horsePassport)) {
                $this->Flash->success(__('The horse passport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horse passport could not be saved. Please, try again.'));
        }
        $horses = $this->HorsePassports->Horses->find('list', ['limit' => 200,'order'=>['name' => 'asc']]);
        $this->set(compact('horsePassport', 'horses'));
        $this->set('_serialize', ['horsePassport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Horse Passport id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horsePassport = $this->HorsePassports->get($id);
        if ($this->HorsePassports->delete($horsePassport)) {
            $this->Flash->success(__('The horse passport has been deleted.'));
        } else {
            $this->Flash->error(__('The horse passport could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
