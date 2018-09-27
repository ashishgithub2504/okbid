<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Campaigns Controller
 *
 * @property \App\Model\Table\CampaignsTable $Campaigns
 */
class CampaignsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $options['order'] = ['id' => 'DESC'];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];

        $this->paginate = $options;
        $campaigns = $this->paginate($this->Campaigns);

        $this->set(compact('campaigns'));
        $this->set('_serialize', ['campaigns']);
    }

    /**
     * View method
     *
     * @param string|null $id Campaign id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $campaign = $this->Campaigns->get($id, [
            'contain' => []
        ]);

        $this->set('campaign', $campaign);
        $this->set('_serialize', ['campaign']);
    }

    /**
     * Add method
     *
     * @param string|null $id Campaign id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id)
            $campaign = $this->Campaigns->get($id, [
                'contain' => []
            ]);
        else
            $campaign = $this->Campaigns->newEntity();

        if ($this->request->is(['post', 'patch', 'put'])) {
            $campaign = $this->Campaigns->patchEntity($campaign, $this->request->data);
            if ($this->Campaigns->save($campaign)) {
                $this->Flash->success(__('The campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campaign could not be saved. Please, try again.'));
        }
        $this->set(compact('campaign'));
        $this->set('_serialize', ['campaign']);
    }

    /**
     * sendMail method
     *
     * @return \Cake\Network\Response|null Redirects on successful save, renders view otherwise.
     */
    public function sendMail() {
        $this->loadModel('Users');
        $campaigns = $this->Campaigns->find('list')->where(['status' => 1])->toArray();
        $users = $this->Users->find('list', [
                    'valueField' => function ($row) {
                        return $row['name'] . ' (' . $row['email'] . ')';
                    }
                ])->where(['status' => 1])->toArray();
                
        if ($this->request->is(['patch', 'post', 'put'])) {
           $campaign = $this->Campaigns->get($this->request->data['campaign_id'], [
                'contain' => ['MailRecords']
            ]);
            unset($this->request->data['campaign_id']);

            $campaign = $this->Campaigns->patchEntity($campaign, $this->request->data);
            if ($this->Campaigns->save($campaign)) {
                $this->Flash->success(__('The mail has been sent.'));

                return $this->redirect(['action' => 'sendMail']);
            }
            $this->Flash->error(__($this->Default->get_errors($campaign->errors())));
        }
        $jsIncludes = array('/assets/plugins/select2/select2.full.min.js');
        $cssIncludes = array('/assets/plugins/select2/select2.min.css');
        $campaign = $this->Campaigns->newEntity();
        $this->set(compact('campaigns', 'users', 'campaign','jsIncludes','cssIncludes'));
        $this->set('_serialize', ['campaigns', 'users', 'campaign']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Campaign id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $campaign = $this->Campaigns->get($id);
        if ($this->Campaigns->delete($campaign)) {
            $this->Flash->success(__('The campaign has been deleted.'));
        } else {
            $this->Flash->error(__('The campaign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * setCron method
     *
     * send mails through cron job
     * in mail records having is_send = 0, After sending mail this will change to 1 
     * 
     */
    public function setCron(){
        $this->autoRender = false;
        $this->loadModel('MailRecords');
        $records = $this->MailRecords->find()->contain(['Campaigns' => function($q){ return $q->select(['id','subject','description']); },'Users' => function($q){ return $q->select(['id','email']); } ])->where(['is_send' => 0])->toArray();
        if(count($records) > 0){
            foreach ($records as $res){
                $sentEmail['to'] = $res->user->email;
                $from = $this->SettingConfig['from_email'];
                $subject = $res->campaign->subject;
                $bodyVars = array("content" => $res->campaign->description, 'template' => false);
                $send = $this->Default->_sendMail($sentEmail, $from, $subject, $bodyVars);
                if($send){
                    $mails = $this->MailRecords->get($res->id);
                    $mails->is_send = 1;
                    $mails->sent = date('Y-m-d H:i:s');
                    $this->MailRecords->save($mails);
                }
            }
        }
    }
}
