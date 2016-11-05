<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcesosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcesosTable Test Case
 */
class ProcesosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcesosTable
     */
    public $Procesos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Procesos') ? [] : ['className' => 'App\Model\Table\ProcesosTable'];
        $this->Procesos = TableRegistry::get('Procesos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Procesos);

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
