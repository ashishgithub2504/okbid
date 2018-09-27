<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertytypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertytypesTable Test Case
 */
class PropertytypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertytypesTable
     */
    public $Propertytypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.propertytypes',
        'app.categories',
        'app.news',
        'app.subcategories',
        'app.properties',
        'app.users',
        'app.roles',
        'app.groups',
        'app.childs',
        'app.activities',
        'app.activity_details',
        'app.guardians',
        'app.childs_guardians',
        'app.messages',
        'app.mail_records',
        'app.campaigns',
        'app.testimonials',
        'app.projects',
        'app.property_images',
        'app.property_ownerships',
        'app.property_owners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Propertytypes') ? [] : ['className' => 'App\Model\Table\PropertytypesTable'];
        $this->Propertytypes = TableRegistry::get('Propertytypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Propertytypes);

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
