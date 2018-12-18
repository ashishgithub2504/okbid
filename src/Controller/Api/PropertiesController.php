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
        $this->pageno = isset($this->request->data['page_no']) ? $this->request->data['page_no'] : '0';
        if ($this->pageno == '0') {
            $this->pagination = '50000';
        }

        $this->offset = ($this->pageno == 0) ? '0' : ($this->pageno - 1) * $this->pagination;
    }

    public function add() {
        if ($this->request->is('post')) {
            //pr($this->request->data);
            $entity = $this->Properties->newEntity();
            $this->request->data['user_id'] = $this->loggedInUserId;
            $this->request->data['property_view_count'] = rand(5, 20);
            $this->request->data['updated_price']  = $this->request->data['price'];
            $user = $this->Properties->patchEntity($entity, $this->request->data);
            
            if ($this->Properties->save($user)) {
                
                for($i=0; $i<$user['property_view_count'];$i++){
                    $pventy = $this->propertyview->newEntity();
                    $pventy->property_id = $user['id'];
                    $pventy->user_id = $user['user_id'];
                    $this->propertyview->save($pventy);
                }
                $this->propertyupdate = TableRegistry::get('property_updates');
                $updateentity = $this->propertyupdate->newEntity();
                $updateentity->type = 'status';
                $updateentity->property_id = $user['id'];
                $updateentity->status = 0;
                $updateentity->date = date('Y-m-d H:i:s');
                $this->propertyupdate->save($updateentity);
                $user['price'] = intval($user['price']);
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
            $this->request->data['evaculation_date'] = !empty($this->request->data['evaculation_date']) ? $this->request->data['evaculation_date'] : '';
            $this->request->data['publish'] = !empty($this->request->data['publish']) ? $this->request->data['publish'] : '';

            $user = $this->Properties->patchEntity($entity, $this->request->data);

            if ($this->Properties->save($user)) {

                $user['evaculation_date'] = ($user['evaculation_date'] != '0000-00-00') ? $this->dateformat($user['evaculation_date']) : '';
                $user['publish'] = ($user['publish'] != '0000-00-00') ? $this->dateformat($user['publish']) : '';
                $user['price'] = intval($user['price']);
                $user['commission'] = number_format($user['commission'], 2);
                $user['name'] = $this->Default->getproptype($user['propertytype_id'], $this->language) . ', ' . $user['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $user['city'];
                
                $user['propertytype_id'] = $this->Default->getproptype($user['propertytype_id'], $this->language);
                $user['category'] = $this->Default->getpropcat($user['category'], $this->language);
                $user['sub_category'] = $this->Default->getpropsubcat($user['sub_category'], $this->language);

                $user['air_direction'] = ($user['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$user['air_direction']];
                $user['balcony_type'] = ($user['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$user['balcony_type']];
                $user['parking_type'] = ($user['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$user['parking_type']];
                $user['first_payment'] = ($user['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$user['first_payment']];
                $user['handling'] = ($user['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$user['handling']];

                $user['bars'] = ($user['bars'] == 1) ? 'Yes' : 'No';
                $user['secure_space'] = ($user['secure_space'] == 1) ? 'Yes' : 'No';
                $user['master_badroom'] = ($user['master_badroom'] == 1) ? 'Yes' : 'No';
                $user['storage'] = ($user['storage'] == 1) ? 'Yes' : 'No';
                $user['disable_access'] = ($user['disable_access'] == 1) ? 'Yes' : 'No';
                $user['is_viewed'] = $this->Default->getView($user['property_id'], $this->loggedInUserId);

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

                $property['evaculation_date'] = $this->dateformat($property['evaculation_date']);
                $property['publish'] = $this->dateformat($property['publish']);
                $property['price'] = intval($property['price']);
                $property['commission'] = number_format($property['commission'], 2);

                $property['name'] = $this->Default->getproptype($property['propertytype_id'], $this->language) . ', ' . $property['city'] . ', ' . $property['no_of_room'];
                $property['propertytype_id'] = $this->Default->getproptype($property['propertytype_id'], $this->language);
                $property['category'] = $this->Default->getpropcat($property['category'], $this->language);
                $property['sub_category'] = $this->Default->getpropsubcat($property['sub_category'], $this->language);

                $property['air_direction'] = ($property['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$property['air_direction']];
                $property['balcony_type'] = ($property['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$property['balcony_type']];
                $property['parking_type'] = ($property['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$property['parking_type']];
                $property['first_payment'] = ($property['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$property['first_payment']];
                $property['handling'] = ($property['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$property['handling']];

                $property['bars'] = ($property['bars'] == 1) ? 'Yes' : 'No';
                $property['secure_space'] = ($property['secure_space'] == 1) ? 'Yes' : 'No';
                $property['master_badroom'] = ($property['master_badroom'] == 1) ? 'Yes' : 'No';
                $property['storage'] = ($property['storage'] == 1) ? 'Yes' : 'No';
                $property['disable_access'] = ($property['disable_access'] == 1) ? 'Yes' : 'No';
                $property['is_viewed'] = $this->Default->getView($property['property_id'], $this->loggedInUserId);

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

    //{{URL}}properties/propertyimages (3dtour)
    public function propertyimages() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $property = $this->Properties->get($this->request->data['id']);
            $property = $this->Properties->patchEntity($property, $this->request->data);
            if ($this->Properties->save($property)) {

                $property['evaculation_date'] = $this->dateformat($property['evaculation_date']);
                $property['publish'] = $this->dateformat($property['publish']);
                $property['price'] = intval($property['price']);
                $property['commission'] = number_format($property['commission'], 2);
				$property['city'] = is_numeric($property['city'])? $this->Default->getCityName($property['city']) : $property['city'];
                $property['name'] = $this->Default->getproptype($property['propertytype_id'], $this->language) . ', ' . $property['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $property['city'];
                
                $property['propertytype_id'] = $this->Default->getproptype($property['propertytype_id'], $this->language);
                $property['category'] = $this->Default->getpropcat($property['category'], $this->language);
                $property['sub_category'] = $this->Default->getpropsubcat($property['sub_category'], $this->language);

                $property['air_direction'] = ($property['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$property['air_direction']];
                $property['balcony_type'] = ($property['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$property['balcony_type']];
                $property['parking_type'] = ($property['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$property['parking_type']];
                $property['first_payment'] = ($property['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$property['first_payment']];
                $property['handling'] = ($property['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$property['handling']];

                $property['bars'] = ($property['bars'] == 1) ? 'Yes' : 'No';
                $property['secure_space'] = ($property['secure_space'] == 1) ? 'Yes' : 'No';
                $property['master_badroom'] = ($property['master_badroom'] == 1) ? 'Yes' : 'No';
                $property['storage'] = ($property['storage'] == 1) ? 'Yes' : 'No';
                $property['disable_access'] = ($property['disable_access'] == 1) ? 'Yes' : 'No';
                $property['is_viewed'] = $this->Default->getView($property['property_id'], $this->loggedInUserId);

                if (!empty($property['property_favourites'])) {
                    $property['is_favourite'] = '1';
                } else {
                    $property['is_favourite'] = '0';
                }
                $property['proimagePath'] = _BASE_ . 'uploads/document/';
                $property['ownershipImagePath'] = _BASE_ . 'uploads/document/';


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
            $entity = $this->Properties->get($this->request->data['id'], ['contain' => [
                    'PropertyImages' => function($q) {
                        return $q->select(['id', 'image', 'property_id']);
                    }
					// , 'PropertyOwners' => function($r) {
                        // return $r->select(['id', 'name', 'cell', 'idno', 'property_id']);
                    // }
					// , 'PropertyFavourites' => function($t) {
                        // return $t->where(['user_id' => $this->loggedInUserId]);
                    // }
					// , 'PropertyOwnerships' => function($o) {
                        // return $o->select(['id', 'image', 'file', 'property_id']);
                    // }
            ]]);

            //$entity = $this->Default->dataformat($entity);
            $entity['evaculation_date'] = ($this->dateformat($entity['evaculation_date']) == '01/01/1970') ? '' : $this->dateformat($entity['evaculation_date']);

            $entity['publish'] = $this->dateformat($entity['publish']);
            $entity['price'] = intval($entity['price']);
            $entity['commission'] = number_format($entity['commission'], 2);
            $entity['country'] = is_numeric($entity['country'])? $this->Default->getCountryName($entity['country']) : $entity['country'];
            $entity['state'] = is_numeric($entity['state'])? $this->Default->getStateName($entity['state']) : $entity['state'];
            $entity['city'] = is_numeric($entity['city'])? $this->Default->getCityName($entity['city']) : $entity['city'];
            $entity['street'] = is_numeric($entity['street'])? $this->Default->getStreetName($entity['street']) : $entity['street'];
            $entity['name'] = $this->Default->getproptype($entity['propertytype_id'], $this->language) . ', ' . $entity['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $entity['city'];
            $entity['propertytype_id'] = $this->Default->getproptype($entity['propertytype_id'], $this->language);
            $entity['category'] = $this->Default->getpropcat($entity['category'], $this->language);
            $entity['sub_category'] = $this->Default->getpropsubcat($entity['sub_category'], $this->language);
            
            $entity['air_direction'] = ($entity['air_direction'] == 0) ? '' : Configure::read('AIR_' . $this->language)[$entity['air_direction']];
            $entity['balcony_type'] = ($entity['balcony_type'] == 0) ? '' : Configure::read('BalconyType_' . $this->language)[$entity['balcony_type']];
            $entity['parking_type'] = ($entity['parking_type'] == 0) ? '' : Configure::read('PARTYPE_' . $this->language)[$entity['parking_type']];
            $entity['first_payment'] = ($entity['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY_' . $this->language)[$entity['first_payment']];
            $entity['handling'] = ($entity['handling'] == 0) ? '' : Configure::read('HANDING_' . $this->language)[$entity['handling']];

            $entity['ac'] = ($entity['ac'] == 0) ? '' : Configure::read('AIRCOND_' . $this->language)[$entity['ac']];
            $entity['property_condition'] = ($entity['property_condition'] == 0) ? '' : Configure::read('PROPCON_' . $this->language)[$entity['property_condition']];
            $entity['defects'] = Configure::read('YN_' . $this->language)[$entity['defects']];
            $entity['bars'] = Configure::read('YN_' . $this->language)[$entity['bars']];
            
            $entity['secure_space'] = !empty($entity['secure_space'])?Configure::read('YN_' . $this->language)[$entity['secure_space']]:'';
            $entity['master_badroom'] = Configure::read('YN_' . $this->language)[$entity['master_badroom']];
            $entity['storage'] = !empty($entity['storage']) ? Configure::read('YN_' . $this->language)[$entity['storage']]:'';
            $entity['disable_access'] = isset($entity['disable_access']) ? Configure::read('YN_' . $this->language)[$entity['disable_access']]:'';
            $entity['is_viewed'] = $this->Default->getView($entity['id'], $this->loggedInUserId);
            $entity['isAutoBidApplied'] = $this->Default->getisAutoBidApplied($entity['id'], $this->loggedInUserId);
            $entity['is_signed'] = $this->Default->getsigned($entity['id'], $this->loggedInUserId);
			
			$entity['property_owners'] = $this->Default->getOwners($entity['id']);
			$entity['property_favourites'] = $this->Default->getFavourte($entity['id']);
			$entity['property_ownerships'] = $this->Default->getOwnership($entity['id']);
			
            if (!empty($entity['property_favourites'])) {
                $entity['is_favourite'] = '1';
            } else {
                $entity['is_favourite'] = '0';
            }
            $entity['proimagePath'] = _BASE_ . 'uploads/document/';
            $entity['ownershipImagePath'] = _BASE_ . 'uploads/document/';

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
            $commisions = TableRegistry::get('property_commisions')
                    ->find()
                    ->where([
                        'category' => $this->request->data['category'],
                        'subcategory_id' => $this->request->data['subcategory_id'],
                        'role_id' => $this->request->data['role_id']])
                    ->first();

            $commision = !empty($commisions) ? number_format($commisions['commision'], 2, '.', '') : '2.00';
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

            $property = $this->Properties->find()
                    ->contain(['PropertyBids' => function($q) {
                            return $q->order(['PropertyBids.id desc'])->limit(['1']);
                        }, 'PropertyOwners' => function($r) {
                            return $r->select(['id', 'name', 'cell', 'idno', 'property_id']);
                        }, 'PropertyImages' => function($p) {
                            return $p->select(['id', 'image', 'property_id']);
                        }])
                    ->where(['Properties.user_id' => $this->loggedInUserId, 'Properties.status' => $this->request->data['status']])
                    ->limit($this->pagination)
                    ->offset($this->offset)
                    ->group(['Properties.id']);

            $properties = $property->toArray();
            $propertiescount = $property->count();

            if (!empty($properties)) {
                foreach ($properties as $key => $val) {
                    //$properties = $this->Default->dataformat($val);
                    //$properties['evaculation_date'] = ($this->dateformat($properties['evaculation_date'])== '01/01/1970')?'':$this->dateformat($properties['evaculation_date']);

                    
                    $properties[$key]['category'] = $this->Default->getpropcat($val['category'], $this->language);
                    $properties[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category'], $this->language);
                    $properties[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                    $properties[$key]['flexible_evaculation_date'] = $this->dateformat($val['flexible_evaculation_date']);
                    $properties[$key]['publish'] = $this->dateformat($val['publish']);
                    $properties[$key]['price'] = intval($val['price']);

                    $properties[$key]['air_direction'] = ($val['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['air_direction']];
                    $properties[$key]['balcony_type'] = ($val['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $properties[$key]['parking_type'] = ($val['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $properties[$key]['first_payment'] = ($val['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $properties[$key]['handling'] = ($val['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['handling']];

                    $properties[$key]['defects'] = ($val['defects'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';

                    $properties[$key]['commission'] = number_format($val['commission'], 2);
                    $val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
                    $properties[$key]['name'] = $this->Default->getproptype($val['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                    $properties[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id'], $this->language);
                    $properties[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                    $properties[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                    $properties[$key]['total'] = $propertiescount;

                    if (!empty($val['property_bids'])) {
                        $properties[$key]['is_newoffer'] = '1';
                    } else {
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

            if ($this->language == 'en') {
                $argu = 'name';
            } else {
                $argu = 'namehe';
            }

            $res = [];
            $this->paramsValidation(array('category' => 'notBlank'));

            $subs = TableRegistry::get('subcategories')->find()
                    ->select(['id', $argu])
                    ->where(['category_id IN ' => explode(',', $this->request->data['category'])])
                    ->toArray();

            $sub = array_map(function($tag) {
                if ($this->language == 'en') {
                    $argu = 'name';
                } else {
                    $argu = 'namehe';
                }
                return array(
                    'name' => $tag[$argu],
                    'id' => $tag['id']
                );
            }, $subs);

            $res['subcategory'] = $sub;

            $props = TableRegistry::get('propertytypes')->find()
                    ->select(['id', $argu])
                    ->where(['category_id IN ' => explode(',', $this->request->data['category'])])
                    ->toArray();

            $prop = array_map(function($tag) {
                if ($this->language == 'en') {
                    $argu = 'name';
                } else {
                    $argu = 'namehe';
                }
                return array(
                    'name' => $tag[$argu],
                    'id' => $tag['id']
                );
            }, $props);

            $res['property_type'] = $prop;

            $this->message = $this->msgDictonary['record_found_' . $this->language];
            $this->responseData = $res;
            $this->status = true;
        }
        $this->respond();
    }

    public function propertylist() {
        if ($this->request->is('post')) {

            $this->paginate = [
                'contain' => []
            ];

            $options['conditions'] = ['Properties.user_id !=' => $this->loggedInUserId,'Properties.status IN ' => ['1', '2']];
            if ($this->pageno != '0') {
                $options['limit'] = $this->limit5;
                $options['page'] = $this->pageno;
            } else {
                $options['limit'] = '50000';
            }

            $options['order'] = ['Properties.id' => 'ASC'];
            $options['group'] = ['Properties.id'];
            $options['contain'] = ['PropertyImages' => function($q) {
                    return $q->select(['id', 'image', 'property_id'])->where(['PropertyImages.image !=' => '']);
                }, 'PropertyOwners' => function($r) {
                    return $r->select(['id', 'name', 'cell', 'idno', 'property_id']);
                }, 'PropertyRejects' => function($pr) {
                    return $pr->where(['PropertyRejects.user_id' => $this->loggedInUserId]);
                }, 'PropertyFavourites' => function($t) {
                    return $t->where(['PropertyFavourites.user_id' => $this->loggedInUserId]);
                }, 'PropertyBids' => function($t) {
                    return $t->where(['PropertyBids.user_id' => $this->loggedInUserId]);
                }, 'PropertyOwnerships' => function($o) {
                    return $o->select(['id', 'image', 'file', 'property_id']);
                }];



            $this->paginate = $options;

            $properties = $this->paginate($this->Properties)->toArray();

//            $this->connection = ConnectionManager::get('default');
//            $results = $this->connection->execute('CALL propertylist()')->fetchAll('assoc');                 
            //debug($properties->sql()); die;

            if (!empty($properties)) {

                foreach ($properties as $key => $val) {

                    $properties[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                    $properties[$key]['publish'] = $this->dateformat($val['publish']);
                    $properties[$key]['price'] = intval($val['price']);
                    //$properties[$key]['commission'] = number_format($val['commission'] , 2);
					$val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
					
                    $properties[$key]['name'] = $this->Default->getproptype($properties[$key]['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                    
                    $properties[$key]['propertytype_id'] = $this->Default->getproptype($properties[$key]['propertytype_id'], $this->language);
                    $properties[$key]['category'] = $this->Default->getpropcat($properties[$key]['category'], $this->language);
                    $properties[$key]['sub_category'] = $this->Default->getpropsubcat($properties[$key]['sub_category'], $this->language);

                    $properties[$key]['air_direction'] = ($val['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['air_direction']];
                    $properties[$key]['balcony_type'] = ($val['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $properties[$key]['parking_type'] = ($val['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $properties[$key]['first_payment'] = ($val['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $properties[$key]['handling'] = ($val['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['handling']];

                    $properties[$key]['defects'] = ($val['defects'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);
                    $properties[$key]['isAutoBidApplied'] = $this->Default->getisAutoBidApplied($val['id'], $this->loggedInUserId);

                    if (!empty($val['property_favourites'])) {
                        $properties[$key]['is_favourite'] = '1';
                    } else {
                        $properties[$key]['is_favourite'] = '0';
                    }

                    if (!empty($val['property_reject'])) {
                        $properties[$key]['is_rejected'] = '1';
                    } else {
                        $properties[$key]['is_rejected'] = '0';
                    }
                    unset($properties[$key]['property_reject']);

                    if (!empty($val['property_bids'])) {
                        $properties[$key]['isBidApplied'] = '1';
                    } else {
                        $properties[$key]['isBidApplied'] = '0';
                    }
                    unset($properties[$key]['property_bids']);

//                    foreach ($val['property_images'] as $k => $v) {
//                        $properties[$key]['property_images'][$k]['image'] = _BASE_ . 'uploads/document/' . $v['image'];
//                    }
                    $properties[$key]['commission'] = $this->Default->getCommission($val['category']);
                    $properties[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                    $properties[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                    $properties[$key]['total'] = $this->request->param('paging.Properties.count');
                }

                //
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

    public function propertyfavourite() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $object = TableRegistry::get('property_favourites');
            $already = $object->find()->where(['user_id' => $this->loggedInUserId, 'property_id' => $this->request->data['id']])->toArray();
            if (count($already) < 1) {
                $entity = $object->newEntity();
                $entity->property_id = $this->request->data['id'];
                $entity->user_id = $this->loggedInUserId;
                if ($object->save($entity)) {
                    $this->message = $this->msgDictonary['favourite_' . $this->language];
                    $this->responseData = $entity;
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['data_save_' . $this->language];
                    $this->status = false;
                }
            } else {
                $this->message = $this->msgDictonary['favourite_' . $this->language];
                $this->responseData = $already;
                $this->status = true;
            }
        }
        $this->respond();
    }

    public function propertyunfavourite() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('property_id' => 'notBlank'));

            $unfav = $this->propertyfavourite
                    ->find()
                    ->where(['property_id' => $this->request->data['property_id'], 'user_id' => $this->loggedInUserId])
                    ->first();

            if (!empty($unfav)) {
                if ($this->propertyfavourite->delete($unfav)) {
                    $this->message = $this->msgDictonary['unfavourite_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['data_save_' . $this->language];
                    $this->status = false;
                }
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function favouritelist() {
        if ($this->request->is('post')) {

            $response = [];
            $results = $this->propertyfavourite->find()
                    ->where(['property_favourites.user_id' => $this->loggedInUserId])
                    ->contain(['Properties' => function($q) {
                            return $q->contain(['PropertyImages']);
                        }])
                    ->hydrate(false)
                    ->toArray();

            foreach ($results as $key => $val) {

                $response[$key] = $val['property'];

                $response[$key]['price'] = intval($val['property']['price']);
                $response[$key]['propertytype_id'] = $this->Default->getproptype($val['property']['propertytype_id'], $this->language);
                $response[$key]['category'] = $this->Default->getpropcat($val['property']['category'], $this->language);
                $response[$key]['sub_category'] = $this->Default->getpropsubcat($val['property']['sub_category'], $this->language);
                $val['property']['city'] = is_numeric($val['property']['city'])? $this->Default->getCityName($val['property']['city']) : $val['property']['city'];
                //$response[$key]['commission'] = number_format($val['property']['commission'], 2);
                $response[$key]['name'] = $this->Default->getproptype($val['property']['propertytype_id'], $this->language) . ', ' . $val['property']['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['property']['city'];
                $response[$key]['favourite_id'] = $val['id'];

                $response[$key]['air_direction'] = ($val['property']['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['property']['air_direction']];
                $response[$key]['balcony_type'] = ($val['property']['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['property']['balcony_type']];
                $response[$key]['parking_type'] = ($val['property']['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['property']['parking_type']];
                $response[$key]['first_payment'] = ($val['property']['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['property']['first_payment']];
                $response[$key]['handling'] = ($val['property']['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['property']['handling']];


                $response[$key]['defects'] = ($val['property']['defects'] == 1) ? 'Yes' : 'No';
                $response[$key]['bars'] = ($val['property']['bars'] == 1) ? 'Yes' : 'No';
                $response[$key]['secure_space'] = ($val['property']['secure_space'] == 1) ? 'Yes' : 'No';
                $response[$key]['master_badroom'] = ($val['property']['master_badroom'] == 1) ? 'Yes' : 'No';
                $response[$key]['storage'] = ($val['property']['storage'] == 1) ? 'Yes' : 'No';
                $response[$key]['disable_access'] = ($val['property']['disable_access'] == 1) ? 'Yes' : 'No';
                $response[$key]['is_viewed'] = $this->Default->getView($val['property']['id'], $this->loggedInUserId);
                $response[$key]['is_signed'] = $this->Default->getsigned($val['property']['id'], $this->loggedInUserId);
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

    public function propertyreject() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $object = TableRegistry::get('property_rejects');
            $entity = $object->newEntity();
            $entity->property_id = $this->request->data['id'];
            $entity->user_id = $this->loggedInUserId;
            if ($object->save($entity)) {
                $this->message = $this->msgDictonary['reject_' . $this->language];
                $this->responseData = $entity;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function propertyview() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $already = $this->propertyview->find()->where(['user_id' => $this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();
            if ($already < 1) {
                $object = $this->propertyview->newEntity();
                $object->property_id = $this->request->data['id'];
                $object->user_id = $this->loggedInUserId;
                if ($this->propertyview->save($object)) {
                    $this->message = $this->msgDictonary['property_view_' . $this->language];
                    $this->responseData = $object;
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['property_view_' . $this->language];
                    $this->status = false;
                }
            } else {
                $this->message = $this->msgDictonary['property_view_' . $this->language];
                $this->status = true;
            }
        }
        $this->respond();
    }

    public function propertysign() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $already = $this->propertysign->find()->where(['user_id' => $this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();

            if (isset($this->request->data['id_number'])) {
                TableRegistry::get('users')->updateAll(['id_number' => $this->request->data['id_number']], ['id' => $this->loggedInUserId]);
            }

            if ($already < 1) {

                $object = $this->propertysign->newEntity();
                $object->property_id = $this->request->data['id'];
                $object->user_id = $this->loggedInUserId;
                if ($this->propertysign->save($object)) {
                    $this->message = $this->msgDictonary['property_sign_' . $this->language];
                    $this->responseData = $object;
                    if (isset($this->request->data['id_number'])) {
                        $this->responseData['id_number'] = $this->request->data['id_number'];
                    }
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['property_sign_' . $this->language];
                    $this->status = false;
                }
            } else {
                if (isset($this->request->data['id_number'])) {
                    $this->responseData['id_number'] = $this->request->data['id_number'];
                }
                $this->message = $this->msgDictonary['property_sign_' . $this->language];
                $this->status = true;
            }
        }
        $this->respond();
    }

    public function signlist() {
        if ($this->request->is('post')) {
            $results = [];

            $ids = $this->propertysign
                    ->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'property_id'
                    ])
                    ->where(['user_id' => $this->loggedInUserId])
                    ->toArray();

            if (!empty($ids)) {
                $result = $this->properties->find()
                        ->contain(['PropertyImages' => function($p) {
                                return $p->select(['image', 'property_id'])->where(['image !=' => '']);
                            }, 'PropertyOwnerships' => function($o) {
                                return $o->select(['image', 'file', 'property_id']);
                            }, 'PropertyOwnerships' => function($o) {
                                return $o->select(['id', 'image', 'file', 'property_id']);
                            }])
                        ->limit($this->pagination)
                        ->offset($this->offset)
                        ->where(['properties.id IN ' => $ids]);

                $results = $result->toArray();
                $resultcount = $result->count();

                if (!empty($results)) {
                    foreach ($results as $key => $val) {

                        $results[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                        $results[$key]['publish'] = $this->dateformat($val['publish']);
                        $results[$key]['price'] = intval($val['price']);

                        $results[$key]['commission'] = number_format($val['commission'], 2);
                        $val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
                        $results[$key]['name'] = $this->Default->getproptype($val['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                        
                        $results[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id'], $this->language);
                        $results[$key]['category'] = $this->Default->getpropcat($val['category'], $this->language);
                        $results[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category'], $this->language);

                        //$response[$key]['commission'] = number_format($val['property']['commission'], 2);

                        $results[$key]['favourite_id'] = $val['id'];

                        $results[$key]['air_direction'] = ($val['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['air_direction']];
                        $results[$key]['balcony_type'] = ($val['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                        $results[$key]['parking_type'] = ($val['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                        $results[$key]['first_payment'] = ($val['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                        $results[$key]['handling'] = ($val['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['handling']];

                        $results[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                        $results[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                        $results[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                        $results[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                        $results[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                        $results[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);
                        $results[$key]['total'] = $resultcount;

//                        foreach ($val['property_images'] as $k => $v) {
//                            $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
//                        }
                        $results[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                        $results[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                    }
                }
            }


            if (!empty($results)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function filter() {
        if ($this->request->is('post')) {
            $array3 = [];
            //$this->paramsValidation(array('category' => 'notBlank'));
            $options['order'] = ['id' => 'DESC'];
            $options['limit'] = $this->SettingConfig['admin_paging_limit'];
            //$options['contain'] = ['PropertyImages'];
            $options['finder'] = ['filter' => ['searchKeyword' => $this->request->data]];
            $options['hydrate'] = false;
            $this->paginate = $options;
            $properties = $this->paginate($this->Properties)->toArray();
            //pr($property);
            if (!empty($this->request->data['range'])) {

                $conn = ConnectionManager::get('default');

                foreach ($properties as $key => $val) {
                    if (!empty($val['lat']) && !empty($val['lng'])) {
                        $rs = $conn->query(
                                'SELECT * from properties'
                                . ' where 
                            ( 3959 * acos( cos( radians(' . $val['lat'] . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $val['lng'] . ') ) + '
                                . 'sin( radians(' . $val['lat'] . ') ) * sin( radians( lat ) ) ) ) < ' . $this->request->data['range']);

                        $rangepro = $rs->fetchAll('assoc');

                        if (!empty($rangepro)) {
                            $array3 = $rangepro;
                        }
                        $properties = $array3;
                    }
                }
            }


            if (!empty($properties)) {

                foreach ($properties as $key => $val) {

                    $properties[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                    $properties[$key]['publish'] = $this->dateformat($val['publish']);
                    $properties[$key]['price'] = intval($val['price']);
                    //$properties[$key]['commission'] = number_format($val['commission'] , 2);

                    $properties[$key]['name'] = $this->Default->getproptype($properties[$key]['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                    
                    $properties[$key]['propertytype_id'] = $this->Default->getproptype($properties[$key]['propertytype_id'], $this->language);
                    $properties[$key]['category'] = $this->Default->getpropcat($properties[$key]['category'], $this->language);
                    $properties[$key]['sub_category'] = $this->Default->getpropsubcat($properties[$key]['sub_category'], $this->language);

                    $properties[$key]['air_direction'] = ($val['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['air_direction']];
                    $properties[$key]['balcony_type'] = ($val['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $properties[$key]['parking_type'] = ($val['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $properties[$key]['first_payment'] = ($val['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $properties[$key]['handling'] = ($val['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['handling']];

                    $properties[$key]['defects'] = ($val['defects'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);
                    $properties[$key]['isAutoBidApplied'] = $this->Default->getisAutoBidApplied($val['id'], $this->loggedInUserId);

                    if (!empty($val['property_favourites'])) {
                        $properties[$key]['is_favourite'] = '1';
                    } else {
                        $properties[$key]['is_favourite'] = '0';
                    }

                    if (!empty($val['property_reject'])) {
                        $properties[$key]['is_rejected'] = '1';
                    } else {
                        $properties[$key]['is_rejected'] = '0';
                    }
                    unset($properties[$key]['property_reject']);

                    if (!empty($val['property_bids'])) {
                        $properties[$key]['isBidApplied'] = '1';
                    } else {
                        $properties[$key]['isBidApplied'] = '0';
                    }
                    unset($properties[$key]['property_bids']);

//                    foreach ($val['property_images'] as $k => $v) {
//                        $properties[$key]['property_images'][$k]['image'] = _BASE_ . 'uploads/document/' . $v['image'];
//                    }
                    $properties[$key]['commission'] = $this->Default->getCommission($val['category']);
                    $properties[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                    $properties[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                }

                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $properties;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
            $this->respond();
        }
    }

    public function propertyfavouritelist() {
        if ($this->request->is('post')) {

            $ids = $this->propertyfavourite
                    ->find('list')
                    ->where(['property_favourites.user_id' => $this->loggedInUserId])
                    ->toArray();

            $results = $this->properties->find()->contain([
                        'PropertyImages' => function($p) {
                            return $p->select(['id', 'image', 'property_id'])->where(['image !=' => '']);
                        }, 'PropertyOwnerships' => function($o) {
                            return $o->select(['id', 'image', 'file', 'property_id']);
                        }])->where(['id IN ' => $ids])->toArray();

            if (!empty($results)) {
                foreach ($results as $key => $val) {
//                    foreach ($val['property_images'] as $k => $v) {
//                        $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
//                    }
                    $results[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                    $results[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                    $val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
                    $results[$key]['name'] = $this->Default->getproptype($val['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                    
                }
            }

            if (!empty($results)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function myproperty() {
        if ($this->request->is('post')) {
            $response = [];
            $myprop = $this->properties
                    ->find()
                    ->contain(['PropertyImages' => function($q) {
                            return $q->select(['id', 'image', 'property_id']);
                        }, 'PropertyFavourites' => function($t) {
                            return $t->where(['user_id' => $this->loggedInUserId]);
                        }, 'PropertyOwnerships' => function($o) {
                            return $o->select(['id', 'image', 'file', 'property_id']);
                        }])
                    ->where(['buyer_id' => $this->loggedInUserId])
                    ->limit($this->pagination)
                    ->offset($this->offset);

            $myproperty = $myprop->toArray();
            $mypropertycount = $myprop->count();

            if (!empty($myproperty)) {
                foreach ($myproperty as $key => $val) {
                    //$myproperty[$key] = $this->Default->dataformat($val);
                    $myproperty[$key]['evaculation_date'] = ($this->dateformat($myproperty[$key]['evaculation_date']) == '01/01/1970') ? '' : $this->dateformat($myproperty[$key]['evaculation_date']);
                    //$myproperty[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);

                    $myproperty[$key]['publish'] = $this->dateformat($val['publish']);
                    $myproperty[$key]['price'] = intval($val['price']);

                    $myproperty[$key]['commission'] = number_format($val['commission'], 2);
                    $val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
                    $myproperty[$key]['name'] = $this->Default->getproptype($val['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];                    
                    $myproperty[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id'], $this->language);
                    $myproperty[$key]['category'] = $this->Default->getpropcat($val['category'], $this->language);
                    $myproperty[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category'], $this->language);

                    $myproperty[$key]['air_direction'] = ($val['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['air_direction']];
                    $myproperty[$key]['balcony_type'] = ($val['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $myproperty[$key]['parking_type'] = ($val['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $myproperty[$key]['first_payment'] = ($val['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $myproperty[$key]['handling'] = ($val['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['handling']];

                    $myproperty[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';

                    $myproperty[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);

                    if (!empty($myproperty[$key]['property_favourites'])) {
                        $myproperty[$key]['is_favourite'] = '1';
                    } else {
                        $myproperty[$key]['is_favourite'] = '0';
                    }
                    $myproperty[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                    $myproperty[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                    $myproperty[$key]['total'] = $mypropertycount;
                }
            }

            if (!empty($myproperty)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $myproperty;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function submitquote() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank', 'price' => 'notBlank'));

            $this->bidvalidation($this->request->data);

            $this->propertyautobids = TableRegistry::get('property_autobids');

            $already = $this->propertyautobids->find()
                    ->select(['price'])
                    ->hydrate(false)
                    ->where(['user_id' => $this->loggedInUserId, 'property_id' => $this->request->data['id'], 'price >' => $this->request->data['price']])
                    ->first();

            if (empty($already)) {

                $entity = $this->propertybid->newEntity();
                $entity->property_id = $this->request->data['id'];
                $entity->user_id = $this->loggedInUserId;
                $entity->price = $this->request->data['price'];

                if ($this->propertybid->save($entity)) {


                    $this->properties->updateAll([
                        'updated_price' => $this->request->data['price']
                            ], ['id' => $this->request->data['id']]);

                    $this->Default->autobid($this->request->data, $this->loggedInUserId);
                    $this->propertysign->deleteAll(['property_id' => $this->request->data['id'], 'user_id' => $this->loggedInUserId]);

                    $userdata = $this->Default->getuserinfobyprop($this->request->data['id']);
                    $this->Default->heigherBidNotification($this->request->data['id'], $this->request->data['price']);
                    $message['title'] = 'Okbid Notification';
                    $message['body'] = $this->msgDictonary['prop_offer_' . $this->language];
                    $aps['id'] = $this->request->data['id'];
                    $aps['type'] = 'offer';
                    if (!empty($userdata))
                        $this->Default->pushnotification($message, $userdata, $aps);
                    $this->properties->find()->where(['properties.id' => $this->request->data['id']]);
                    $this->message = $this->msgDictonary['property_quote_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['property_quote_' . $this->language];
                    $this->status = false;
                }
            } else {
                $this->message = $this->msgDictonary['autobid_' . $this->language] . $already['price'];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function bidvalidation($data = null) {

        $res = $this->propertybid
                ->find()
                ->select(['price'])
                ->where(['property_id' => $data['id'], 'price >' => ($data['price'] - MINBID)])
                ->first();

        if (!empty($res)) {
            $this->message = $this->msgDictonary['bid_val_' . $this->language] . ($res['price'] + MINBID);
            $this->status = false;
            $this->respond();
            die;
        } else {
            return true;
        }
    }

    public function auction() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $result = $this->properties->find()->select(['updated_price', 'property_view_count', 'property_signature_count', 'property_bid_count', 'price'])->where(['id' => $this->request->data['id']])->first();
            $result['map'] = $this->propertybid->find()->select(['price', 'created'])->where(['property_id' => $this->request->data['id']])->toArray();

            if (!empty($result)) {

//                foreach ($result as $key => $val) {
//                    $result[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
//                    $result[$key]['publish'] = $this->dateformat($val['publish']);
//                    $result[$key]['price'] = intval($val['price']);
//                    $result[$key]['updated_price'] = intval($val['updated_price']);
//                    $result[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
//                    $result[$key]['commission'] = number_format($val['commission'], 2);
//                    $result[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
//                    $result[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id']);
//                    $result[$key]['category'] = $this->Default->getpropcat($val['category']);
//                    $result[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category']);
//
//                    $result[$key]['air_direction'] = ($val['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['air_direction']];
//                    $result[$key]['balcony_type'] = ($val['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['balcony_type']];
//                    $result[$key]['parking_type'] = ($val['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['parking_type']];
//                    $result[$key]['first_payment'] = ($val['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
//                    $result[$key]['handling'] = ($val['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['handling']];
//
//                    $result[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
//                    $result[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
//                    $result[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
//                    $result[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
//                    $result[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
//                }

                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $result;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function acceptdecline() {
        if ($this->request->is('post')) {
            $this->PropertyBids = TableRegistry::get('property_bids');
            $this->paramsValidation(array('id' => 'notBlank', 'user_id' => 'notBlank', 'is_accept' => 'notBlank'));

            //$userdata = $this->Default->getuserinfo($this->request->data['user_id']);
            $userdata = $this->Default->getuserinfoByProp($this->request->data['id']);
            if ($this->request->data['is_accept'] == '1') {
                if ($this->properties->updateAll(['status' => '3', 'buyer_id' => $this->request->data['user_id']], ['id' => $this->request->data['id']])) {
                    $message['title'] = 'okbid notification';
                    $message['body'] = $this->msgDictonary['prop_won_' . $this->language];
                    $aps['id'] = $this->request->data['id'];
                    $aps['type'] = 'general';
                    $this->Default->pushnotification($message, $userdata, $aps);
                    $this->message = $this->msgDictonary['prop_sold_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['prop_sold_' . $this->language];
                    $this->status = false;
                }
            } else {

                if ($this->PropertyBids->updateAll(['status' => '1'], ['property_id' => $this->request->data['id'], 'user_id' => $this->request->data['user_id']])) {
                    $message['title'] = 'okbid notification';
                    $message['body'] = $this->msgDictonary['pro_decln_bid_' . $this->language];
                    $aps['id'] = $this->request->data['id'];
                    $aps['type'] = 'general';
                    $this->Default->pushnotification($message, $userdata, $aps);
                    $this->message = $this->msgDictonary['pro_decln_bid_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['pro_decln_bid_' . $this->language];
                    $this->status = true;
                }
            }
        }
        $this->respond();
    }

    public function activeInactive() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank', 'is_active' => 'notBlank'));
            if ($this->request->data['is_active'] == '1') {
                if ($this->properties->updateAll(['status' => '0'], ['id' => $this->request->data['id']])) {
                    $this->message = $this->msgDictonary['prop_act_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['prop_act_' . $this->language];
                    $this->status = true;
                }
            } else {
                if ($this->properties->updateAll(['status' => '4'], ['id' => $this->request->data['id']])) {
                    $this->message = $this->msgDictonary['prop_inact_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['prop_inact_' . $this->language];
                    $this->status = true;
                }
            }
        }
        $this->respond();
    }

    public function editproperty() {
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

    public function submitquotelist() {
        if ($this->request->is('post')) {
            $results = [];
            $ids = $this->propertybid
                    ->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'property_id'
                    ])
                    ->where(['user_id' => $this->loggedInUserId])
                    ->toArray();
            if (!empty($ids)) {
                $result = $this->properties->find()->contain(
                                ['PropertyImages' => function($p) {
                                        return $p->select(['id', 'image', 'property_id'])->where(['image !=' => '']);
                                    }, 'PropertyOwnerships' => function($o) {
                                        return $o->select(['id', 'image', 'file', 'property_id']);
                                    }])->where(['id IN ' => $ids])
                        ->limit($this->pagination)
                        ->offset($this->offset);

                $results = $result->toArray();
                $resultcount = $result->count();

                if (!empty($results)) {
                    foreach ($results as $key => $val) {

                        //$results[$key] = $this->Default->dataformat($val);
                        $results[$key]['evaculation_date'] = ($this->dateformat($results[$key]['evaculation_date']) == '01/01/1970') ? '' : $this->dateformat($results[$key]['evaculation_date']);

                        $results[$key]['price'] = intval($results[$key]['price']);

                        $myproperty[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                        $myproperty[$key]['publish'] = $this->dateformat($val['publish']);
                        $myproperty[$key]['price'] = intval($val['price']);
                        $myproperty[$key]['commission'] = number_format($val['commission'], 2);
                        $myproperty[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id'], $this->language);
                        $myproperty[$key]['category'] = $this->Default->getpropcat($val['category'], $this->language);
                        $myproperty[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category'], $this->language);

                        $results[$key]['air_direction'] = ($val['air_direction'] == 0) ? '' : Configure::read('AIR' . LAN)[$val['air_direction']];
                        $results[$key]['balcony_type'] = ($val['balcony_type'] == 0) ? '' : Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                        $results[$key]['parking_type'] = ($val['parking_type'] == 0) ? '' : Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                        $results[$key]['first_payment'] = ($val['first_payment'] == 0) ? '' : Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                        $results[$key]['handling'] = ($val['handling'] == 0) ? '' : Configure::read('HANDING' . LAN)[$val['handling']];

                        $results[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                        $results[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                        $results[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                        $results[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                        $results[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                        $results[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                        $results[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                        $results[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);
                        $val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
                        $results[$key]['name'] = $this->Default->getproptype($val['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                        $results[$key]['total'] = $resultcount;
                    }
                }
            }

            if (!empty($results)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function auctionlist() {
        if ($this->request->is('post')) {
            $results = [];
            $ids = $this->propertybid
                    ->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'property_id'
                    ])
                    ->where(['user_id' => $this->loggedInUserId])
                    ->toArray();

            if (!empty($ids)) {
                $results = $this->properties->find()->contain(['PropertyImages' => function($p) {
                                return $p->select(['id', 'image', 'property_id'])->where(['image !=' => '']);
                            }, 'PropertyOwnerships' => function($o) {
                                return $o->select(['id', 'image', 'file', 'property_id']);
                            }])->where(['id IN ' => $ids, 'status' => '2'])->toArray();

                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        $results[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
                        $results[$key]['price'] = intval($results[$key]['price']);
//                        foreach ($val['property_images'] as $k => $v) {
//                            $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
//                        }
                        $results[$key]['proimagePath'] = _BASE_ . 'uploads/document/';
                        $results[$key]['ownershipImagePath'] = _BASE_ . 'uploads/document/';
                        $results[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);
                        $val['city'] = is_numeric($val['city'])? $this->Default->getCityName($val['city']) : $val['city'];
                        $results[$key]['name'] = $this->Default->getproptype($val['propertytype_id'], $this->language) . ', ' . $val['no_of_room'] . ' ' . Configure::read('ROOM')[$this->language] . ', ' . $val['city'];
                    }
                }
            }

            if (!empty($results)) {
                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $results;
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function auctionstart() {
        $devices = TableRegistry::get('users')->find()->select(['device_token', 'device_type', 'name'])
                ->where(['status' => '1', 'device_token !=' => ''])
                ->hydrate(false)
                ->toArray();
        $message['title'] = 'okbid notification';
        $message['body'] = $this->msgDictonary['prop_auction_' . $this->language];
        $aps['type'] = 'general';

        $this->Default->pushnotification($message, $devices, $aps);
        $this->message = 'Auction will start at 10 AM';
        $this->status = true;
        $this->respond();
    }

    public function deleteimage() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank', 'property_id' => 'notBlank'));
            $this->propertyimage = TableRegistry::get('property_images');
            if ($this->propertyimage->deleteAll(['propertyimage.id' => $this->request->data['id'], 'propertyimage.property_id' => $this->request->data['property_id']])) {
                $this->message = $this->msgDictonary['prop_image_' . $this->language];
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function pushtest() {
        $message['title'] = 'test';
        $message['body'] = 'test message body';
        $devices[0]['device_token'] = 'f-iHrsb2v0A:APA91bGy1fLZ94lXZ2iEKjnot68H4XDV4qg-SBC4R9-Mw36KjfGbUJTh8OzT6RykfrxgFnwDOFoHvKxkD6ilgJsmarnJ6_Q8Z-4QmR-sDdQXSpTsq3UF_oPqzP-fQ6lhBfV8ctTPRBzr';
        $devices[0]['device_type'] = 'android';

        $this->Default->pushnotification($message, $devices);
        die;
    }

    public function deleteownership() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $this->PropertyOwnerships = TableRegistry::get('property_ownerships');
            if ($this->PropertyOwnerships->deleteAll(['id' => $this->request->data['id']])) {
                $this->message = $this->msgDictonary['prop_ownership_' . $this->language];
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function iscomplete() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            if (TableRegistry::get('properties')->updateAll(['is_complete' => '1'], ['id' => $this->request->data['id']])) {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['data_save_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function deleteowners() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $this->PropertyOwners = TableRegistry::get('property_owners');
            if ($this->PropertyOwners->deleteAll(['id' => $this->request->data['id']])) {
                $this->message = $this->msgDictonary['prop_owners_' . $this->language];
                $this->status = true;
            } else {
                $this->message = $this->msgDictonary['no_record_found_' . $this->language];
                $this->status = false;
            }
        }
        $this->respond();
    }

    public function getcity(){
        $res =[];
        $result = TableRegistry::get('cities')->find('list', [
                        'keyField' => 'code',
                        'valueField' => 'name'
                    ])->where(['status'=>'1'])->toArray();
        if(!empty($result)){
            $f=0;
            foreach($result as $k=>$v){
                $res[$f]['id'] = $k;
                $res[$f]['name'] = $v;
                $f++;
            }
        }
        
        $this->status = true;
        $this->responseData = $res;
        $this->respond();
    }
    
    public function getstreet(){
        if ($this->request->is('post')) {
            $this->paramsValidation(array('city_id' => 'notBlank'));
            $res =[];
            $result = TableRegistry::get('streets')->find('list')
                    ->where(['city_id IN '=>explode(',',$this->request->data['city_id']),'status'=>'1'])->toArray();
            if(!empty($result)){
                $f=0;
                foreach($result as $k=>$v){
                    $res[$f]['id'] = $k;
                    $res[$f]['name'] = $v;
                    $f++;
                }
            }
            if(!empty($res)){
                $this->status = true;
                $this->responseData = $res;
            }
        }        
        $this->respond();
    }

}
