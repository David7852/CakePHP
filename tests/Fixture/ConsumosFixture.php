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
        'servicio_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cupo' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'consumido' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'excedente' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => '0', 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'monto_bs' => ['type' => 'float', 'length' => 0, 'precision' => 0, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => ''],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'consumo_de' => ['type' => 'index', 'columns' => ['factura_id'], 'length' => []],
            'consumo_del_servicio' => ['type' => 'index', 'columns' => ['servicio_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'consumos_ibfk_1' => ['type' => 'foreign', 'columns' => ['factura_id'], 'references' => ['facturas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'consumos_ibfk_2' => ['type' => 'foreign', 'columns' => ['servicio_id'], 'references' => ['servicios', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'servicio_id' => 1,
            'cupo' => 'Lorem ipsum dolor ',
            'consumido' => 'Lorem ipsum dolor ',
            'excedente' => 'Lorem ipsum dolor ',
            'monto_bs' => 1,
            'created' => '2016-11-17 03:46:07',
            'modified' => '2016-11-17 03:46:07'
        ],
    ];
}
