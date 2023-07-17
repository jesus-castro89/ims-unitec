<?php

namespace App\Map;

use App\Pedido;
use App\PedidoQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'pedido' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PedidoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.PedidoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pedido';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Pedido';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Pedido';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.Pedido';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the codigo_pedido field
     */
    public const COL_CODIGO_PEDIDO = 'pedido.codigo_pedido';

    /**
     * the column name for the fecha_pedido field
     */
    public const COL_FECHA_PEDIDO = 'pedido.fecha_pedido';

    /**
     * the column name for the fecha_esperada field
     */
    public const COL_FECHA_ESPERADA = 'pedido.fecha_esperada';

    /**
     * the column name for the fecha_entrega field
     */
    public const COL_FECHA_ENTREGA = 'pedido.fecha_entrega';

    /**
     * the column name for the estado field
     */
    public const COL_ESTADO = 'pedido.estado';

    /**
     * the column name for the comentarios field
     */
    public const COL_COMENTARIOS = 'pedido.comentarios';

    /**
     * the column name for the codigo_cliente field
     */
    public const COL_CODIGO_CLIENTE = 'pedido.codigo_cliente';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['CodigoPedido', 'FechaPedido', 'FechaEsperada', 'FechaEntrega', 'Estado', 'Comentarios', 'CodigoCliente', ],
        self::TYPE_CAMELNAME     => ['codigoPedido', 'fechaPedido', 'fechaEsperada', 'fechaEntrega', 'estado', 'comentarios', 'codigoCliente', ],
        self::TYPE_COLNAME       => [PedidoTableMap::COL_CODIGO_PEDIDO, PedidoTableMap::COL_FECHA_PEDIDO, PedidoTableMap::COL_FECHA_ESPERADA, PedidoTableMap::COL_FECHA_ENTREGA, PedidoTableMap::COL_ESTADO, PedidoTableMap::COL_COMENTARIOS, PedidoTableMap::COL_CODIGO_CLIENTE, ],
        self::TYPE_FIELDNAME     => ['codigo_pedido', 'fecha_pedido', 'fecha_esperada', 'fecha_entrega', 'estado', 'comentarios', 'codigo_cliente', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['CodigoPedido' => 0, 'FechaPedido' => 1, 'FechaEsperada' => 2, 'FechaEntrega' => 3, 'Estado' => 4, 'Comentarios' => 5, 'CodigoCliente' => 6, ],
        self::TYPE_CAMELNAME     => ['codigoPedido' => 0, 'fechaPedido' => 1, 'fechaEsperada' => 2, 'fechaEntrega' => 3, 'estado' => 4, 'comentarios' => 5, 'codigoCliente' => 6, ],
        self::TYPE_COLNAME       => [PedidoTableMap::COL_CODIGO_PEDIDO => 0, PedidoTableMap::COL_FECHA_PEDIDO => 1, PedidoTableMap::COL_FECHA_ESPERADA => 2, PedidoTableMap::COL_FECHA_ENTREGA => 3, PedidoTableMap::COL_ESTADO => 4, PedidoTableMap::COL_COMENTARIOS => 5, PedidoTableMap::COL_CODIGO_CLIENTE => 6, ],
        self::TYPE_FIELDNAME     => ['codigo_pedido' => 0, 'fecha_pedido' => 1, 'fecha_esperada' => 2, 'fecha_entrega' => 3, 'estado' => 4, 'comentarios' => 5, 'codigo_cliente' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CodigoPedido' => 'CODIGO_PEDIDO',
        'Pedido.CodigoPedido' => 'CODIGO_PEDIDO',
        'codigoPedido' => 'CODIGO_PEDIDO',
        'pedido.codigoPedido' => 'CODIGO_PEDIDO',
        'PedidoTableMap::COL_CODIGO_PEDIDO' => 'CODIGO_PEDIDO',
        'COL_CODIGO_PEDIDO' => 'CODIGO_PEDIDO',
        'codigo_pedido' => 'CODIGO_PEDIDO',
        'pedido.codigo_pedido' => 'CODIGO_PEDIDO',
        'FechaPedido' => 'FECHA_PEDIDO',
        'Pedido.FechaPedido' => 'FECHA_PEDIDO',
        'fechaPedido' => 'FECHA_PEDIDO',
        'pedido.fechaPedido' => 'FECHA_PEDIDO',
        'PedidoTableMap::COL_FECHA_PEDIDO' => 'FECHA_PEDIDO',
        'COL_FECHA_PEDIDO' => 'FECHA_PEDIDO',
        'fecha_pedido' => 'FECHA_PEDIDO',
        'pedido.fecha_pedido' => 'FECHA_PEDIDO',
        'FechaEsperada' => 'FECHA_ESPERADA',
        'Pedido.FechaEsperada' => 'FECHA_ESPERADA',
        'fechaEsperada' => 'FECHA_ESPERADA',
        'pedido.fechaEsperada' => 'FECHA_ESPERADA',
        'PedidoTableMap::COL_FECHA_ESPERADA' => 'FECHA_ESPERADA',
        'COL_FECHA_ESPERADA' => 'FECHA_ESPERADA',
        'fecha_esperada' => 'FECHA_ESPERADA',
        'pedido.fecha_esperada' => 'FECHA_ESPERADA',
        'FechaEntrega' => 'FECHA_ENTREGA',
        'Pedido.FechaEntrega' => 'FECHA_ENTREGA',
        'fechaEntrega' => 'FECHA_ENTREGA',
        'pedido.fechaEntrega' => 'FECHA_ENTREGA',
        'PedidoTableMap::COL_FECHA_ENTREGA' => 'FECHA_ENTREGA',
        'COL_FECHA_ENTREGA' => 'FECHA_ENTREGA',
        'fecha_entrega' => 'FECHA_ENTREGA',
        'pedido.fecha_entrega' => 'FECHA_ENTREGA',
        'Estado' => 'ESTADO',
        'Pedido.Estado' => 'ESTADO',
        'estado' => 'ESTADO',
        'pedido.estado' => 'ESTADO',
        'PedidoTableMap::COL_ESTADO' => 'ESTADO',
        'COL_ESTADO' => 'ESTADO',
        'Comentarios' => 'COMENTARIOS',
        'Pedido.Comentarios' => 'COMENTARIOS',
        'comentarios' => 'COMENTARIOS',
        'pedido.comentarios' => 'COMENTARIOS',
        'PedidoTableMap::COL_COMENTARIOS' => 'COMENTARIOS',
        'COL_COMENTARIOS' => 'COMENTARIOS',
        'CodigoCliente' => 'CODIGO_CLIENTE',
        'Pedido.CodigoCliente' => 'CODIGO_CLIENTE',
        'codigoCliente' => 'CODIGO_CLIENTE',
        'pedido.codigoCliente' => 'CODIGO_CLIENTE',
        'PedidoTableMap::COL_CODIGO_CLIENTE' => 'CODIGO_CLIENTE',
        'COL_CODIGO_CLIENTE' => 'CODIGO_CLIENTE',
        'codigo_cliente' => 'CODIGO_CLIENTE',
        'pedido.codigo_cliente' => 'CODIGO_CLIENTE',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('pedido');
        $this->setPhpName('Pedido');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Pedido');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('codigo_pedido', 'CodigoPedido', 'INTEGER', true, null, null);
        $this->addColumn('fecha_pedido', 'FechaPedido', 'DATE', true, null, null);
        $this->addColumn('fecha_esperada', 'FechaEsperada', 'DATE', true, null, null);
        $this->addColumn('fecha_entrega', 'FechaEntrega', 'DATE', false, null, null);
        $this->addColumn('estado', 'Estado', 'VARCHAR', true, 15, null);
        $this->addColumn('comentarios', 'Comentarios', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('codigo_cliente', 'CodigoCliente', 'INTEGER', 'cliente', 'codigo_cliente', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Cliente', '\\App\\Cliente', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codigo_cliente',
    1 => ':codigo_cliente',
  ),
), null, null, null, false);
        $this->addRelation('DetallePedido', '\\App\\DetallePedido', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_pedido',
    1 => ':codigo_pedido',
  ),
), null, null, 'DetallePedidos', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? PedidoTableMap::CLASS_DEFAULT : PedidoTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Pedido object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PedidoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PedidoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PedidoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PedidoTableMap::OM_CLASS;
            /** @var Pedido $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PedidoTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PedidoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PedidoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pedido $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PedidoTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PedidoTableMap::COL_CODIGO_PEDIDO);
            $criteria->addSelectColumn(PedidoTableMap::COL_FECHA_PEDIDO);
            $criteria->addSelectColumn(PedidoTableMap::COL_FECHA_ESPERADA);
            $criteria->addSelectColumn(PedidoTableMap::COL_FECHA_ENTREGA);
            $criteria->addSelectColumn(PedidoTableMap::COL_ESTADO);
            $criteria->addSelectColumn(PedidoTableMap::COL_COMENTARIOS);
            $criteria->addSelectColumn(PedidoTableMap::COL_CODIGO_CLIENTE);
        } else {
            $criteria->addSelectColumn($alias . '.codigo_pedido');
            $criteria->addSelectColumn($alias . '.fecha_pedido');
            $criteria->addSelectColumn($alias . '.fecha_esperada');
            $criteria->addSelectColumn($alias . '.fecha_entrega');
            $criteria->addSelectColumn($alias . '.estado');
            $criteria->addSelectColumn($alias . '.comentarios');
            $criteria->addSelectColumn($alias . '.codigo_cliente');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(PedidoTableMap::COL_CODIGO_PEDIDO);
            $criteria->removeSelectColumn(PedidoTableMap::COL_FECHA_PEDIDO);
            $criteria->removeSelectColumn(PedidoTableMap::COL_FECHA_ESPERADA);
            $criteria->removeSelectColumn(PedidoTableMap::COL_FECHA_ENTREGA);
            $criteria->removeSelectColumn(PedidoTableMap::COL_ESTADO);
            $criteria->removeSelectColumn(PedidoTableMap::COL_COMENTARIOS);
            $criteria->removeSelectColumn(PedidoTableMap::COL_CODIGO_CLIENTE);
        } else {
            $criteria->removeSelectColumn($alias . '.codigo_pedido');
            $criteria->removeSelectColumn($alias . '.fecha_pedido');
            $criteria->removeSelectColumn($alias . '.fecha_esperada');
            $criteria->removeSelectColumn($alias . '.fecha_entrega');
            $criteria->removeSelectColumn($alias . '.estado');
            $criteria->removeSelectColumn($alias . '.comentarios');
            $criteria->removeSelectColumn($alias . '.codigo_cliente');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(PedidoTableMap::DATABASE_NAME)->getTable(PedidoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Pedido or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Pedido object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Pedido) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PedidoTableMap::DATABASE_NAME);
            $criteria->add(PedidoTableMap::COL_CODIGO_PEDIDO, (array) $values, Criteria::IN);
        }

        $query = PedidoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PedidoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PedidoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pedido table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PedidoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pedido or Criteria object.
     *
     * @param mixed $criteria Criteria or Pedido object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pedido object
        }


        // Set the correct dbName
        $query = PedidoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
