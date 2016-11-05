<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LineasRentasFixture
 *
 */
class LineasRentasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'linea_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'renta_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'renta_id' => ['type' => 'index', 'columns' => ['renta_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['linea_id', 'renta_id'], 'length' => []],
            'lineas_rentas_ibfk_1' => ['type' => 'foreign', 'columns' => ['linea_id'], 'references' => ['lineas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'lineas_rentas_ibfk_2' => ['type' => 'foreign', 'columns' => ['renta_id'], 'references' => ['rentas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'linea_id' => 1,
            'renta_id' => 1
        ],
    ];
}
