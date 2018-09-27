<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseRidingWeightsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseRidingWeightsTable Test Case
 */
class HorseRidingWeightsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseRidingWeightsTable
     */
    public $HorseRidingWeights;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_riding_weights',
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
        $config = TableRegistry::exists('HorseRidingWeights') ? [] : ['className' => 'App\Model\Table\HorseRidingWeightsTable'];
        $this->HorseRidingWeights = TableRegistry::get('HorseRidingWeights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseRidingWeights);

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
