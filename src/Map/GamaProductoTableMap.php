<?php

namespace App\Map;

use App\GamaProducto;
use App\GamaProductoQuery;
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
 * This class defines the structure of the 'gama_producto' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GamaProductoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.GamaProductoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'gama_producto';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GamaProducto';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\GamaProducto';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.GamaProducto';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the gama field
     */
    public const COL_GAMA = 'gama_producto.gama';

    /**
     * the column name for the descripcion_texto field
     */
    public const COL_DESCRIPCION_TEXTO = 'gama_producto.descripcion_texto';

    /**
     * the column name for the descripcion_html field
     */
    public const COL_DESCRIPCION_HTML = 'gama_producto.descripcion_html';

    /**
     * the column name for the imagen field
     */
    public const COL_IMAGEN = 'gama_producto.imagen';

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
        self::TYPE_PHPNAME       => ['Gama', 'DescripcionTexto', 'DescripcionHtml', 'Imagen', ],
        self::TYPE_CAMELNAME     => ['gama', 'descripcionTexto', 'descripcionHtml', 'imagen', ],
        self::TYPE_COLNAME       => [GamaProductoTableMap::COL_GAMA, GamaProductoTableMap::COL_DESCRIPCION_TEXTO, GamaProductoTableMap::COL_DESCRIPCION_HTML, GamaProductoTableMap::COL_IMAGEN, ],
        self::TYPE_FIELDNAME     => ['gama', 'descripcion_texto', 'descripcion_html', 'imagen', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['Gama' => 0, 'DescripcionTexto' => 1, 'DescripcionHtml' => 2, 'Imagen' => 3, ],
        self::TYPE_CAMELNAME     => ['gama' => 0, 'descripcionTexto' => 1, 'descripcionHtml' => 2, 'imagen' => 3, ],
        self::TYPE_COLNAME       => [GamaProductoTableMap::COL_GAMA => 0, GamaProductoTableMap::COL_DESCRIPCION_TEXTO => 1, GamaProductoTableMap::COL_DESCRIPCION_HTML => 2, GamaProductoTableMap::COL_IMAGEN => 3, ],
        self::TYPE_FIELDNAME     => ['gama' => 0, 'descripcion_texto' => 1, 'descripcion_html' => 2, 'imagen' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Gama' => 'GAMA',
        'GamaProducto.Gama' => 'GAMA',
        'gama' => 'GAMA',
        'gamaProducto.gama' => 'GAMA',
        'GamaProductoTableMap::COL_GAMA' => 'GAMA',
        'COL_GAMA' => 'GAMA',
        'gama_producto.gama' => 'GAMA',
        'DescripcionTexto' => 'DESCRIPCION_TEXTO',
        'GamaProducto.DescripcionTexto' => 'DESCRIPCION_TEXTO',
        'descripcionTexto' => 'DESCRIPCION_TEXTO',
        'gamaProducto.descripcionTexto' => 'DESCRIPCION_TEXTO',
        'GamaProductoTableMap::COL_DESCRIPCION_TEXTO' => 'DESCRIPCION_TEXTO',
        'COL_DESCRIPCION_TEXTO' => 'DESCRIPCION_TEXTO',
        'descripcion_texto' => 'DESCRIPCION_TEXTO',
        'gama_producto.descripcion_texto' => 'DESCRIPCION_TEXTO',
        'DescripcionHtml' => 'DESCRIPCION_HTML',
        'GamaProducto.DescripcionHtml' => 'DESCRIPCION_HTML',
        'descripcionHtml' => 'DESCRIPCION_HTML',
        'gamaProducto.descripcionHtml' => 'DESCRIPCION_HTML',
        'GamaProductoTableMap::COL_DESCRIPCION_HTML' => 'DESCRIPCION_HTML',
        'COL_DESCRIPCION_HTML' => 'DESCRIPCION_HTML',
        'descripcion_html' => 'DESCRIPCION_HTML',
        'gama_producto.descripcion_html' => 'DESCRIPCION_HTML',
        'Imagen' => 'IMAGEN',
        'GamaProducto.Imagen' => 'IMAGEN',
        'imagen' => 'IMAGEN',
        'gamaProducto.imagen' => 'IMAGEN',
        'GamaProductoTableMap::COL_IMAGEN' => 'IMAGEN',
        'COL_IMAGEN' => 'IMAGEN',
        'gama_producto.imagen' => 'IMAGEN',
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
        $this->setName('gama_producto');
        $this->setPhpName('GamaProducto');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\GamaProducto');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('gama', 'Gama', 'VARCHAR', true, 50, null);
        $this->addColumn('descripcion_texto', 'DescripcionTexto', 'LONGVARCHAR', false, null, null);
        $this->addColumn('descripcion_html', 'DescripcionHtml', 'LONGVARCHAR', false, null, null);
        $this->addColumn('imagen', 'Imagen', 'VARCHAR', false, 256, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Producto', '\\App\\Producto', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':gama',
    1 => ':gama',
  ),
), null, null, 'Productos', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Gama', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GamaProductoTableMap::CLASS_DEFAULT : GamaProductoTableMap::OM_CLASS;
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
     * @return array (GamaProducto object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GamaProductoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GamaProductoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GamaProductoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GamaProductoTableMap::OM_CLASS;
            /** @var GamaProducto $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GamaProductoTableMap::addInstanceToPool($obj, $key);
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
            $key = GamaProductoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GamaProductoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GamaProducto $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GamaProductoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GamaProductoTableMap::COL_GAMA);
            $criteria->addSelectColumn(GamaProductoTableMap::COL_DESCRIPCION_TEXTO);
            $criteria->addSelectColumn(GamaProductoTableMap::COL_DESCRIPCION_HTML);
            $criteria->addSelectColumn(GamaProductoTableMap::COL_IMAGEN);
        } else {
            $criteria->addSelectColumn($alias . '.gama');
            $criteria->addSelectColumn($alias . '.descripcion_texto');
            $criteria->addSelectColumn($alias . '.descripcion_html');
            $criteria->addSelectColumn($alias . '.imagen');
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
            $criteria->removeSelectColumn(GamaProductoTableMap::COL_GAMA);
            $criteria->removeSelectColumn(GamaProductoTableMap::COL_DESCRIPCION_TEXTO);
            $criteria->removeSelectColumn(GamaProductoTableMap::COL_DESCRIPCION_HTML);
            $criteria->removeSelectColumn(GamaProductoTableMap::COL_IMAGEN);
        } else {
            $criteria->removeSelectColumn($alias . '.gama');
            $criteria->removeSelectColumn($alias . '.descripcion_texto');
            $criteria->removeSelectColumn($alias . '.descripcion_html');
            $criteria->removeSelectColumn($alias . '.imagen');
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
        return Propel::getServiceContainer()->getDatabaseMap(GamaProductoTableMap::DATABASE_NAME)->getTable(GamaProductoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GamaProducto or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GamaProducto object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GamaProductoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\GamaProducto) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GamaProductoTableMap::DATABASE_NAME);
            $criteria->add(GamaProductoTableMap::COL_GAMA, (array) $values, Criteria::IN);
        }

        $query = GamaProductoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GamaProductoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GamaProductoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the gama_producto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GamaProductoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GamaProducto or Criteria object.
     *
     * @param mixed $criteria Criteria or GamaProducto object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GamaProductoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GamaProducto object
        }


        // Set the correct dbName
        $query = GamaProductoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
