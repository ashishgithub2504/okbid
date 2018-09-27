<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyOwnershipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyOwnershipsTable Test Case
 */
class PropertyOwnershipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyOwnershipsTable
     */
    public $PropertyOwnerships;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_ownerships',
        'app.properties',
        'app.propertytypes',
        'app.property_images'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PropertyOwnerships') ? [] : ['className' => 'App\Model\Table\PropertyOwnershipsTable'];
        $this->PropertyOwnerships = TableRegistry::get('PropertyOwnerships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyOwnerships);

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
