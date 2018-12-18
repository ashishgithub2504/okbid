<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

/**
 * Custom Helper
 */
class CustomHelper extends Helper {

    public function getIndividualCommission($id, $startDate, $endDate, $payment_status, $role_id) {
        $orderComm = TableRegistry::get('OrderCommissions');
        $query = $orderComm->find()->where(['OrderCommissions.payment_status' => $payment_status]);
        if ($role_id == 2)
            $query->where(['OrderCommissions.employee_id' => $id])->group('OrderCommissions.employee_id');
        if ($role_id == 4)
            $query->where(['OrderCommissions.laundromat_id' => $id])->group('OrderCommissions.laundromat_id');
        $query->find('commission', ['dates' => ['from' => $startDate, 'to' => $endDate]]);
        if ($payment_status)
            $query->select(['paid_commission' => $query->func()->sum('OrderCommissions.amount')]);
        else
            $query->select(['unpaid_commission' => $query->func()->sum('OrderCommissions.amount')]);

        $employee = $query->first();
        return $employee;
    }

    public function getLeaderAssignProperties($user_id = null){
        return $properties = TableRegistry::get('Properties')->find()->where(['assign'=>$user_id , 'status !=' => '4'])->count();
    }
    
    public function getActivePropertyPublish($user_id = null){
        return TableRegistry::get('properties')->find()->where(['user_id'=>$user_id , 'status !='=>'4'])->count();
    }

        public function getPropertyType($id = null){
        $result = TableRegistry::get('propertytypes')->find()->select(['name','namehe'])->where(['id'=>$id , 'status'=>'1'])->first();
        if(!empty($result)){
            return $result['name'];
        }
    }
    
    public function publishedDays($id = null){
        $result = TableRegistry::get('property_updates')->find()->select(['date'])->where(['property_id'=>$id , 'type'=>'status' , 'status' => '1'])->first();
        
        if(!empty($result)){
            $date1=date_create($result['date']);
            $date2=date_create(date('Y-m-d'));
            $diff=date_diff($date1,$date2);
            echo $diff->format("%a days");
        }
    }
    
    public function getSellingTime($id = null){
        $result = TableRegistry::get('property_updates')->find()->select(['date'])->where(['property_id'=>$id , 'type'=>'status' , 'status' => '3'])->first();
        
        if(!empty($result)){
            $date1=date_create($result['date']);
            $date2=date_create(date('Y-m-d'));
            $diff=date_diff($date1,$date2);
            echo $diff->format("%a days");
        }
    }

        public function getCategory($id = null){
        $result = TableRegistry::get('categories')->find()->where(['id' => $id , 'status' => '1'])->first();
        if(!empty($result)){
            return $result['name'];
        }
    }
    
    public function getUntillSold($id = null){
        $result = TableRegistry::get('property_updates')->find()->select(['date'])->where(['property_id' => $id , 'type'=>'status' ,'status IN' => ['1']])->first();
        $resultsold = TableRegistry::get('property_updates')->find()->select(['date'])->where(['property_id' => $id , 'type'=>'status' ,'status IN' => ['3']])->first();
        if(!empty($result)){
            $date1=date_create($result['date']);
            $date2=date_create($resultsold['date']);
            $diff=date_diff($date1,$date2);
            echo $diff->format("%R%a days");
        }else{
            echo '0 days';
        }
        
    }


    public function getsubcatagory($id = null){
        $sub = TableRegistry::get('subcategories')->find()
                    ->select(['id', 'name'])
                    ->where(['id' => $id])
                    ->first();
        if(!empty($sub)){
            return $sub['name'];
        }
    }

    public function getRole($role = null) {
        if ($role == 2) {
            $role = '(buyer/seller) ';
        } else if ($role == 3) {
            $role = '(Leader) ';
        } else if ($role == 4) {
            $role = '(Agent) ';
        } else if ($role == 5) {
            $role = '(Manager) ';
        } else if ($role == 6) {
            $role = '(Building contractor) ';
        } else {
            $role = '(Admin)';
        }
        return $role;
    }
    
    public function getUserName($id = null){
        $username = TableRegistry::get('users')->find()->where(['id'=>$id])->select(['name'])->hydrate(FALSE)->first();
        return !empty($username['name'])?$username['name']:'';
    }
    
    public function getCountry(){
        
        $result = TableRegistry::get('countries')->find('list')->select(['id','name'])->toArray();
        return $result;
    }
    
    public function getCountryName($id = null){
        $userinfo = TableRegistry::get('countries')->find()->select(['name'])->hydrate(false)->where(['id'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    public function getStateName($id = null){
        $userinfo = TableRegistry::get('states')->find()->select(['name'])->hydrate(false)->where(['id'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    public function getCityName($id = null){
        $userinfo = TableRegistry::get('cities')->find()->select(['name'])->hydrate(false)->where(['code'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }
    
    public function getAddress($property = []){
        $name = '';
        $name .= is_numeric($property->country)?$this->getCountryName($property->country):$property->country;                                    
        $name .= !empty($property->country)?',  ':'';
        $name .= is_numeric($property->state)?$this->getStateName($property->state):$property->state;                                    
        $name .= !empty($property->state)?',  ':'';
        $name .= is_numeric($property->city)?$this->getCityName($property->city):$property->city;
        return $name;
    }
    
    public function getPublish($id = null){
        $date = TableRegistry::get('property_updates')->find()->select(['date'])->where(['status'=>'1','property_id' => $id])->first();
        return $this->dateDiff($date['date'], date('Y-m-d'));
    }
    
    function dateDiff($date1, $date2) 
    {
      $date1_ts = strtotime($date1);
      $date2_ts = strtotime($date2);
      $diff = $date2_ts - $date1_ts;
      return abs(round($diff / 86400));
    }
    
    public function getwatchpro($id = null){
        $views = $this->proview($id);
        $all = TableRegistry::get('users')->find()->where(['status' => '1' , 'role_id' => '2'])->count();
        return ($views / $all ) * 100;
    }
    
    public function viewbid($id = null){
        $views = $this->proview($id);
        $bid = $this->probid($id);
        if($bid == '0'){
            $bid = 1;
        }
        if($views == '0'){
            $views = 1;
        }
        return ($views / $bid ) * 100;
    }
    
    public function proview($id = null){
        return $views = TableRegistry::get('property_views')->find()->where(['property_id' => $id])->count();
    }
    
    public function probid($id = null){
        return TableRegistry::get('property_bids')->find()->where(['property_id' => $id])->count();
    }
    
    public function getStreetName($id = null){
        $userinfo = TableRegistry::get('streets')->find()->select(['name'])->hydrate(false)->where(['id'=>$id,'status'=>'1'])->first();
        return isset($userinfo)?$userinfo['name']:'';
    }

}
