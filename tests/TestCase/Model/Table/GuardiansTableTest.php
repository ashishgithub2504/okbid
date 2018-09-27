<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GuardiansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GuardiansTable Test Case
 */
class GuardiansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GuardiansTable
     */
    public $Guardians;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.guardians',
        'app.children',
        'app.guardian_childs',
        'app.messages',
        'app.users',
        'app.roles',
        'app.mail_records',
        'app.campaigns',
        'app.childs',
        'app.activities',
        'app.activity_details',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Guardians') ? [] : ['className' => 'App\Model\Table\GuardiansTable'];
        $this->Guardians = TableRegistry::get('Guardians', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Guardians);

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
