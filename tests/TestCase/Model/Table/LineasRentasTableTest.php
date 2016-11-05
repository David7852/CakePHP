<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LineasRentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LineasRentasTable Test Case
 */
class LineasRentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LineasRentasTable
     */
    public $LineasRentas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lineas_rentas',
        'app.lineas',
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
        'app.facturas',
        'app.consumos',
        'app.rentas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LineasRentas') ? [] : ['className' => 'App\Model\Table\LineasRentasTable'];
        $this->LineasRentas = TableRegistry::get('LineasRentas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LineasRentas);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
