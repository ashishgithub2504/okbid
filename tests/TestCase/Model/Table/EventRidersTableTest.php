<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventRidersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventRidersTable Test Case
 */
class EventRidersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventRidersTable
     */
    public $EventRiders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.event_riders',
        'app.events',
        'app.riders',
        'app.countries',
        'app.horses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventRiders') ? [] : ['className' => 'App\Model\Table\EventRidersTable'];
        $this->EventRiders = TableRegistry::get('EventRiders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventRiders);

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
