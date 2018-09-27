<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorsesTable Test Case
 */
class HorsesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorsesTable
     */
    public $Horses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Horses') ? [] : ['className' => 'App\Model\Table\HorsesTable'];
        $this->Horses = TableRegistry::get('Horses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Horses);

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
}
