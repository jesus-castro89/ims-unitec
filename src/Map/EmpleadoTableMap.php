<?php

namespace App\Map;

use App\Empleado;
use App\EmpleadoQuery;
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
 * This class defines the structure of the 'empleado' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmpleadoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.EmpleadoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'empleado';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Empleado';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Empleado';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.Empleado';

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
     * the column name for the codigo_empleado field
     */
    public const COL_CODIGO_EMPLEADO = 'empleado.codigo_empleado';

    /**
     * the column name for the nombre field
     */
    public const COL_NOMBRE = 'empleado.nombre';

    /**
     * the column name for the apellido1 field
     */
    public const COL_APELLIDO1 = 'empleado.apellido1';

    /**
     * the column name for the apellido2 field
     */
    public const COL_APELLIDO2 = 'empleado.apellido2';

    /**
     * the column name for the extension field
     */
    public const COL_EXTENSION = 'empleado.extension';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'empleado.email';

    /**
     * the column name for the codigo_oficina field
     */
    public const COL_CODIGO_OFICINA = 'empleado.codigo_oficina';

    /**
     * the column name for the codigo_jefe field
     */
    public const COL_CODIGO_JEFE = 'empleado.codigo_jefe';

    /**
     * the column name for the puesto field
     */
    public const COL_PUESTO = 'empleado.puesto';

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
        self::TYPE_PHPNAME       => ['CodigoEmpleado', 'Nombre', 'Apellido1', 'Apellido2', 'Extension', 'Email', 'CodigoOficina', 'CodigoJefe', 'Puesto', ],
        self::TYPE_CAMELNAME     => ['codigoEmpleado', 'nombre', 'apellido1', 'apellido2', 'extension', 'email', 'codigoOficina', 'codigoJefe', 'puesto', ],
        self::TYPE_COLNAME       => [EmpleadoTableMap::COL_CODIGO_EMPLEADO, EmpleadoTableMap::COL_NOMBRE, EmpleadoTableMap::COL_APELLIDO1, EmpleadoTableMap::COL_APELLIDO2, EmpleadoTableMap::COL_EXTENSION, EmpleadoTableMap::COL_EMAIL, EmpleadoTableMap::COL_CODIGO_OFICINA, EmpleadoTableMap::COL_CODIGO_JEFE, EmpleadoTableMap::COL_PUESTO, ],
        self::TYPE_FIELDNAME     => ['codigo_empleado', 'nombre', 'apellido1', 'apellido2', 'extension', 'email', 'codigo_oficina', 'codigo_jefe', 'puesto', ],
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
        self::TYPE_PHPNAME       => ['CodigoEmpleado' => 0, 'Nombre' => 1, 'Apellido1' => 2, 'Apellido2' => 3, 'Extension' => 4, 'Email' => 5, 'CodigoOficina' => 6, 'CodigoJefe' => 7, 'Puesto' => 8, ],
        self::TYPE_CAMELNAME     => ['codigoEmpleado' => 0, 'nombre' => 1, 'apellido1' => 2, 'apellido2' => 3, 'extension' => 4, 'email' => 5, 'codigoOficina' => 6, 'codigoJefe' => 7, 'puesto' => 8, ],
        self::TYPE_COLNAME       => [EmpleadoTableMap::COL_CODIGO_EMPLEADO => 0, EmpleadoTableMap::COL_NOMBRE => 1, EmpleadoTableMap::COL_APELLIDO1 => 2, EmpleadoTableMap::COL_APELLIDO2 => 3, EmpleadoTableMap::COL_EXTENSION => 4, EmpleadoTableMap::COL_EMAIL => 5, EmpleadoTableMap::COL_CODIGO_OFICINA => 6, EmpleadoTableMap::COL_CODIGO_JEFE => 7, EmpleadoTableMap::COL_PUESTO => 8, ],
        self::TYPE_FIELDNAME     => ['codigo_empleado' => 0, 'nombre' => 1, 'apellido1' => 2, 'apellido2' => 3, 'extension' => 4, 'email' => 5, 'codigo_oficina' => 6, 'codigo_jefe' => 7, 'puesto' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CodigoEmpleado' => 'CODIGO_EMPLEADO',
        'Empleado.CodigoEmpleado' => 'CODIGO_EMPLEADO',
        'codigoEmpleado' => 'CODIGO_EMPLEADO',
        'empleado.codigoEmpleado' => 'CODIGO_EMPLEADO',
        'EmpleadoTableMap::COL_CODIGO_EMPLEADO' => 'CODIGO_EMPLEADO',
        'COL_CODIGO_EMPLEADO' => 'CODIGO_EMPLEADO',
        'codigo_empleado' => 'CODIGO_EMPLEADO',
        'empleado.codigo_empleado' => 'CODIGO_EMPLEADO',
        'Nombre' => 'NOMBRE',
        'Empleado.Nombre' => 'NOMBRE',
        'nombre' => 'NOMBRE',
        'empleado.nombre' => 'NOMBRE',
        'EmpleadoTableMap::COL_NOMBRE' => 'NOMBRE',
        'COL_NOMBRE' => 'NOMBRE',
        'Apellido1' => 'APELLIDO1',
        'Empleado.Apellido1' => 'APELLIDO1',
        'apellido1' => 'APELLIDO1',
        'empleado.apellido1' => 'APELLIDO1',
        'EmpleadoTableMap::COL_APELLIDO1' => 'APELLIDO1',
        'COL_APELLIDO1' => 'APELLIDO1',
        'Apellido2' => 'APELLIDO2',
        'Empleado.Apellido2' => 'APELLIDO2',
        'apellido2' => 'APELLIDO2',
        'empleado.apellido2' => 'APELLIDO2',
        'EmpleadoTableMap::COL_APELLIDO2' => 'APELLIDO2',
        'COL_APELLIDO2' => 'APELLIDO2',
        'Extension' => 'EXTENSION',
        'Empleado.Extension' => 'EXTENSION',
        'extension' => 'EXTENSION',
        'empleado.extension' => 'EXTENSION',
        'EmpleadoTableMap::COL_EXTENSION' => 'EXTENSION',
        'COL_EXTENSION' => 'EXTENSION',
        'Email' => 'EMAIL',
        'Empleado.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'empleado.email' => 'EMAIL',
        'EmpleadoTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'CodigoOficina' => 'CODIGO_OFICINA',
        'Empleado.CodigoOficina' => 'CODIGO_OFICINA',
        'codigoOficina' => 'CODIGO_OFICINA',
        'empleado.codigoOficina' => 'CODIGO_OFICINA',
        'EmpleadoTableMap::COL_CODIGO_OFICINA' => 'CODIGO_OFICINA',
        'COL_CODIGO_OFICINA' => 'CODIGO_OFICINA',
        'codigo_oficina' => 'CODIGO_OFICINA',
        'empleado.codigo_oficina' => 'CODIGO_OFICINA',
        'CodigoJefe' => 'CODIGO_JEFE',
        'Empleado.CodigoJefe' => 'CODIGO_JEFE',
        'codigoJefe' => 'CODIGO_JEFE',
        'empleado.codigoJefe' => 'CODIGO_JEFE',
        'EmpleadoTableMap::COL_CODIGO_JEFE' => 'CODIGO_JEFE',
        'COL_CODIGO_JEFE' => 'CODIGO_JEFE',
        'codigo_jefe' => 'CODIGO_JEFE',
        'empleado.codigo_jefe' => 'CODIGO_JEFE',
        'Puesto' => 'PUESTO',
        'Empleado.Puesto' => 'PUESTO',
        'puesto' => 'PUESTO',
        'empleado.puesto' => 'PUESTO',
        'EmpleadoTableMap::COL_PUESTO' => 'PUESTO',
        'COL_PUESTO' => 'PUESTO',
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
        $this->setName('empleado');
        $this->setPhpName('Empleado');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Empleado');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('codigo_empleado', 'CodigoEmpleado', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 50, null);
        $this->addColumn('apellido1', 'Apellido1', 'VARCHAR', true, 50, null);
        $this->addColumn('apellido2', 'Apellido2', 'VARCHAR', false, 50, null);
        $this->addColumn('extension', 'Extension', 'VARCHAR', true, 10, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 100, null);
        $this->addForeignKey('codigo_oficina', 'CodigoOficina', 'VARCHAR', 'oficina', 'codigo_oficina', true, 10, null);
        $this->addForeignKey('codigo_jefe', 'CodigoJefe', 'INTEGER', 'empleado', 'codigo_empleado', false, null, null);
        $this->addColumn('puesto', 'Puesto', 'VARCHAR', false, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Oficina', '\\App\\Oficina', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codigo_oficina',
    1 => ':codigo_oficina',
  ),
), null, null, null, false);
        $this->addRelation('EmpleadoRelatedByCodigoJefe', '\\App\\Empleado', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codigo_jefe',
    1 => ':codigo_empleado',
  ),
), null, null, null, false);
        $this->addRelation('Cliente', '\\App\\Cliente', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_empleado_rep_ventas',
    1 => ':codigo_empleado',
  ),
), null, null, 'Clientes', false);
        $this->addRelation('EmpleadoRelatedByCodigoEmpleado', '\\App\\Empleado', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_jefe',
    1 => ':codigo_empleado',
  ),
), null, null, 'EmpleadosRelatedByCodigoEmpleado', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmpleadoTableMap::CLASS_DEFAULT : EmpleadoTableMap::OM_CLASS;
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
     * @return array (Empleado object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmpleadoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmpleadoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmpleadoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmpleadoTableMap::OM_CLASS;
            /** @var Empleado $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmpleadoTableMap::addInstanceToPool($obj, $key);
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
            $key = EmpleadoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmpleadoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Empleado $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmpleadoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmpleadoTableMap::COL_CODIGO_EMPLEADO);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_APELLIDO1);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_APELLIDO2);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_EXTENSION);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_EMAIL);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_CODIGO_OFICINA);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_CODIGO_JEFE);
            $criteria->addSelectColumn(EmpleadoTableMap::COL_PUESTO);
        } else {
            $criteria->addSelectColumn($alias . '.codigo_empleado');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.apellido1');
            $criteria->addSelectColumn($alias . '.apellido2');
            $criteria->addSelectColumn($alias . '.extension');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.codigo_oficina');
            $criteria->addSelectColumn($alias . '.codigo_jefe');
            $criteria->addSelectColumn($alias . '.puesto');
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
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_CODIGO_EMPLEADO);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_NOMBRE);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_APELLIDO1);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_APELLIDO2);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_EXTENSION);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_CODIGO_OFICINA);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_CODIGO_JEFE);
            $criteria->removeSelectColumn(EmpleadoTableMap::COL_PUESTO);
        } else {
            $criteria->removeSelectColumn($alias . '.codigo_empleado');
            $criteria->removeSelectColumn($alias . '.nombre');
            $criteria->removeSelectColumn($alias . '.apellido1');
            $criteria->removeSelectColumn($alias . '.apellido2');
            $criteria->removeSelectColumn($alias . '.extension');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.codigo_oficina');
            $criteria->removeSelectColumn($alias . '.codigo_jefe');
            $criteria->removeSelectColumn($alias . '.puesto');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmpleadoTableMap::DATABASE_NAME)->getTable(EmpleadoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Empleado or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Empleado object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Empleado) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmpleadoTableMap::DATABASE_NAME);
            $criteria->add(EmpleadoTableMap::COL_CODIGO_EMPLEADO, (array) $values, Criteria::IN);
        }

        $query = EmpleadoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmpleadoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmpleadoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the empleado table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmpleadoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Empleado or Criteria object.
     *
     * @param mixed $criteria Criteria or Empleado object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Empleado object
        }


        // Set the correct dbName
        $query = EmpleadoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
