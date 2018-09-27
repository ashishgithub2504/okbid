<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CartsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CartsTable Test Case
 */
class CartsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CartsTable
     */
    public $Carts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.carts',
        'app.users',
        'app.roles',
        'app.services',
        'app.laundry_bags',
        'app.other_bags',
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
        $config = TableRegistry::exists('Carts') ? [] : ['className' => 'App\Model\Table\CartsTable'];
        $this->Carts = TableRegistry::get('Carts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Carts);

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