<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseMedicalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseMedicalsTable Test Case
 */
class HorseMedicalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseMedicalsTable
     */
    public $HorseMedicals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_medicals',
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
        $config = TableRegistry::exists('HorseMedicals') ? [] : ['className' => 'App\Model\Table\HorseMedicalsTable'];
        $this->HorseMedicals = TableRegistry::get('HorseMedicals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseMedicals);

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
