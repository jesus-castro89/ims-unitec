<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Cliente as ChildCliente;
use App\ClienteQuery as ChildClienteQuery;
use App\Empleado as ChildEmpleado;
use App\EmpleadoQuery as ChildEmpleadoQuery;
use App\Pago as ChildPago;
use App\PagoQuery as ChildPagoQuery;
use App\Pedido as ChildPedido;
use App\PedidoQuery as ChildPedidoQuery;
use App\Map\ClienteTableMap;
use App\Map\PagoTableMap;
use App\Map\PedidoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'cliente' table.
 *
 *
 *
 * @package    propel.generator.App.Base
 */
abstract class Cliente implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\App\\Map\\ClienteTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the codigo_cliente field.
     *
     * @var        int
     */
    protected $codigo_cliente;

    /**
     * The value for the nombre_cliente field.
     *
     * @var        string
     */
    protected $nombre_cliente;

    /**
     * The value for the nombre_contacto field.
     *
     * @var        string|null
     */
    protected $nombre_contacto;

    /**
     * The value for the apellido_contacto field.
     *
     * @var        string|null
     */
    protected $apellido_contacto;

    /**
     * The value for the telefono field.
     *
     * @var        string
     */
    protected $telefono;

    /**
     * The value for the fax field.
     *
     * @var        string
     */
    protected $fax;

    /**
     * The value for the linea_direccion1 field.
     *
     * @var        string
     */
    protected $linea_direccion1;

    /**
     * The value for the linea_direccion2 field.
     *
     * @var        string|null
     */
    protected $linea_direccion2;

    /**
     * The value for the ciudad field.
     *
     * @var        string
     */
    protected $ciudad;

    /**
     * The value for the region field.
     *
     * @var        string|null
     */
    protected $region;

    /**
     * The value for the pais field.
     *
     * @var        string|null
     */
    protected $pais;

    /**
     * The value for the codigo_postal field.
     *
     * @var        string|null
     */
    protected $codigo_postal;

    /**
     * The value for the codigo_empleado_rep_ventas field.
     *
     * @var        int|null
     */
    protected $codigo_empleado_rep_ventas;

    /**
     * The value for the limite_credito field.
     *
     * @var        string|null
     */
    protected $limite_credito;

    /**
     * @var        ChildEmpleado
     */
    protected $aEmpleado;

    /**
     * @var        ObjectCollection|ChildPago[] Collection to store aggregation of ChildPago objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPago> Collection to store aggregation of ChildPago objects.
     */
    protected $collPagos;
    protected $collPagosPartial;

    /**
     * @var        ObjectCollection|ChildPedido[] Collection to store aggregation of ChildPedido objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPedido> Collection to store aggregation of ChildPedido objects.
     */
    protected $collPedidos;
    protected $collPedidosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPago[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPago>
     */
    protected $pagosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPedido[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPedido>
     */
    protected $pedidosScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Base\Cliente object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Cliente</code> instance.  If
     * <code>obj</code> is an instance of <code>Cliente</code>, delegates to
     * <code>equals(Cliente)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [codigo_cliente] column value.
     *
     * @return int
     */
    public function getCodigoCliente()
    {
        return $this->codigo_cliente;
    }

    /**
     * Get the [nombre_cliente] column value.
     *
     * @return string
     */
    public function getNombreCliente()
    {
        return $this->nombre_cliente;
    }

    /**
     * Get the [nombre_contacto] column value.
     *
     * @return string|null
     */
    public function getNombreContacto()
    {
        return $this->nombre_contacto;
    }

    /**
     * Get the [apellido_contacto] column value.
     *
     * @return string|null
     */
    public function getApellidoContacto()
    {
        return $this->apellido_contacto;
    }

    /**
     * Get the [telefono] column value.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Get the [fax] column value.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Get the [linea_direccion1] column value.
     *
     * @return string
     */
    public function getLineaDireccion1()
    {
        return $this->linea_direccion1;
    }

    /**
     * Get the [linea_direccion2] column value.
     *
     * @return string|null
     */
    public function getLineaDireccion2()
    {
        return $this->linea_direccion2;
    }

    /**
     * Get the [ciudad] column value.
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Get the [region] column value.
     *
     * @return string|null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Get the [pais] column value.
     *
     * @return string|null
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Get the [codigo_postal] column value.
     *
     * @return string|null
     */
    public function getCodigoPostal()
    {
        return $this->codigo_postal;
    }

    /**
     * Get the [codigo_empleado_rep_ventas] column value.
     *
     * @return int|null
     */
    public function getCodigoEmpleadoRepVentas()
    {
        return $this->codigo_empleado_rep_ventas;
    }

    /**
     * Get the [limite_credito] column value.
     *
     * @return string|null
     */
    public function getLimiteCredito()
    {
        return $this->limite_credito;
    }

    /**
     * Set the value of [codigo_cliente] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoCliente($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codigo_cliente !== $v) {
            $this->codigo_cliente = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CODIGO_CLIENTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nombre_cliente] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNombreCliente($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_cliente !== $v) {
            $this->nombre_cliente = $v;
            $this->modifiedColumns[ClienteTableMap::COL_NOMBRE_CLIENTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nombre_contacto] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNombreContacto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre_contacto !== $v) {
            $this->nombre_contacto = $v;
            $this->modifiedColumns[ClienteTableMap::COL_NOMBRE_CONTACTO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [apellido_contacto] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApellidoContacto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellido_contacto !== $v) {
            $this->apellido_contacto = $v;
            $this->modifiedColumns[ClienteTableMap::COL_APELLIDO_CONTACTO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [telefono] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTelefono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono !== $v) {
            $this->telefono = $v;
            $this->modifiedColumns[ClienteTableMap::COL_TELEFONO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fax] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[ClienteTableMap::COL_FAX] = true;
        }

        return $this;
    }

    /**
     * Set the value of [linea_direccion1] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLineaDireccion1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->linea_direccion1 !== $v) {
            $this->linea_direccion1 = $v;
            $this->modifiedColumns[ClienteTableMap::COL_LINEA_DIRECCION1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [linea_direccion2] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLineaDireccion2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->linea_direccion2 !== $v) {
            $this->linea_direccion2 = $v;
            $this->modifiedColumns[ClienteTableMap::COL_LINEA_DIRECCION2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ciudad] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCiudad($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ciudad !== $v) {
            $this->ciudad = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CIUDAD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [region] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->region !== $v) {
            $this->region = $v;
            $this->modifiedColumns[ClienteTableMap::COL_REGION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pais] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPais($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pais !== $v) {
            $this->pais = $v;
            $this->modifiedColumns[ClienteTableMap::COL_PAIS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [codigo_postal] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoPostal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codigo_postal !== $v) {
            $this->codigo_postal = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CODIGO_POSTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [codigo_empleado_rep_ventas] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoEmpleadoRepVentas($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codigo_empleado_rep_ventas !== $v) {
            $this->codigo_empleado_rep_ventas = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS] = true;
        }

        if ($this->aEmpleado !== null && $this->aEmpleado->getCodigoEmpleado() !== $v) {
            $this->aEmpleado = null;
        }

        return $this;
    }

    /**
     * Set the value of [limite_credito] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLimiteCredito($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->limite_credito !== $v) {
            $this->limite_credito = $v;
            $this->modifiedColumns[ClienteTableMap::COL_LIMITE_CREDITO] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ClienteTableMap::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_cliente = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ClienteTableMap::translateFieldName('NombreCliente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_cliente = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ClienteTableMap::translateFieldName('NombreContacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre_contacto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ClienteTableMap::translateFieldName('ApellidoContacto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellido_contacto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ClienteTableMap::translateFieldName('Telefono', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ClienteTableMap::translateFieldName('Fax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ClienteTableMap::translateFieldName('LineaDireccion1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->linea_direccion1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ClienteTableMap::translateFieldName('LineaDireccion2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->linea_direccion2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ClienteTableMap::translateFieldName('Ciudad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ciudad = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ClienteTableMap::translateFieldName('Region', TableMap::TYPE_PHPNAME, $indexType)];
            $this->region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ClienteTableMap::translateFieldName('Pais', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pais = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ClienteTableMap::translateFieldName('CodigoPostal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_postal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ClienteTableMap::translateFieldName('CodigoEmpleadoRepVentas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_empleado_rep_ventas = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ClienteTableMap::translateFieldName('LimiteCredito', TableMap::TYPE_PHPNAME, $indexType)];
            $this->limite_credito = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = ClienteTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Cliente'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aEmpleado !== null && $this->codigo_empleado_rep_ventas !== $this->aEmpleado->getCodigoEmpleado()) {
            $this->aEmpleado = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClienteTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildClienteQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmpleado = null;
            $this->collPagos = null;

            $this->collPedidos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Cliente::setDeleted()
     * @see Cliente::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildClienteQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ClienteTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEmpleado !== null) {
                if ($this->aEmpleado->isModified() || $this->aEmpleado->isNew()) {
                    $affectedRows += $this->aEmpleado->save($con);
                }
                $this->setEmpleado($this->aEmpleado);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->pagosScheduledForDeletion !== null) {
                if (!$this->pagosScheduledForDeletion->isEmpty()) {
                    \App\PagoQuery::create()
                        ->filterByPrimaryKeys($this->pagosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pagosScheduledForDeletion = null;
                }
            }

            if ($this->collPagos !== null) {
                foreach ($this->collPagos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pedidosScheduledForDeletion !== null) {
                if (!$this->pedidosScheduledForDeletion->isEmpty()) {
                    \App\PedidoQuery::create()
                        ->filterByPrimaryKeys($this->pedidosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pedidosScheduledForDeletion = null;
                }
            }

            if ($this->collPedidos !== null) {
                foreach ($this->collPedidos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ClienteTableMap::COL_CODIGO_CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_cliente';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_NOMBRE_CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre_cliente';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_NOMBRE_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'nombre_contacto';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_APELLIDO_CONTACTO)) {
            $modifiedColumns[':p' . $index++]  = 'apellido_contacto';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_TELEFONO)) {
            $modifiedColumns[':p' . $index++]  = 'telefono';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_FAX)) {
            $modifiedColumns[':p' . $index++]  = 'fax';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_LINEA_DIRECCION1)) {
            $modifiedColumns[':p' . $index++]  = 'linea_direccion1';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_LINEA_DIRECCION2)) {
            $modifiedColumns[':p' . $index++]  = 'linea_direccion2';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CIUDAD)) {
            $modifiedColumns[':p' . $index++]  = 'ciudad';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_REGION)) {
            $modifiedColumns[':p' . $index++]  = 'region';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_PAIS)) {
            $modifiedColumns[':p' . $index++]  = 'pais';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CODIGO_POSTAL)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_postal';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_empleado_rep_ventas';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_LIMITE_CREDITO)) {
            $modifiedColumns[':p' . $index++]  = 'limite_credito';
        }

        $sql = sprintf(
            'INSERT INTO cliente (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'codigo_cliente':
                        $stmt->bindValue($identifier, $this->codigo_cliente, PDO::PARAM_INT);

                        break;
                    case 'nombre_cliente':
                        $stmt->bindValue($identifier, $this->nombre_cliente, PDO::PARAM_STR);

                        break;
                    case 'nombre_contacto':
                        $stmt->bindValue($identifier, $this->nombre_contacto, PDO::PARAM_STR);

                        break;
                    case 'apellido_contacto':
                        $stmt->bindValue($identifier, $this->apellido_contacto, PDO::PARAM_STR);

                        break;
                    case 'telefono':
                        $stmt->bindValue($identifier, $this->telefono, PDO::PARAM_STR);

                        break;
                    case 'fax':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);

                        break;
                    case 'linea_direccion1':
                        $stmt->bindValue($identifier, $this->linea_direccion1, PDO::PARAM_STR);

                        break;
                    case 'linea_direccion2':
                        $stmt->bindValue($identifier, $this->linea_direccion2, PDO::PARAM_STR);

                        break;
                    case 'ciudad':
                        $stmt->bindValue($identifier, $this->ciudad, PDO::PARAM_STR);

                        break;
                    case 'region':
                        $stmt->bindValue($identifier, $this->region, PDO::PARAM_STR);

                        break;
                    case 'pais':
                        $stmt->bindValue($identifier, $this->pais, PDO::PARAM_STR);

                        break;
                    case 'codigo_postal':
                        $stmt->bindValue($identifier, $this->codigo_postal, PDO::PARAM_STR);

                        break;
                    case 'codigo_empleado_rep_ventas':
                        $stmt->bindValue($identifier, $this->codigo_empleado_rep_ventas, PDO::PARAM_INT);

                        break;
                    case 'limite_credito':
                        $stmt->bindValue($identifier, $this->limite_credito, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ClienteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getCodigoCliente();

            case 1:
                return $this->getNombreCliente();

            case 2:
                return $this->getNombreContacto();

            case 3:
                return $this->getApellidoContacto();

            case 4:
                return $this->getTelefono();

            case 5:
                return $this->getFax();

            case 6:
                return $this->getLineaDireccion1();

            case 7:
                return $this->getLineaDireccion2();

            case 8:
                return $this->getCiudad();

            case 9:
                return $this->getRegion();

            case 10:
                return $this->getPais();

            case 11:
                return $this->getCodigoPostal();

            case 12:
                return $this->getCodigoEmpleadoRepVentas();

            case 13:
                return $this->getLimiteCredito();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Cliente'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Cliente'][$this->hashCode()] = true;
        $keys = ClienteTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getCodigoCliente(),
            $keys[1] => $this->getNombreCliente(),
            $keys[2] => $this->getNombreContacto(),
            $keys[3] => $this->getApellidoContacto(),
            $keys[4] => $this->getTelefono(),
            $keys[5] => $this->getFax(),
            $keys[6] => $this->getLineaDireccion1(),
            $keys[7] => $this->getLineaDireccion2(),
            $keys[8] => $this->getCiudad(),
            $keys[9] => $this->getRegion(),
            $keys[10] => $this->getPais(),
            $keys[11] => $this->getCodigoPostal(),
            $keys[12] => $this->getCodigoEmpleadoRepVentas(),
            $keys[13] => $this->getLimiteCredito(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEmpleado) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'empleado';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'empleado';
                        break;
                    default:
                        $key = 'Empleado';
                }

                $result[$key] = $this->aEmpleado->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPagos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pagos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pagos';
                        break;
                    default:
                        $key = 'Pagos';
                }

                $result[$key] = $this->collPagos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPedidos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pedidos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pedidos';
                        break;
                    default:
                        $key = 'Pedidos';
                }

                $result[$key] = $this->collPedidos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ClienteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCodigoCliente($value);
                break;
            case 1:
                $this->setNombreCliente($value);
                break;
            case 2:
                $this->setNombreContacto($value);
                break;
            case 3:
                $this->setApellidoContacto($value);
                break;
            case 4:
                $this->setTelefono($value);
                break;
            case 5:
                $this->setFax($value);
                break;
            case 6:
                $this->setLineaDireccion1($value);
                break;
            case 7:
                $this->setLineaDireccion2($value);
                break;
            case 8:
                $this->setCiudad($value);
                break;
            case 9:
                $this->setRegion($value);
                break;
            case 10:
                $this->setPais($value);
                break;
            case 11:
                $this->setCodigoPostal($value);
                break;
            case 12:
                $this->setCodigoEmpleadoRepVentas($value);
                break;
            case 13:
                $this->setLimiteCredito($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ClienteTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCodigoCliente($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNombreCliente($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNombreContacto($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setApellidoContacto($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTelefono($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFax($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLineaDireccion1($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLineaDireccion2($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCiudad($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRegion($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPais($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCodigoPostal($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCodigoEmpleadoRepVentas($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setLimiteCredito($arr[$keys[13]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(ClienteTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ClienteTableMap::COL_CODIGO_CLIENTE)) {
            $criteria->add(ClienteTableMap::COL_CODIGO_CLIENTE, $this->codigo_cliente);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_NOMBRE_CLIENTE)) {
            $criteria->add(ClienteTableMap::COL_NOMBRE_CLIENTE, $this->nombre_cliente);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_NOMBRE_CONTACTO)) {
            $criteria->add(ClienteTableMap::COL_NOMBRE_CONTACTO, $this->nombre_contacto);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_APELLIDO_CONTACTO)) {
            $criteria->add(ClienteTableMap::COL_APELLIDO_CONTACTO, $this->apellido_contacto);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_TELEFONO)) {
            $criteria->add(ClienteTableMap::COL_TELEFONO, $this->telefono);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_FAX)) {
            $criteria->add(ClienteTableMap::COL_FAX, $this->fax);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_LINEA_DIRECCION1)) {
            $criteria->add(ClienteTableMap::COL_LINEA_DIRECCION1, $this->linea_direccion1);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_LINEA_DIRECCION2)) {
            $criteria->add(ClienteTableMap::COL_LINEA_DIRECCION2, $this->linea_direccion2);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CIUDAD)) {
            $criteria->add(ClienteTableMap::COL_CIUDAD, $this->ciudad);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_REGION)) {
            $criteria->add(ClienteTableMap::COL_REGION, $this->region);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_PAIS)) {
            $criteria->add(ClienteTableMap::COL_PAIS, $this->pais);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CODIGO_POSTAL)) {
            $criteria->add(ClienteTableMap::COL_CODIGO_POSTAL, $this->codigo_postal);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS)) {
            $criteria->add(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, $this->codigo_empleado_rep_ventas);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_LIMITE_CREDITO)) {
            $criteria->add(ClienteTableMap::COL_LIMITE_CREDITO, $this->limite_credito);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildClienteQuery::create();
        $criteria->add(ClienteTableMap::COL_CODIGO_CLIENTE, $this->codigo_cliente);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getCodigoCliente();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getCodigoCliente();
    }

    /**
     * Generic method to set the primary key (codigo_cliente column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setCodigoCliente($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getCodigoCliente();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \App\Cliente (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCodigoCliente($this->getCodigoCliente());
        $copyObj->setNombreCliente($this->getNombreCliente());
        $copyObj->setNombreContacto($this->getNombreContacto());
        $copyObj->setApellidoContacto($this->getApellidoContacto());
        $copyObj->setTelefono($this->getTelefono());
        $copyObj->setFax($this->getFax());
        $copyObj->setLineaDireccion1($this->getLineaDireccion1());
        $copyObj->setLineaDireccion2($this->getLineaDireccion2());
        $copyObj->setCiudad($this->getCiudad());
        $copyObj->setRegion($this->getRegion());
        $copyObj->setPais($this->getPais());
        $copyObj->setCodigoPostal($this->getCodigoPostal());
        $copyObj->setCodigoEmpleadoRepVentas($this->getCodigoEmpleadoRepVentas());
        $copyObj->setLimiteCredito($this->getLimiteCredito());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPagos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPago($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPedidos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPedido($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \App\Cliente Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildEmpleado object.
     *
     * @param ChildEmpleado|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmpleado(ChildEmpleado $v = null)
    {
        if ($v === null) {
            $this->setCodigoEmpleadoRepVentas(NULL);
        } else {
            $this->setCodigoEmpleadoRepVentas($v->getCodigoEmpleado());
        }

        $this->aEmpleado = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmpleado object, it will not be re-added.
        if ($v !== null) {
            $v->addCliente($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmpleado object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmpleado|null The associated ChildEmpleado object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmpleado(?ConnectionInterface $con = null)
    {
        if ($this->aEmpleado === null && ($this->codigo_empleado_rep_ventas != 0)) {
            $this->aEmpleado = ChildEmpleadoQuery::create()->findPk($this->codigo_empleado_rep_ventas, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmpleado->addClientes($this);
             */
        }

        return $this->aEmpleado;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('Pago' === $relationName) {
            $this->initPagos();
            return;
        }
        if ('Pedido' === $relationName) {
            $this->initPedidos();
            return;
        }
    }

    /**
     * Clears out the collPagos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPagos()
     */
    public function clearPagos()
    {
        $this->collPagos = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPagos collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPagos($v = true): void
    {
        $this->collPagosPartial = $v;
    }

    /**
     * Initializes the collPagos collection.
     *
     * By default this just sets the collPagos collection to an empty array (like clearcollPagos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPagos(bool $overrideExisting = true): void
    {
        if (null !== $this->collPagos && !$overrideExisting) {
            return;
        }

        $collectionClassName = PagoTableMap::getTableMap()->getCollectionClassName();

        $this->collPagos = new $collectionClassName;
        $this->collPagos->setModel('\App\Pago');
    }

    /**
     * Gets an array of ChildPago objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCliente is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPago[] List of ChildPago objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPago> List of ChildPago objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPagos(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPagosPartial && !$this->isNew();
        if (null === $this->collPagos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPagos) {
                    $this->initPagos();
                } else {
                    $collectionClassName = PagoTableMap::getTableMap()->getCollectionClassName();

                    $collPagos = new $collectionClassName;
                    $collPagos->setModel('\App\Pago');

                    return $collPagos;
                }
            } else {
                $collPagos = ChildPagoQuery::create(null, $criteria)
                    ->filterByCliente($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPagosPartial && count($collPagos)) {
                        $this->initPagos(false);

                        foreach ($collPagos as $obj) {
                            if (false == $this->collPagos->contains($obj)) {
                                $this->collPagos->append($obj);
                            }
                        }

                        $this->collPagosPartial = true;
                    }

                    return $collPagos;
                }

                if ($partial && $this->collPagos) {
                    foreach ($this->collPagos as $obj) {
                        if ($obj->isNew()) {
                            $collPagos[] = $obj;
                        }
                    }
                }

                $this->collPagos = $collPagos;
                $this->collPagosPartial = false;
            }
        }

        return $this->collPagos;
    }

    /**
     * Sets a collection of ChildPago objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $pagos A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPagos(Collection $pagos, ?ConnectionInterface $con = null)
    {
        /** @var ChildPago[] $pagosToDelete */
        $pagosToDelete = $this->getPagos(new Criteria(), $con)->diff($pagos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->pagosScheduledForDeletion = clone $pagosToDelete;

        foreach ($pagosToDelete as $pagoRemoved) {
            $pagoRemoved->setCliente(null);
        }

        $this->collPagos = null;
        foreach ($pagos as $pago) {
            $this->addPago($pago);
        }

        $this->collPagos = $pagos;
        $this->collPagosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pago objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Pago objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPagos(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPagosPartial && !$this->isNew();
        if (null === $this->collPagos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPagos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPagos());
            }

            $query = ChildPagoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCliente($this)
                ->count($con);
        }

        return count($this->collPagos);
    }

    /**
     * Method called to associate a ChildPago object to this object
     * through the ChildPago foreign key attribute.
     *
     * @param ChildPago $l ChildPago
     * @return $this The current object (for fluent API support)
     */
    public function addPago(ChildPago $l)
    {
        if ($this->collPagos === null) {
            $this->initPagos();
            $this->collPagosPartial = true;
        }

        if (!$this->collPagos->contains($l)) {
            $this->doAddPago($l);

            if ($this->pagosScheduledForDeletion and $this->pagosScheduledForDeletion->contains($l)) {
                $this->pagosScheduledForDeletion->remove($this->pagosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPago $pago The ChildPago object to add.
     */
    protected function doAddPago(ChildPago $pago): void
    {
        $this->collPagos[]= $pago;
        $pago->setCliente($this);
    }

    /**
     * @param ChildPago $pago The ChildPago object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePago(ChildPago $pago)
    {
        if ($this->getPagos()->contains($pago)) {
            $pos = $this->collPagos->search($pago);
            $this->collPagos->remove($pos);
            if (null === $this->pagosScheduledForDeletion) {
                $this->pagosScheduledForDeletion = clone $this->collPagos;
                $this->pagosScheduledForDeletion->clear();
            }
            $this->pagosScheduledForDeletion[]= clone $pago;
            $pago->setCliente(null);
        }

        return $this;
    }

    /**
     * Clears out the collPedidos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPedidos()
     */
    public function clearPedidos()
    {
        $this->collPedidos = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPedidos collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPedidos($v = true): void
    {
        $this->collPedidosPartial = $v;
    }

    /**
     * Initializes the collPedidos collection.
     *
     * By default this just sets the collPedidos collection to an empty array (like clearcollPedidos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPedidos(bool $overrideExisting = true): void
    {
        if (null !== $this->collPedidos && !$overrideExisting) {
            return;
        }

        $collectionClassName = PedidoTableMap::getTableMap()->getCollectionClassName();

        $this->collPedidos = new $collectionClassName;
        $this->collPedidos->setModel('\App\Pedido');
    }

    /**
     * Gets an array of ChildPedido objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCliente is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPedido[] List of ChildPedido objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPedido> List of ChildPedido objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPedidos(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPedidosPartial && !$this->isNew();
        if (null === $this->collPedidos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPedidos) {
                    $this->initPedidos();
                } else {
                    $collectionClassName = PedidoTableMap::getTableMap()->getCollectionClassName();

                    $collPedidos = new $collectionClassName;
                    $collPedidos->setModel('\App\Pedido');

                    return $collPedidos;
                }
            } else {
                $collPedidos = ChildPedidoQuery::create(null, $criteria)
                    ->filterByCliente($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPedidosPartial && count($collPedidos)) {
                        $this->initPedidos(false);

                        foreach ($collPedidos as $obj) {
                            if (false == $this->collPedidos->contains($obj)) {
                                $this->collPedidos->append($obj);
                            }
                        }

                        $this->collPedidosPartial = true;
                    }

                    return $collPedidos;
                }

                if ($partial && $this->collPedidos) {
                    foreach ($this->collPedidos as $obj) {
                        if ($obj->isNew()) {
                            $collPedidos[] = $obj;
                        }
                    }
                }

                $this->collPedidos = $collPedidos;
                $this->collPedidosPartial = false;
            }
        }

        return $this->collPedidos;
    }

    /**
     * Sets a collection of ChildPedido objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $pedidos A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPedidos(Collection $pedidos, ?ConnectionInterface $con = null)
    {
        /** @var ChildPedido[] $pedidosToDelete */
        $pedidosToDelete = $this->getPedidos(new Criteria(), $con)->diff($pedidos);


        $this->pedidosScheduledForDeletion = $pedidosToDelete;

        foreach ($pedidosToDelete as $pedidoRemoved) {
            $pedidoRemoved->setCliente(null);
        }

        $this->collPedidos = null;
        foreach ($pedidos as $pedido) {
            $this->addPedido($pedido);
        }

        $this->collPedidos = $pedidos;
        $this->collPedidosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pedido objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Pedido objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPedidos(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPedidosPartial && !$this->isNew();
        if (null === $this->collPedidos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPedidos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPedidos());
            }

            $query = ChildPedidoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCliente($this)
                ->count($con);
        }

        return count($this->collPedidos);
    }

    /**
     * Method called to associate a ChildPedido object to this object
     * through the ChildPedido foreign key attribute.
     *
     * @param ChildPedido $l ChildPedido
     * @return $this The current object (for fluent API support)
     */
    public function addPedido(ChildPedido $l)
    {
        if ($this->collPedidos === null) {
            $this->initPedidos();
            $this->collPedidosPartial = true;
        }

        if (!$this->collPedidos->contains($l)) {
            $this->doAddPedido($l);

            if ($this->pedidosScheduledForDeletion and $this->pedidosScheduledForDeletion->contains($l)) {
                $this->pedidosScheduledForDeletion->remove($this->pedidosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPedido $pedido The ChildPedido object to add.
     */
    protected function doAddPedido(ChildPedido $pedido): void
    {
        $this->collPedidos[]= $pedido;
        $pedido->setCliente($this);
    }

    /**
     * @param ChildPedido $pedido The ChildPedido object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePedido(ChildPedido $pedido)
    {
        if ($this->getPedidos()->contains($pedido)) {
            $pos = $this->collPedidos->search($pedido);
            $this->collPedidos->remove($pos);
            if (null === $this->pedidosScheduledForDeletion) {
                $this->pedidosScheduledForDeletion = clone $this->collPedidos;
                $this->pedidosScheduledForDeletion->clear();
            }
            $this->pedidosScheduledForDeletion[]= clone $pedido;
            $pedido->setCliente(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aEmpleado) {
            $this->aEmpleado->removeCliente($this);
        }
        $this->codigo_cliente = null;
        $this->nombre_cliente = null;
        $this->nombre_contacto = null;
        $this->apellido_contacto = null;
        $this->telefono = null;
        $this->fax = null;
        $this->linea_direccion1 = null;
        $this->linea_direccion2 = null;
        $this->ciudad = null;
        $this->region = null;
        $this->pais = null;
        $this->codigo_postal = null;
        $this->codigo_empleado_rep_ventas = null;
        $this->limite_credito = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collPagos) {
                foreach ($this->collPagos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPedidos) {
                foreach ($this->collPedidos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPagos = null;
        $this->collPedidos = null;
        $this->aEmpleado = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ClienteTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
