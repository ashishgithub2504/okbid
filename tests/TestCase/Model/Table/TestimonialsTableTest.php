<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestimonialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestimonialsTable Test Case
 */
class TestimonialsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TestimonialsTable
     */
    public $Testimonials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.testimonials',
        'app.users',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Testimonials') ? [] : ['className' => 'App\Model\Table\TestimonialsTable'];
        $this->Testimonials = TableRegistry::get('Testimonials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Testimonials);

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
