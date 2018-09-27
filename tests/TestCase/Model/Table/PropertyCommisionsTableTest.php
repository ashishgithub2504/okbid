<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyCommisionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyCommisionsTable Test Case
 */
class PropertyCommisionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyCommisionsTable
     */
    public $PropertyCommisions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_commisions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PropertyCommisions') ? [] : ['className' => 'App\Model\Table\PropertyCommisionsTable'];
        $this->PropertyCommisions = TableRegistry::get('PropertyCommisions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyCommisions);

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
