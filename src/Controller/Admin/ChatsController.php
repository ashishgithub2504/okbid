<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Chats Controller
 *
 * @property \App\Model\Table\ChatsTable $Chats
 */
class ChatsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $chats = $this->paginate($this->Chats);
        
        $this->set(compact('chats'));
        $this->set('_serialize', ['chats']);
    }

    /**
     * View method
     *
     * @param string|null $id Chat id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
//        $chat = $this->Chats->get($id, [
//            'contain' => ['Users']
//        ]);
        
        $chat = $this->Chats->find()->where(['sender_id'=>$id])->toArray();
        $this->set('chats', $chat);
        $this->set('_serialize', ['chat']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chat = $this->Chats->newEntity();
        if ($this->request->is('post')) {
            $chat = $this->Chats->patchEntity($chat, $this->request->data);
            if ($this->Chats->save($chat)) {
                $this->Flash->success(__('The chat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chat could not be saved. Please, try again.'));
        }
        $senders = $this->Chats->Senders->find('list', ['limit' => 200]);
        $receivers = $this->Chats->Receivers->find('list', ['limit' => 200]);
        $this->set(compact('chat', 'senders', 'receivers'));
        $this->set('_serialize', ['chat']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chat id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chat = $this->Chats->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chat = $this->Chats->patchEntity($chat, $this->request->data);
            if ($this->Chats->save($chat)) {
                $this->Flash->success(__('The chat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chat could not be saved. Please, try again.'));
        }
        $senders = $this->Chats->Senders->find('list', ['limit' => 200]);
        $receivers = $this->Chats->Receivers->find('list', ['limit' => 200]);
        $this->set(compact('chat', 'senders', 'receivers'));
        $this->set('_serialize', ['chat']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Chat id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chat = $this->Chats->get($id);
        if ($this->Chats->delete($chat)) {
            $this->Flash->success(__('The chat has been deleted.'));
        } else {
            $this->Flash->error(__('The chat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
