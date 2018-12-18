<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public $SettingConfig = null;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Default');
        
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'finder' => 'authAdmin',
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index',
                'prefix' => 'admin'
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => 'admin'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => 'admin'
            ],
            'storage' => [
                'className' => 'Session',
                'key' => 'Auth.admin',
            ],
        ]);
        
        $this->Auth->allow(['forgot', 'reset']);
        $userData = ($this->Auth->user()) ? ($this->Auth->user()) : [];
        $this->set(compact("userData"));
        $property = TableRegistry::get('Properties');
        
//        $pendingproty = $property->find('list', [
//            'keyField' => 'id',
//            'valueField' => ['country','state','city','no_of_room','propertytype_id']
//          ])->where(['status'=>0])->toArray();
        
        $pendingproty = $property->find('all')
                        ->select(['id','city','propertytype_id','no_of_room'])
                        ->hydrate(false)
                        ->where(['status'=>0,'is_read'=>'0','is_complete'=>'1'])
                        ->count();
        
        
        $assignproty = $property->find('list', [
            'keyField' => 'id',
            'valueField' => ['city','no_of_room']
        ])->where(['assign != '=>'0','is_complete'=>'1'])->count();
        
        $msgnotification = TableRegistry::get('Conversations')->find()
                ->contain(['Users' => function($q){
                    return $q->select(['name','profile_pic']);
                }])->where(['is_read' => '0'])
        ->hydrate(false)        
        ->toArray();
        
        $messages['0']['message'] = $pendingproty.' New property';
        $messages['0']['controller'] = 'properties';
        $messages['0']['action'] = 'index';
        $messages['1']['message'] = $assignproty.' Assign properties';
        $messages['1']['controller'] = 'properties';
        $messages['1']['action'] = 'index';
        
        
        $this->loadModel('Settings');
        $SettingConfig = $this->Settings->getAllSettings();
        $this->SettingConfig = $SettingConfig;
        $this->set(compact("SettingConfig","pendingproty","assignproty","messages","msgnotification"));
        
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

}
