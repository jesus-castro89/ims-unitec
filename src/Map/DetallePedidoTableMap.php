<?php

namespace App\Map;

use App\DetallePedido;
use App\DetallePedidoQuery;
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
 * This class defines the structure of the 'detalle_pedido' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DetallePedidoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.DetallePedidoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'detalle_pedido';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DetallePedido';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\DetallePedido';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.DetallePedido';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the codigo_pedido field
     */
    public const COL_CODIGO_PEDIDO = 'detalle_pedido.codigo_pedido';

    /**
     * the column name for the codigo_producto field
     */
    public const COL_CODIGO_PRODUCTO = 'detalle_pedido.codigo_producto';

    /**
     * the column name for the cantidad field
     */
    public const COL_CANTIDAD = 'detalle_pedido.cantidad';

    /**
     * the column name for the precio_unidad field
     */
    public const COL_PRECIO_UNIDAD = 'detalle_pedido.precio_unidad';

    /**
     * the column name for the numero_linea field
     */
    public const COL_NUMERO_LINEA = 'detalle_pedido.numero_linea';

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
        self::TYPE_PHPNAME       => ['CodigoPedido', 'CodigoProducto', 'Cantidad', 'PrecioUnidad', 'NumeroLinea', ],
        self::TYPE_CAMELNAME     => ['codigoPedido', 'codigoProducto', 'cantidad', 'precioUnidad', 'numeroLinea', ],
        self::TYPE_COLNAME       => [DetallePedidoTableMap::COL_CODIGO_PEDIDO, DetallePedidoTableMap::COL_CODIGO_PRODUCTO, DetallePedidoTableMap::COL_CANTIDAD, DetallePedidoTableMap::COL_PRECIO_UNIDAD, DetallePedidoTableMap::COL_NUMERO_LINEA, ],
        self::TYPE_FIELDNAME     => ['codigo_pedido', 'codigo_producto', 'cantidad', 'precio_unidad', 'numero_linea', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['CodigoPedido' => 0, 'CodigoProducto' => 1, 'Cantidad' => 2, 'PrecioUnidad' => 3, 'NumeroLinea' => 4, ],
        self::TYPE_CAMELNAME     => ['codigoPedido' => 0, 'codigoProducto' => 1, 'cantidad' => 2, 'precioUnidad' => 3, 'numeroLinea' => 4, ],
        self::TYPE_COLNAME       => [DetallePedidoTableMap::COL_CODIGO_PEDIDO => 0, DetallePedidoTableMap::COL_CODIGO_PRODUCTO => 1, DetallePedidoTableMap::COL_CANTIDAD => 2, DetallePedidoTableMap::COL_PRECIO_UNIDAD => 3, DetallePedidoTableMap::COL_NUMERO_LINEA => 4, ],
        self::TYPE_FIELDNAME     => ['codigo_pedido' => 0, 'codigo_producto' => 1, 'cantidad' => 2, 'precio_unidad' => 3, 'numero_linea' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CodigoPedido' => 'CODIGO_PEDIDO',
        'DetallePedido.CodigoPedido' => 'CODIGO_PEDIDO',
        'codigoPedido' => 'CODIGO_PEDIDO',
        'detallePedido.codigoPedido' => 'CODIGO_PEDIDO',
        'DetallePedidoTableMap::COL_CODIGO_PEDIDO' => 'CODIGO_PEDIDO',
        'COL_CODIGO_PEDIDO' => 'CODIGO_PEDIDO',
        'codigo_pedido' => 'CODIGO_PEDIDO',
        'detalle_pedido.codigo_pedido' => 'CODIGO_PEDIDO',
        'CodigoProducto' => 'CODIGO_PRODUCTO',
        'DetallePedido.CodigoProducto' => 'CODIGO_PRODUCTO',
        'codigoProducto' => 'CODIGO_PRODUCTO',
        'detallePedido.codigoProducto' => 'CODIGO_PRODUCTO',
        'DetallePedidoTableMap::COL_CODIGO_PRODUCTO' => 'CODIGO_PRODUCTO',
        'COL_CODIGO_PRODUCTO' => 'CODIGO_PRODUCTO',
        'codigo_producto' => 'CODIGO_PRODUCTO',
        'detalle_pedido.codigo_producto' => 'CODIGO_PRODUCTO',
        'Cantidad' => 'CANTIDAD',
        'DetallePedido.Cantidad' => 'CANTIDAD',
        'cantidad' => 'CANTIDAD',
        'detallePedido.cantidad' => 'CANTIDAD',
        'DetallePedidoTableMap::COL_CANTIDAD' => 'CANTIDAD',
        'COL_CANTIDAD' => 'CANTIDAD',
        'detalle_pedido.cantidad' => 'CANTIDAD',
        'PrecioUnidad' => 'PRECIO_UNIDAD',
        'DetallePedido.PrecioUnidad' => 'PRECIO_UNIDAD',
        'precioUnidad' => 'PRECIO_UNIDAD',
        'detallePedido.precioUnidad' => 'PRECIO_UNIDAD',
        'DetallePedidoTableMap::COL_PRECIO_UNIDAD' => 'PRECIO_UNIDAD',
        'COL_PRECIO_UNIDAD' => 'PRECIO_UNIDAD',
        'precio_unidad' => 'PRECIO_UNIDAD',
        'detalle_pedido.precio_unidad' => 'PRECIO_UNIDAD',
        'NumeroLinea' => 'NUMERO_LINEA',
        'DetallePedido.NumeroLinea' => 'NUMERO_LINEA',
        'numeroLinea' => 'NUMERO_LINEA',
        'detallePedido.numeroLinea' => 'NUMERO_LINEA',
        'DetallePedidoTableMap::COL_NUMERO_LINEA' => 'NUMERO_LINEA',
        'COL_NUMERO_LINEA' => 'NUMERO_LINEA',
        'numero_linea' => 'NUMERO_LINEA',
        'detalle_pedido.numero_linea' => 'NUMERO_LINEA',
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
        $this->setName('detalle_pedido');
        $this->setPhpName('DetallePedido');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\DetallePedido');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('codigo_pedido', 'CodigoPedido', 'INTEGER' , 'pedido', 'codigo_pedido', true, null, null);
        $this->addForeignPrimaryKey('codigo_producto', 'CodigoProducto', 'VARCHAR' , 'producto', 'codigo_producto', true, 15, null);
        $this->addColumn('cantidad', 'Cantidad', 'INTEGER', true, null, null);
        $this->addColumn('precio_unidad', 'PrecioUnidad', 'DECIMAL', true, 15, null);
        $this->addColumn('numero_linea', 'NumeroLinea', 'SMALLINT', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Pedido', '\\App\\Pedido', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codigo_pedido',
    1 => ':codigo_pedido',
  ),
), null, null, null, false);
        $this->addRelation('Producto', '\\App\\Producto', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codigo_producto',
    1 => ':codigo_producto',
  ),
), null, null, null, false);
    }

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \App\DetallePedido $obj A \App\DetallePedido object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(DetallePedido $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getCodigoPedido() || is_scalar($obj->getCodigoPedido()) || is_callable([$obj->getCodigoPedido(), '__toString']) ? (string) $obj->getCodigoPedido() : $obj->getCodigoPedido()), (null === $obj->getCodigoProducto() || is_scalar($obj->getCodigoProducto()) || is_callable([$obj->getCodigoProducto(), '__toString']) ? (string) $obj->getCodigoProducto() : $obj->getCodigoProducto())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \App\DetallePedido object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \App\DetallePedido) {
                $key = serialize([(null === $value->getCodigoPedido() || is_scalar($value->getCodigoPedido()) || is_callable([$value->getCodigoPedido(), '__toString']) ? (string) $value->getCodigoPedido() : $value->getCodigoPedido()), (null === $value->getCodigoProducto() || is_scalar($value->getCodigoProducto()) || is_callable([$value->getCodigoProducto(), '__toString']) ? (string) $value->getCodigoProducto() : $value->getCodigoProducto())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \App\DetallePedido object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? DetallePedidoTableMap::CLASS_DEFAULT : DetallePedidoTableMap::OM_CLASS;
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
     * @return array (DetallePedido object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DetallePedidoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DetallePedidoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DetallePedidoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DetallePedidoTableMap::OM_CLASS;
            /** @var DetallePedido $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DetallePedidoTableMap::addInstanceToPool($obj, $key);
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
            $key = DetallePedidoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DetallePedidoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DetallePedido $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DetallePedidoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DetallePedidoTableMap::COL_CODIGO_PEDIDO);
            $criteria->addSelectColumn(DetallePedidoTableMap::COL_CODIGO_PRODUCTO);
            $criteria->addSelectColumn(DetallePedidoTableMap::COL_CANTIDAD);
            $criteria->addSelectColumn(DetallePedidoTableMap::COL_PRECIO_UNIDAD);
            $criteria->addSelectColumn(DetallePedidoTableMap::COL_NUMERO_LINEA);
        } else {
            $criteria->addSelectColumn($alias . '.codigo_pedido');
            $criteria->addSelectColumn($alias . '.codigo_producto');
            $criteria->addSelectColumn($alias . '.cantidad');
            $criteria->addSelectColumn($alias . '.precio_unidad');
            $criteria->addSelectColumn($alias . '.numero_linea');
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
            $criteria->removeSelectColumn(DetallePedidoTableMap::COL_CODIGO_PEDIDO);
            $criteria->removeSelectColumn(DetallePedidoTableMap::COL_CODIGO_PRODUCTO);
            $criteria->removeSelectColumn(DetallePedidoTableMap::COL_CANTIDAD);
            $criteria->removeSelectColumn(DetallePedidoTableMap::COL_PRECIO_UNIDAD);
            $criteria->removeSelectColumn(DetallePedidoTableMap::COL_NUMERO_LINEA);
        } else {
            $criteria->removeSelectColumn($alias . '.codigo_pedido');
            $criteria->removeSelectColumn($alias . '.codigo_producto');
            $criteria->removeSelectColumn($alias . '.cantidad');
            $criteria->removeSelectColumn($alias . '.precio_unidad');
            $criteria->removeSelectColumn($alias . '.numero_linea');
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
        return Propel::getServiceContainer()->getDatabaseMap(DetallePedidoTableMap::DATABASE_NAME)->getTable(DetallePedidoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DetallePedido or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DetallePedido object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DetallePedidoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\DetallePedido) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DetallePedidoTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(DetallePedidoTableMap::COL_CODIGO_PRODUCTO, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = DetallePedidoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DetallePedidoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DetallePedidoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the detalle_pedido table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DetallePedidoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DetallePedido or Criteria object.
     *
     * @param mixed $criteria Criteria or DetallePedido object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DetallePedidoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DetallePedido object
        }


        // Set the correct dbName
        $query = DetallePedidoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
