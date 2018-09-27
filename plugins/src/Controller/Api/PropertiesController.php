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
class PropertiesController extends AppController {

    public function initialize() {
        parent::initialize();
        //$this->Auth->allow();
        $this->tmpproperties = TableRegistry::get('tmp_properties');
        $this->properties = TableRegistry::get('properties');
        $this->propertylike = TableRegistry::get('property_likes');
        $this->propertyview = TableRegistry::get('property_views');
        $this->propertysign = TableRegistry::get('property_signatures');
        $this->propertybid = TableRegistry::get('property_bids');
        $this->propertyfavourite = TableRegistry::get('property_favourites');
        $this->authAllowedMethods = ['login', 'register', 'forgot', 'reset', 'varification', 'propertyimages'];
    }

    public function add() {
        if ($this->request->is('post')) {
            //pr($this->request->data);
            $entity = $this->Properties->newEntity();
            $this->request->data['user_id'] = $this->loggedInUserId;
            $user = $this->Properties->patchEntity($entity, $this->request->data);
            if ($this->Properties->save($user)) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $user;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function update() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $entity = $this->Properties->get($this->request->data['id']);
            $this->request->data['user_id'] = $this->loggedInUserId;
            $user = $this->Properties->patchEntity($entity, $this->request->data);
            
            if ($this->Properties->save($user)) {

                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $user;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function conditions() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));

            $entity = $this->Properties->get($this->request->data['id']);
            $property = $this->Properties->patchEntity($entity, $this->request->data);
            if ($this->Properties->save($property)) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $property;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function propertyimages() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $property = $this->Properties->get($this->request->data['id']);
            $property = $this->Properties->patchEntity($property, $this->request->data);
            if ($this->Properties->save($property)) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $property;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function detail() {
        if ($this->request->is('post')) {

            $this->paramsValidation(array('id' => 'notBlank'));
            $entity = $this->Properties->get($this->request->data['id'], ['contain' => ['PropertyImages' => function($q) {
                        return $q->select(['image', 'property_id']);
                    }]]);

            foreach ($entity['property_images'] as $key => $val) {

                $entity['property_images'][$key]['image'] = _BASE_ . 'uploads/images/' . $val['image'];
            }
            if (!empty($entity)) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $entity;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function comission() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('role_id' => 'notBlank', 'category' => 'notBlank'));
            $commisions = TableRegistry::get('property_commisions')->find()->where([
                        'category' => $this->request->data['category'],
                        'subcategory_id' => $this->request->data['subcategory_id'],
                        'role_id' => '2'])->first();
            $commision = !empty($commisions) ? $commisions['commision'] : '2.00';
            if (!empty($commision)) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->responseData = $commision;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function type() {
        if ($this->request->is('post')) {
            
            $this->paramsValidation(array('status' => 'notBlank'));
            
        $properties = $this->Properties->find()->contain(['PropertyBids'=>function($q){
                        return $q->order(['PropertyBids.id desc'])->limit(['1']);
                    }])
                    ->where(['Properties.user_id' => $this->loggedInUserId, 'Properties.status' => $this->request->data['status']])
                    ->group(['Properties.id'])
                    
                    ->toArray();
            if (!empty($properties)) {
                foreach($properties as $key=>$val){
                    if(!empty($val['property_bids'])){
                        $properties[$key]['is_newoffer'] = '1';
                    }else{
                        $properties[$key]['is_newoffer'] = '0';
                    }
                    
                }
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $properties;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function getsubcategory() {
        if ($this->request->is('post')) {
            $res = [];
            $this->paramsValidation(array('category' => 'notBlank'));
            $sub = TableRegistry::get('subcategories')->find()->select(['id', 'name'])->where(['category_id' => $this->request->data['category']])->toArray();
            $res['subcategory'] = $sub;

            $prop = TableRegistry::get('propertytypes')->find()->select(['id', 'name'])->where(['category_id' => $this->request->data['category']])->toArray();
            $res['property_type'] = $prop;

            $this->message = $this->msgDictonary['record_found_' . $this->language];
            $this->responseData = $res;
            $this->status = true;
        }
        $this->respond();
    }

    public function propertylist() {
        if ($this->request->is('post')) {
            $properties = $this->Properties->find()->contain(['PropertyImages'=>function($q){
                return $q->select(['image','property_id'])->where(['PropertyImages.image !='=>'']);
            }])->where(['status IN ' => ['1', '2']])->toArray();
           
            if (!empty($properties)) {
                
                foreach($properties as $key=>$val){
					foreach($val['property_images'] as $k=>$v){
						$properties[$key]['property_images'][$k]['image'] = _BASE_.'uploads/document/'.$v['image'];
					}
                    $properties[$key]['commission'] = $this->Default->getCommission($val['category']);
                }
                
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $properties;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function propertyfavourite(){
        if($this->request->is('post')){
            $this->paramsValidation(array('id' => 'notBlank'));
            $object = TableRegistry::get('property_favourites');
            $already = $object->find()->where(['user_id'=>$this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();
            if($already < 1){
                $entity = $object->newEntity();
                $entity->property_id = $this->request->data['id'];
                $entity->user_id = $this->loggedInUserId;
                if($object->save($entity)){
                    $this->message = $this->msgDictonary['favourite_' . $this->language];
                    $this->responseData = $entity;
                    $this->status = true;
                }else{
                    $this->message = $this->msgDictonary['data_save_' . $this->language];
                    $this->status = false;
                }
            }else{
                $this->message = $this->msgDictonary['favourite_' . $this->language];
                $this->status = true;
            }
        }
         $this->respond();
    }
    
    public function propertyunfavourite(){
        if($this->request->is('post')){
            $this->paramsValidation(array('favourite_id' => 'notBlank'));
            $unfav = $this->propertyfavourite->get($this->request->data['favourite_id']);
            if ($this->propertyfavourite->delete($unfav)) {
                $this->message = $this->msgDictonary['unfavourite_' . $this->language];
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
         $this->respond();
    }
    
    public function favouritelist(){
        if($this->request->is('post')){
            $response = [];
            $results = $this->propertyfavourite->find()->where(['property_favourites.user_id' => $this->loggedInUserId])->contain('Properties')->toArray();
            foreach($results as $key=>$val){
                $response[$key]= $val['property'];
                $response[$key]['favourite_id'] = $val['id'];
            }
            if (!empty($response)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $response;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
         $this->respond();
    }
   
    public function propertyreject(){
        if($this->request->is('post')){
            $this->paramsValidation(array('id' => 'notBlank'));
            $object = TableRegistry::get('property_rejects');
            $entity = $object->newEntity();
            $entity->property_id = $this->request->data['id'];
            $entity->user_id = $this->loggedInUserId;
            if($object->save($entity)){
                $this->message = $this->msgDictonary['reject_' . $this->language];
                $this->responseData = $entity;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
         $this->respond();
    }
    
    public function propertyview(){
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $already = $this->propertyview->find()->where(['user_id'=>$this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();
            if($already < 1){
                $object = $this->propertyview->newEntity();
                $object->property_id = $this->request->data['id'];
                $object->user_id = $this->loggedInUserId;
                if($this->propertyview->save($object)){
                    $this->message = $this->msgDictonary['property_view_' . $this->language];
                    $this->responseData = $object;
                    $this->status = true;
                }else{
                    $this->message = $this->msgDictonary['property_view_' . $this->language];
                    $this->status = false;
                }
            }else{
                $this->message = $this->msgDictonary['property_view_' . $this->language];
                $this->status = true;
            }
        }
         $this->respond();
    }
    
    public function propertysign(){
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $already = $this->propertysign->find()->where(['user_id'=>$this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();
            if($already < 1){
                $object = $this->propertysign->newEntity();
                $object->property_id = $this->request->data['id'];
                $object->user_id = $this->loggedInUserId;
                if($this->propertysign->save($object)){
                    $this->message = $this->msgDictonary['property_sign_' . $this->language];
                    $this->responseData = $object;
                    $this->status = true;
                }else{
                    $this->message = $this->msgDictonary['property_sign_' . $this->language];
                    $this->status = false;
                }
            }else{
                $this->message = $this->msgDictonary['property_sign_' . $this->language];
                $this->status = true;
            }
        }
         $this->respond();
    }
    
    public function signlist(){
        if ($this->request->is('post')) {
            
            $ids = $this->propertysign
                    ->find('list')
                    ->where(['user_id' => $this->loggedInUserId ])
                    ->toArray();
            
            $results = $this->properties->find()->contain(['PropertyImages'=>function($p){
                return $p->select(['image','property_id'])->where(['image !=' => '']);
            }])->where(['id IN ' => $ids])->toArray();
           
            if(!empty($results)){
                foreach($results as $key=>$val){
                    foreach($val['property_images'] as $k=>$v){
                        $results[$key]['property_images'][$k]['image'] = !empty($v['image'])? _BASE_.'uploads/document/'.$v['image']:'';
                    }
                    $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']].','.$val['city'].','.$val['no_of_room'];
                }
            }
            
            if(!empty($results)){
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
            
        }
        $this->respond();
    }
    
    public function filter() {
        if ($this->request->is('post')) {
            
            $this->paramsValidation(array('category' => 'notBlank'));
            $options['order'] = ['id' => 'DESC'];
            $options['limit'] = $this->SettingConfig['admin_paging_limit'];
            $options['finder'] = ['filter' => ['searchKeyword' => $this->request->data]];
            
            $this->paginate = $options;
            $property = $this->paginate($this->Properties);
            
            if (!empty($property)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $property;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
            $this->respond();
        }
    }
    
   public function propertyfavouritelist(){
        if ($this->request->is('post')) {
            
            $ids = $this->propertyfavourite
                    ->find('list')
                    ->where(['property_favourites.user_id' => $this->loggedInUserId ])
                    ->toArray();
            
            $results = $this->properties->find()->contain(['PropertyImages'=>function($p){
                return $p->select(['image','property_id'])->where(['image !=' => '']);
            }])->where(['id IN ' => $ids])->toArray();
           
            if(!empty($results)){
                foreach($results as $key=>$val){
                    foreach($val['property_images'] as $k=>$v){
                        $results[$key]['property_images'][$k]['image'] = !empty($v['image'])? _BASE_.'uploads/document/'.$v['image']:'';
                    }
                    $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']].','.$val['city'].','.$val['no_of_room'];
                }
            }
            
            if(!empty($results)){
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
           
        }
        $this->respond();
    }
    
   public function myproperty(){
        if ($this->request->is('post')) {
            $response = [];
            $myproperty = $this->properties
                    ->find()
                    ->contain(['PropertyImagesone'=>function($m){
                                return $m->select(['image'=>'image'])->where(['image !=' => '']);
                    }])
                    ->select(['price'=>'price',
                        'city'=>'city',
                        'propertytype_id'=>'propertytype_id',
                        'no_of_room'=>'no_of_room'])
                    ->where(['user_id' => $this->loggedInUserId])->toArray();
            
            if(!empty($myproperty)){
                foreach($myproperty as $key=>$val){
                    $response[$key]['price'] = $val['price'];
                    $response[$key]['city'] = $val['city'];
                    $response[$key]['image'] = !empty($val['image'])?_BASE_.'uploads/document/'.$val['image']:'';
                    $response[$key]['name'] = !empty($val['propertytype_id'])?Configure::read('PROTY' . LAN)[$val['propertytype_id']].','.$val['city'].','.$val['no_of_room']:'';
                }
            }
            
            if(!empty($response)){
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $response;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
   }
   
   public function submitquote(){
       if ($this->request->is('post')) {
           $this->paramsValidation(array('id' => 'notBlank','price'=>'notBlank'));
           $already = $this->propertybid->find()->where(['user_id'=>$this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();
           if($already < 1){
               $entity = $this->propertybid->newEntity();
               $entity->property_id = $this->request->data['id'];
               $entity->user_id = $this->loggedInUserId;
               $entity->price = $this->request->data['price'];
               if($this->propertybid->save($entity)){
                    $this->message = $this->msgDictonary['property_quote_' . $this->language];
                    $this->status = true;
                }else{
                    $this->message = $this->msgDictonary['property_quote_' . $this->language];
                    $this->status = false;
                }
           }else{
                $this->message = $this->msgDictonary['property_quote_' . $this->language];
                $this->status = true;
            }
       }
       $this->respond();
   }
   
   public function auction(){
       if ($this->request->is('post')) {
           $this->paramsValidation(array('id' => 'notBlank'));
           $result = $this->properties->find()->select(['property_view_count','property_signature_count','property_bid_count','price'])->where(['id'=> $this->request->data['id']])->first();
           $result['map'] = $this->propertybid->find()->select(['price','created'])->where(['property_id' => $this->request->data['id']])->toArray();
           
           if(!empty($result)){
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $result;
                $this->status = true;
           } else{
               $this->message = $this->msgDictonary['no_record_found_' . $this->language];
               $this->status = false;
           }
       }
       $this->respond();
   }
   
   public function acceptdecline(){
       if ($this->request->is('post')) {
           $this->PropertyBids = TableRegistry::get('property_bids');
            $this->paramsValidation(array('id' => 'notBlank','user_id'=> 'notBlank','is_accept'=>'notBlank'));
            if($this->request->data['is_accept'] == '1'){
                if($this->properties->updateAll(['status' => '3','buyer_id'=> $this->request->data['user_id']],['id' => $this->request->data['id']])){
                    $this->message = $this->msgDictonary['prop_sold_' . $this->language];
                    $this->status = true;
               }else{
                   $this->message = $this->msgDictonary['technical_error_' . $this->language];
                    $this->status = false;
               }
            }else{
                
                if($this->PropertyBids->updateAll(['status' => '1'],['property_id' => $this->request->data['id'],'user_id' => $this->request->data['user_id']])){
                    $this->message = $this->msgDictonary['pro_decln_bid_' . $this->language];
                    $this->status = true;
                }
            }
            
       }
       $this->respond();
   }
   
   public function activeInactive(){
       if ($this->request->is('post')) {
           $this->paramsValidation(array('id' => 'notBlank','is_active'=>'notBlank'));
           if($this->request->data['is_active'] == '1'){
               if($this->properties->updateAll(['status' => '3'],['id' => $this->request->data['id']])){
                   $this->message = $this->msgDictonary['prop_act_' . $this->language];
                   $this->status = true;
               }
           }else{
               if($this->properties->updateAll(['status' => '4'],['id' => $this->request->data['id']])){
                   $this->message = $this->msgDictonary['prop_inact_' . $this->language];
                   $this->status = true;
               }
           }           
       }
       $this->respond();
   }
   
   public function editproperty(){
       if ($this->request->is('post')) {
           $this->paramsValidation(array('property_id' => 'notBlank'));
           
           //$entitys = $this->Properties->find()->where(['id' => $this->request->data['id']])->hydrate(false)->first();
           $this->request->data['user_id'] = $this->loggedInUserId;
           $entity = $this->tmpproperties->newEntity();
           $user = $this->tmpproperties->patchEntity($entity, $this->request->data);
          
           if ($this->tmpproperties->save($user)) {
                $this->message = $this->msgDictonary['prop_edit_' . $this->language];
                $this->responseData = $user;
                $this->status = true;
           }
       }
       $this->respond();
   }

   public function submitquotelist(){
       if ($this->request->is('post')) {
           
            $ids = $this->propertybid
                    ->find('list')
                    ->where(['user_id' => $this->loggedInUserId ])
                    ->toArray();
            
            $results = $this->properties->find()->contain(['PropertyImages'=>function($p){
                return $p->select(['image','property_id'])->where(['image !=' => '']);
            }])->where(['id IN ' => $ids])->toArray();
           
            if(!empty($results)){
                foreach($results as $key=>$val){
                    foreach($val['property_images'] as $k=>$v){
                        $results[$key]['property_images'][$k]['image'] = !empty($v['image'])? _BASE_.'uploads/document/'.$v['image']:'';
                    }
                    $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']].','.$val['city'].','.$val['no_of_room'];
                }
            }
            
            if(!empty($results)){
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            }else{
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
           
       }
       $this->respond();
   }
   
}
