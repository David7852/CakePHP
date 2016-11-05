<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticulosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArticulosTable Test Case
 */
class ArticulosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticulosTable
     */
    public $Articulos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.articulos',
        'app.modelos',
        'app.accesorios',
        'app.asignaciones',
        'app.procesos',
        'app.devoluciones',
        'app.trabajadores',
        'app.contratos',
        'app.usuarios',
        'app.procesos_trabajadores',
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
        $config = TableRegistry::exists('Articulos') ? [] : ['className' => 'App\Model\Table\ArticulosTable'];
        $this->Articulos = TableRegistry::get('Articulos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Articulos);

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
