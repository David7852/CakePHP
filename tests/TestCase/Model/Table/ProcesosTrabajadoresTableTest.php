<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcesosTrabajadoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcesosTrabajadoresTable Test Case
 */
class ProcesosTrabajadoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcesosTrabajadoresTable
     */
    public $ProcesosTrabajadores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.procesos_trabajadores',
        'app.trabajadores',
        'app.contratos',
        'app.usuarios',
        'app.procesos',
        'app.asignaciones',
        'app.articulos',
        'app.modelos',
        'app.accesorios',
        'app.devoluciones',
        'app.lineas',
        'app.facturas',
        'app.consumos',
        'app.rentas',
        'app.lineas_rentas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProcesosTrabajadores') ? [] : ['className' => 'App\Model\Table\ProcesosTrabajadoresTable'];
        $this->ProcesosTrabajadores = TableRegistry::get('ProcesosTrabajadores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProcesosTrabajadores);

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
