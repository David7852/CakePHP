<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccesoriosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccesoriosTable Test Case
 */
class AccesoriosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AccesoriosTable
     */
    public $Accesorios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.accesorios',
        'app.articulos',
        'app.modelos',
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
        $config = TableRegistry::exists('Accesorios') ? [] : ['className' => 'App\Model\Table\AccesoriosTable'];
        $this->Accesorios = TableRegistry::get('Accesorios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accesorios);

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
