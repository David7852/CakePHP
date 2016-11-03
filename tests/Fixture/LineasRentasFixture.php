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
        'Linea_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Renta_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'Renta_id' => ['type' => 'index', 'columns' => ['Renta_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Linea_id', 'Renta_id'], 'length' => []],
            'lineas_rentas_ibfk_1' => ['type' => 'foreign', 'columns' => ['Linea_id'], 'references' => ['lineas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'lineas_rentas_ibfk_2' => ['type' => 'foreign', 'columns' => ['Renta_id'], 'references' => ['rentas', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'Linea_id' => 1,
            'Renta_id' => 1
        ],
    ];
}
