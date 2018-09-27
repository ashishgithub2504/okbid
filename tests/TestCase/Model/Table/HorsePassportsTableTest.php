<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorsePassportsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorsePassportsTable Test Case
 */
class HorsePassportsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorsePassportsTable
     */
    public $HorsePassports;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_passports',
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
        $config = TableRegistry::exists('HorsePassports') ? [] : ['className' => 'App\Model\Table\HorsePassportsTable'];
        $this->HorsePassports = TableRegistry::get('HorsePassports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorsePassports);

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
