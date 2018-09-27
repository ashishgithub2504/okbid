<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyFavouritesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyFavouritesTable Test Case
 */
class PropertyFavouritesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyFavouritesTable
     */
    public $PropertyFavourites;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_favourites',
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
        $config = TableRegistry::exists('PropertyFavourites') ? [] : ['className' => 'App\Model\Table\PropertyFavouritesTable'];
        $this->PropertyFavourites = TableRegistry::get('PropertyFavourites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyFavourites);

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
