<?php
namespace App\Test\TestCase\Controller;

use App\Controller\HorsePerformancesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\HorsePerformancesController Test Case
 */
class HorsePerformancesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horse_performances',
        'app.horses',
        'app.users',
        'app.roles',
        'app.mail_records',
        'app.campaigns',
        'app.childs',
        'app.activities',
        'app.activity_details',
        'app.categories',
        'app.groups',
        'app.guardians',
        'app.childs_guardians',
        'app.messages'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
