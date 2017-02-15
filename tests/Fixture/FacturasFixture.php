<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FacturasFixture
 *
 */
class FacturasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'titulo' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'linea_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'paguese_antes_de' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'balance' => ['type' => 'float', 'length' => 0, 'precision' => 0, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => ''],
        'iva' => ['type' => 'float', 'length' => 0, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => ''],
        'cargos_extra' => ['type' => 'float', 'length' => 0, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => ''],
        'desde' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'hasta' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'numero_de_cuenta' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'linea_de_factura' => ['type' => 'index', 'columns' => ['linea_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'facturas_ibfk_1' => ['type' => 'foreign', 'columns' => ['linea_id'], 'references' => ['lineas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'titulo' => 'Lorem ipsum dolor sit amet',
            'linea_id' => 1,
            'paguese_antes_de' => '2016-11-05',
            'balance' => 1,
            'desde' => '2016-11-05',
            'hasta' => '2016-11-05',
            'numero_de_cuenta' => 'Lorem ipsum dolor sit a',
            'created' => '2016-11-05 20:03:34',
            'modified' => '2016-11-05 20:03:34'
        ],
    ];
}
