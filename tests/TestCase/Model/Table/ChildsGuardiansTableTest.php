<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChildsGuardiansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChildsGuardiansTable Test Case
 */
class ChildsGuardiansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChildsGuardiansTable
     */
    public $ChildsGuardians;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.childs_guardians',
        'app.children',
        'app.guardians',
        'app.childs',
        'app.users',
        'app.roles',
        'app.mail_records',
        'app.campaigns',
        'app.activity_details',
        'app.activities',
        'app.categories',
        'app.messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ChildsGuardians') ? [] : ['className' => 'App\Model\Table\ChildsGuardiansTable'];
        $this->ChildsGuardians = TableRegistry::get('ChildsGuardians', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChildsGuardians);

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
