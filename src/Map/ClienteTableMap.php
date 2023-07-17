<?php

namespace App\Map;

use App\Cliente;
use App\ClienteQuery;
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
 * This class defines the structure of the 'cliente' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ClienteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'App.Map.ClienteTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'cliente';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Cliente';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\App\\Cliente';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'App.Cliente';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the codigo_cliente field
     */
    public const COL_CODIGO_CLIENTE = 'cliente.codigo_cliente';

    /**
     * the column name for the nombre_cliente field
     */
    public const COL_NOMBRE_CLIENTE = 'cliente.nombre_cliente';

    /**
     * the column name for the nombre_contacto field
     */
    public const COL_NOMBRE_CONTACTO = 'cliente.nombre_contacto';

    /**
     * the column name for the apellido_contacto field
     */
    public const COL_APELLIDO_CONTACTO = 'cliente.apellido_contacto';

    /**
     * the column name for the telefono field
     */
    public const COL_TELEFONO = 'cliente.telefono';

    /**
     * the column name for the fax field
     */
    public const COL_FAX = 'cliente.fax';

    /**
     * the column name for the linea_direccion1 field
     */
    public const COL_LINEA_DIRECCION1 = 'cliente.linea_direccion1';

    /**
     * the column name for the linea_direccion2 field
     */
    public const COL_LINEA_DIRECCION2 = 'cliente.linea_direccion2';

    /**
     * the column name for the ciudad field
     */
    public const COL_CIUDAD = 'cliente.ciudad';

    /**
     * the column name for the region field
     */
    public const COL_REGION = 'cliente.region';

    /**
     * the column name for the pais field
     */
    public const COL_PAIS = 'cliente.pais';

    /**
     * the column name for the codigo_postal field
     */
    public const COL_CODIGO_POSTAL = 'cliente.codigo_postal';

    /**
     * the column name for the codigo_empleado_rep_ventas field
     */
    public const COL_CODIGO_EMPLEADO_REP_VENTAS = 'cliente.codigo_empleado_rep_ventas';

    /**
     * the column name for the limite_credito field
     */
    public const COL_LIMITE_CREDITO = 'cliente.limite_credito';

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
        self::TYPE_PHPNAME       => ['CodigoCliente', 'NombreCliente', 'NombreContacto', 'ApellidoContacto', 'Telefono', 'Fax', 'LineaDireccion1', 'LineaDireccion2', 'Ciudad', 'Region', 'Pais', 'CodigoPostal', 'CodigoEmpleadoRepVentas', 'LimiteCredito', ],
        self::TYPE_CAMELNAME     => ['codigoCliente', 'nombreCliente', 'nombreContacto', 'apellidoContacto', 'telefono', 'fax', 'lineaDireccion1', 'lineaDireccion2', 'ciudad', 'region', 'pais', 'codigoPostal', 'codigoEmpleadoRepVentas', 'limiteCredito', ],
        self::TYPE_COLNAME       => [ClienteTableMap::COL_CODIGO_CLIENTE, ClienteTableMap::COL_NOMBRE_CLIENTE, ClienteTableMap::COL_NOMBRE_CONTACTO, ClienteTableMap::COL_APELLIDO_CONTACTO, ClienteTableMap::COL_TELEFONO, ClienteTableMap::COL_FAX, ClienteTableMap::COL_LINEA_DIRECCION1, ClienteTableMap::COL_LINEA_DIRECCION2, ClienteTableMap::COL_CIUDAD, ClienteTableMap::COL_REGION, ClienteTableMap::COL_PAIS, ClienteTableMap::COL_CODIGO_POSTAL, ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, ClienteTableMap::COL_LIMITE_CREDITO, ],
        self::TYPE_FIELDNAME     => ['codigo_cliente', 'nombre_cliente', 'nombre_contacto', 'apellido_contacto', 'telefono', 'fax', 'linea_direccion1', 'linea_direccion2', 'ciudad', 'region', 'pais', 'codigo_postal', 'codigo_empleado_rep_ventas', 'limite_credito', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['CodigoCliente' => 0, 'NombreCliente' => 1, 'NombreContacto' => 2, 'ApellidoContacto' => 3, 'Telefono' => 4, 'Fax' => 5, 'LineaDireccion1' => 6, 'LineaDireccion2' => 7, 'Ciudad' => 8, 'Region' => 9, 'Pais' => 10, 'CodigoPostal' => 11, 'CodigoEmpleadoRepVentas' => 12, 'LimiteCredito' => 13, ],
        self::TYPE_CAMELNAME     => ['codigoCliente' => 0, 'nombreCliente' => 1, 'nombreContacto' => 2, 'apellidoContacto' => 3, 'telefono' => 4, 'fax' => 5, 'lineaDireccion1' => 6, 'lineaDireccion2' => 7, 'ciudad' => 8, 'region' => 9, 'pais' => 10, 'codigoPostal' => 11, 'codigoEmpleadoRepVentas' => 12, 'limiteCredito' => 13, ],
        self::TYPE_COLNAME       => [ClienteTableMap::COL_CODIGO_CLIENTE => 0, ClienteTableMap::COL_NOMBRE_CLIENTE => 1, ClienteTableMap::COL_NOMBRE_CONTACTO => 2, ClienteTableMap::COL_APELLIDO_CONTACTO => 3, ClienteTableMap::COL_TELEFONO => 4, ClienteTableMap::COL_FAX => 5, ClienteTableMap::COL_LINEA_DIRECCION1 => 6, ClienteTableMap::COL_LINEA_DIRECCION2 => 7, ClienteTableMap::COL_CIUDAD => 8, ClienteTableMap::COL_REGION => 9, ClienteTableMap::COL_PAIS => 10, ClienteTableMap::COL_CODIGO_POSTAL => 11, ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS => 12, ClienteTableMap::COL_LIMITE_CREDITO => 13, ],
        self::TYPE_FIELDNAME     => ['codigo_cliente' => 0, 'nombre_cliente' => 1, 'nombre_contacto' => 2, 'apellido_contacto' => 3, 'telefono' => 4, 'fax' => 5, 'linea_direccion1' => 6, 'linea_direccion2' => 7, 'ciudad' => 8, 'region' => 9, 'pais' => 10, 'codigo_postal' => 11, 'codigo_empleado_rep_ventas' => 12, 'limite_credito' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CodigoCliente' => 'CODIGO_CLIENTE',
        'Cliente.CodigoCliente' => 'CODIGO_CLIENTE',
        'codigoCliente' => 'CODIGO_CLIENTE',
        'cliente.codigoCliente' => 'CODIGO_CLIENTE',
        'ClienteTableMap::COL_CODIGO_CLIENTE' => 'CODIGO_CLIENTE',
        'COL_CODIGO_CLIENTE' => 'CODIGO_CLIENTE',
        'codigo_cliente' => 'CODIGO_CLIENTE',
        'cliente.codigo_cliente' => 'CODIGO_CLIENTE',
        'NombreCliente' => 'NOMBRE_CLIENTE',
        'Cliente.NombreCliente' => 'NOMBRE_CLIENTE',
        'nombreCliente' => 'NOMBRE_CLIENTE',
        'cliente.nombreCliente' => 'NOMBRE_CLIENTE',
        'ClienteTableMap::COL_NOMBRE_CLIENTE' => 'NOMBRE_CLIENTE',
        'COL_NOMBRE_CLIENTE' => 'NOMBRE_CLIENTE',
        'nombre_cliente' => 'NOMBRE_CLIENTE',
        'cliente.nombre_cliente' => 'NOMBRE_CLIENTE',
        'NombreContacto' => 'NOMBRE_CONTACTO',
        'Cliente.NombreContacto' => 'NOMBRE_CONTACTO',
        'nombreContacto' => 'NOMBRE_CONTACTO',
        'cliente.nombreContacto' => 'NOMBRE_CONTACTO',
        'ClienteTableMap::COL_NOMBRE_CONTACTO' => 'NOMBRE_CONTACTO',
        'COL_NOMBRE_CONTACTO' => 'NOMBRE_CONTACTO',
        'nombre_contacto' => 'NOMBRE_CONTACTO',
        'cliente.nombre_contacto' => 'NOMBRE_CONTACTO',
        'ApellidoContacto' => 'APELLIDO_CONTACTO',
        'Cliente.ApellidoContacto' => 'APELLIDO_CONTACTO',
        'apellidoContacto' => 'APELLIDO_CONTACTO',
        'cliente.apellidoContacto' => 'APELLIDO_CONTACTO',
        'ClienteTableMap::COL_APELLIDO_CONTACTO' => 'APELLIDO_CONTACTO',
        'COL_APELLIDO_CONTACTO' => 'APELLIDO_CONTACTO',
        'apellido_contacto' => 'APELLIDO_CONTACTO',
        'cliente.apellido_contacto' => 'APELLIDO_CONTACTO',
        'Telefono' => 'TELEFONO',
        'Cliente.Telefono' => 'TELEFONO',
        'telefono' => 'TELEFONO',
        'cliente.telefono' => 'TELEFONO',
        'ClienteTableMap::COL_TELEFONO' => 'TELEFONO',
        'COL_TELEFONO' => 'TELEFONO',
        'Fax' => 'FAX',
        'Cliente.Fax' => 'FAX',
        'fax' => 'FAX',
        'cliente.fax' => 'FAX',
        'ClienteTableMap::COL_FAX' => 'FAX',
        'COL_FAX' => 'FAX',
        'LineaDireccion1' => 'LINEA_DIRECCION1',
        'Cliente.LineaDireccion1' => 'LINEA_DIRECCION1',
        'lineaDireccion1' => 'LINEA_DIRECCION1',
        'cliente.lineaDireccion1' => 'LINEA_DIRECCION1',
        'ClienteTableMap::COL_LINEA_DIRECCION1' => 'LINEA_DIRECCION1',
        'COL_LINEA_DIRECCION1' => 'LINEA_DIRECCION1',
        'linea_direccion1' => 'LINEA_DIRECCION1',
        'cliente.linea_direccion1' => 'LINEA_DIRECCION1',
        'LineaDireccion2' => 'LINEA_DIRECCION2',
        'Cliente.LineaDireccion2' => 'LINEA_DIRECCION2',
        'lineaDireccion2' => 'LINEA_DIRECCION2',
        'cliente.lineaDireccion2' => 'LINEA_DIRECCION2',
        'ClienteTableMap::COL_LINEA_DIRECCION2' => 'LINEA_DIRECCION2',
        'COL_LINEA_DIRECCION2' => 'LINEA_DIRECCION2',
        'linea_direccion2' => 'LINEA_DIRECCION2',
        'cliente.linea_direccion2' => 'LINEA_DIRECCION2',
        'Ciudad' => 'CIUDAD',
        'Cliente.Ciudad' => 'CIUDAD',
        'ciudad' => 'CIUDAD',
        'cliente.ciudad' => 'CIUDAD',
        'ClienteTableMap::COL_CIUDAD' => 'CIUDAD',
        'COL_CIUDAD' => 'CIUDAD',
        'Region' => 'REGION',
        'Cliente.Region' => 'REGION',
        'region' => 'REGION',
        'cliente.region' => 'REGION',
        'ClienteTableMap::COL_REGION' => 'REGION',
        'COL_REGION' => 'REGION',
        'Pais' => 'PAIS',
        'Cliente.Pais' => 'PAIS',
        'pais' => 'PAIS',
        'cliente.pais' => 'PAIS',
        'ClienteTableMap::COL_PAIS' => 'PAIS',
        'COL_PAIS' => 'PAIS',
        'CodigoPostal' => 'CODIGO_POSTAL',
        'Cliente.CodigoPostal' => 'CODIGO_POSTAL',
        'codigoPostal' => 'CODIGO_POSTAL',
        'cliente.codigoPostal' => 'CODIGO_POSTAL',
        'ClienteTableMap::COL_CODIGO_POSTAL' => 'CODIGO_POSTAL',
        'COL_CODIGO_POSTAL' => 'CODIGO_POSTAL',
        'codigo_postal' => 'CODIGO_POSTAL',
        'cliente.codigo_postal' => 'CODIGO_POSTAL',
        'CodigoEmpleadoRepVentas' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'Cliente.CodigoEmpleadoRepVentas' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'codigoEmpleadoRepVentas' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'cliente.codigoEmpleadoRepVentas' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'COL_CODIGO_EMPLEADO_REP_VENTAS' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'codigo_empleado_rep_ventas' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'cliente.codigo_empleado_rep_ventas' => 'CODIGO_EMPLEADO_REP_VENTAS',
        'LimiteCredito' => 'LIMITE_CREDITO',
        'Cliente.LimiteCredito' => 'LIMITE_CREDITO',
        'limiteCredito' => 'LIMITE_CREDITO',
        'cliente.limiteCredito' => 'LIMITE_CREDITO',
        'ClienteTableMap::COL_LIMITE_CREDITO' => 'LIMITE_CREDITO',
        'COL_LIMITE_CREDITO' => 'LIMITE_CREDITO',
        'limite_credito' => 'LIMITE_CREDITO',
        'cliente.limite_credito' => 'LIMITE_CREDITO',
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
        $this->setName('cliente');
        $this->setPhpName('Cliente');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Cliente');
        $this->setPackage('App');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('codigo_cliente', 'CodigoCliente', 'INTEGER', true, null, null);
        $this->addColumn('nombre_cliente', 'NombreCliente', 'VARCHAR', true, 50, null);
        $this->addColumn('nombre_contacto', 'NombreContacto', 'VARCHAR', false, 30, null);
        $this->addColumn('apellido_contacto', 'ApellidoContacto', 'VARCHAR', false, 30, null);
        $this->addColumn('telefono', 'Telefono', 'VARCHAR', true, 15, null);
        $this->addColumn('fax', 'Fax', 'VARCHAR', true, 15, null);
        $this->addColumn('linea_direccion1', 'LineaDireccion1', 'VARCHAR', true, 50, null);
        $this->addColumn('linea_direccion2', 'LineaDireccion2', 'VARCHAR', false, 50, null);
        $this->addColumn('ciudad', 'Ciudad', 'VARCHAR', true, 50, null);
        $this->addColumn('region', 'Region', 'VARCHAR', false, 50, null);
        $this->addColumn('pais', 'Pais', 'VARCHAR', false, 50, null);
        $this->addColumn('codigo_postal', 'CodigoPostal', 'VARCHAR', false, 10, null);
        $this->addForeignKey('codigo_empleado_rep_ventas', 'CodigoEmpleadoRepVentas', 'INTEGER', 'empleado', 'codigo_empleado', false, null, null);
        $this->addColumn('limite_credito', 'LimiteCredito', 'DECIMAL', false, 15, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Empleado', '\\App\\Empleado', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codigo_empleado_rep_ventas',
    1 => ':codigo_empleado',
  ),
), null, null, null, false);
        $this->addRelation('Pago', '\\App\\Pago', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_cliente',
    1 => ':codigo_cliente',
  ),
), null, null, 'Pagos', false);
        $this->addRelation('Pedido', '\\App\\Pedido', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codigo_cliente',
    1 => ':codigo_cliente',
  ),
), null, null, 'Pedidos', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ClienteTableMap::CLASS_DEFAULT : ClienteTableMap::OM_CLASS;
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
     * @return array (Cliente object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ClienteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ClienteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ClienteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ClienteTableMap::OM_CLASS;
            /** @var Cliente $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ClienteTableMap::addInstanceToPool($obj, $key);
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
            $key = ClienteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ClienteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cliente $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ClienteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ClienteTableMap::COL_CODIGO_CLIENTE);
            $criteria->addSelectColumn(ClienteTableMap::COL_NOMBRE_CLIENTE);
            $criteria->addSelectColumn(ClienteTableMap::COL_NOMBRE_CONTACTO);
            $criteria->addSelectColumn(ClienteTableMap::COL_APELLIDO_CONTACTO);
            $criteria->addSelectColumn(ClienteTableMap::COL_TELEFONO);
            $criteria->addSelectColumn(ClienteTableMap::COL_FAX);
            $criteria->addSelectColumn(ClienteTableMap::COL_LINEA_DIRECCION1);
            $criteria->addSelectColumn(ClienteTableMap::COL_LINEA_DIRECCION2);
            $criteria->addSelectColumn(ClienteTableMap::COL_CIUDAD);
            $criteria->addSelectColumn(ClienteTableMap::COL_REGION);
            $criteria->addSelectColumn(ClienteTableMap::COL_PAIS);
            $criteria->addSelectColumn(ClienteTableMap::COL_CODIGO_POSTAL);
            $criteria->addSelectColumn(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS);
            $criteria->addSelectColumn(ClienteTableMap::COL_LIMITE_CREDITO);
        } else {
            $criteria->addSelectColumn($alias . '.codigo_cliente');
            $criteria->addSelectColumn($alias . '.nombre_cliente');
            $criteria->addSelectColumn($alias . '.nombre_contacto');
            $criteria->addSelectColumn($alias . '.apellido_contacto');
            $criteria->addSelectColumn($alias . '.telefono');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.linea_direccion1');
            $criteria->addSelectColumn($alias . '.linea_direccion2');
            $criteria->addSelectColumn($alias . '.ciudad');
            $criteria->addSelectColumn($alias . '.region');
            $criteria->addSelectColumn($alias . '.pais');
            $criteria->addSelectColumn($alias . '.codigo_postal');
            $criteria->addSelectColumn($alias . '.codigo_empleado_rep_ventas');
            $criteria->addSelectColumn($alias . '.limite_credito');
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
            $criteria->removeSelectColumn(ClienteTableMap::COL_CODIGO_CLIENTE);
            $criteria->removeSelectColumn(ClienteTableMap::COL_NOMBRE_CLIENTE);
            $criteria->removeSelectColumn(ClienteTableMap::COL_NOMBRE_CONTACTO);
            $criteria->removeSelectColumn(ClienteTableMap::COL_APELLIDO_CONTACTO);
            $criteria->removeSelectColumn(ClienteTableMap::COL_TELEFONO);
            $criteria->removeSelectColumn(ClienteTableMap::COL_FAX);
            $criteria->removeSelectColumn(ClienteTableMap::COL_LINEA_DIRECCION1);
            $criteria->removeSelectColumn(ClienteTableMap::COL_LINEA_DIRECCION2);
            $criteria->removeSelectColumn(ClienteTableMap::COL_CIUDAD);
            $criteria->removeSelectColumn(ClienteTableMap::COL_REGION);
            $criteria->removeSelectColumn(ClienteTableMap::COL_PAIS);
            $criteria->removeSelectColumn(ClienteTableMap::COL_CODIGO_POSTAL);
            $criteria->removeSelectColumn(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS);
            $criteria->removeSelectColumn(ClienteTableMap::COL_LIMITE_CREDITO);
        } else {
            $criteria->removeSelectColumn($alias . '.codigo_cliente');
            $criteria->removeSelectColumn($alias . '.nombre_cliente');
            $criteria->removeSelectColumn($alias . '.nombre_contacto');
            $criteria->removeSelectColumn($alias . '.apellido_contacto');
            $criteria->removeSelectColumn($alias . '.telefono');
            $criteria->removeSelectColumn($alias . '.fax');
            $criteria->removeSelectColumn($alias . '.linea_direccion1');
            $criteria->removeSelectColumn($alias . '.linea_direccion2');
            $criteria->removeSelectColumn($alias . '.ciudad');
            $criteria->removeSelectColumn($alias . '.region');
            $criteria->removeSelectColumn($alias . '.pais');
            $criteria->removeSelectColumn($alias . '.codigo_postal');
            $criteria->removeSelectColumn($alias . '.codigo_empleado_rep_ventas');
            $criteria->removeSelectColumn($alias . '.limite_credito');
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
        return Propel::getServiceContainer()->getDatabaseMap(ClienteTableMap::DATABASE_NAME)->getTable(ClienteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Cliente or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Cliente object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Cliente) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ClienteTableMap::DATABASE_NAME);
            $criteria->add(ClienteTableMap::COL_CODIGO_CLIENTE, (array) $values, Criteria::IN);
        }

        $query = ClienteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ClienteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ClienteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cliente table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ClienteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cliente or Criteria object.
     *
     * @param mixed $criteria Criteria or Cliente object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cliente object
        }


        // Set the correct dbName
        $query = ClienteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
