<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\ORM\TableRegistry;
/**
 * Conversations Controller
 *
 * @property \App\Model\Table\ConversationsTable $Conversations
 */
class ConversationsController extends AppController
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
        $conversations = $this->paginate($this->Conversations);
        pr($conversations); die;
        if(!empty($conversations)){
            $this->message = $this->msgDictonary['data_save_' . $this->language];
            $this->responseData = $conversations;
            $this->status = true;
        }else{
            $this->message = $this->msgDictonary['data_save_' . $this->language];
            $this->status = false;
        }
        $this->respond();
    }
    
    public function listing(){
        
        $conversations = $this->Conversations->find()->select(['id','title','user_id','message','is_read','created'])->where(['user_id'=>$this->loggedInUserId])->toArray();
        
        if(!empty($conversations)){
            $this->message = $this->msgDictonary['record_found_' . $this->language];
            $this->responseData = $conversations;
            $this->status = true;
        }else{
            $this->message = $this->msgDictonary['no_record_found_' . $this->language];
            $this->status = false;
        }
        $this->respond();
    }
    
    public function chating(){
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank','chat'=>'notBlank'));
            $obj = TableRegistry::get('chats');
            $entity = $obj->newEntity();
            $entity->conversation_id = $this->request->data['id'];
            $entity->sender_id = $this->loggedInUserId;
            $entity->chat = $this->request->data['chat'];
            $entity->created = date('Y-m-d h:i:s');
            $entity->modified = date('Y-m-d h:i:s');
            $entity->is_read = '0'; 
            $entity->status = '1'; 
            if($obj->save($entity)){
                $this->Conversations->updateAll(['message'=>$this->request->data['chat']],['id'=>$this->request->data['id']]);
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $entity;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }
    
    public function conversation(){
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
             $obj = TableRegistry::get('chats');
             $result = $obj->find()->where(['conversation_id'=>$this->request->data['id']])->toArray();
             if(!empty($result)){
                 $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $result;
                $this->status = true;
             }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
         $this->respond();
    }

        public function notification(){
        if ($this->request->is('post')) {
            
            $messages = TableRegistry::get('messages')->find()->select(['id','message','status'])->where(['receiver_id'=>$this->loggedInUserId])->toArray();
            if(!empty($messages)){
                 $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $messages;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
            
        }
         $this->respond();
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
            
            $this->request->data['user_id'] = $this->loggedInUserId;
            $this->request->data['chats']['0']['sender_id'] = $this->loggedInUserId;
            $this->request->data['chats']['0']['sender_id'] = $this->loggedInUserId;
            $this->request->data['chats']['0']['is_read'] = '1';
            $this->request->data['chats']['0']['chat'] = $this->request->data['message'];
            $this->request->data['chats']['0']['status'] = '1';
            $this->request->data['chats']['0']['created'] = date('Y-m-d h:i:s');
            $this->request->data['chats']['0']['modified'] = date('Y-m-d h:i:s');
            
            $this->request->data['is_read'] = '1';
            $conversation = $this->Conversations->patchEntity($conversation, $this->request->data);
            
            if ($this->Conversations->save($conversation)) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $conversation;
                $this->status = true;
            }else{
                $this->Flash->error(__('The conversation could not be saved. Please, try again.'));
            }
            
        }
        $this->respond();
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
}
