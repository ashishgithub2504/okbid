<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reports = $this->paginate($this->Reports);

        $this->set(compact('reports'));
        $this->set('_serialize', ['reports']);
    }

    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => []
        ]);

        $this->set('report', $report);
        $this->set('_serialize', ['report']);
    }
    
    public function datareport(){
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->data);
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $this->set(compact('report'));
        $this->set('_serialize', ['report']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->data);
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $this->set(compact('report'));
        $this->set('_serialize', ['report']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function export() {
        $data = array(
            array("Amount payable for the current quarter" => "Mike", "Credits" => "$10,000", "Entitlement" => "Yes", "2%" => "No","sale"=>"Yes","5 Year"=>"Yes","Amount of profit distribution"=>"897"),
            array("Amount payable for the current quarter" => "Mike", "Credits" => "$10,000", "Entitlement" => "Yes", "2%" => "No","sale"=>"Yes","5 Year"=>"Yes","Amount of profit distribution"=>"897"),
            array("Amount payable for the current quarter" => "Mike", "Credits" => "$10,000", "Entitlement" => "Yes", "2%" => "No","sale"=>"Yes","5 Year"=>"Yes","Amount of profit distribution"=>"897"),
            array("Amount payable for the current quarter" => "Mike", "Credits" => "$10,000", "Entitlement" => "Yes", "2%" => "No","sale"=>"Yes","5 Year"=>"Yes","Amount of profit distribution"=>"897"),
            array("Amount payable for the current quarter" => "Mike", "Credits" => "$10,000", "Entitlement" => "Yes", "2%" => "No","sale"=>"Yes","5 Year"=>"Yes","Amount of profit distribution"=>"897"),
            array("Amount payable for the current quarter" => "Mike", "Credits" => "$10,000", "Entitlement" => "Yes", "2%" => "No","sale"=>"Yes","5 Year"=>"Yes","Amount of profit distribution"=>"897")
            
        );

        // file name for download
        $fileName = "profit_sharing_report" . date('Y-m-d') . ".xls";

        // headers for download
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
            // filter data
            //array_walk($row, 'filterData');
            echo implode("\t", array_values($row)) . "\n";
        }

        exit;
    }
    
    public function leaderexport() {
        $data = array(
            array("company" => "Mike", "Master fee including VAT" => "$10,000", "Leaders commission including VAT" => "Yes", "Distributing top profits to a leaders" => "No","Distribution of profits to customers (after reduction 17 + 25)"=>"Yes"),
            array("company" => "Mike", "Master fee including VAT" => "$10,000", "Leaders commission including VAT" => "Yes", "Distributing top profits to a leaders" => "No","Distribution of profits to customers (after reduction 17 + 25)"=>"Yes"),
            array("company" => "Mike", "Master fee including VAT" => "$10,000", "Leaders commission including VAT" => "Yes", "Distributing top profits to a leaders" => "No","Distribution of profits to customers (after reduction 17 + 25)"=>"Yes"),
            array("company" => "Mike", "Master fee including VAT" => "$10,000", "Leaders commission including VAT" => "Yes", "Distributing top profits to a leaders" => "No","Distribution of profits to customers (after reduction 17 + 25)"=>"Yes"),
            array("company" => "Mike", "Master fee including VAT" => "$10,000", "Leaders commission including VAT" => "Yes", "Distributing top profits to a leaders" => "No","Distribution of profits to customers (after reduction 17 + 25)"=>"Yes"),
            array("company" => "Mike", "Master fee including VAT" => "$10,000", "Leaders commission including VAT" => "Yes", "Distributing top profits to a leaders" => "No","Distribution of profits to customers (after reduction 17 + 25)"=>"Yes")
            
        );

        // file name for download
        $fileName = "leader_income_report" . date('Y-m-d') . ".xls";

        // headers for download
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
            // filter data
            //array_walk($row, 'filterData');
            echo implode("\t", array_values($row)) . "\n";
        }

        exit;
    }
    
    public function dataexport() {
        $data = array(
            array("data" => "data", "Distribution of profits to customers" => "$10,000", "Distribution of profits to Leader" => "Yes", "Leader fee" => "No","Type of commission: buy / sell"=>"Yes","Purchase"=>"1000","sale"=>"897","Brokerage fee for average transaction"=>"45,000"),
            array("data" => "data", "Distribution of profits to customers" => "$10,000", "Distribution of profits to Leader" => "Yes", "Leader fee" => "No","Type of commission: buy / sell"=>"Yes","Purchase"=>"1000","sale"=>"897","Brokerage fee for average transaction"=>"45,000"),
            array("data" => "data", "Distribution of profits to customers" => "$10,000", "Distribution of profits to Leader" => "Yes", "Leader fee" => "No","Type of commission: buy / sell"=>"Yes","Purchase"=>"1000","sale"=>"897","Brokerage fee for average transaction"=>"45,000"),
            array("data" => "data", "Distribution of profits to customers" => "$10,000", "Distribution of profits to Leader" => "Yes", "Leader fee" => "No","Type of commission: buy / sell"=>"Yes","Purchase"=>"1000","sale"=>"897","Brokerage fee for average transaction"=>"45,000"),
            array("data" => "data", "Distribution of profits to customers" => "$10,000", "Distribution of profits to Leader" => "Yes", "Leader fee" => "No","Type of commission: buy / sell"=>"Yes","Purchase"=>"1000","sale"=>"897","Brokerage fee for average transaction"=>"45,000"),
            array("data" => "data", "Distribution of profits to customers" => "$10,000", "Distribution of profits to Leader" => "Yes", "Leader fee" => "No","Type of commission: buy / sell"=>"Yes","Purchase"=>"1000","sale"=>"897","Brokerage fee for average transaction"=>"45,000")
            
        );

        // file name for download
        $fileName = "data_report" . date('Y-m-d') . ".xls";

        // headers for download
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
            // filter data
            //array_walk($row, 'filterData');
            echo implode("\t", array_values($row)) . "\n";
        }

        exit;
    }
    
}
