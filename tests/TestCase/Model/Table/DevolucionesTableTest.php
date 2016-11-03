<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DevolucionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DevolucionesTable Test Case
 */
class DevolucionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DevolucionesTable
     */
    public $Devoluciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.devoluciones',
        'app.procesos',
        'app.articulos',
        'app.modelos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Devoluciones') ? [] : ['className' => 'App\Model\Table\DevolucionesTable'];
        $this->Devoluciones = TableRegistry::get('Devoluciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Devoluciones);

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
