<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaundromatCommissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaundromatCommissionsTable Test Case
 */
class LaundromatCommissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LaundromatCommissionsTable
     */
    public $LaundromatCommissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.laundromat_commissions',
        'app.laundromats',
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
        'app.order_commissions',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LaundromatCommissions') ? [] : ['className' => 'App\Model\Table\LaundromatCommissionsTable'];
        $this->LaundromatCommissions = TableRegistry::get('LaundromatCommissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LaundromatCommissions);

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
