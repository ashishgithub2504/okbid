<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TmpPropertiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TmpPropertiesTable Test Case
 */
class TmpPropertiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TmpPropertiesTable
     */
    public $TmpProperties;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tmp_properties',
        'app.users',
        'app.roles',
        'app.groups',
        'app.childs',
        'app.activities',
        'app.activity_details',
        'app.categories',
        'app.news',
        'app.subcategories',
        'app.guardians',
        'app.childs_guardians',
        'app.messages',
        'app.mail_records',
        'app.campaigns',
        'app.testimonials',
        'app.projects',
        'app.buyers',
        'app.propertytypes',
        'app.properties',
        'app.projects',
        'app.property_images',
        'app.property_imagesone',
        'app.property_ownerships',
        'app.property_bids',
        'app.property_bids_one',
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
        $config = TableRegistry::exists('TmpProperties') ? [] : ['className' => 'App\Model\Table\TmpPropertiesTable'];
        $this->TmpProperties = TableRegistry::get('TmpProperties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TmpProperties);

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
