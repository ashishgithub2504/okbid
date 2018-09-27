<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

/**
 * Properties Controller
 *
 * @property \App\Model\Table\PropertiesTable $Properties
 */
class PropertiesController extends AppController {

    function initialize() {
        $this->PropertyUpdates = TableRegistry::get('PropertyUpdates');
        $this->PropertyFavourites = TableRegistry::get('property_favourites');
        $this->PropertySignatures = TableRegistry::get('property_signatures');
        $this->PropertyProposals = TableRegistry::get('property_proposals');
        $this->PropertyAuctions = TableRegistry::get('property_auctions');
        
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '0'];
        } else {
            $options['conditions'] = ['Properties.status' => '0'];
        }
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users' => function($q) {
                return $q->select(['id', 'name', 'role_id']);
            }];
        //pr($options); die;	
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        
        //pr($properties); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function sale() {
        $this->paginate = [
            'contain' => []
        ];
        $options['conditions'] = [];
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '1'];
        } else {
            $options['conditions'] = ['Properties.status' => '1'];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];

        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();

        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function sold() {
        $this->paginate = [
            'contain' => []
        ];
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id'), 'Properties.status' => '3'];
        } else {
            $options['conditions'] = ['Properties.status' => '3'];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        //pr($options); die;	
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function inactive() {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.user_id' => $this->Auth->user('id')];
        }
        $options['conditions'] = ['Properties.status' => '4'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        //pr($options); die;	
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function userPro($user_id = null) {

        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];

        $options['conditions'] = ['Properties.user_id' => $user_id];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($this->Auth->user('role_id')); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }
    
    public function buyer($user_id = null)
    {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];

        $options['conditions'] = ['Properties.user_id' => $user_id];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        
        $favourites = $this->PropertyFavourites->find()->where(['property_favourites.user_id'=>$user_id])->contain(['Properties'])->toArray();
        $signatures = $this->PropertySignatures->find()->where(['property_signatures.user_id'=>$user_id])->contain(['Properties'])->toArray();
        $proposals = $this->PropertyProposals->find()->where(['property_proposals.user_id'=>$user_id])->contain(['Properties'])->toArray();
        
       
        $this->set(compact('properties', 'favourites','signatures','proposals'));
        $this->set('_serialize', ['properties', 'list']);
    }
    
    public function seller($user_id = null)
    {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];

        $options['conditions'] = ['Properties.user_id' => $user_id];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users'];
        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        
        $favourites = $this->PropertyFavourites->find()->where(['property_favourites.user_id'=>$user_id])->contain(['Properties'])->toArray();
        $signatures = $this->PropertySignatures->find()->where(['property_signatures.user_id'=>$user_id])->contain(['Properties'])->toArray();
        $proposals = $this->PropertyProposals->find()->where(['property_proposals.user_id'=>$user_id])->contain(['Properties'])->toArray();
        
       
        $this->set(compact('properties', 'favourites','signatures','proposals'));
        $this->set('_serialize', ['properties', 'list']);
    }
    
    function filterData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"'))
            $str = '"' . str_replace('"', '""', $str) . '"';
    }

    /**
     * View method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $property = $this->Properties->get($id, [
            'contain' => ['PropertyImages', 'PropertyOwnerships', 'Users', 'PropertyOwners']
        ]);

        $this->set('property', $property);
        $this->set('_serialize', ['property']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $property = $this->Properties->newEntity();

        if ($this->request->is('post')) {

            if (!isset($this->request->data['status'])) {
                $this->request->data['status'] = 0;
            }
            if (empty($this->request->data['property_ownerships']['0']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['0']);
            }
            if (empty($this->request->data['property_ownerships']['1']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['1']);
            }
            if (empty($this->request->data['property_images']['0']['image_file']['name'])) {
                unset($this->request->data['property_images']);
            }

            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['publish'] = date('Y-m-d');
            $property = $this->Properties->patchEntity($property, $this->request->data);

            $this->request->data['user_id'] = $this->Auth->user('id');
            
            if ($this->Properties->save($property)) {
                $this->Flash->success(__('The property has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                
            }
            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }
        $projects = TableRegistry::get('projects')->find('list', ['limit' => 200]);
        $propertytypes = $this->Properties->Propertytypes->find('list', ['limit' => 200]);
        $this->set(compact('property', 'propertytypes','projects'));
        $this->set('_serialize', ['property']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $property = $this->Properties->get($id, [
            'contain' => ['PropertyImages', 'PropertyOwnerships', 'PropertyOwners']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            if (empty($this->request->data['property_ownerships']['0']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['0']);
            }
            if (empty($this->request->data['property_ownerships']['1']['file_file']['name']) && empty($this->request->data['property_ownerships']['1']['image_file']['name'])) {
                unset($this->request->data['property_ownerships']['1']);
            }
            if (empty($this->request->data['property_images']['0']['image_file']['name'])) {
                unset($this->request->data['property_images']);
            }
            
            $this->request->data['user_id'] = $this->Auth->user('id');
            
            $property = $this->Properties->patchEntity($property, $this->request->data);

            if ($this->Properties->save($property)) {
                $entity = $this->PropertyUpdates->newEntity();
                $entity->property_id = $property->id;
                $entity->type = 'handling';
                $entity->date = date('Y-m-d');
                $this->PropertyUpdates->save($entity);
                $this->Flash->success(__('The property has been saved.'));
                return $this->redirect(['action' => 'edit/' . $id]);
            }
            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }
        $projects = TableRegistry::get('projects')->find('list', ['limit' => 200]);
        $propertytypes = $this->Properties->Propertytypes->find('list', ['limit' => 200]);
        $this->set(compact('property', 'projects','propertytypes', 'id'));
        $this->set('_serialize', ['property']);
    }

    public function assign($id = null) {
        if (!empty($this->request->data)) {

            $entity = $this->Properties->get($id);
            $entity->assign = $this->request->data['role'];
            if ($this->Properties->save($entity)) {
                $this->Flash->success(__('Property assign to leader'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Property not assign to leader'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $roles = TableRegistry::get('Users')->find('list')->where(['role_id' => 3])->toArray();
        $this->set(compact('roles'));
    }

    public function assignpro() {
        $this->paginate = [
            'contain' => []
        ];

        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        if (in_array($this->Auth->user('role_id'), array('2', '3', '4', '6'))) {
            $options['conditions'] = ['Properties.assign' => $this->Auth->user('id')];
        }

        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];
        $options['contain'] = ['Users' => function($q) {
                return $q->select(['id', 'name', 'role_id']);
            }];

        $this->paginate = $options;
        $properties = $this->paginate($this->Properties);
        $list = TableRegistry::get('roles')->find('list')->toArray();
        //pr($properties); die;
        $this->set(compact('properties', 'list'));
        $this->set('_serialize', ['properties', 'list']);
    }

    public function deletedocument($id = null, $redirect = null) {

        $this->PropertyOwnerships = TableRegistry::get('property_ownerships');
        if ($this->PropertyOwnerships->deleteAll(array('PropertyOwnerships.id' => $id))) {
            $this->Flash->success(__('Property document deleted successfully'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        } else {
            $this->Flash->error(__('Property document not deleted'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        }
    }

    public function deleteimage($id = null, $redirect = null) {

        $this->PropertyImages = TableRegistry::get('property_images');
        if ($this->PropertyImages->deleteAll(array('PropertyImages.id' => $id))) {
            $this->Flash->success(__('Property image deleted successfully'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        } else {
            $this->Flash->error(__('Property image not deleted'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        }
    }

    public function delowner($id = null, $redirect = null) {
        $this->PropertyOwners = TableRegistry::get('property_owners');
        if ($this->PropertyOwners->deleteAll(array('PropertyOwners.id' => $id))) {
            $this->Flash->success(__('Property Owners deleted successfully'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        } else {
            $this->Flash->error(__('Property image not deleted'));
            $this->redirect(['controller' => 'properties', 'action' => 'edit', $redirect]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Property id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $property = $this->Properties->get($id);
        if ($this->Properties->delete($property)) {
            $this->Flash->success(__('The property has been deleted.'));
        } else {
            $this->Flash->error(__('The property could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function graph() {
        
    }
    
    public function project($id = null)
    {
        $query = TableRegistry::get('properties')->find()->where(['project_id'=>$id]);
        $project = TableRegistry::get('projects')->find()->select(['name'])->where(['id'=>$id])->first();
        $properties  = $this->paginate($query);
        $this->set(compact('properties','project'));
    }
    
    public function status($id = null) {
        $property = $this->Properties->get($id);
        $this->set(compact('property'));
        if (!empty($this->request->data)) {
            if ($this->Properties->updateAll(['status' => $this->request->data['status']], ['id' => $id])) {
                $entity = $this->PropertyUpdates->newEntity();
                $entity->property_id = $id;
                $entity->type = 'status';
                $entity->status = $this->request->data['status'];
                $entity->date = date('Y-m-d');
                $this->PropertyUpdates->save($entity);
                $this->Flash->success(__('Property status change successfully'));
                $this->redirect(['controller'=>'properties','action'=>'status',$id]);
            }
        }
    }

}
