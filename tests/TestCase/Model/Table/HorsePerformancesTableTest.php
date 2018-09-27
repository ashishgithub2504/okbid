<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorsePerformancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorsePerformancesTable Test Case
 */
class HorsePerformancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorsePerformancesTable
     */
    public $HorsePerformances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_performances',
        'app.horses',
        'app.users',
        'app.roles',
        'app.groups',
        'app.childs',
        'app.activities',
        'app.activity_details',
        'app.categories',
        'app.guardians',
        'app.childs_guardians',
        'app.messages',
        'app.mail_records',
        'app.campaigns',
        'app.testimonials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HorsePerformances') ? [] : ['className' => 'App\Model\Table\HorsePerformancesTable'];
        $this->HorsePerformances = TableRegistry::get('HorsePerformances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorsePerformances);

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
