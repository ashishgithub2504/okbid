<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityDetailsTable Test Case
 */
class ActivityDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityDetailsTable
     */
    public $ActivityDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_details',
        'app.activities',
        'app.children',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ActivityDetails') ? [] : ['className' => 'App\Model\Table\ActivityDetailsTable'];
        $this->ActivityDetails = TableRegistry::get('ActivityDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityDetails);

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
