<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Testimonials Controller
 *
 * @property \App\Model\Table\TestimonialsTable $Testimonials
 */
class TestimonialsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $options['order'] = ['id' => 'DESC'];
        $options['contain'] = ['Users' => function($q) {
                return $q->select(['id', 'name']);
            }];
        $options['limit'] = $this->SettingConfig['admin_paging_limit'];
        $options['finder'] = ['common' => ['searchKeyword' => $this->request->query]];

        $this->paginate = $options;
        $testimonials = $this->paginate($this->Testimonials);
        $this->set(compact('testimonials'));
        $this->set('_serialize', ['testimonials']);
    }

    /**
     * View method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $testimonial = $this->Testimonials->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('testimonial', $testimonial);
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * Add method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id)
            $testimonial = $this->Testimonials->get($id, [
                'contain' => ['Users']
            ]);
        else
            $testimonial = $this->Testimonials->newEntity();
        if ($this->request->is(['post', 'patch', 'put'])) {
            $this->request->data['status'] = 1;
            $testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->data);
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__($this->Default->get_errors($testimonial->errors())));
        }
        $users = $this->Testimonials->Users->find('list', ['limit' => 200]);
        $this->set(compact('testimonial', 'users'));
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $testimonial = $this->Testimonials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->data);
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
        }
        $users = $this->Testimonials->Users->find('list', ['limit' => 200]);
        $this->set(compact('testimonial', 'users'));
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $testimonial = $this->Testimonials->get($id);
        if ($this->Testimonials->delete($testimonial)) {
            $this->Flash->success(__('The testimonial has been deleted.'));
        } else {
            $this->Flash->error(__('The testimonial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function changeStatus($id = null)
    {
        $this->autoRender = false;
        if ($id) {
            $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : "";
            $testimonial = $this->Testimonials->get($id);
            if ($testimonial) {
                $testimonial->status = $status;
            }
            if ($this->Testimonials->save($testimonial)) {
                if($status)
                    $this->Flash->success(__('The testimonials has been approved'));
                else
                    $this->Flash->success(__('The testimonials has been disapproved'));
            }
            return $this->redirect($this->referer());
        }
    }

}
