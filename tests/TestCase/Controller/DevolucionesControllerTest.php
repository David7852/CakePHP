<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DevolucionesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\DevolucionesController Test Case
 */
class DevolucionesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.devoluciones',
        'app.procesos',
        'app.asignaciones',
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
