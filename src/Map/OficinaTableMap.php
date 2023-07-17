<?php

namespace App\Map;

use App\Oficina;
use App\OficinaQuery;
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
 * This class defines the structure of the 'oficina' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OficinaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.OficinaTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'oficina';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Oficina';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Oficina';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.Oficina';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the codigo_oficina field
     */
    public const COL_CODIGO_OFICINA = 'oficina.codigo_oficina';

    /**
     * the column name for the ciudad field
     */
    public const COL_CIUDAD = 'oficina.ciudad';

    /**
     * the column name for the pais field
     */
    public const COL_PAIS = 'oficina.pais';

    /**
     * the column name for the region field
     */
    public const COL_REGION = 'oficina.region';

    /**
     * the column name for the codigo_postal field
     */
    public const COL_CODIGO_POSTAL = 'oficina.codigo_postal';

    /**
     * the column name for the telefono field
     */
    public const COL_TELEFONO = 'oficina.telefono';

    /**
     * the column name for the linea_direccion1 field
     */
    public const COL_LINEA_DIRECCION1 = 'oficina.linea_direccion1';

    /**
     * the column name for the linea_direccion2 field
     */
    public const COL_LINEA_DIRECCION2 = 'oficina.linea_direccion2';

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
        self::TYPE_PHPNAME       => ['CodigoOficina', 'Ciudad', 'Pais', 'Region', 'CodigoPostal', 'Telefono', 'LineaDireccion1', 'LineaDireccion2', ],
        self::TYPE_CAMELNAME     => ['codigoOficina', 'ciudad', 'pais', 'region', 'codigoPostal', 'telefono', 'lineaDireccion1', 'lineaDireccion2', ],
        self::TYPE_COLNAME       => [OficinaTableMap::COL_CODIGO_OFICINA, OficinaTableMap::COL_CIUDAD, OficinaTableMap::COL_PAIS, OficinaTableMap::COL_REGION, OficinaTableMap::COL_CODIGO_POSTAL, OficinaTableMap::COL_TELEFONO, OficinaTableMap::COL_LINEA_DIRECCION1, OficinaTableMap::COL_LINEA_DIRECCION2, ],
        self::TYPE_FIELDNAME     => ['codigo_oficina', 'ciudad', 'pais', 'region', 'codigo_postal', 'telefono', 'linea_direccion1', 'linea_direccion2', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['CodigoOficina' => 0, 'Ciudad' => 1, 'Pais' => 2, 'Region' => 3, 'CodigoPostal' => 4, 'Telefono' => 5, 'LineaDireccion1' => 6, 'LineaDireccion2' => 7, ],
        self::TYPE_CAMELNAME     => ['codigoOficina' => 0, 'ciudad' => 1, 'pais' => 2, 'region' => 3, 'codigoPostal' => 4, 'telefono' => 5, 'lineaDireccion1' => 6, 'lineaDireccion2' => 7, ],
        self::TYPE_COLNAME       => [OficinaTableMap::COL_CODIGO_OFICINA => 0, OficinaTableMap::COL_CIUDAD => 1, OficinaTableMap::COL_PAIS => 2, OficinaTableMap::COL_REGION => 3, OficinaTableMap::COL_CODIGO_POSTAL => 4, OficinaTableMap::COL_TELEFONO => 5, OficinaTableMap::COL_LINEA_DIRECCION1 => 6, OficinaTableMap::COL_LINEA_DIRECCION2 => 7, ],
        self::TYPE_FIELDNAME     => ['codigo_oficina' => 0, 'ciudad' => 1, 'pais' => 2, 'region' => 3, 'codigo_postal' => 4, 'telefono' => 5, 'linea_direccion1' => 6, 'linea_direccion2' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CodigoOficina' => 'CODIGO_OFICINA',
        'Oficina.CodigoOficina' => 'CODIGO_OFICINA',
        'codigoOficina' => 'CODIGO_OFICINA',
        'oficina.codigoOficina' => 'CODIGO_OFICINA',
        'OficinaTableMap::COL_CODIGO_OFICINA' => 'CODIGO_OFICINA',
        'COL_CODIGO_OFICINA' => 'CODIGO_OFICINA',
        'codigo_oficina' => 'CODIGO_OFICINA',
        'oficina.codigo_oficina' => 'CODIGO_OFICINA',
        'Ciudad' => 'CIUDAD',
        'Oficina.Ciudad' => 'CIUDAD',
        'ciudad' => 'CIUDAD',
        'oficina.ciudad' => 'CIUDAD',
        'OficinaTableMap::COL_CIUDAD' => 'CIUDAD',
        'COL_CIUDAD' => 'CIUDAD',
        'Pais' => 'PAIS',
        'Oficina.Pais' => 'PAIS',
        'pais' => 'PAIS',
        'oficina.pais' => 'PAIS',
        'OficinaTableMap::COL_PAIS' => 'PAIS',
        'COL_PAIS' => 'PAIS',
        'Region' => 'REGION',
        'Oficina.Region' => 'REGION',
        'region' => 'REGION',
        'oficina.region' => 'REGION',
        'OficinaTableMap::COL_REGION' => 'REGION',
        'COL_REGION' => 'REGION',
        'CodigoPostal' => 'CODIGO_POSTAL',
        'Oficina.CodigoPostal' => 'CODIGO_POSTAL',
        'codigoPostal' => 'CODIGO_POSTAL',
        'oficina.codigoPostal' => 'CODIGO_POSTAL',
        'OficinaTableMap::COL_CODIGO_POSTAL' => 'CODIGO_POSTAL',
        'COL_CODIGO_POSTAL' => 'CODIGO_POSTAL',
        'codigo_postal' => 'CODIGO_POSTAL',
        'oficina.codigo_postal' => 'CODIGO_POSTAL',
        'Telefono' => 'TELEFONO',
        'Oficina.Telefono' => 'TELEFONO',
        'telefono' => 'TELEFONO',
        'oficina.telefono' => 'TELEFONO',
        'OficinaTableMap::COL_TELEFONO' => 'TELEFONO',
        'COL_TELEFONO' => 'TELEFONO',
        'LineaDireccion1' => 'LINEA_DIRECCION1',
        'Oficina.LineaDireccion1' => 'LINEA_DIRECCION1',
        'lineaDireccion1' => 'LINEA_DIRECCION1',
        'oficina.lineaDireccion1' => 'LINEA_DIRECCION1',
        'OficinaTableMap::COL_LINEA_DIRECCION1' => 'LINEA_DIRECCION1',
        'COL_LINEA_DIRECCION1' => 'LINEA_DIRECCION1',
        'linea_direccion1' => 'LINEA_DIRECCION1',
        'oficina.linea_direccion1' => 'LINEA_DIRECCION1',
        'LineaDireccion2' => 'LINEA_DIRECCION2',
        'Oficina.LineaDireccion2' => 'LINEA_DIRECCION2',
        'lineaDireccion2' => 'LINEA_DIRECCION2',
        'oficina.lineaDireccion2' => 'LINEA_DIRECCION2',
        'OficinaTableMap::COL_LINEA_DIRECCION2' => 'LINEA_DIRECCION2',
        'COL_LINEA_DIRECCION2' => 'LINEA_DIRECCION2',
        'linea_direccion2' => 'LINEA_DIRECCION2',
        'oficina.linea_direccion2' => 'LINEA_DIRECCION2',
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
        $this->setName('oficina');
        $this->setPhpName('Oficina');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Oficina');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('codigo_oficina', 'CodigoOficina', 'VARCHAR', true, 10, null);
        $this->addColumn('ciudad', 'Ciudad', 'VARCHAR', true, 30, null);
        $this->addColumn('pais', 'Pais', 'VARCHAR', true, 50, null);
        $this->addColumn('region', 'Region', 'VARCHAR', false, 50, null);
        $this->addColumn('codigo_postal', 'CodigoPostal', 'VARCHAR', true, 10, null);
        $this->addColumn('telefono', 'Telefono', 'VARCHAR', true, 20, null);
        $this->addColumn('linea_direccion1', 'LineaDireccion1', 'VARCHAR', true, 50, null);
        $this->addColumn('linea_direccion2', 'LineaDireccion2', 'VARCHAR', false, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Empleado', '\\App\\Empleado', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_oficina',
    1 => ':codigo_oficina',
  ),
), null, null, 'Empleados', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OficinaTableMap::CLASS_DEFAULT : OficinaTableMap::OM_CLASS;
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
     * @return array (Oficina object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OficinaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OficinaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OficinaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OficinaTableMap::OM_CLASS;
            /** @var Oficina $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OficinaTableMap::addInstanceToPool($obj, $key);
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
            $key = OficinaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OficinaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Oficina $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OficinaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OficinaTableMap::COL_CODIGO_OFICINA);
            $criteria->addSelectColumn(OficinaTableMap::COL_CIUDAD);
            $criteria->addSelectColumn(OficinaTableMap::COL_PAIS);
            $criteria->addSelectColumn(OficinaTableMap::COL_REGION);
            $criteria->addSelectColumn(OficinaTableMap::COL_CODIGO_POSTAL);
            $criteria->addSelectColumn(OficinaTableMap::COL_TELEFONO);
            $criteria->addSelectColumn(OficinaTableMap::COL_LINEA_DIRECCION1);
            $criteria->addSelectColumn(OficinaTableMap::COL_LINEA_DIRECCION2);
        } else {
            $criteria->addSelectColumn($alias . '.codigo_oficina');
            $criteria->addSelectColumn($alias . '.ciudad');
            $criteria->addSelectColumn($alias . '.pais');
            $criteria->addSelectColumn($alias . '.region');
            $criteria->addSelectColumn($alias . '.codigo_postal');
            $criteria->addSelectColumn($alias . '.telefono');
            $criteria->addSelectColumn($alias . '.linea_direccion1');
            $criteria->addSelectColumn($alias . '.linea_direccion2');
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
            $criteria->removeSelectColumn(OficinaTableMap::COL_CODIGO_OFICINA);
            $criteria->removeSelectColumn(OficinaTableMap::COL_CIUDAD);
            $criteria->removeSelectColumn(OficinaTableMap::COL_PAIS);
            $criteria->removeSelectColumn(OficinaTableMap::COL_REGION);
            $criteria->removeSelectColumn(OficinaTableMap::COL_CODIGO_POSTAL);
            $criteria->removeSelectColumn(OficinaTableMap::COL_TELEFONO);
            $criteria->removeSelectColumn(OficinaTableMap::COL_LINEA_DIRECCION1);
            $criteria->removeSelectColumn(OficinaTableMap::COL_LINEA_DIRECCION2);
        } else {
            $criteria->removeSelectColumn($alias . '.codigo_oficina');
            $criteria->removeSelectColumn($alias . '.ciudad');
            $criteria->removeSelectColumn($alias . '.pais');
            $criteria->removeSelectColumn($alias . '.region');
            $criteria->removeSelectColumn($alias . '.codigo_postal');
            $criteria->removeSelectColumn($alias . '.telefono');
            $criteria->removeSelectColumn($alias . '.linea_direccion1');
            $criteria->removeSelectColumn($alias . '.linea_direccion2');
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
        return Propel::getServiceContainer()->getDatabaseMap(OficinaTableMap::DATABASE_NAME)->getTable(OficinaTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Oficina or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Oficina object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OficinaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Oficina) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OficinaTableMap::DATABASE_NAME);
            $criteria->add(OficinaTableMap::COL_CODIGO_OFICINA, (array) $values, Criteria::IN);
        }

        $query = OficinaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OficinaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OficinaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the oficina table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OficinaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Oficina or Criteria object.
     *
     * @param mixed $criteria Criteria or Oficina object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OficinaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Oficina object
        }


        // Set the correct dbName
        $query = OficinaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
