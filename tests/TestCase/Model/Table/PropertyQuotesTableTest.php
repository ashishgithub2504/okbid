<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyQuotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyQuotesTable Test Case
 */
class PropertyQuotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyQuotesTable
     */
    public $PropertyQuotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_quotes',
        'app.properties',
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
        'app.propertytypes',
        'app.projects',
        'app.property_images',
        'app.property_imagesone',
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
        $config = TableRegistry::exists('PropertyQuotes') ? [] : ['className' => 'App\Model\Table\PropertyQuotesTable'];
        $this->PropertyQuotes = TableRegistry::get('PropertyQuotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyQuotes);

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
