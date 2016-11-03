<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AsignacionesFixture
 *
 */
class AsignacionesFixture extends TestFixture
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
        'Proceso_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Articulo_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Hasta' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'articulo_asignado' => ['type' => 'index', 'columns' => ['Articulo_id'], 'length' => []],
            'parte_del_proceso' => ['type' => 'index', 'columns' => ['Proceso_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'asignaciones_ibfk_1' => ['type' => 'foreign', 'columns' => ['Articulo_id'], 'references' => ['articulos', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'asignaciones_ibfk_2' => ['type' => 'foreign', 'columns' => ['Proceso_id'], 'references' => ['procesos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'Proceso_id' => 1,
            'Articulo_id' => 1,
            'Hasta' => '2016-11-03',
            'created' => '2016-11-03 19:04:52',
            'modified' => '2016-11-03 19:04:52'
        ],
    ];
}
