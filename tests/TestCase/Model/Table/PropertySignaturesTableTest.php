<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertySignaturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertySignaturesTable Test Case
 */
class PropertySignaturesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertySignaturesTable
     */
    public $PropertySignatures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.property_signatures',
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
        $config = TableRegistry::exists('PropertySignatures') ? [] : ['className' => 'App\Model\Table\PropertySignaturesTable'];
        $this->PropertySignatures = TableRegistry::get('PropertySignatures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertySignatures);

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
