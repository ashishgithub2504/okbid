<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RiderLeavesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RiderLeavesTable Test Case
 */
class RiderLeavesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RiderLeavesTable
     */
    public $RiderLeaves;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rider_leaves',
        'app.riders',
        'app.countries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RiderLeaves') ? [] : ['className' => 'App\Model\Table\RiderLeavesTable'];
        $this->RiderLeaves = TableRegistry::get('RiderLeaves', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RiderLeaves);

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
