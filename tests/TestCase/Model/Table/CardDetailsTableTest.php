<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CardDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CardDetailsTable Test Case
 */
class CardDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CardDetailsTable
     */
    public $CardDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.card_details',
        'app.users',
        'app.roles',
        'app.user_addresses',
        'app.orders',
        'app.customers',
        'app.employee_details',
        'app.carts',
        'app.services',
        'app.order_details',
        'app.laundry_bags',
        'app.other_bags',
        'app.add_ons',
        'app.employees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CardDetails') ? [] : ['className' => 'App\Model\Table\CardDetailsTable'];
        $this->CardDetails = TableRegistry::get('CardDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CardDetails);

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
