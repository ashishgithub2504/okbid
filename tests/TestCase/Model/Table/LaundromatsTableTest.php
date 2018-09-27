<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaundromatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaundromatsTable Test Case
 */
class LaundromatsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LaundromatsTable
     */
    public $Laundromats;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.laundromats'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Laundromats') ? [] : ['className' => 'App\Model\Table\LaundromatsTable'];
        $this->Laundromats = TableRegistry::get('Laundromats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Laundromats);

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
