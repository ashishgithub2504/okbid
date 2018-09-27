<?php
namespace App\Test\TestCase\Controller;

use App\Controller\OrderCommissionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\OrderCommissionsController Test Case
 */
class OrderCommissionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.order_commissions',
        'app.orders',
        'app.customers',
        'app.roles',
        'app.users',
        'app.user_addresses',
        'app.employee_details',
        'app.carts',
        'app.services',
        'app.order_details',
        'app.laundry_bags',
        'app.other_bags',
        'app.add_ons',
        'app.card_details',
        'app.employees',
        'app.laundromats'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
