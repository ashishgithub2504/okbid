<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseTransfersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseTransfersTable Test Case
 */
class HorseTransfersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseTransfersTable
     */
    public $HorseTransfers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_transfers',
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
        $config = TableRegistry::exists('HorseTransfers') ? [] : ['className' => 'App\Model\Table\HorseTransfersTable'];
        $this->HorseTransfers = TableRegistry::get('HorseTransfers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseTransfers);

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
