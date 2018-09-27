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
        return $properties = TableRegistry::get('Properties')->find()->where(['user_id'=>$user_id])->count();
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

}
