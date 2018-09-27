<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseWeightsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseWeightsTable Test Case
 */
class HorseWeightsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseWeightsTable
     */
    public $HorseWeights;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_weights',
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
        $config = TableRegistry::exists('HorseWeights') ? [] : ['className' => 'App\Model\Table\HorseWeightsTable'];
        $this->HorseWeights = TableRegistry::get('HorseWeights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseWeights);

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
