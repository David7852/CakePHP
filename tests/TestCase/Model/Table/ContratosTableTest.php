<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContratosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContratosTable Test Case
 */
class ContratosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContratosTable
     */
    public $Contratos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contratos',
        'app.trabajadores',
        'app.usuarios',
        'app.procesos',
        'app.asignaciones',
        'app.articulos',
        'app.modelos',
        'app.accesorios',
        'app.devoluciones',
        'app.lineas',
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
        $config = TableRegistry::exists('Contratos') ? [] : ['className' => 'App\Model\Table\ContratosTable'];
        $this->Contratos = TableRegistry::get('Contratos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contratos);

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
