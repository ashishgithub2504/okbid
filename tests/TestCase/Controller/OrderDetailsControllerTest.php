<?php
namespace App\Test\TestCase\Controller;

use App\Controller\OrderDetailsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\OrderDetailsController Test Case
 */
class OrderDetailsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.order_details',
        'app.orders',
        'app.customers',
        'app.roles',
        'app.users',
        'app.user_addresses',
        'app.carts',
        'app.services',
        'app.laundry_bags',
        'app.other_bags',
        'app.add_ons',
        'app.employees'
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
