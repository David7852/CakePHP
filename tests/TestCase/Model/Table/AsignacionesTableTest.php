<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsignacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsignacionesTable Test Case
 */
class AsignacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsignacionesTable
     */
    public $Asignaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asignaciones',
        'app.procesos',
        'app.articulos',
        'app.modelos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Asignaciones') ? [] : ['className' => 'App\Model\Table\AsignacionesTable'];
        $this->Asignaciones = TableRegistry::get('Asignaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Asignaciones);

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
