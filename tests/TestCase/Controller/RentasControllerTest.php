<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RentasController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RentasController Test Case
 */
class RentasControllerTest extends IntegrationTestCase
{

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
