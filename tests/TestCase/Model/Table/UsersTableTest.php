<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.horse_performances',
        'app.horses',
        'app.countries',
        'app.riders',
        'app.states',
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
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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

    /**
     * Test findCommon method
     *
     * @return void
     */
    public function testFindCommon()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAuthAdmin method
     *
     * @return void
     */
    public function testFindAuthAdmin()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAuthCustomer method
     *
     * @return void
     */
    public function testFindAuthCustomer()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAuthUser method
     *
     * @return void
     */
    public function testFindAuthUser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
