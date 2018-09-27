<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaundryBagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaundryBagsTable Test Case
 */
class LaundryBagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LaundryBagsTable
     */
    public $LaundryBags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.laundry_bags',
        'app.carts',
        'app.users',
        'app.roles',
        'app.services',
        'app.other_bags',
        'app.add_ons',
        'app.order_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LaundryBags') ? [] : ['className' => 'App\Model\Table\LaundryBagsTable'];
        $this->LaundryBags = TableRegistry::get('LaundryBags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LaundryBags);

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
}
