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

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Default');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'finder' => 'authUser',
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'loginAction' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'storage' => [
                'className' => 'Session',
                'key' => 'Auth.user',
            ],
        ]);

        $userData = ($this->Auth->user()) ? ($this->Auth->user()) : [];
        $this->set(compact("userData"));

        $this->loadModel('Settings');
        $this->loadModel('Images');
        $this->loadModel('Categories');
        $this->loadModel('News');
        $this->loadModel('Testimonials');

        //$sliders = $this->Images->find()->where(['status' => 1, 'type' => 2])->select(['id', 'title', 'image'])->order(['created DESC'])->toArray();
        $categories = $this->Categories->find()->where(['status' => 1])->select(['id', 'name'])->toArray();
        $recent_news = $this->News->find()->where(['status' => 1])->select(['id', 'title', 'short_desc', 'image', 'created'])->order(['created DESC'])->limit(8)->toArray();
        $testimonials = $this->Testimonials->find()->where(['Testimonials.status' => 1])->contain(['Users' => function($q) {
                        return $q->select(['id', 'name', 'profile_pic']);
                    }])->select(['id', 'user_id', 'user_name', 'title', 'content'])->toArray();
        $SettingConfig = $this->Settings->getAllSettings();
        $this->SettingConfig = $SettingConfig;
        $this->set(compact('SettingConfig', 'sliders', 'categories', 'recent_news', 'testimonials'));
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml','multipart/form-data'])
        ) {
            $this->set('_serialize', true);
        }
    }

}
