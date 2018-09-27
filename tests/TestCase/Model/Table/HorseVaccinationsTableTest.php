<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorseVaccinationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorseVaccinationsTable Test Case
 */
class HorseVaccinationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorseVaccinationsTable
     */
    public $HorseVaccinations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_vaccinations',
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
        $config = TableRegistry::exists('HorseVaccinations') ? [] : ['className' => 'App\Model\Table\HorseVaccinationsTable'];
        $this->HorseVaccinations = TableRegistry::get('HorseVaccinations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorseVaccinations);

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
