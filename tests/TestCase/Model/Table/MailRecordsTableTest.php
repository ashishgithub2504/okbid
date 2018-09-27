<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MailRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MailRecordsTable Test Case
 */
class MailRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MailRecordsTable
     */
    public $MailRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.mail_records',
        'app.campaigns',
        'app.users',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MailRecords') ? [] : ['className' => 'App\Model\Table\MailRecordsTable'];
        $this->MailRecords = TableRegistry::get('MailRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MailRecords);

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
