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
        'app.devoluciones',
        'app.articulos',
        'app.modelos',
        'app.accesorios',
        'app.lineas',
        'app.facturas',
        'app.consumos',
        'app.rentas',
        'app.lineas_rentas',
        'app.trabajadores',
        'app.contratos',
        'app.usuarios',
        'app.procesos_trabajadores'
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
