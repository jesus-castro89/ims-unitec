<?php

namespace App\Map;

use App\Producto;
use App\ProductoQuery;
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
 * This class defines the structure of the 'producto' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProductoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.ProductoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'producto';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Producto';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Producto';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.Producto';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the codigo_producto field
     */
    public const COL_CODIGO_PRODUCTO = 'producto.codigo_producto';

    /**
     * the column name for the nombre field
     */
    public const COL_NOMBRE = 'producto.nombre';

    /**
     * the column name for the gama field
     */
    public const COL_GAMA = 'producto.gama';

    /**
     * the column name for the dimensiones field
     */
    public const COL_DIMENSIONES = 'producto.dimensiones';

    /**
     * the column name for the proveedor field
     */
    public const COL_PROVEEDOR = 'producto.proveedor';

    /**
     * the column name for the descripcion field
     */
    public const COL_DESCRIPCION = 'producto.descripcion';

    /**
     * the column name for the cantidad_en_stock field
     */
    public const COL_CANTIDAD_EN_STOCK = 'producto.cantidad_en_stock';

    /**
     * the column name for the precio_venta field
     */
    public const COL_PRECIO_VENTA = 'producto.precio_venta';

    /**
     * the column name for the precio_proveedor field
     */
    public const COL_PRECIO_PROVEEDOR = 'producto.precio_proveedor';

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
        self::TYPE_PHPNAME       => ['CodigoProducto', 'Nombre', 'Gama', 'Dimensiones', 'Proveedor', 'Descripcion', 'CantidadEnStock', 'PrecioVenta', 'PrecioProveedor', ],
        self::TYPE_CAMELNAME     => ['codigoProducto', 'nombre', 'gama', 'dimensiones', 'proveedor', 'descripcion', 'cantidadEnStock', 'precioVenta', 'precioProveedor', ],
        self::TYPE_COLNAME       => [ProductoTableMap::COL_CODIGO_PRODUCTO, ProductoTableMap::COL_NOMBRE, ProductoTableMap::COL_GAMA, ProductoTableMap::COL_DIMENSIONES, ProductoTableMap::COL_PROVEEDOR, ProductoTableMap::COL_DESCRIPCION, ProductoTableMap::COL_CANTIDAD_EN_STOCK, ProductoTableMap::COL_PRECIO_VENTA, ProductoTableMap::COL_PRECIO_PROVEEDOR, ],
        self::TYPE_FIELDNAME     => ['codigo_producto', 'nombre', 'gama', 'dimensiones', 'proveedor', 'descripcion', 'cantidad_en_stock', 'precio_venta', 'precio_proveedor', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['CodigoProducto' => 0, 'Nombre' => 1, 'Gama' => 2, 'Dimensiones' => 3, 'Proveedor' => 4, 'Descripcion' => 5, 'CantidadEnStock' => 6, 'PrecioVenta' => 7, 'PrecioProveedor' => 8, ],
        self::TYPE_CAMELNAME     => ['codigoProducto' => 0, 'nombre' => 1, 'gama' => 2, 'dimensiones' => 3, 'proveedor' => 4, 'descripcion' => 5, 'cantidadEnStock' => 6, 'precioVenta' => 7, 'precioProveedor' => 8, ],
        self::TYPE_COLNAME       => [ProductoTableMap::COL_CODIGO_PRODUCTO => 0, ProductoTableMap::COL_NOMBRE => 1, ProductoTableMap::COL_GAMA => 2, ProductoTableMap::COL_DIMENSIONES => 3, ProductoTableMap::COL_PROVEEDOR => 4, ProductoTableMap::COL_DESCRIPCION => 5, ProductoTableMap::COL_CANTIDAD_EN_STOCK => 6, ProductoTableMap::COL_PRECIO_VENTA => 7, ProductoTableMap::COL_PRECIO_PROVEEDOR => 8, ],
        self::TYPE_FIELDNAME     => ['codigo_producto' => 0, 'nombre' => 1, 'gama' => 2, 'dimensiones' => 3, 'proveedor' => 4, 'descripcion' => 5, 'cantidad_en_stock' => 6, 'precio_venta' => 7, 'precio_proveedor' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CodigoProducto' => 'CODIGO_PRODUCTO',
        'Producto.CodigoProducto' => 'CODIGO_PRODUCTO',
        'codigoProducto' => 'CODIGO_PRODUCTO',
        'producto.codigoProducto' => 'CODIGO_PRODUCTO',
        'ProductoTableMap::COL_CODIGO_PRODUCTO' => 'CODIGO_PRODUCTO',
        'COL_CODIGO_PRODUCTO' => 'CODIGO_PRODUCTO',
        'codigo_producto' => 'CODIGO_PRODUCTO',
        'producto.codigo_producto' => 'CODIGO_PRODUCTO',
        'Nombre' => 'NOMBRE',
        'Producto.Nombre' => 'NOMBRE',
        'nombre' => 'NOMBRE',
        'producto.nombre' => 'NOMBRE',
        'ProductoTableMap::COL_NOMBRE' => 'NOMBRE',
        'COL_NOMBRE' => 'NOMBRE',
        'Gama' => 'GAMA',
        'Producto.Gama' => 'GAMA',
        'gama' => 'GAMA',
        'producto.gama' => 'GAMA',
        'ProductoTableMap::COL_GAMA' => 'GAMA',
        'COL_GAMA' => 'GAMA',
        'Dimensiones' => 'DIMENSIONES',
        'Producto.Dimensiones' => 'DIMENSIONES',
        'dimensiones' => 'DIMENSIONES',
        'producto.dimensiones' => 'DIMENSIONES',
        'ProductoTableMap::COL_DIMENSIONES' => 'DIMENSIONES',
        'COL_DIMENSIONES' => 'DIMENSIONES',
        'Proveedor' => 'PROVEEDOR',
        'Producto.Proveedor' => 'PROVEEDOR',
        'proveedor' => 'PROVEEDOR',
        'producto.proveedor' => 'PROVEEDOR',
        'ProductoTableMap::COL_PROVEEDOR' => 'PROVEEDOR',
        'COL_PROVEEDOR' => 'PROVEEDOR',
        'Descripcion' => 'DESCRIPCION',
        'Producto.Descripcion' => 'DESCRIPCION',
        'descripcion' => 'DESCRIPCION',
        'producto.descripcion' => 'DESCRIPCION',
        'ProductoTableMap::COL_DESCRIPCION' => 'DESCRIPCION',
        'COL_DESCRIPCION' => 'DESCRIPCION',
        'CantidadEnStock' => 'CANTIDAD_EN_STOCK',
        'Producto.CantidadEnStock' => 'CANTIDAD_EN_STOCK',
        'cantidadEnStock' => 'CANTIDAD_EN_STOCK',
        'producto.cantidadEnStock' => 'CANTIDAD_EN_STOCK',
        'ProductoTableMap::COL_CANTIDAD_EN_STOCK' => 'CANTIDAD_EN_STOCK',
        'COL_CANTIDAD_EN_STOCK' => 'CANTIDAD_EN_STOCK',
        'cantidad_en_stock' => 'CANTIDAD_EN_STOCK',
        'producto.cantidad_en_stock' => 'CANTIDAD_EN_STOCK',
        'PrecioVenta' => 'PRECIO_VENTA',
        'Producto.PrecioVenta' => 'PRECIO_VENTA',
        'precioVenta' => 'PRECIO_VENTA',
        'producto.precioVenta' => 'PRECIO_VENTA',
        'ProductoTableMap::COL_PRECIO_VENTA' => 'PRECIO_VENTA',
        'COL_PRECIO_VENTA' => 'PRECIO_VENTA',
        'precio_venta' => 'PRECIO_VENTA',
        'producto.precio_venta' => 'PRECIO_VENTA',
        'PrecioProveedor' => 'PRECIO_PROVEEDOR',
        'Producto.PrecioProveedor' => 'PRECIO_PROVEEDOR',
        'precioProveedor' => 'PRECIO_PROVEEDOR',
        'producto.precioProveedor' => 'PRECIO_PROVEEDOR',
        'ProductoTableMap::COL_PRECIO_PROVEEDOR' => 'PRECIO_PROVEEDOR',
        'COL_PRECIO_PROVEEDOR' => 'PRECIO_PROVEEDOR',
        'precio_proveedor' => 'PRECIO_PROVEEDOR',
        'producto.precio_proveedor' => 'PRECIO_PROVEEDOR',
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
        $this->setName('producto');
        $this->setPhpName('Producto');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Producto');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('codigo_producto', 'CodigoProducto', 'VARCHAR', true, 15, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 70, null);
        $this->addForeignKey('gama', 'Gama', 'VARCHAR', 'gama_producto', 'gama', true, 50, null);
        $this->addColumn('dimensiones', 'Dimensiones', 'VARCHAR', false, 25, null);
        $this->addColumn('proveedor', 'Proveedor', 'VARCHAR', false, 50, null);
        $this->addColumn('descripcion', 'Descripcion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('cantidad_en_stock', 'CantidadEnStock', 'SMALLINT', true, null, null);
        $this->addColumn('precio_venta', 'PrecioVenta', 'DECIMAL', true, 15, null);
        $this->addColumn('precio_proveedor', 'PrecioProveedor', 'DECIMAL', false, 15, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GamaProducto', '\\App\\GamaProducto', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':gama',
    1 => ':gama',
  ),
), null, null, null, false);
        $this->addRelation('DetallePedido', '\\App\\DetallePedido', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_producto',
    1 => ':codigo_producto',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('CodigoProducto', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductoTableMap::CLASS_DEFAULT : ProductoTableMap::OM_CLASS;
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
     * @return array (Producto object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProductoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductoTableMap::OM_CLASS;
            /** @var Producto $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductoTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Producto $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductoTableMap::COL_CODIGO_PRODUCTO);
            $criteria->addSelectColumn(ProductoTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(ProductoTableMap::COL_GAMA);
            $criteria->addSelectColumn(ProductoTableMap::COL_DIMENSIONES);
            $criteria->addSelectColumn(ProductoTableMap::COL_PROVEEDOR);
            $criteria->addSelectColumn(ProductoTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(ProductoTableMap::COL_CANTIDAD_EN_STOCK);
            $criteria->addSelectColumn(ProductoTableMap::COL_PRECIO_VENTA);
            $criteria->addSelectColumn(ProductoTableMap::COL_PRECIO_PROVEEDOR);
        } else {
            $criteria->addSelectColumn($alias . '.codigo_producto');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.gama');
            $criteria->addSelectColumn($alias . '.dimensiones');
            $criteria->addSelectColumn($alias . '.proveedor');
            $criteria->addSelectColumn($alias . '.descripcion');
            $criteria->addSelectColumn($alias . '.cantidad_en_stock');
            $criteria->addSelectColumn($alias . '.precio_venta');
            $criteria->addSelectColumn($alias . '.precio_proveedor');
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
            $criteria->removeSelectColumn(ProductoTableMap::COL_CODIGO_PRODUCTO);
            $criteria->removeSelectColumn(ProductoTableMap::COL_NOMBRE);
            $criteria->removeSelectColumn(ProductoTableMap::COL_GAMA);
            $criteria->removeSelectColumn(ProductoTableMap::COL_DIMENSIONES);
            $criteria->removeSelectColumn(ProductoTableMap::COL_PROVEEDOR);
            $criteria->removeSelectColumn(ProductoTableMap::COL_DESCRIPCION);
            $criteria->removeSelectColumn(ProductoTableMap::COL_CANTIDAD_EN_STOCK);
            $criteria->removeSelectColumn(ProductoTableMap::COL_PRECIO_VENTA);
            $criteria->removeSelectColumn(ProductoTableMap::COL_PRECIO_PROVEEDOR);
        } else {
            $criteria->removeSelectColumn($alias . '.codigo_producto');
            $criteria->removeSelectColumn($alias . '.nombre');
            $criteria->removeSelectColumn($alias . '.gama');
            $criteria->removeSelectColumn($alias . '.dimensiones');
            $criteria->removeSelectColumn($alias . '.proveedor');
            $criteria->removeSelectColumn($alias . '.descripcion');
            $criteria->removeSelectColumn($alias . '.cantidad_en_stock');
            $criteria->removeSelectColumn($alias . '.precio_venta');
            $criteria->removeSelectColumn($alias . '.precio_proveedor');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductoTableMap::DATABASE_NAME)->getTable(ProductoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Producto or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Producto object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Producto) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductoTableMap::DATABASE_NAME);
            $criteria->add(ProductoTableMap::COL_CODIGO_PRODUCTO, (array) $values, Criteria::IN);
        }

        $query = ProductoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the producto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProductoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Producto or Criteria object.
     *
     * @param mixed $criteria Criteria or Producto object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Producto object
        }


        // Set the correct dbName
        $query = ProductoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
