<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChildsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChildsTable Test Case
 */
class ChildsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChildsTable
     */
    public $Childs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.childs',
        'app.users',
        'app.roles',
        'app.mail_records',
        'app.campaigns',
        'app.guardians'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Childs') ? [] : ['className' => 'App\Model\Table\ChildsTable'];
        $this->Childs = TableRegistry::get('Childs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Childs);

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
