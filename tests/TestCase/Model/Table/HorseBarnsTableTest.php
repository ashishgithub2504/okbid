<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseBarnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseBarnsTable Test Case
 */
class HorseBarnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseBarnsTable
     */
    public $HorseBarns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_barns',
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
        $config = TableRegistry::exists('HorseBarns') ? [] : ['className' => 'App\Model\Table\HorseBarnsTable'];
        $this->HorseBarns = TableRegistry::get('HorseBarns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseBarns);

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
