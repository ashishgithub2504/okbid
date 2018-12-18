<?php
namespace App\Controller\Admin;
use Cake\ORM\TableRegistry;
use App\Controller\Admin\AppController;
use Cake\Validation\Validation;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize() {
        parent::initialize();
        
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Roles'];
        $options['conditions'] = ['Roles.id'=>'2'];
        
        $this->paginate = $options;
        
        $users = $this->paginate($this->Users);
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.id !=' => '1']);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5'])->toArray();
        
        $this->set(compact('users','roles','manager'));
        $this->set('_serialize', ['users']);
    }
    
    public function leader()
    {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Roles'];
        $options['conditions'] = ['Roles.id'=>'3'];
        
        $this->paginate = $options;
        
        $users = $this->paginate($this->Users);
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.id !=' => '1']);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5'])->toArray();
        
        $this->set(compact('users','roles','manager'));
        $this->set('_serialize', ['users']);
    }
    
    public function agent()
    {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Roles'];
        $options['conditions'] = ['Roles.id'=>'4'];
        
        $this->paginate = $options;
        
        $users = $this->paginate($this->Users);
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.id !=' => '1']);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5'])->toArray();
        
        $this->set(compact('users','roles','manager'));
        $this->set('_serialize', ['users']);
    }
    
    public function manager()
    {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Roles'];
        $options['conditions'] = ['Roles.id'=>'5'];
        
        $this->paginate = $options;
        
        $users = $this->paginate($this->Users);
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.id !=' => '1']);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5'])->toArray();
        
        $this->set(compact('users','roles','manager'));
        $this->set('_serialize', ['users']);
    }
    
    public function contractor()
    {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Roles'];
        $options['conditions'] = ['Roles.id'=>'6'];
        
        $this->paginate = $options;
        
        $users = $this->paginate($this->Users);
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.id !=' => '1']);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5'])->toArray();
        
        $this->set(compact('users','roles','manager'));
        $this->set('_serialize', ['users']);
    }
    
    public function viewcount()
    {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Roles'];
        
        $this->paginate = $options;
        
        
        $users = $this->paginate($this->Users);
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.id !=' => '1']);
        $this->set(compact('users','roles'));
        $this->set('_serialize', ['users']);
    }
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);
		$countsign = TableRegistry::get('property_signatures')->find()->where(['user_id' => $id])->count();
		$countview = TableRegistry::get('property_views')->find()->where(['user_id' => $id])->group(['property_id'])->count();
		$countbid = TableRegistry::get('property_bids')->find()->where(['user_id' => $id])->count();
		$countwon = TableRegistry::get('properties')->find()->where(['buyer_id' => $id,'status'=>'3'])->count();
		$this->set(compact('countsign','countview','countbid','countwon'));
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
            
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
           
            if($this->request->data['role_id'] == '3'){
                $redirect = 'leader';
            }else if($this->request->data['role_id'] == '4'){
                $redirect = 'agent';
            }else if($this->request->data['role_id'] == '5'){
                $redirect = 'contractor';
            }else if($this->request->data['role_id'] == '6'){
                $redirect = 'manager';
            }else{
                $redirect = 'index';
            }
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => $redirect]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.status' => '1','Roles.id !=' => $this->Auth->user('role_id')]);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5']);
        $prefix = TableRegistry::get('prefixs')->find('list',['keyField' => 'dialing','valueField' => 'dialing'])->toArray();
        //$campaigns = $this->Users->Campaigns->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles','manager','prefix'));
        $this->set('_serialize', ['user','manager']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            if(empty($this->request->data['password'])){
                unset($this->request->data['password']);
                unset($this->request->data['cpassword']);
            }
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $prefix = TableRegistry::get('prefixs')->find('list',['keyField' => 'dialing','valueField' => 'dialing'])->toArray();
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->where(['Roles.status' => '1','Roles.id !=' => $this->Auth->user('role_id')]);
        $manager = $this->Users->find('list', ['limit' => 200])->where(['Users.status' => '1','Users.role_id' => '5']);
        
        //$campaigns = $this->Users->Campaigns->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles','manager','prefix'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $url = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        if(!empty($url)){
            return $this->redirect(['action' => $url]);
        }else{
            return $this->redirect(['action' => 'index']);
        }
        
    }
    
    public function login() {
        if ($this->Auth->user('id'))
            return $this->redirect($this->Auth->redirectUrl());

        $this->viewBuilder()->layout('login');
        
        if ($this->request->is('post')) {
             $this->loadComponent('Cookie', ['expires' => '1 day']);
            if (Validation::email($this->request->data['username'])) {
                $this->Auth->config('authenticate', [
                    'Form' => [
                        'fields' => ['username' => 'email']
                    ]
                ]);
                $this->Auth->constructAuthenticate();
                $this->request->data['email'] = $this->request->data['username'];
                unset($this->request->data['username']);
            }
          
            $user = $this->Auth->identify();
           
            if ($user) {
                $this->Auth->setUser($user);
                if ($this->request->data['remember_me'] == 1) {
                    unset($this->request->data['remember_me']);
                    $this->Cookie->write('remember_me', $this->request->data, true, "1 week");
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid email or password, try again'));
        }
        else {
            //$loginCookie = $this->Cookie->read('remember_me');
            if (!empty($loginCookie))
                $this->request->data = $loginCookie;
        }
    }
    
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function profileView() {
        $user = $this->Users->get($this->Auth->user('id'));

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function profile() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $user = $this->Users->get($this->Auth->user('id'));
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user))
                $this->Flash->success(__('Profile has been saved.'));
            else
                $this->Flash->error(__($this->Default->get_errors($user->errors())));
        }
        if ($this->Auth->user('id')) {
            $this->request->data = $this->Users->get($this->Auth->user('id'));
        }
    }
    
    public function forgot() {
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $result = $this->{$this->modelClass}->find()->where(['email' => $this->request->data['email']])->first();

            if (!empty($result)) {
                $uid = Text::uuid();
                $EmailTemplates = TableRegistry::get('EmailTemplates');
                if($this->language == 'en'){
                    $template = $EmailTemplates->find()->where(['id' => 12])->first();
                }else{
                    $template = $EmailTemplates->find()->where(['id' => 13])->first();    
                }
                $message = str_replace('##_BASE_##', _BASE_, $template->description);
                $message = str_replace('##SITE_NAME##', $this->SettingConfig['sitename'], $message);
                $message = str_replace('##FROM_EMAIL##', $this->SettingConfig['from_email'], $message);
                $message = str_replace('##SUPPORT_EMAIL##', $this->SettingConfig['support_email'], $message);
                $message = str_replace('##SITE_LINK##', _BASE_, $message);
                $message = str_replace('##SITE_LOGO##', _BASE_ . 'uploads/settings/' . $this->SettingConfig['sitelogo'], $message);
                $message = str_replace('##USERNAME##', $result->username, $message);
                $message = str_replace('##USER_RESET_LINK##', _BASE_ . "admin/users/reset/" . $uid, $message);
                $sentEmail['to'] = $result->email;
                $from = $this->SettingConfig['from_email'];
                $subject = str_replace('##SITE_NAME##', $this->SettingConfig['sitename'], $template->subject);
                $bodyVars = array("content" => $message, 'template' => false);
                $send = $this->Default->_sendMail($sentEmail, $from, $subject, $bodyVars);
                $user = $this->Users->get($result->id, [
                    'contain' => []
                ]);
                $tokenData = array(
                    'reset_key' => $uid
                );
                $user = $this->Users->patchEntity($user, $tokenData);
                if ($this->Users->save($user)) {
                    if ($send) {
                        $this->Flash->success(__('Your password reset link has been sent to your email!'));
                    } else {
                        $this->Flash->error(__('your process failed. please try again!'));
                    }
                }
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('This email address does not exist in database.!'));
            }
        }
    }

    /**
     * Reset Password
     */
    Public function reset($token) {
        $this->viewBuilder()->layout('login');
        if (!$token) {
            return $this->redirect(['action' => 'login']);
        }
        $result = $this->Users->find()->where(['reset_key' => $token])->first();
        if (empty($result)) {
            $this->Flash->error(__('you token has expired.!'));
            return $this->redirect(['action' => 'forgot']);
        }
        if ($this->request->is('post')) {
            if (($this->request->data['password'] != $this->request->data['confirm_password']) || empty($this->request->data['password'])) {
                $this->Flash->error(__('Password didn\'t match. please try again!'));
                return;
            }
            $user = $this->Users->get($result->id, [
                'contain' => []
            ]);

            $tokenData = array(
                'reset_key' => '',
                'password' => $this->request->data['password'],
                'confirm_password' => $this->request->data['confirm_password'],
            );
            $user = $this->Users->patchEntity($user, $tokenData);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has changed.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('your process failed. please try again!'));
            }
        }
    }

    /**
     * Change Password
     */
    Public function changePassword() {
        $user = $this->Users->get($this->Auth->user('id'));
        if (!empty($this->request->data)) {
            $user = $this->Users->patchEntity($user, [
                'password' => $this->request->data['new_password'],
                'new_password' => $this->request->data['new_password'],
                'confirm_password' => $this->request->data['confirm_password']]);
            if ($this->Users->save($user)) {
                $this->Flash->success('The password is successfully changed');
                return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
            } else {
                $this->Flash->error($this->Default->get_errors($user->errors()));
            }
        }
        $this->set('user', $user);
    }
    
    public function message($id = null)
    {
        $response = array();
        $obj = TableRegistry::get('messages');
        $messages = $obj->find()->where(['OR'=>[['receiver_id'=> $id, 'sender_id'=>$this->Auth->user('id')],['receiver_id'=> $this->Auth->user('id'), 'sender_id'=>$id]]])->hydrate(false)->toArray();
        //pr($messages); die;
        $auth = $this->Auth->user('id');
        if(!empty($this->request->data)){
            
            $entity = $obj->newEntity();
            $entity->sender_id = $this->Auth->user('id');
            $entity->receiver_id = $id;
            $entity->message = $this->request->data['message'];
            $entity->is_read = 0;
            $entity->status = 1;
            if($obj->save($entity)){
                $token = $this->Users->find()->select(['device_token','device_type'])->hydrate(false)->where(['id'=>$id,'status'=>'1','device_token !='=>''])->toArray();
               
                $message['title'] = 'Okbid notification';
                $message['body'] = 'You have got new message';
                $aps['id'] = $entity->id;
                $aps['type'] = 'general';
                
                $this->Default->pushnotification($message,$token,$aps);
                $this->Flash->success(__('Message has been sent successfully'));
                return $this->redirect(['controller'=>'users','action'=>'message/'.$id]);
            }
        }
        $this->set(compact('messages','auth'));
    }
    
    
    
}
