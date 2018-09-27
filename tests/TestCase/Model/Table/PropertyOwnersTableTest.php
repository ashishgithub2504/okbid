<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyOwnersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyOwnersTable Test Case
 */
class PropertyOwnersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyOwnersTable
     */
    public $PropertyOwners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_owners',
        'app.properties',
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
        'app.mail_records',
        'app.campaigns',
        'app.testimonials',
        'app.propertytypes',
        'app.property_images',
        'app.property_ownerships'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PropertyOwners') ? [] : ['className' => 'App\Model\Table\PropertyOwnersTable'];
        $this->PropertyOwners = TableRegistry::get('PropertyOwners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyOwners);

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
