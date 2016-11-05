<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RentasTable Test Case
 */
class RentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RentasTable
     */
    public $Rentas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rentas',
        'app.consumos',
        'app.facturas',
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
        $config = TableRegistry::exists('Rentas') ? [] : ['className' => 'App\Model\Table\RentasTable'];
        $this->Rentas = TableRegistry::get('Rentas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rentas);

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
}
