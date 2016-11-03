<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConsumosFixture
 *
 */
class ConsumosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Titulo' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Factura_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Renta_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Consumido' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Excedente' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Monto_Bs' => ['type' => 'float', 'length' => 0, 'precision' => 0, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => ''],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'consumo_de' => ['type' => 'index', 'columns' => ['Factura_id'], 'length' => []],
            'renta_mensual' => ['type' => 'index', 'columns' => ['Renta_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'consumos_ibfk_1' => ['type' => 'foreign', 'columns' => ['Factura_id'], 'references' => ['facturas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'consumos_ibfk_2' => ['type' => 'foreign', 'columns' => ['Renta_id'], 'references' => ['rentas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'Titulo' => 'Lorem ipsum dolor sit amet',
            'Factura_id' => 1,
            'Renta_id' => 1,
            'Consumido' => 'Lorem ipsum d',
            'Excedente' => 'Lorem ip',
            'Monto_Bs' => 1,
            'created' => '2016-11-03 19:05:39',
            'modified' => '2016-11-03 19:05:39'
        ],
    ];
}
