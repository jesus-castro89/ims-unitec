<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Cliente as ChildCliente;
use App\ClienteQuery as ChildClienteQuery;
use App\Empleado as ChildEmpleado;
use App\EmpleadoQuery as ChildEmpleadoQuery;
use App\Oficina as ChildOficina;
use App\OficinaQuery as ChildOficinaQuery;
use App\Map\ClienteTableMap;
use App\Map\EmpleadoTableMap;
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
 * Base class that represents a row from the 'empleado' table.
 *
 *
 *
 * @package    propel.generator.App.Base
 */
abstract class Empleado implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\App\\Map\\EmpleadoTableMap';


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
     * The value for the codigo_empleado field.
     *
     * @var        int
     */
    protected $codigo_empleado;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the apellido1 field.
     *
     * @var        string
     */
    protected $apellido1;

    /**
     * The value for the apellido2 field.
     *
     * @var        string|null
     */
    protected $apellido2;

    /**
     * The value for the extension field.
     *
     * @var        string
     */
    protected $extension;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the codigo_oficina field.
     *
     * @var        string
     */
    protected $codigo_oficina;

    /**
     * The value for the codigo_jefe field.
     *
     * @var        int|null
     */
    protected $codigo_jefe;

    /**
     * The value for the puesto field.
     *
     * @var        string|null
     */
    protected $puesto;

    /**
     * @var        ChildOficina
     */
    protected $aOficina;

    /**
     * @var        ChildEmpleado
     */
    protected $aEmpleadoRelatedByCodigoJefe;

    /**
     * @var        ObjectCollection|ChildCliente[] Collection to store aggregation of ChildCliente objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCliente> Collection to store aggregation of ChildCliente objects.
     */
    protected $collClientes;
    protected $collClientesPartial;

    /**
     * @var        ObjectCollection|ChildEmpleado[] Collection to store aggregation of ChildEmpleado objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmpleado> Collection to store aggregation of ChildEmpleado objects.
     */
    protected $collEmpleadosRelatedByCodigoEmpleado;
    protected $collEmpleadosRelatedByCodigoEmpleadoPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCliente[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCliente>
     */
    protected $clientesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmpleado[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmpleado>
     */
    protected $empleadosRelatedByCodigoEmpleadoScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Base\Empleado object.
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
     * Compares this with another <code>Empleado</code> instance.  If
     * <code>obj</code> is an instance of <code>Empleado</code>, delegates to
     * <code>equals(Empleado)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [codigo_empleado] column value.
     *
     * @return int
     */
    public function getCodigoEmpleado()
    {
        return $this->codigo_empleado;
    }

    /**
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the [apellido1] column value.
     *
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Get the [apellido2] column value.
     *
     * @return string|null
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Get the [extension] column value.
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [codigo_oficina] column value.
     *
     * @return string
     */
    public function getCodigoOficina()
    {
        return $this->codigo_oficina;
    }

    /**
     * Get the [codigo_jefe] column value.
     *
     * @return int|null
     */
    public function getCodigoJefe()
    {
        return $this->codigo_jefe;
    }

    /**
     * Get the [puesto] column value.
     *
     * @return string|null
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set the value of [codigo_empleado] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoEmpleado($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codigo_empleado !== $v) {
            $this->codigo_empleado = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_CODIGO_EMPLEADO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_NOMBRE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [apellido1] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApellido1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellido1 !== $v) {
            $this->apellido1 = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_APELLIDO1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [apellido2] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApellido2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellido2 !== $v) {
            $this->apellido2 = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_APELLIDO2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [extension] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExtension($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->extension !== $v) {
            $this->extension = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_EXTENSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [codigo_oficina] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoOficina($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codigo_oficina !== $v) {
            $this->codigo_oficina = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_CODIGO_OFICINA] = true;
        }

        if ($this->aOficina !== null && $this->aOficina->getCodigoOficina() !== $v) {
            $this->aOficina = null;
        }

        return $this;
    }

    /**
     * Set the value of [codigo_jefe] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCodigoJefe($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codigo_jefe !== $v) {
            $this->codigo_jefe = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_CODIGO_JEFE] = true;
        }

        if ($this->aEmpleadoRelatedByCodigoJefe !== null && $this->aEmpleadoRelatedByCodigoJefe->getCodigoEmpleado() !== $v) {
            $this->aEmpleadoRelatedByCodigoJefe = null;
        }

        return $this;
    }

    /**
     * Set the value of [puesto] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPuesto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->puesto !== $v) {
            $this->puesto = $v;
            $this->modifiedColumns[EmpleadoTableMap::COL_PUESTO] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmpleadoTableMap::translateFieldName('CodigoEmpleado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_empleado = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmpleadoTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmpleadoTableMap::translateFieldName('Apellido1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellido1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmpleadoTableMap::translateFieldName('Apellido2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellido2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmpleadoTableMap::translateFieldName('Extension', TableMap::TYPE_PHPNAME, $indexType)];
            $this->extension = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmpleadoTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmpleadoTableMap::translateFieldName('CodigoOficina', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_oficina = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmpleadoTableMap::translateFieldName('CodigoJefe', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo_jefe = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EmpleadoTableMap::translateFieldName('Puesto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->puesto = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = EmpleadoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Empleado'), 0, $e);
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
        if ($this->aOficina !== null && $this->codigo_oficina !== $this->aOficina->getCodigoOficina()) {
            $this->aOficina = null;
        }
        if ($this->aEmpleadoRelatedByCodigoJefe !== null && $this->codigo_jefe !== $this->aEmpleadoRelatedByCodigoJefe->getCodigoEmpleado()) {
            $this->aEmpleadoRelatedByCodigoJefe = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmpleadoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOficina = null;
            $this->aEmpleadoRelatedByCodigoJefe = null;
            $this->collClientes = null;

            $this->collEmpleadosRelatedByCodigoEmpleado = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Empleado::setDeleted()
     * @see Empleado::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmpleadoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadoTableMap::DATABASE_NAME);
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
                EmpleadoTableMap::addInstanceToPool($this);
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

            if ($this->aOficina !== null) {
                if ($this->aOficina->isModified() || $this->aOficina->isNew()) {
                    $affectedRows += $this->aOficina->save($con);
                }
                $this->setOficina($this->aOficina);
            }

            if ($this->aEmpleadoRelatedByCodigoJefe !== null) {
                if ($this->aEmpleadoRelatedByCodigoJefe->isModified() || $this->aEmpleadoRelatedByCodigoJefe->isNew()) {
                    $affectedRows += $this->aEmpleadoRelatedByCodigoJefe->save($con);
                }
                $this->setEmpleadoRelatedByCodigoJefe($this->aEmpleadoRelatedByCodigoJefe);
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

            if ($this->clientesScheduledForDeletion !== null) {
                if (!$this->clientesScheduledForDeletion->isEmpty()) {
                    foreach ($this->clientesScheduledForDeletion as $cliente) {
                        // need to save related object because we set the relation to null
                        $cliente->save($con);
                    }
                    $this->clientesScheduledForDeletion = null;
                }
            }

            if ($this->collClientes !== null) {
                foreach ($this->collClientes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion !== null) {
                if (!$this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion->isEmpty()) {
                    foreach ($this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion as $empleadoRelatedByCodigoEmpleado) {
                        // need to save related object because we set the relation to null
                        $empleadoRelatedByCodigoEmpleado->save($con);
                    }
                    $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion = null;
                }
            }

            if ($this->collEmpleadosRelatedByCodigoEmpleado !== null) {
                foreach ($this->collEmpleadosRelatedByCodigoEmpleado as $referrerFK) {
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
        if ($this->isColumnModified(EmpleadoTableMap::COL_CODIGO_EMPLEADO)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_empleado';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_APELLIDO1)) {
            $modifiedColumns[':p' . $index++]  = 'apellido1';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_APELLIDO2)) {
            $modifiedColumns[':p' . $index++]  = 'apellido2';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_EXTENSION)) {
            $modifiedColumns[':p' . $index++]  = 'extension';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_CODIGO_OFICINA)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_oficina';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_CODIGO_JEFE)) {
            $modifiedColumns[':p' . $index++]  = 'codigo_jefe';
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_PUESTO)) {
            $modifiedColumns[':p' . $index++]  = 'puesto';
        }

        $sql = sprintf(
            'INSERT INTO empleado (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'codigo_empleado':
                        $stmt->bindValue($identifier, $this->codigo_empleado, PDO::PARAM_INT);

                        break;
                    case 'nombre':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);

                        break;
                    case 'apellido1':
                        $stmt->bindValue($identifier, $this->apellido1, PDO::PARAM_STR);

                        break;
                    case 'apellido2':
                        $stmt->bindValue($identifier, $this->apellido2, PDO::PARAM_STR);

                        break;
                    case 'extension':
                        $stmt->bindValue($identifier, $this->extension, PDO::PARAM_STR);

                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'codigo_oficina':
                        $stmt->bindValue($identifier, $this->codigo_oficina, PDO::PARAM_STR);

                        break;
                    case 'codigo_jefe':
                        $stmt->bindValue($identifier, $this->codigo_jefe, PDO::PARAM_INT);

                        break;
                    case 'puesto':
                        $stmt->bindValue($identifier, $this->puesto, PDO::PARAM_STR);

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
        $pos = EmpleadoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCodigoEmpleado();

            case 1:
                return $this->getNombre();

            case 2:
                return $this->getApellido1();

            case 3:
                return $this->getApellido2();

            case 4:
                return $this->getExtension();

            case 5:
                return $this->getEmail();

            case 6:
                return $this->getCodigoOficina();

            case 7:
                return $this->getCodigoJefe();

            case 8:
                return $this->getPuesto();

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
        if (isset($alreadyDumpedObjects['Empleado'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Empleado'][$this->hashCode()] = true;
        $keys = EmpleadoTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getCodigoEmpleado(),
            $keys[1] => $this->getNombre(),
            $keys[2] => $this->getApellido1(),
            $keys[3] => $this->getApellido2(),
            $keys[4] => $this->getExtension(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getCodigoOficina(),
            $keys[7] => $this->getCodigoJefe(),
            $keys[8] => $this->getPuesto(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOficina) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'oficina';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'oficina';
                        break;
                    default:
                        $key = 'Oficina';
                }

                $result[$key] = $this->aOficina->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmpleadoRelatedByCodigoJefe) {

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

                $result[$key] = $this->aEmpleadoRelatedByCodigoJefe->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collClientes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'clientes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'clientes';
                        break;
                    default:
                        $key = 'Clientes';
                }

                $result[$key] = $this->collClientes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmpleadosRelatedByCodigoEmpleado) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'empleados';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'empleados';
                        break;
                    default:
                        $key = 'Empleados';
                }

                $result[$key] = $this->collEmpleadosRelatedByCodigoEmpleado->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = EmpleadoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setCodigoEmpleado($value);
                break;
            case 1:
                $this->setNombre($value);
                break;
            case 2:
                $this->setApellido1($value);
                break;
            case 3:
                $this->setApellido2($value);
                break;
            case 4:
                $this->setExtension($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setCodigoOficina($value);
                break;
            case 7:
                $this->setCodigoJefe($value);
                break;
            case 8:
                $this->setPuesto($value);
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
        $keys = EmpleadoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCodigoEmpleado($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNombre($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setApellido1($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setApellido2($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setExtension($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCodigoOficina($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCodigoJefe($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPuesto($arr[$keys[8]]);
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
        $criteria = new Criteria(EmpleadoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmpleadoTableMap::COL_CODIGO_EMPLEADO)) {
            $criteria->add(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $this->codigo_empleado);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_NOMBRE)) {
            $criteria->add(EmpleadoTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_APELLIDO1)) {
            $criteria->add(EmpleadoTableMap::COL_APELLIDO1, $this->apellido1);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_APELLIDO2)) {
            $criteria->add(EmpleadoTableMap::COL_APELLIDO2, $this->apellido2);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_EXTENSION)) {
            $criteria->add(EmpleadoTableMap::COL_EXTENSION, $this->extension);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_EMAIL)) {
            $criteria->add(EmpleadoTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_CODIGO_OFICINA)) {
            $criteria->add(EmpleadoTableMap::COL_CODIGO_OFICINA, $this->codigo_oficina);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_CODIGO_JEFE)) {
            $criteria->add(EmpleadoTableMap::COL_CODIGO_JEFE, $this->codigo_jefe);
        }
        if ($this->isColumnModified(EmpleadoTableMap::COL_PUESTO)) {
            $criteria->add(EmpleadoTableMap::COL_PUESTO, $this->puesto);
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
        $criteria = ChildEmpleadoQuery::create();
        $criteria->add(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $this->codigo_empleado);

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
        $validPk = null !== $this->getCodigoEmpleado();

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
        return $this->getCodigoEmpleado();
    }

    /**
     * Generic method to set the primary key (codigo_empleado column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setCodigoEmpleado($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getCodigoEmpleado();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \App\Empleado (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCodigoEmpleado($this->getCodigoEmpleado());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setApellido1($this->getApellido1());
        $copyObj->setApellido2($this->getApellido2());
        $copyObj->setExtension($this->getExtension());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setCodigoOficina($this->getCodigoOficina());
        $copyObj->setCodigoJefe($this->getCodigoJefe());
        $copyObj->setPuesto($this->getPuesto());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getClientes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCliente($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmpleadosRelatedByCodigoEmpleado() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmpleadoRelatedByCodigoEmpleado($relObj->copy($deepCopy));
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
     * @return \App\Empleado Clone of current object.
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
     * Declares an association between this object and a ChildOficina object.
     *
     * @param ChildOficina $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOficina(ChildOficina $v = null)
    {
        if ($v === null) {
            $this->setCodigoOficina(NULL);
        } else {
            $this->setCodigoOficina($v->getCodigoOficina());
        }

        $this->aOficina = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOficina object, it will not be re-added.
        if ($v !== null) {
            $v->addEmpleado($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOficina object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOficina The associated ChildOficina object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOficina(?ConnectionInterface $con = null)
    {
        if ($this->aOficina === null && (($this->codigo_oficina !== "" && $this->codigo_oficina !== null))) {
            $this->aOficina = ChildOficinaQuery::create()->findPk($this->codigo_oficina, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOficina->addEmpleados($this);
             */
        }

        return $this->aOficina;
    }

    /**
     * Declares an association between this object and a ChildEmpleado object.
     *
     * @param ChildEmpleado|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmpleadoRelatedByCodigoJefe(ChildEmpleado $v = null)
    {
        if ($v === null) {
            $this->setCodigoJefe(NULL);
        } else {
            $this->setCodigoJefe($v->getCodigoEmpleado());
        }

        $this->aEmpleadoRelatedByCodigoJefe = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmpleado object, it will not be re-added.
        if ($v !== null) {
            $v->addEmpleadoRelatedByCodigoEmpleado($this);
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
    public function getEmpleadoRelatedByCodigoJefe(?ConnectionInterface $con = null)
    {
        if ($this->aEmpleadoRelatedByCodigoJefe === null && ($this->codigo_jefe != 0)) {
            $this->aEmpleadoRelatedByCodigoJefe = ChildEmpleadoQuery::create()->findPk($this->codigo_jefe, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmpleadoRelatedByCodigoJefe->addEmpleadosRelatedByCodigoEmpleado($this);
             */
        }

        return $this->aEmpleadoRelatedByCodigoJefe;
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
        if ('Cliente' === $relationName) {
            $this->initClientes();
            return;
        }
        if ('EmpleadoRelatedByCodigoEmpleado' === $relationName) {
            $this->initEmpleadosRelatedByCodigoEmpleado();
            return;
        }
    }

    /**
     * Clears out the collClientes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addClientes()
     */
    public function clearClientes()
    {
        $this->collClientes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collClientes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialClientes($v = true): void
    {
        $this->collClientesPartial = $v;
    }

    /**
     * Initializes the collClientes collection.
     *
     * By default this just sets the collClientes collection to an empty array (like clearcollClientes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initClientes(bool $overrideExisting = true): void
    {
        if (null !== $this->collClientes && !$overrideExisting) {
            return;
        }

        $collectionClassName = ClienteTableMap::getTableMap()->getCollectionClassName();

        $this->collClientes = new $collectionClassName;
        $this->collClientes->setModel('\App\Cliente');
    }

    /**
     * Gets an array of ChildCliente objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmpleado is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCliente[] List of ChildCliente objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCliente> List of ChildCliente objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getClientes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collClientesPartial && !$this->isNew();
        if (null === $this->collClientes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collClientes) {
                    $this->initClientes();
                } else {
                    $collectionClassName = ClienteTableMap::getTableMap()->getCollectionClassName();

                    $collClientes = new $collectionClassName;
                    $collClientes->setModel('\App\Cliente');

                    return $collClientes;
                }
            } else {
                $collClientes = ChildClienteQuery::create(null, $criteria)
                    ->filterByEmpleado($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collClientesPartial && count($collClientes)) {
                        $this->initClientes(false);

                        foreach ($collClientes as $obj) {
                            if (false == $this->collClientes->contains($obj)) {
                                $this->collClientes->append($obj);
                            }
                        }

                        $this->collClientesPartial = true;
                    }

                    return $collClientes;
                }

                if ($partial && $this->collClientes) {
                    foreach ($this->collClientes as $obj) {
                        if ($obj->isNew()) {
                            $collClientes[] = $obj;
                        }
                    }
                }

                $this->collClientes = $collClientes;
                $this->collClientesPartial = false;
            }
        }

        return $this->collClientes;
    }

    /**
     * Sets a collection of ChildCliente objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $clientes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setClientes(Collection $clientes, ?ConnectionInterface $con = null)
    {
        /** @var ChildCliente[] $clientesToDelete */
        $clientesToDelete = $this->getClientes(new Criteria(), $con)->diff($clientes);


        $this->clientesScheduledForDeletion = $clientesToDelete;

        foreach ($clientesToDelete as $clienteRemoved) {
            $clienteRemoved->setEmpleado(null);
        }

        $this->collClientes = null;
        foreach ($clientes as $cliente) {
            $this->addCliente($cliente);
        }

        $this->collClientes = $clientes;
        $this->collClientesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Cliente objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Cliente objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countClientes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collClientesPartial && !$this->isNew();
        if (null === $this->collClientes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collClientes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getClientes());
            }

            $query = ChildClienteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmpleado($this)
                ->count($con);
        }

        return count($this->collClientes);
    }

    /**
     * Method called to associate a ChildCliente object to this object
     * through the ChildCliente foreign key attribute.
     *
     * @param ChildCliente $l ChildCliente
     * @return $this The current object (for fluent API support)
     */
    public function addCliente(ChildCliente $l)
    {
        if ($this->collClientes === null) {
            $this->initClientes();
            $this->collClientesPartial = true;
        }

        if (!$this->collClientes->contains($l)) {
            $this->doAddCliente($l);

            if ($this->clientesScheduledForDeletion and $this->clientesScheduledForDeletion->contains($l)) {
                $this->clientesScheduledForDeletion->remove($this->clientesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCliente $cliente The ChildCliente object to add.
     */
    protected function doAddCliente(ChildCliente $cliente): void
    {
        $this->collClientes[]= $cliente;
        $cliente->setEmpleado($this);
    }

    /**
     * @param ChildCliente $cliente The ChildCliente object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCliente(ChildCliente $cliente)
    {
        if ($this->getClientes()->contains($cliente)) {
            $pos = $this->collClientes->search($cliente);
            $this->collClientes->remove($pos);
            if (null === $this->clientesScheduledForDeletion) {
                $this->clientesScheduledForDeletion = clone $this->collClientes;
                $this->clientesScheduledForDeletion->clear();
            }
            $this->clientesScheduledForDeletion[]= $cliente;
            $cliente->setEmpleado(null);
        }

        return $this;
    }

    /**
     * Clears out the collEmpleadosRelatedByCodigoEmpleado collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmpleadosRelatedByCodigoEmpleado()
     */
    public function clearEmpleadosRelatedByCodigoEmpleado()
    {
        $this->collEmpleadosRelatedByCodigoEmpleado = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmpleadosRelatedByCodigoEmpleado collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmpleadosRelatedByCodigoEmpleado($v = true): void
    {
        $this->collEmpleadosRelatedByCodigoEmpleadoPartial = $v;
    }

    /**
     * Initializes the collEmpleadosRelatedByCodigoEmpleado collection.
     *
     * By default this just sets the collEmpleadosRelatedByCodigoEmpleado collection to an empty array (like clearcollEmpleadosRelatedByCodigoEmpleado());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmpleadosRelatedByCodigoEmpleado(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmpleadosRelatedByCodigoEmpleado && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmpleadoTableMap::getTableMap()->getCollectionClassName();

        $this->collEmpleadosRelatedByCodigoEmpleado = new $collectionClassName;
        $this->collEmpleadosRelatedByCodigoEmpleado->setModel('\App\Empleado');
    }

    /**
     * Gets an array of ChildEmpleado objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmpleado is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmpleado[] List of ChildEmpleado objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmpleado> List of ChildEmpleado objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmpleadosRelatedByCodigoEmpleado(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmpleadosRelatedByCodigoEmpleadoPartial && !$this->isNew();
        if (null === $this->collEmpleadosRelatedByCodigoEmpleado || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmpleadosRelatedByCodigoEmpleado) {
                    $this->initEmpleadosRelatedByCodigoEmpleado();
                } else {
                    $collectionClassName = EmpleadoTableMap::getTableMap()->getCollectionClassName();

                    $collEmpleadosRelatedByCodigoEmpleado = new $collectionClassName;
                    $collEmpleadosRelatedByCodigoEmpleado->setModel('\App\Empleado');

                    return $collEmpleadosRelatedByCodigoEmpleado;
                }
            } else {
                $collEmpleadosRelatedByCodigoEmpleado = ChildEmpleadoQuery::create(null, $criteria)
                    ->filterByEmpleadoRelatedByCodigoJefe($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmpleadosRelatedByCodigoEmpleadoPartial && count($collEmpleadosRelatedByCodigoEmpleado)) {
                        $this->initEmpleadosRelatedByCodigoEmpleado(false);

                        foreach ($collEmpleadosRelatedByCodigoEmpleado as $obj) {
                            if (false == $this->collEmpleadosRelatedByCodigoEmpleado->contains($obj)) {
                                $this->collEmpleadosRelatedByCodigoEmpleado->append($obj);
                            }
                        }

                        $this->collEmpleadosRelatedByCodigoEmpleadoPartial = true;
                    }

                    return $collEmpleadosRelatedByCodigoEmpleado;
                }

                if ($partial && $this->collEmpleadosRelatedByCodigoEmpleado) {
                    foreach ($this->collEmpleadosRelatedByCodigoEmpleado as $obj) {
                        if ($obj->isNew()) {
                            $collEmpleadosRelatedByCodigoEmpleado[] = $obj;
                        }
                    }
                }

                $this->collEmpleadosRelatedByCodigoEmpleado = $collEmpleadosRelatedByCodigoEmpleado;
                $this->collEmpleadosRelatedByCodigoEmpleadoPartial = false;
            }
        }

        return $this->collEmpleadosRelatedByCodigoEmpleado;
    }

    /**
     * Sets a collection of ChildEmpleado objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $empleadosRelatedByCodigoEmpleado A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmpleadosRelatedByCodigoEmpleado(Collection $empleadosRelatedByCodigoEmpleado, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmpleado[] $empleadosRelatedByCodigoEmpleadoToDelete */
        $empleadosRelatedByCodigoEmpleadoToDelete = $this->getEmpleadosRelatedByCodigoEmpleado(new Criteria(), $con)->diff($empleadosRelatedByCodigoEmpleado);


        $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion = $empleadosRelatedByCodigoEmpleadoToDelete;

        foreach ($empleadosRelatedByCodigoEmpleadoToDelete as $empleadoRelatedByCodigoEmpleadoRemoved) {
            $empleadoRelatedByCodigoEmpleadoRemoved->setEmpleadoRelatedByCodigoJefe(null);
        }

        $this->collEmpleadosRelatedByCodigoEmpleado = null;
        foreach ($empleadosRelatedByCodigoEmpleado as $empleadoRelatedByCodigoEmpleado) {
            $this->addEmpleadoRelatedByCodigoEmpleado($empleadoRelatedByCodigoEmpleado);
        }

        $this->collEmpleadosRelatedByCodigoEmpleado = $empleadosRelatedByCodigoEmpleado;
        $this->collEmpleadosRelatedByCodigoEmpleadoPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Empleado objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Empleado objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmpleadosRelatedByCodigoEmpleado(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmpleadosRelatedByCodigoEmpleadoPartial && !$this->isNew();
        if (null === $this->collEmpleadosRelatedByCodigoEmpleado || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmpleadosRelatedByCodigoEmpleado) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmpleadosRelatedByCodigoEmpleado());
            }

            $query = ChildEmpleadoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmpleadoRelatedByCodigoJefe($this)
                ->count($con);
        }

        return count($this->collEmpleadosRelatedByCodigoEmpleado);
    }

    /**
     * Method called to associate a ChildEmpleado object to this object
     * through the ChildEmpleado foreign key attribute.
     *
     * @param ChildEmpleado $l ChildEmpleado
     * @return $this The current object (for fluent API support)
     */
    public function addEmpleadoRelatedByCodigoEmpleado(ChildEmpleado $l)
    {
        if ($this->collEmpleadosRelatedByCodigoEmpleado === null) {
            $this->initEmpleadosRelatedByCodigoEmpleado();
            $this->collEmpleadosRelatedByCodigoEmpleadoPartial = true;
        }

        if (!$this->collEmpleadosRelatedByCodigoEmpleado->contains($l)) {
            $this->doAddEmpleadoRelatedByCodigoEmpleado($l);

            if ($this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion and $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion->contains($l)) {
                $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion->remove($this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmpleado $empleadoRelatedByCodigoEmpleado The ChildEmpleado object to add.
     */
    protected function doAddEmpleadoRelatedByCodigoEmpleado(ChildEmpleado $empleadoRelatedByCodigoEmpleado): void
    {
        $this->collEmpleadosRelatedByCodigoEmpleado[]= $empleadoRelatedByCodigoEmpleado;
        $empleadoRelatedByCodigoEmpleado->setEmpleadoRelatedByCodigoJefe($this);
    }

    /**
     * @param ChildEmpleado $empleadoRelatedByCodigoEmpleado The ChildEmpleado object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmpleadoRelatedByCodigoEmpleado(ChildEmpleado $empleadoRelatedByCodigoEmpleado)
    {
        if ($this->getEmpleadosRelatedByCodigoEmpleado()->contains($empleadoRelatedByCodigoEmpleado)) {
            $pos = $this->collEmpleadosRelatedByCodigoEmpleado->search($empleadoRelatedByCodigoEmpleado);
            $this->collEmpleadosRelatedByCodigoEmpleado->remove($pos);
            if (null === $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion) {
                $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion = clone $this->collEmpleadosRelatedByCodigoEmpleado;
                $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion->clear();
            }
            $this->empleadosRelatedByCodigoEmpleadoScheduledForDeletion[]= $empleadoRelatedByCodigoEmpleado;
            $empleadoRelatedByCodigoEmpleado->setEmpleadoRelatedByCodigoJefe(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Empleado is new, it will return
     * an empty collection; or if this Empleado has previously
     * been saved, it will retrieve related EmpleadosRelatedByCodigoEmpleado from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Empleado.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmpleado[] List of ChildEmpleado objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmpleado}> List of ChildEmpleado objects
     */
    public function getEmpleadosRelatedByCodigoEmpleadoJoinOficina(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmpleadoQuery::create(null, $criteria);
        $query->joinWith('Oficina', $joinBehavior);

        return $this->getEmpleadosRelatedByCodigoEmpleado($query, $con);
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
        if (null !== $this->aOficina) {
            $this->aOficina->removeEmpleado($this);
        }
        if (null !== $this->aEmpleadoRelatedByCodigoJefe) {
            $this->aEmpleadoRelatedByCodigoJefe->removeEmpleadoRelatedByCodigoEmpleado($this);
        }
        $this->codigo_empleado = null;
        $this->nombre = null;
        $this->apellido1 = null;
        $this->apellido2 = null;
        $this->extension = null;
        $this->email = null;
        $this->codigo_oficina = null;
        $this->codigo_jefe = null;
        $this->puesto = null;
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
            if ($this->collClientes) {
                foreach ($this->collClientes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmpleadosRelatedByCodigoEmpleado) {
                foreach ($this->collEmpleadosRelatedByCodigoEmpleado as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collClientes = null;
        $this->collEmpleadosRelatedByCodigoEmpleado = null;
        $this->aOficina = null;
        $this->aEmpleadoRelatedByCodigoJefe = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmpleadoTableMap::DEFAULT_STRING_FORMAT);
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
