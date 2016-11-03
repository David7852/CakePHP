<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsumosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsumosTable Test Case
 */
class ConsumosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsumosTable
     */
    public $Consumos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.consumos',
        'app.facturas',
        'app.lineas',
        'app.articulos',
        'app.modelos',
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
        $config = TableRegistry::exists('Consumos') ? [] : ['className' => 'App\Model\Table\ConsumosTable'];
        $this->Consumos = TableRegistry::get('Consumos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Consumos);

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
