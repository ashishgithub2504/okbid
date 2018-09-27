<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EquipmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EquipmentsTable Test Case
 */
class EquipmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EquipmentsTable
     */
    public $Equipments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.equipments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Equipments') ? [] : ['className' => 'App\Model\Table\EquipmentsTable'];
        $this->Equipments = TableRegistry::get('Equipments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Equipments);

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
