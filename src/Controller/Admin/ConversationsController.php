<?php
namespace App\Controller\Admin;
use Cake\ORM\TableRegistry;
use App\Controller\Admin\AppController;

/**
 * Conversations Controller
 *
 * @property \App\Model\Table\ConversationsTable $Conversations
 */
class ConversationsController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->Users = TableRegistry::get('users');
    }

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
        $conversations = $this->paginate($this->Conversations);

        $this->set(compact('conversations'));
        $this->set('_serialize', ['conversations']);
    }

    /**
     * View method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $conversation = $this->Conversations->get($id, [
            'contain' => ['Users', 'Chats']
        ]);

        $this->set('conversation', $conversation);
        $this->set('_serialize', ['conversation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $conversation = $this->Conversations->newEntity();
        if ($this->request->is('post')) {
            $conversation = $this->Conversations->patchEntity($conversation, $this->request->data);
            if ($this->Conversations->save($conversation)) {
                $this->Flash->success(__('The conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conversation could not be saved. Please, try again.'));
        }
        $users = $this->Conversations->Users->find('list', ['limit' => 200]);
        $this->set(compact('conversation', 'users'));
        $this->set('_serialize', ['conversation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $conversation = $this->Conversations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conversation = $this->Conversations->patchEntity($conversation, $this->request->data);
            if ($this->Conversations->save($conversation)) {
                $this->Flash->success(__('The conversation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conversation could not be saved. Please, try again.'));
        }
        $users = $this->Conversations->Users->find('list', ['limit' => 200]);
        $this->set(compact('conversation', 'users'));
        $this->set('_serialize', ['conversation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Conversation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $conversation = $this->Conversations->get($id);
        if ($this->Conversations->delete($conversation)) {
            $this->Flash->success(__('The conversation has been deleted.'));
        } else {
            $this->Flash->error(__('The conversation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function globalmessage()
    {
        if(!empty($this->request->data)){
            $message['title']= 'Okbid Notification';
            $message['body']= $this->request->data['message'];
            $userinfo = TableRegistry::get('users')->find()->select(['device_token','device_type'])->hydrate(false)->where(['status'=>'1','device_token !='=>''])->toArray();
            $this->Default->pushnotification( $message,$userinfo );
            $this->Flash->success(__('Global notification has been sent'));
            $this->redirect(['controller'=>'conversations','action'=>'globalmessage']);
        }
    }
    
    public function message($id = null)
    {
        $response = array();
        
        $obj = TableRegistry::get('conversations');
        
        $messages = $obj->find()
                ->where(['id'=>$id])
                ->contain(['Chats'])
                ->hydrate(false)->first();
        //pr($messages); die;
        $auth = $this->Auth->user('id');
        if(!empty($this->request->data)){
            
            $chat = TableRegistry::get('chats');
            $entity = $chat->newEntity();
            $entity->sender_id = $this->Auth->user('id');
            $entity->conversation_id = $id;
            //$entity->receiver_id = $id;
            $entity->chat = $this->request->data['message'];
            $entity->is_read = 0;
            $entity->status = 1;
            
            if($chat->save($entity)){
                $obj->updateAll(['message'=>$this->request->data['message']],['id'=>$id]);
                $token = $this->Users->find()
                        ->select(['device_token','device_type'])->hydrate(false)
                        ->where(['id'=>$this->request->data['user_id'],'status'=>'1','device_token !='=>''])->toArray();
                
                $message['title'] = 'Okbid notification';
                $message['body'] = 'You have got new message';
                $this->Default->pushnotification($message,$token);
                $this->Flash->success(__('Message has been sent successfully'));
                return $this->redirect(['controller'=>'conversations','action'=>'message/'.$id]);
            }
        }
        $this->set(compact('messages','auth'));
    }
    
}
