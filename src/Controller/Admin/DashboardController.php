<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class DashboardController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['location','getlocation']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $users = TableRegistry::get('Users');
        $property = TableRegistry::get('Properties');
        
        $emailtemplates = TableRegistry::get('EmailTemplates');
        $this->viewBuilder()->layout('default1');
        $count_users = $users->find()->where(['status' =>1,'role_id'=>'2'])->count();
        $leader_users = $users->find()->where(['status' =>1,'role_id'=>'3'])->count();
        $agent_users = $users->find()->where(['status' =>1,'role_id'=>'4'])->count();
        $manager_users = $users->find()->where(['status' =>1,'role_id'=>'5'])->count();
        $building_users = $users->find()->where(['status' =>1,'role_id'=>'6'])->count();
        
        $count_emailtemplates = $emailtemplates->find()->count();
        if($this->Auth->user('id') != 1){
            $pending = $property->find()->where(['status'=>0,'user_id'=>$this->Auth->user('id')])->count();
            $onsale = $property->find()->where(['status'=>1,'user_id'=>$this->Auth->user('id')])->count();
            $auction = $property->find()->where(['status'=>2,'user_id'=>$this->Auth->user('id')])->count();
            $sold = $property->find()->where(['status'=>3,'user_id'=>$this->Auth->user('id')])->count();
            $inactive = $property->find()->where(['status'=>4,'user_id'=>$this->Auth->user('id')])->count();
            $projects = TableRegistry::get('projects')->find()->where(['user_id' =>$this->Auth->user('id') ])->toArray();
        }else{
            $pending = $property->find()->where(['status'=>0])->count();
            $onsale = $property->find()->where(['status'=>1])->count();
            $auction = $property->find()->where(['status'=>2])->count();
            $inactive = $property->find()->where(['status'=>4])->count();
            $sold = $property->find()->where(['status'=>3])->count();
        }
        
       // $jsIncludes = ['admin/jquery.flot','admin/jquery.flot.pie','admin/flot-data'];
        
        $this->set(compact('pending','onsale','auction','sold','inactive','count_users','leader_users','projects','leader_users','agent_users','manager_users', 'building_users','count_emailtemplates'));
    }
    
    public function location(){
        $this->viewBuilder()->layout(false);
    }
    
    public function getlocation($loc = null,$lat = null){
        $this->autoRender = false;
        
            $this->location = TableRegistry::get('location');
            $location = $this->location->newEntity();
            $location->location = $loc.'/'.$lat;
            $location->ip = '192.168.99.255';
            $location->created = date('Y-m-d h:i:s');
            $this->location->save($location);    
            echo '1';
            die;
        
    }

}
