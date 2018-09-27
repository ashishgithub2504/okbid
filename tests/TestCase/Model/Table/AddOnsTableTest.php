<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AddOnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AddOnsTable Test Case
 */
class AddOnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AddOnsTable
     */
    public $AddOns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.add_ons',
        'app.carts',
        'app.users',
        'app.roles',
        'app.services',
        'app.order_details',
        'app.laundry_bags',
        'app.other_bags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AddOns') ? [] : ['className' => 'App\Model\Table\AddOnsTable'];
        $this->AddOns = TableRegistry::get('AddOns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AddOns);

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
