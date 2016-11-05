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
        'titulo' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'factura_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'renta_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'consumido' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'excedente' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'monto_bs' => ['type' => 'float', 'length' => 0, 'precision' => 0, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => ''],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'consumo_de' => ['type' => 'index', 'columns' => ['factura_id'], 'length' => []],
            'renta_mensual' => ['type' => 'index', 'columns' => ['renta_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'consumos_ibfk_1' => ['type' => 'foreign', 'columns' => ['factura_id'], 'references' => ['facturas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'consumos_ibfk_2' => ['type' => 'foreign', 'columns' => ['renta_id'], 'references' => ['rentas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'factura_id' => 1,
            'renta_id' => 1,
            'consumido' => 'Lorem ipsum d',
            'excedente' => 'Lorem ip',
            'monto_bs' => 1,
            'created' => '2016-11-05 20:03:29',
            'modified' => '2016-11-05 20:03:29'
        ],
    ];
}
