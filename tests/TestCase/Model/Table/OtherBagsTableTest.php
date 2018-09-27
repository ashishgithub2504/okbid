<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OtherBagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OtherBagsTable Test Case
 */
class OtherBagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OtherBagsTable
     */
    public $OtherBags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.other_bags',
        'app.carts',
        'app.users',
        'app.roles',
        'app.services',
        'app.order_details',
        'app.laundry_bags',
        'app.add_ons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OtherBags') ? [] : ['className' => 'App\Model\Table\OtherBagsTable'];
        $this->OtherBags = TableRegistry::get('OtherBags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OtherBags);

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
