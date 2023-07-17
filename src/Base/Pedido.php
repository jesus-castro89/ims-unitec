<?php

namespace App\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Cliente as ChildCliente;
use App\ClienteQuery as ChildClienteQuery;
use App\DetallePedido as ChildDetallePedido;
use App\DetallePedidoQuery as ChildDetallePedidoQuery;
use App\Pedido as ChildPedido;
use App\PedidoQuery as ChildPedidoQuery;
use App\Map\DetallePedidoTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'pedido' table.
 *
 *
 *
 * @package    propel.generator.App.Base
 */
abstract class Pedido implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\App\\Map\\PedidoTableMap';


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
     * The value for the codigo_pedido field.
     *
     * @var        int
     */
    protected $codigo_pedido;

    /**
     * The value for the fecha_pedido field.
     *
     * @var        DateTime
     */
    protected $fecha_pedido;

    /**
     * The value for the fecha_esperada field.
     *
     * @var        DateTime
     */
    protected $fecha_esperada;

    /**
     * The value for the fecha_entrega field.
     *
     * @var        DateTime|null
     */
    protected $fecha_entrega;

    /**
     * The value for the estado field.
     *
     * @var        string
     */
    protected $estado;

    /**
     * The value for the comentarios field.
     *
     * @var        string|null
     */
    protected $comentarios;

    /**
     * The value for the codigo_cliente field.
     *
     * @var        int
     */
    protected $codigo_cliente;

    /**
     * @var        ChildCliente
     */
    protected $aCliente;

    /**
     * @var        ObjectCollection|ChildDetallePedido[] Collection to store aggregation of ChildDetallePedido objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDetallePedido> Collection to store aggregation of ChildDetallePedido objects.
     */
    protected $collDetallePedidos;
    protected $collDetallePedidosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDetallePedido[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDetallePedido>
     */
    protected $detallePedidosScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Base\Pedido object.
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
     * Compares this with another <code>Pedido</code> instance.  If
     * <code>obj</code> is an instance of <code>Pedido</code>, delegates to
     * <code>equals(Pedido)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [codigo_pedido] column value.
     *
     * @return int
     */
    public function getCodigoPedido()
    {
        return $this->codigo_pedido;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_pedido] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getFechaPedido($format = null)
    {
        if ($format === null) {
            return $this->fecha_pedido;
        } else {
            return $this->fecha_pedido instanceof \DateTimeInterface ? $this->fecha_pedido->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_esperada] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getFechaEsperada($format = null)
    {
        if ($format === null) {
            return $this->fecha_esperada;
        } else {
            return $this->fecha_esperada instanceof \DateTimeInterface ? $this->fecha_esperada->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fecha_entrega] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getFechaEntrega($format = null)
    {
        if ($format === null) {
            return $this->fecha_entrega;
        } else {
            return $this->fecha_entrega instanceof \DateTimeInterface ? $this->fecha_entrega->format($format) : null;
        }
    }

    /**
     * Get the [estado] column value.
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get the [comentarios] column value.
     *
     * @return string|null
     */
    public function getComentarios()
    {
        return $this->comentarios;
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
     * Set the value of [codigo_pedido] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoPedido($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codigo_pedido !== $v) {
            $this->codigo_pedido = $v;
            $this->modifiedColumns[PedidoTableMap::COL_CODIGO_PEDIDO] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [fecha_pedido] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setFechaPedido($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_pedido !== null || $dt !== null) {
            if ($this->fecha_pedido === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_pedido->format("Y-m-d")) {
                $this->fecha_pedido = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PedidoTableMap::COL_FECHA_PEDIDO] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [fecha_esperada] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setFechaEsperada($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_esperada !== null || $dt !== null) {
            if ($this->fecha_esperada === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_esperada->format("Y-m-d")) {
                $this->fecha_esperada = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PedidoTableMap::COL_FECHA_ESPERADA] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [fecha_entrega] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setFechaEntrega($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_entrega !== null || $dt !== null) {
            if ($this->fecha_entrega === null || $dt === null || $dt->format("Y-m-d") !== $this->fecha_entrega->format("Y-m-d")) {
                $this->fecha_entrega = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PedidoTableMap::COL_FECHA_ENTREGA] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [estado] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[PedidoTableMap::COL_ESTADO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comentarios] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setComentarios($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comentarios !== $v) {
            $this->comentarios = $v;
            $this->modifiedColumns[PedidoTableMap::COL_COMENTARIOS] = true;
        }

        return $this;
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
            $this->modifiedColumns[PedidoTableMap::COL_CODIGO_CLIENTE] = true;
        }

        if ($this->aCliente !== null && $this->aCliente->getCodigoCliente() !== $v) {
            $this->aCliente = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PedidoTableMap::translateFieldName('CodigoPedido', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_pedido = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PedidoTableMap::translateFieldName('FechaPedido', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_pedido = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PedidoTableMap::translateFieldName('FechaEsperada', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_esperada = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PedidoTableMap::translateFieldName('FechaEntrega', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecha_entrega = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PedidoTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PedidoTableMap::translateFieldName('Comentarios', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comentarios = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PedidoTableMap::translateFieldName('CodigoCliente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_cliente = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = PedidoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Pedido'), 0, $e);
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
        if ($this->aCliente !== null && $this->codigo_cliente !== $this->aCliente->getCodigoCliente()) {
            $this->aCliente = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PedidoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPedidoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCliente = null;
            $this->collDetallePedidos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Pedido::setDeleted()
     * @see Pedido::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPedidoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
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
                PedidoTableMap::addInstanceToPool($this);
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

            if ($this->aCliente !== null) {
                if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
                    $affectedRows += $this->aCliente->save($con);
                }
                $this->setCliente($this->aCliente);
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

            if ($this->detallePedidosScheduledForDeletion !== null) {
                if (!$this->detallePedidosScheduledForDeletion->isEmpty()) {
                    \App\DetallePedidoQuery::create()
                        ->filterByPrimaryKeys($this->detallePedidosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->detallePedidosScheduledForDeletion = null;
                }
            }

            if ($this->collDetallePedidos !== null) {
                foreach ($this->collDetallePedidos as $referrerFK) {
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
        if ($this->isColumnModified(PedidoTableMap::COL_CODIGO_PEDIDO)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_pedido';
        }
        if ($this->isColumnModified(PedidoTableMap::COL_FECHA_PEDIDO)) {
            $modifiedColumns[':p' . $index++]  = 'fecha_pedido';
        }
        if ($this->isColumnModified(PedidoTableMap::COL_FECHA_ESPERADA)) {
            $modifiedColumns[':p' . $index++]  = 'fecha_esperada';
        }
        if ($this->isColumnModified(PedidoTableMap::COL_FECHA_ENTREGA)) {
            $modifiedColumns[':p' . $index++]  = 'fecha_entrega';
        }
        if ($this->isColumnModified(PedidoTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'estado';
        }
        if ($this->isColumnModified(PedidoTableMap::COL_COMENTARIOS)) {
            $modifiedColumns[':p' . $index++]  = 'comentarios';
        }
        if ($this->isColumnModified(PedidoTableMap::COL_CODIGO_CLIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_cliente';
        }

        $sql = sprintf(
            'INSERT INTO pedido (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'codigo_pedido':
                        $stmt->bindValue($identifier, $this->codigo_pedido, PDO::PARAM_INT);

                        break;
                    case 'fecha_pedido':
                        $stmt->bindValue($identifier, $this->fecha_pedido ? $this->fecha_pedido->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'fecha_esperada':
                        $stmt->bindValue($identifier, $this->fecha_esperada ? $this->fecha_esperada->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'fecha_entrega':
                        $stmt->bindValue($identifier, $this->fecha_entrega ? $this->fecha_entrega->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'estado':
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);

                        break;
                    case 'comentarios':
                        $stmt->bindValue($identifier, $this->comentarios, PDO::PARAM_STR);

                        break;
                    case 'codigo_cliente':
                        $stmt->bindValue($identifier, $this->codigo_cliente, PDO::PARAM_INT);

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
        $pos = PedidoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCodigoPedido();

            case 1:
                return $this->getFechaPedido();

            case 2:
                return $this->getFechaEsperada();

            case 3:
                return $this->getFechaEntrega();

            case 4:
                return $this->getEstado();

            case 5:
                return $this->getComentarios();

            case 6:
                return $this->getCodigoCliente();

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
        if (isset($alreadyDumpedObjects['Pedido'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Pedido'][$this->hashCode()] = true;
        $keys = PedidoTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getCodigoPedido(),
            $keys[1] => $this->getFechaPedido(),
            $keys[2] => $this->getFechaEsperada(),
            $keys[3] => $this->getFechaEntrega(),
            $keys[4] => $this->getEstado(),
            $keys[5] => $this->getComentarios(),
            $keys[6] => $this->getCodigoCliente(),
        ];
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('Y-m-d');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCliente) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cliente';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'cliente';
                        break;
                    default:
                        $key = 'Cliente';
                }

                $result[$key] = $this->aCliente->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDetallePedidos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'detallePedidos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'detalle_pedidos';
                        break;
                    default:
                        $key = 'DetallePedidos';
                }

                $result[$key] = $this->collDetallePedidos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PedidoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setCodigoPedido($value);
                break;
            case 1:
                $this->setFechaPedido($value);
                break;
            case 2:
                $this->setFechaEsperada($value);
                break;
            case 3:
                $this->setFechaEntrega($value);
                break;
            case 4:
                $this->setEstado($value);
                break;
            case 5:
                $this->setComentarios($value);
                break;
            case 6:
                $this->setCodigoCliente($value);
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
        $keys = PedidoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCodigoPedido($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFechaPedido($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFechaEsperada($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFechaEntrega($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEstado($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setComentarios($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCodigoCliente($arr[$keys[6]]);
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
        $criteria = new Criteria(PedidoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PedidoTableMap::COL_CODIGO_PEDIDO)) {
            $criteria->add(PedidoTableMap::COL_CODIGO_PEDIDO, $this->codigo_pedido);
        }
        if ($this->isColumnModified(PedidoTableMap::COL_FECHA_PEDIDO)) {
            $criteria->add(PedidoTableMap::COL_FECHA_PEDIDO, $this->fecha_pedido);
        }
        if ($this->isColumnModified(PedidoTableMap::COL_FECHA_ESPERADA)) {
            $criteria->add(PedidoTableMap::COL_FECHA_ESPERADA, $this->fecha_esperada);
        }
        if ($this->isColumnModified(PedidoTableMap::COL_FECHA_ENTREGA)) {
            $criteria->add(PedidoTableMap::COL_FECHA_ENTREGA, $this->fecha_entrega);
        }
        if ($this->isColumnModified(PedidoTableMap::COL_ESTADO)) {
            $criteria->add(PedidoTableMap::COL_ESTADO, $this->estado);
        }
        if ($this->isColumnModified(PedidoTableMap::COL_COMENTARIOS)) {
            $criteria->add(PedidoTableMap::COL_COMENTARIOS, $this->comentarios);
        }
        if ($this->isColumnModified(PedidoTableMap::COL_CODIGO_CLIENTE)) {
            $criteria->add(PedidoTableMap::COL_CODIGO_CLIENTE, $this->codigo_cliente);
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
        $criteria = ChildPedidoQuery::create();
        $criteria->add(PedidoTableMap::COL_CODIGO_PEDIDO, $this->codigo_pedido);

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
        $validPk = null !== $this->getCodigoPedido();

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
        return $this->getCodigoPedido();
    }

    /**
     * Generic method to set the primary key (codigo_pedido column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setCodigoPedido($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getCodigoPedido();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \App\Pedido (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCodigoPedido($this->getCodigoPedido());
        $copyObj->setFechaPedido($this->getFechaPedido());
        $copyObj->setFechaEsperada($this->getFechaEsperada());
        $copyObj->setFechaEntrega($this->getFechaEntrega());
        $copyObj->setEstado($this->getEstado());
        $copyObj->setComentarios($this->getComentarios());
        $copyObj->setCodigoCliente($this->getCodigoCliente());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDetallePedidos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDetallePedido($relObj->copy($deepCopy));
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
     * @return \App\Pedido Clone of current object.
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
     * Declares an association between this object and a ChildCliente object.
     *
     * @param ChildCliente $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCliente(ChildCliente $v = null)
    {
        if ($v === null) {
            $this->setCodigoCliente(NULL);
        } else {
            $this->setCodigoCliente($v->getCodigoCliente());
        }

        $this->aCliente = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCliente object, it will not be re-added.
        if ($v !== null) {
            $v->addPedido($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCliente object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCliente The associated ChildCliente object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCliente(?ConnectionInterface $con = null)
    {
        if ($this->aCliente === null && ($this->codigo_cliente != 0)) {
            $this->aCliente = ChildClienteQuery::create()->findPk($this->codigo_cliente, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCliente->addPedidos($this);
             */
        }

        return $this->aCliente;
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
        if ('DetallePedido' === $relationName) {
            $this->initDetallePedidos();
            return;
        }
    }

    /**
     * Clears out the collDetallePedidos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDetallePedidos()
     */
    public function clearDetallePedidos()
    {
        $this->collDetallePedidos = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDetallePedidos collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDetallePedidos($v = true): void
    {
        $this->collDetallePedidosPartial = $v;
    }

    /**
     * Initializes the collDetallePedidos collection.
     *
     * By default this just sets the collDetallePedidos collection to an empty array (like clearcollDetallePedidos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDetallePedidos(bool $overrideExisting = true): void
    {
        if (null !== $this->collDetallePedidos && !$overrideExisting) {
            return;
        }

        $collectionClassName = DetallePedidoTableMap::getTableMap()->getCollectionClassName();

        $this->collDetallePedidos = new $collectionClassName;
        $this->collDetallePedidos->setModel('\App\DetallePedido');
    }

    /**
     * Gets an array of ChildDetallePedido objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPedido is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDetallePedido[] List of ChildDetallePedido objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDetallePedido> List of ChildDetallePedido objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDetallePedidos(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDetallePedidosPartial && !$this->isNew();
        if (null === $this->collDetallePedidos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDetallePedidos) {
                    $this->initDetallePedidos();
                } else {
                    $collectionClassName = DetallePedidoTableMap::getTableMap()->getCollectionClassName();

                    $collDetallePedidos = new $collectionClassName;
                    $collDetallePedidos->setModel('\App\DetallePedido');

                    return $collDetallePedidos;
                }
            } else {
                $collDetallePedidos = ChildDetallePedidoQuery::create(null, $criteria)
                    ->filterByPedido($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDetallePedidosPartial && count($collDetallePedidos)) {
                        $this->initDetallePedidos(false);

                        foreach ($collDetallePedidos as $obj) {
                            if (false == $this->collDetallePedidos->contains($obj)) {
                                $this->collDetallePedidos->append($obj);
                            }
                        }

                        $this->collDetallePedidosPartial = true;
                    }

                    return $collDetallePedidos;
                }

                if ($partial && $this->collDetallePedidos) {
                    foreach ($this->collDetallePedidos as $obj) {
                        if ($obj->isNew()) {
                            $collDetallePedidos[] = $obj;
                        }
                    }
                }

                $this->collDetallePedidos = $collDetallePedidos;
                $this->collDetallePedidosPartial = false;
            }
        }

        return $this->collDetallePedidos;
    }

    /**
     * Sets a collection of ChildDetallePedido objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $detallePedidos A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDetallePedidos(Collection $detallePedidos, ?ConnectionInterface $con = null)
    {
        /** @var ChildDetallePedido[] $detallePedidosToDelete */
        $detallePedidosToDelete = $this->getDetallePedidos(new Criteria(), $con)->diff($detallePedidos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->detallePedidosScheduledForDeletion = clone $detallePedidosToDelete;

        foreach ($detallePedidosToDelete as $detallePedidoRemoved) {
            $detallePedidoRemoved->setPedido(null);
        }

        $this->collDetallePedidos = null;
        foreach ($detallePedidos as $detallePedido) {
            $this->addDetallePedido($detallePedido);
        }

        $this->collDetallePedidos = $detallePedidos;
        $this->collDetallePedidosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DetallePedido objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DetallePedido objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDetallePedidos(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDetallePedidosPartial && !$this->isNew();
        if (null === $this->collDetallePedidos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDetallePedidos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDetallePedidos());
            }

            $query = ChildDetallePedidoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPedido($this)
                ->count($con);
        }

        return count($this->collDetallePedidos);
    }

    /**
     * Method called to associate a ChildDetallePedido object to this object
     * through the ChildDetallePedido foreign key attribute.
     *
     * @param ChildDetallePedido $l ChildDetallePedido
     * @return $this The current object (for fluent API support)
     */
    public function addDetallePedido(ChildDetallePedido $l)
    {
        if ($this->collDetallePedidos === null) {
            $this->initDetallePedidos();
            $this->collDetallePedidosPartial = true;
        }

        if (!$this->collDetallePedidos->contains($l)) {
            $this->doAddDetallePedido($l);

            if ($this->detallePedidosScheduledForDeletion and $this->detallePedidosScheduledForDeletion->contains($l)) {
                $this->detallePedidosScheduledForDeletion->remove($this->detallePedidosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDetallePedido $detallePedido The ChildDetallePedido object to add.
     */
    protected function doAddDetallePedido(ChildDetallePedido $detallePedido): void
    {
        $this->collDetallePedidos[]= $detallePedido;
        $detallePedido->setPedido($this);
    }

    /**
     * @param ChildDetallePedido $detallePedido The ChildDetallePedido object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDetallePedido(ChildDetallePedido $detallePedido)
    {
        if ($this->getDetallePedidos()->contains($detallePedido)) {
            $pos = $this->collDetallePedidos->search($detallePedido);
            $this->collDetallePedidos->remove($pos);
            if (null === $this->detallePedidosScheduledForDeletion) {
                $this->detallePedidosScheduledForDeletion = clone $this->collDetallePedidos;
                $this->detallePedidosScheduledForDeletion->clear();
            }
            $this->detallePedidosScheduledForDeletion[]= clone $detallePedido;
            $detallePedido->setPedido(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pedido is new, it will return
     * an empty collection; or if this Pedido has previously
     * been saved, it will retrieve related DetallePedidos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pedido.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDetallePedido[] List of ChildDetallePedido objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDetallePedido}> List of ChildDetallePedido objects
     */
    public function getDetallePedidosJoinProducto(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDetallePedidoQuery::create(null, $criteria);
        $query->joinWith('Producto', $joinBehavior);

        return $this->getDetallePedidos($query, $con);
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
        if (null !== $this->aCliente) {
            $this->aCliente->removePedido($this);
        }
        $this->codigo_pedido = null;
        $this->fecha_pedido = null;
        $this->fecha_esperada = null;
        $this->fecha_entrega = null;
        $this->estado = null;
        $this->comentarios = null;
        $this->codigo_cliente = null;
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
            if ($this->collDetallePedidos) {
                foreach ($this->collDetallePedidos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDetallePedidos = null;
        $this->aCliente = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PedidoTableMap::DEFAULT_STRING_FORMAT);
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
