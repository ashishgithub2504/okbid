<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyViewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyViewsTable Test Case
 */
class PropertyViewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyViewsTable
     */
    public $PropertyViews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_views',
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
        $config = TableRegistry::exists('PropertyViews') ? [] : ['className' => 'App\Model\Table\PropertyViewsTable'];
        $this->PropertyViews = TableRegistry::get('PropertyViews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyViews);

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
