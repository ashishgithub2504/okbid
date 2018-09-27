<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderCommissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderCommissionsTable Test Case
 */
class OrderCommissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderCommissionsTable
     */
    public $OrderCommissions;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OrderCommissions') ? [] : ['className' => 'App\Model\Table\OrderCommissionsTable'];
        $this->OrderCommissions = TableRegistry::get('OrderCommissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderCommissions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
