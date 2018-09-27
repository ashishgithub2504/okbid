<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RiderDocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RiderDocumentsTable Test Case
 */
class RiderDocumentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RiderDocumentsTable
     */
    public $RiderDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rider_documents',
        'app.riders',
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
        $config = TableRegistry::exists('RiderDocuments') ? [] : ['className' => 'App\Model\Table\RiderDocumentsTable'];
        $this->RiderDocuments = TableRegistry::get('RiderDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RiderDocuments);

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
