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
            $this->request->data['evaculation_date'] = !empty($this->request->data['evaculation_date']) ? $this->request->data['evaculation_date'] : date('Y-m-d');
            $this->request->data['publish'] = !empty($this->request->data['publish']) ? $this->request->data['publish'] : date('Y-m-d');
            
            $user = $this->Properties->patchEntity($entity, $this->request->data);
            
            if ($this->Properties->save($user)) {
                
                $user['evaculation_date'] = $this->dateformat($user['evaculation_date']);
                $user['publish'] = $this->dateformat($user['publish']);
                $user['price'] = intval($user['price']);
                $user['commission'] = number_format($user['commission'], 2);
                $user['name'] = Configure::read('PROTY' . LAN)[$user['propertytype_id']] . ',' . $user['city'] . ',' . $user['no_of_room'];
                $user['propertytype_id'] = $this->Default->getproptype($user['propertytype_id']);
                $user['category'] = $this->Default->getpropcat($user['category']);
                $user['sub_category'] = $this->Default->getpropsubcat($user['sub_category']);

                $user['air_direction'] = ($user['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$user['air_direction']];
                $user['balcony_type'] = ($user['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$user['balcony_type']];
                $user['parking_type'] = ($user['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$user['parking_type']];
                $user['first_payment'] = ($user['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$user['first_payment']];
                $user['handling'] = ($user['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$user['handling']];

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
                $property['name'] = Configure::read('PROTY' . LAN)[$property['propertytype_id']] . ',' . $property['city'] . ',' . $property['no_of_room'];
                $property['propertytype_id'] = $this->Default->getproptype($property['propertytype_id']);
                $property['category'] = $this->Default->getpropcat($property['category']);
                $property['sub_category'] = $this->Default->getpropsubcat($property['sub_category']);

                $property['air_direction'] = ($property['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$property['air_direction']];
                $property['balcony_type'] = ($property['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$property['balcony_type']];
                $property['parking_type'] = ($property['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$property['parking_type']];
                $property['first_payment'] = ($property['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$property['first_payment']];
                $property['handling'] = ($property['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$property['handling']];

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
                        return $q->select(['id', 'image', 'property_id']);
                    }, 'PropertyOwners' => function($r) {
                        return $r->select(['name', 'cell', 'idno', 'property_id']);
                    }, 'PropertyFavourites' => function($t) {
                        return $t->where(['user_id' => $this->loggedInUserId]);
                    }]]);

            $entity['evaculation_date'] = $this->dateformat($entity['evaculation_date']);
            $entity['publish'] = $this->dateformat($entity['publish']);
            $entity['price'] = intval($entity['price']);
            $entity['commission'] = number_format($entity['commission'], 2);
            $entity['name'] = Configure::read('PROTY' . LAN)[$entity['propertytype_id']] . ',' . $entity['city'] . ',' . $entity['no_of_room'];
            $entity['propertytype_id'] = $this->Default->getproptype($entity['propertytype_id']);
            $entity['category'] = $this->Default->getpropcat($entity['category']);
            $entity['sub_category'] = $this->Default->getpropsubcat($entity['sub_category']);
            
            $entity['air_direction'] = ($entity['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$entity['air_direction']];
            $entity['balcony_type'] = ($entity['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$entity['balcony_type']];
            $entity['parking_type'] = ($entity['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$entity['parking_type']];
            $entity['first_payment'] = ($entity['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$entity['first_payment']];
            $entity['handling'] = ($entity['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$entity['handling']];
            
            $entity['bars'] = ($entity['bars'] == 1) ? 'Yes' : 'No';
            $entity['secure_space'] = ($entity['secure_space'] == 1) ? 'Yes' : 'No';
            $entity['master_badroom'] = ($entity['master_badroom'] == 1) ? 'Yes' : 'No';
            $entity['storage'] = ($entity['storage'] == 1) ? 'Yes' : 'No';
            $entity['disable_access'] = ($entity['disable_access'] == 1) ? 'Yes' : 'No';
            $entity['is_viewed'] = $this->Default->getView($entity['property_id'], $this->loggedInUserId);

            if (!empty($entity['property_favourites'])) {
                $entity['is_favourite'] = '1';
            } else {
                $entity['is_favourite'] = '0';
            }

            foreach ($entity['property_images'] as $key => $val) {
                $entity['property_images'][$key]['image'] = _BASE_ . 'uploads/document/' . $val['image'];
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

            $properties = $this->Properties->find()
                    ->contain(['PropertyBids' => function($q) {
                            return $q->order(['PropertyBids.id desc'])->limit(['1']);
                        }, 'PropertyOwners' => function($r) {
                            return $r->select(['name', 'cell', 'idno', 'property_id']);
                        }, 'PropertyImages' => function($p) {
                            return $p->select(['id', 'image', 'property_id']);
                        }])
                    ->where(['Properties.user_id' => $this->loggedInUserId, 'Properties.status' => $this->request->data['status']])
                    ->group(['Properties.id'])
                    ->toArray();

            if (!empty($properties)) {
                foreach ($properties as $key => $val) {
                    $properties[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id']);
                    $properties[$key]['category'] = $this->Default->getpropcat($val['category']);
                    $properties[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category']);
                    $properties[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                    $properties[$key]['flexible_evaculation_date'] = $this->dateformat($val['flexible_evaculation_date']);
                    $properties[$key]['publish'] = $this->dateformat($val['publish']);
                    $properties[$key]['price'] = intval($val['price']);
                    
                    $properties[$key]['air_direction'] = ($val['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['air_direction']];
                    $properties[$key]['balcony_type'] = ($val['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $properties[$key]['parking_type'] = ($val['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $properties[$key]['first_payment'] = ($val['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $properties[$key]['handling'] = ($val['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['handling']];
            
                    $properties[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';

                    $properties[$key]['commission'] = number_format($val['commission'], 2);
                    $properties[$key]['name'] = $val['propertytype_id'] . ',' . $val['city'] . ',' . $val['no_of_room'];

                    foreach ($properties[$key]['property_images'] as $k => $v) {
                        $properties[$key]['property_images'][$k]['image'] = _BASE_ . 'uploads/document/' . $v['image'];
                    }

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
            $properties = $this->Properties->find()
                    ->contain(['PropertyImages' => function($q) {
                            return $q->select(['image', 'property_id'])->where(['PropertyImages.image !=' => '']);
                        }, 'PropertyOwners' => function($r) {
                            return $r->select(['name', 'cell', 'idno', 'property_id']);
                        }, 'PropertyRejects' => function($pr) {
                            return $pr->where(['PropertyRejects.user_id' => $this->loggedInUserId]);
                        }, 'PropertyFavourites' => function($t) {
                            return $t->where(['PropertyFavourites.user_id' => $this->loggedInUserId]);
                        }])
                    ->hydrate(false)
                    ->where(['status IN ' => ['1', '2']])
                    ->toArray();


            if (!empty($properties)) {

                foreach ($properties as $key => $val) {
                    $properties[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                    $properties[$key]['publish'] = $this->dateformat($val['publish']);
                    $properties[$key]['price'] = intval($val['price']);
                    //$properties[$key]['commission'] = number_format($val['commission'] , 2);
                    
                    $properties[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
                    $properties[$key]['propertytype_id'] = $this->Default->getproptype($properties[$key]['propertytype_id']);
                    $properties[$key]['category'] = $this->Default->getpropcat($properties[$key]['category']);
                    $properties[$key]['sub_category'] = $this->Default->getpropsubcat($properties[$key]['sub_category']);
                    
                    $properties[$key]['air_direction'] = ($val['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['air_direction']];
                    $properties[$key]['balcony_type'] = ($val['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $properties[$key]['parking_type'] = ($val['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $properties[$key]['first_payment'] = ($val['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $properties[$key]['handling'] = ($val['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['handling']];
                    
                    $properties[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                    $properties[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);

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

                    foreach ($val['property_images'] as $k => $v) {
                        $properties[$key]['property_images'][$k]['image'] = _BASE_ . 'uploads/document/' . $v['image'];
                    }
                    $properties[$key]['commission'] = $this->Default->getCommission($val['category']);
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
                    ->contain('Properties')
                    ->hydrate(false)
                    ->toArray();
            //pr($results); die;
            foreach ($results as $key => $val) {

                $response[$key] = $val['property'];
                $response[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
                
                $response[$key]['price'] = intval($val['property']['price']);
                $response[$key]['propertytype_id'] = $this->Default->getproptype($val['property']['propertytype_id']);
                $response[$key]['category'] = $this->Default->getpropcat($val['property']['category']);
                $response[$key]['sub_category'] = $this->Default->getpropsubcat($val['property']['sub_category']);
                    
                //$response[$key]['commission'] = number_format($val['property']['commission'], 2);
                $response[$key]['name'] = Configure::read('PROTY' . LAN)[$val['property']['propertytype_id']] . ',' . $val['property']['city'] . ',' . $val['property']['no_of_room'];
                $response[$key]['favourite_id'] = $val['id'];
                
                $response[$key]['air_direction'] = ($val['property']['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['property']['air_direction']];
                $response[$key]['balcony_type'] = ($val['property']['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['property']['balcony_type']];
                $response[$key]['parking_type'] = ($val['property']['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['property']['parking_type']];
                $response[$key]['first_payment'] = ($val['property']['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['property']['first_payment']];
                $response[$key]['handling'] = ($val['property']['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['property']['handling']];

                $response[$key]['bars'] = ($val['property']['bars'] == 1) ? 'Yes' : 'No';
                $response[$key]['secure_space'] = ($val['property']['secure_space'] == 1) ? 'Yes' : 'No';
                $response[$key]['master_badroom'] = ($val['property']['master_badroom'] == 1) ? 'Yes' : 'No';
                $response[$key]['storage'] = ($val['property']['storage'] == 1) ? 'Yes' : 'No';
                $response[$key]['disable_access'] = ($val['property']['disable_access'] == 1) ? 'Yes' : 'No';
                $response[$key]['is_viewed'] = $this->Default->getView($val['property']['id'], $this->loggedInUserId);
                
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
            if ($already < 1) {
                $object = $this->propertysign->newEntity();
                $object->property_id = $this->request->data['id'];
                $object->user_id = $this->loggedInUserId;
                if ($this->propertysign->save($object)) {
                    $this->message = $this->msgDictonary['property_sign_' . $this->language];
                    $this->responseData = $object;
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['property_sign_' . $this->language];
                    $this->status = false;
                }
            } else {
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
                $results = $this->properties->find()
                        ->contain(['PropertyImages' => function($p) {
                                return $p->select(['image', 'property_id'])->where(['image !=' => '']);
                            }])
                        ->where(['properties.id IN ' => $ids])
                        ->toArray();

                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        
                        $results[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                        $results[$key]['publish'] = $this->dateformat($val['publish']);
                        $results[$key]['price'] = intval($val['price']);
                        $results[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
                        $results[$key]['commission'] = number_format($val['commission'], 2);
                        $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
                        
                        $results[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id']);
                        $results[$key]['category'] = $this->Default->getpropcat($val['category']);
                        $results[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category']);

                        //$response[$key]['commission'] = number_format($val['property']['commission'], 2);
                        
                        $results[$key]['favourite_id'] = $val['id'];

                        $results[$key]['air_direction'] = ($val['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['air_direction']];
                        $results[$key]['balcony_type'] = ($val['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                        $results[$key]['parking_type'] = ($val['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                        $results[$key]['first_payment'] = ($val['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                        $results[$key]['handling'] = ($val['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['handling']];

                        $results[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                        $results[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                        $results[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                        $results[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                        $results[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                        $results[$key]['is_viewed'] = $this->Default->getView($val['id'], $this->loggedInUserId);
                        
                        foreach ($val['property_images'] as $k => $v) {
                            $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
                        }
                        
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
            $this->paramsValidation(array('category' => 'notBlank'));
            $options['order'] = ['id' => 'DESC'];
            $options['limit'] = $this->SettingConfig['admin_paging_limit'];
            $options['finder'] = ['filter' => ['searchKeyword' => $this->request->data]];
            $options['hydrate'] = false;
            $this->paginate = $options;
            $property = $this->paginate($this->Properties)->toArray();
            //pr($property);
            if (!empty($this->request->data['range'])) {

                $conn = ConnectionManager::get('default');

                foreach ($property as $key => $val) {
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
                        $property = $array3;
                    }                    
                }
                
            }


            if (!empty($property)) {

                $this->message = $this->msgDictonary['record_found_' . $this->language];
                $this->responseData = $property;
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

            $results = $this->properties->find()->contain(['PropertyImages' => function($p) {
                            return $p->select(['image', 'property_id'])->where(['image !=' => '']);
                        }])->where(['id IN ' => $ids])->toArray();

            if (!empty($results)) {
                foreach ($results as $key => $val) {
                    foreach ($val['property_images'] as $k => $v) {
                        $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
                    }
                    $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
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
            $myproperty = $this->properties
                            ->find()
                            ->contain(['PropertyImages' => function($q) {
                                    return $q->select(['id', 'image', 'property_id']);
                                }, 'PropertyFavourites' => function($t) {
                                    return $t->where(['user_id' => $this->loggedInUserId]);
                                }])
                            ->where(['user_id' => $this->loggedInUserId])->toArray();


            if (!empty($myproperty)) {
                foreach ($myproperty as $key => $val) {
                    $myproperty[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                    $myproperty[$key]['publish'] = $this->dateformat($val['publish']);
                    $myproperty[$key]['price'] = intval($val['price']);
                    $myproperty[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
                    $myproperty[$key]['commission'] = number_format($val['commission'], 2);
                    $myproperty[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
                    $myproperty[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id']);
                    $myproperty[$key]['category'] = $this->Default->getpropcat($val['category']);
                    $myproperty[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category']);
                    
                    $myproperty[$key]['air_direction'] = ($val['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['air_direction']];
                    $myproperty[$key]['balcony_type'] = ($val['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                    $myproperty[$key]['parking_type'] = ($val['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                    $myproperty[$key]['first_payment'] = ($val['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                    $myproperty[$key]['handling'] = ($val['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['handling']];

                    $myproperty[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                    $myproperty[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';

                    if (!empty($myproperty[$key]['property_favourites'])) {
                        $myproperty[$key]['is_favourite'] = '1';
                    } else {
                        $myproperty[$key]['is_favourite'] = '0';
                    }

                    foreach ($val['property_images'] as $k => $v) {
                        $myproperty[$key]['property_images'][$k]['image'] = _BASE_ . 'uploads/document/' . $v['image'];
                    }
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
                                
            $already = $this->propertybid->find()->where(['user_id' => $this->loggedInUserId, 'property_id' => $this->request->data['id']])->count();
            if ($already < 1) {
                $entity = $this->propertybid->newEntity();
                $entity->property_id = $this->request->data['id'];
                $entity->user_id = $this->loggedInUserId;
                $entity->price = $this->request->data['price'];
                if ($this->propertybid->save($entity)) {
                    $userdata = $this->Default->getuserinfobyprop($this->request->data['id']);
                    
                    $message['title'] = 'Okbid Notification';
                    $message['body'] = 'Congrate you have got new offer';
                    $aps['id'] = $this->request->data['id'];
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
                if ($this->propertybid->updateAll([
                            'price' => $this->request->data['price']
                                ], ['user_id' => $this->loggedInUserId, 'property_id' => $this->request->data['id']])) {
                    $this->message = $this->msgDictonary['property_quote_' . $this->language];
                    $this->status = true;
                } else {
                    $this->message = $this->msgDictonary['property_quote_' . $this->language];
                    $this->status = true;
                }
            }
        }
        $this->respond();
    }

    public function auction() {
        if ($this->request->is('post')) {
            $this->paramsValidation(array('id' => 'notBlank'));
            $result = $this->properties->find()->select(['property_view_count', 'property_signature_count', 'property_bid_count', 'price'])->where(['id' => $this->request->data['id']])->first();
            $result['map'] = $this->propertybid->find()->select(['price', 'created'])->where(['property_id' => $this->request->data['id']])->toArray();

            if (!empty($result)) {
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
            $userdata = $this->Default->getuserinfo($this->request->data['user_id']);
            if ($this->request->data['is_accept'] == '1') {
                if ($this->properties->updateAll(['status' => '3', 'buyer_id' => $this->request->data['user_id']], ['id' => $this->request->data['id']])) {
                    $message['title'] = 'okbid notification';
                    $message['body'] = 'Congrats you have won property';
                    $aps['id'] = $this->request->data['id'];
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
                    $message['body'] = 'your bid has been decline';
                    $aps['id'] = $this->request->data['id'];
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
                $results = $this->properties->find()->contain(['PropertyImages' => function($p) {
                                return $p->select(['image', 'property_id'])->where(['image !=' => '']);
                            }])->where(['id IN ' => $ids, 'status' => '1'])->toArray();

                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        $results[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
                        $results[$key]['price'] = intval($results[$key]['price']);
                        
                        $myproperty[$key]['evaculation_date'] = $this->dateformat($val['evaculation_date']);
                        $myproperty[$key]['publish'] = $this->dateformat($val['publish']);
                        $myproperty[$key]['price'] = intval($val['price']);
                        $myproperty[$key]['commission'] = number_format($val['commission'], 2);
                        $myproperty[$key]['propertytype_id'] = $this->Default->getproptype($val['propertytype_id']);
                        $myproperty[$key]['category'] = $this->Default->getpropcat($val['category']);
                        $myproperty[$key]['sub_category'] = $this->Default->getpropsubcat($val['sub_category']);
                    
                        $results[$key]['air_direction'] = ($val['air_direction'] == 0)?'':Configure::read('AIR' . LAN)[$val['air_direction']];
                        $results[$key]['balcony_type'] = ($val['balcony_type'] == 0)?'':Configure::read('BalconyType' . LAN)[$val['balcony_type']];
                        $results[$key]['parking_type'] = ($val['parking_type'] == 0)?'':Configure::read('PARTYPE' . LAN)[$val['parking_type']];
                        $results[$key]['first_payment'] = ($val['first_payment'] == 0)?'':Configure::read('FIRSTPAY' . LAN)[$val['first_payment']];
                        $results[$key]['handling'] = ($val['handling'] == 0)?'':Configure::read('HANDING' . LAN)[$val['handling']];

                        $results[$key]['bars'] = ($val['bars'] == 1) ? 'Yes' : 'No';
                        $results[$key]['secure_space'] = ($val['secure_space'] == 1) ? 'Yes' : 'No';
                        $results[$key]['master_badroom'] = ($val['master_badroom'] == 1) ? 'Yes' : 'No';
                        $results[$key]['storage'] = ($val['storage'] == 1) ? 'Yes' : 'No';
                        $results[$key]['disable_access'] = ($val['disable_access'] == 1) ? 'Yes' : 'No';
                    
                        foreach ($val['property_images'] as $k => $v) {
                            $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
                        }
                        $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
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
                                return $p->select(['image', 'property_id'])->where(['image !=' => '']);
                            }])->where(['id IN ' => $ids, 'status' => '2'])->toArray();

                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        $results[$key]['is_viewed'] = $this->Default->getView($val['property_id'], $this->loggedInUserId);
                        $results[$key]['price'] = intval($results[$key]['price']);
                        foreach ($val['property_images'] as $k => $v) {
                            $results[$key]['property_images'][$k]['image'] = !empty($v['image']) ? _BASE_ . 'uploads/document/' . $v['image'] : '';
                        }
                        $results[$key]['name'] = Configure::read('PROTY' . LAN)[$val['propertytype_id']] . ',' . $val['city'] . ',' . $val['no_of_room'];
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
        $message['title'] = 'push notification sent to user';
        $message['body'] = 'push notification sent to user';

        $this->Default->pushnotification($message, $devices);
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

}
