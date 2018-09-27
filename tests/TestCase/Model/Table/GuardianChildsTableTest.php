<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GuardianChildsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GuardianChildsTable Test Case
 */
class GuardianChildsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GuardianChildsTable
     */
    public $GuardianChilds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.guardian_childs',
        'app.children',
        'app.guardians',
        'app.childs',
        'app.users',
        'app.roles',
        'app.mail_records',
        'app.campaigns'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GuardianChilds') ? [] : ['className' => 'App\Model\Table\GuardianChildsTable'];
        $this->GuardianChilds = TableRegistry::get('GuardianChilds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GuardianChilds);

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
