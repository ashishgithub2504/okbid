<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseTravelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseTravelsTable Test Case
 */
class HorseTravelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseTravelsTable
     */
    public $HorseTravels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_travels',
        'app.horses',
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
        $config = TableRegistry::exists('HorseTravels') ? [] : ['className' => 'App\Model\Table\HorseTravelsTable'];
        $this->HorseTravels = TableRegistry::get('HorseTravels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseTravels);

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
