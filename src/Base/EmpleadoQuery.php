<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Empleado as ChildEmpleado;
use App\EmpleadoQuery as ChildEmpleadoQuery;
use App\Map\EmpleadoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `empleado` table.
 *
 * @method     ChildEmpleadoQuery orderByCodigoEmpleado($order = Criteria::ASC) Order by the codigo_empleado column
 * @method     ChildEmpleadoQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildEmpleadoQuery orderByApellido1($order = Criteria::ASC) Order by the apellido1 column
 * @method     ChildEmpleadoQuery orderByApellido2($order = Criteria::ASC) Order by the apellido2 column
 * @method     ChildEmpleadoQuery orderByExtension($order = Criteria::ASC) Order by the extension column
 * @method     ChildEmpleadoQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildEmpleadoQuery orderByCodigoOficina($order = Criteria::ASC) Order by the codigo_oficina column
 * @method     ChildEmpleadoQuery orderByCodigoJefe($order = Criteria::ASC) Order by the codigo_jefe column
 * @method     ChildEmpleadoQuery orderByPuesto($order = Criteria::ASC) Order by the puesto column
 *
 * @method     ChildEmpleadoQuery groupByCodigoEmpleado() Group by the codigo_empleado column
 * @method     ChildEmpleadoQuery groupByNombre() Group by the nombre column
 * @method     ChildEmpleadoQuery groupByApellido1() Group by the apellido1 column
 * @method     ChildEmpleadoQuery groupByApellido2() Group by the apellido2 column
 * @method     ChildEmpleadoQuery groupByExtension() Group by the extension column
 * @method     ChildEmpleadoQuery groupByEmail() Group by the email column
 * @method     ChildEmpleadoQuery groupByCodigoOficina() Group by the codigo_oficina column
 * @method     ChildEmpleadoQuery groupByCodigoJefe() Group by the codigo_jefe column
 * @method     ChildEmpleadoQuery groupByPuesto() Group by the puesto column
 *
 * @method     ChildEmpleadoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmpleadoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmpleadoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmpleadoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmpleadoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmpleadoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmpleadoQuery leftJoinOficina($relationAlias = null) Adds a LEFT JOIN clause to the query using the Oficina relation
 * @method     ChildEmpleadoQuery rightJoinOficina($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Oficina relation
 * @method     ChildEmpleadoQuery innerJoinOficina($relationAlias = null) Adds a INNER JOIN clause to the query using the Oficina relation
 *
 * @method     ChildEmpleadoQuery joinWithOficina($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Oficina relation
 *
 * @method     ChildEmpleadoQuery leftJoinWithOficina() Adds a LEFT JOIN clause and with to the query using the Oficina relation
 * @method     ChildEmpleadoQuery rightJoinWithOficina() Adds a RIGHT JOIN clause and with to the query using the Oficina relation
 * @method     ChildEmpleadoQuery innerJoinWithOficina() Adds a INNER JOIN clause and with to the query using the Oficina relation
 *
 * @method     ChildEmpleadoQuery leftJoinEmpleadoRelatedByCodigoJefe($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmpleadoRelatedByCodigoJefe relation
 * @method     ChildEmpleadoQuery rightJoinEmpleadoRelatedByCodigoJefe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmpleadoRelatedByCodigoJefe relation
 * @method     ChildEmpleadoQuery innerJoinEmpleadoRelatedByCodigoJefe($relationAlias = null) Adds a INNER JOIN clause to the query using the EmpleadoRelatedByCodigoJefe relation
 *
 * @method     ChildEmpleadoQuery joinWithEmpleadoRelatedByCodigoJefe($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmpleadoRelatedByCodigoJefe relation
 *
 * @method     ChildEmpleadoQuery leftJoinWithEmpleadoRelatedByCodigoJefe() Adds a LEFT JOIN clause and with to the query using the EmpleadoRelatedByCodigoJefe relation
 * @method     ChildEmpleadoQuery rightJoinWithEmpleadoRelatedByCodigoJefe() Adds a RIGHT JOIN clause and with to the query using the EmpleadoRelatedByCodigoJefe relation
 * @method     ChildEmpleadoQuery innerJoinWithEmpleadoRelatedByCodigoJefe() Adds a INNER JOIN clause and with to the query using the EmpleadoRelatedByCodigoJefe relation
 *
 * @method     ChildEmpleadoQuery leftJoinCliente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cliente relation
 * @method     ChildEmpleadoQuery rightJoinCliente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cliente relation
 * @method     ChildEmpleadoQuery innerJoinCliente($relationAlias = null) Adds a INNER JOIN clause to the query using the Cliente relation
 *
 * @method     ChildEmpleadoQuery joinWithCliente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cliente relation
 *
 * @method     ChildEmpleadoQuery leftJoinWithCliente() Adds a LEFT JOIN clause and with to the query using the Cliente relation
 * @method     ChildEmpleadoQuery rightJoinWithCliente() Adds a RIGHT JOIN clause and with to the query using the Cliente relation
 * @method     ChildEmpleadoQuery innerJoinWithCliente() Adds a INNER JOIN clause and with to the query using the Cliente relation
 *
 * @method     ChildEmpleadoQuery leftJoinEmpleadoRelatedByCodigoEmpleado($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmpleadoRelatedByCodigoEmpleado relation
 * @method     ChildEmpleadoQuery rightJoinEmpleadoRelatedByCodigoEmpleado($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmpleadoRelatedByCodigoEmpleado relation
 * @method     ChildEmpleadoQuery innerJoinEmpleadoRelatedByCodigoEmpleado($relationAlias = null) Adds a INNER JOIN clause to the query using the EmpleadoRelatedByCodigoEmpleado relation
 *
 * @method     ChildEmpleadoQuery joinWithEmpleadoRelatedByCodigoEmpleado($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmpleadoRelatedByCodigoEmpleado relation
 *
 * @method     ChildEmpleadoQuery leftJoinWithEmpleadoRelatedByCodigoEmpleado() Adds a LEFT JOIN clause and with to the query using the EmpleadoRelatedByCodigoEmpleado relation
 * @method     ChildEmpleadoQuery rightJoinWithEmpleadoRelatedByCodigoEmpleado() Adds a RIGHT JOIN clause and with to the query using the EmpleadoRelatedByCodigoEmpleado relation
 * @method     ChildEmpleadoQuery innerJoinWithEmpleadoRelatedByCodigoEmpleado() Adds a INNER JOIN clause and with to the query using the EmpleadoRelatedByCodigoEmpleado relation
 *
 * @method     \App\OficinaQuery|\App\EmpleadoQuery|\App\ClienteQuery|\App\EmpleadoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmpleado|null findOne(?ConnectionInterface $con = null) Return the first ChildEmpleado matching the query
 * @method     ChildEmpleado findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmpleado matching the query, or a new ChildEmpleado object populated from the query conditions when no match is found
 *
 * @method     ChildEmpleado|null findOneByCodigoEmpleado(int $codigo_empleado) Return the first ChildEmpleado filtered by the codigo_empleado column
 * @method     ChildEmpleado|null findOneByNombre(string $nombre) Return the first ChildEmpleado filtered by the nombre column
 * @method     ChildEmpleado|null findOneByApellido1(string $apellido1) Return the first ChildEmpleado filtered by the apellido1 column
 * @method     ChildEmpleado|null findOneByApellido2(string $apellido2) Return the first ChildEmpleado filtered by the apellido2 column
 * @method     ChildEmpleado|null findOneByExtension(string $extension) Return the first ChildEmpleado filtered by the extension column
 * @method     ChildEmpleado|null findOneByEmail(string $email) Return the first ChildEmpleado filtered by the email column
 * @method     ChildEmpleado|null findOneByCodigoOficina(string $codigo_oficina) Return the first ChildEmpleado filtered by the codigo_oficina column
 * @method     ChildEmpleado|null findOneByCodigoJefe(int $codigo_jefe) Return the first ChildEmpleado filtered by the codigo_jefe column
 * @method     ChildEmpleado|null findOneByPuesto(string $puesto) Return the first ChildEmpleado filtered by the puesto column
 *
 * @method     ChildEmpleado requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmpleado by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOne(?ConnectionInterface $con = null) Return the first ChildEmpleado matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmpleado requireOneByCodigoEmpleado(int $codigo_empleado) Return the first ChildEmpleado filtered by the codigo_empleado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByNombre(string $nombre) Return the first ChildEmpleado filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByApellido1(string $apellido1) Return the first ChildEmpleado filtered by the apellido1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByApellido2(string $apellido2) Return the first ChildEmpleado filtered by the apellido2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByExtension(string $extension) Return the first ChildEmpleado filtered by the extension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByEmail(string $email) Return the first ChildEmpleado filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByCodigoOficina(string $codigo_oficina) Return the first ChildEmpleado filtered by the codigo_oficina column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByCodigoJefe(int $codigo_jefe) Return the first ChildEmpleado filtered by the codigo_jefe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleado requireOneByPuesto(string $puesto) Return the first ChildEmpleado filtered by the puesto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmpleado[]|Collection find(?ConnectionInterface $con = null) Return ChildEmpleado objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmpleado> find(?ConnectionInterface $con = null) Return ChildEmpleado objects based on current ModelCriteria
 *
 * @method     ChildEmpleado[]|Collection findByCodigoEmpleado(int|array<int> $codigo_empleado) Return ChildEmpleado objects filtered by the codigo_empleado column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByCodigoEmpleado(int|array<int> $codigo_empleado) Return ChildEmpleado objects filtered by the codigo_empleado column
 * @method     ChildEmpleado[]|Collection findByNombre(string|array<string> $nombre) Return ChildEmpleado objects filtered by the nombre column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByNombre(string|array<string> $nombre) Return ChildEmpleado objects filtered by the nombre column
 * @method     ChildEmpleado[]|Collection findByApellido1(string|array<string> $apellido1) Return ChildEmpleado objects filtered by the apellido1 column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByApellido1(string|array<string> $apellido1) Return ChildEmpleado objects filtered by the apellido1 column
 * @method     ChildEmpleado[]|Collection findByApellido2(string|array<string> $apellido2) Return ChildEmpleado objects filtered by the apellido2 column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByApellido2(string|array<string> $apellido2) Return ChildEmpleado objects filtered by the apellido2 column
 * @method     ChildEmpleado[]|Collection findByExtension(string|array<string> $extension) Return ChildEmpleado objects filtered by the extension column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByExtension(string|array<string> $extension) Return ChildEmpleado objects filtered by the extension column
 * @method     ChildEmpleado[]|Collection findByEmail(string|array<string> $email) Return ChildEmpleado objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByEmail(string|array<string> $email) Return ChildEmpleado objects filtered by the email column
 * @method     ChildEmpleado[]|Collection findByCodigoOficina(string|array<string> $codigo_oficina) Return ChildEmpleado objects filtered by the codigo_oficina column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByCodigoOficina(string|array<string> $codigo_oficina) Return ChildEmpleado objects filtered by the codigo_oficina column
 * @method     ChildEmpleado[]|Collection findByCodigoJefe(int|array<int> $codigo_jefe) Return ChildEmpleado objects filtered by the codigo_jefe column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByCodigoJefe(int|array<int> $codigo_jefe) Return ChildEmpleado objects filtered by the codigo_jefe column
 * @method     ChildEmpleado[]|Collection findByPuesto(string|array<string> $puesto) Return ChildEmpleado objects filtered by the puesto column
 * @psalm-method Collection&\Traversable<ChildEmpleado> findByPuesto(string|array<string> $puesto) Return ChildEmpleado objects filtered by the puesto column
 *
 * @method     ChildEmpleado[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmpleado> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmpleadoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\EmpleadoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Empleado', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmpleadoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmpleadoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmpleadoQuery) {
            return $criteria;
        }
        $query = new ChildEmpleadoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildEmpleado|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmpleadoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmpleado A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_empleado, nombre, apellido1, apellido2, extension, email, codigo_oficina, codigo_jefe, puesto FROM empleado WHERE codigo_empleado = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEmpleado $obj */
            $obj = new ChildEmpleado();
            $obj->hydrate($row);
            EmpleadoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildEmpleado|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the codigo_empleado column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoEmpleado(1234); // WHERE codigo_empleado = 1234
     * $query->filterByCodigoEmpleado(array(12, 34)); // WHERE codigo_empleado IN (12, 34)
     * $query->filterByCodigoEmpleado(array('min' => 12)); // WHERE codigo_empleado > 12
     * </code>
     *
     * @param mixed $codigoEmpleado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoEmpleado($codigoEmpleado = null, ?string $comparison = null)
    {
        if (is_array($codigoEmpleado)) {
            $useMinMax = false;
            if (isset($codigoEmpleado['min'])) {
                $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $codigoEmpleado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoEmpleado['max'])) {
                $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $codigoEmpleado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $codigoEmpleado, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE nombre LIKE '%fooValue%'
     * $query->filterByNombre(['foo', 'bar']); // WHERE nombre IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nombre The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_NOMBRE, $nombre, $comparison);

        return $this;
    }

    /**
     * Filter the query on the apellido1 column
     *
     * Example usage:
     * <code>
     * $query->filterByApellido1('fooValue');   // WHERE apellido1 = 'fooValue'
     * $query->filterByApellido1('%fooValue%', Criteria::LIKE); // WHERE apellido1 LIKE '%fooValue%'
     * $query->filterByApellido1(['foo', 'bar']); // WHERE apellido1 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $apellido1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApellido1($apellido1 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellido1)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_APELLIDO1, $apellido1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the apellido2 column
     *
     * Example usage:
     * <code>
     * $query->filterByApellido2('fooValue');   // WHERE apellido2 = 'fooValue'
     * $query->filterByApellido2('%fooValue%', Criteria::LIKE); // WHERE apellido2 LIKE '%fooValue%'
     * $query->filterByApellido2(['foo', 'bar']); // WHERE apellido2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $apellido2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApellido2($apellido2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellido2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_APELLIDO2, $apellido2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the extension column
     *
     * Example usage:
     * <code>
     * $query->filterByExtension('fooValue');   // WHERE extension = 'fooValue'
     * $query->filterByExtension('%fooValue%', Criteria::LIKE); // WHERE extension LIKE '%fooValue%'
     * $query->filterByExtension(['foo', 'bar']); // WHERE extension IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $extension The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExtension($extension = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($extension)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_EXTENSION, $extension, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codigo_oficina column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoOficina('fooValue');   // WHERE codigo_oficina = 'fooValue'
     * $query->filterByCodigoOficina('%fooValue%', Criteria::LIKE); // WHERE codigo_oficina LIKE '%fooValue%'
     * $query->filterByCodigoOficina(['foo', 'bar']); // WHERE codigo_oficina IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codigoOficina The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoOficina($codigoOficina = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoOficina)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_OFICINA, $codigoOficina, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codigo_jefe column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoJefe(1234); // WHERE codigo_jefe = 1234
     * $query->filterByCodigoJefe(array(12, 34)); // WHERE codigo_jefe IN (12, 34)
     * $query->filterByCodigoJefe(array('min' => 12)); // WHERE codigo_jefe > 12
     * </code>
     *
     * @see       filterByEmpleadoRelatedByCodigoJefe()
     *
     * @param mixed $codigoJefe The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoJefe($codigoJefe = null, ?string $comparison = null)
    {
        if (is_array($codigoJefe)) {
            $useMinMax = false;
            if (isset($codigoJefe['min'])) {
                $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_JEFE, $codigoJefe['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoJefe['max'])) {
                $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_JEFE, $codigoJefe['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_JEFE, $codigoJefe, $comparison);

        return $this;
    }

    /**
     * Filter the query on the puesto column
     *
     * Example usage:
     * <code>
     * $query->filterByPuesto('fooValue');   // WHERE puesto = 'fooValue'
     * $query->filterByPuesto('%fooValue%', Criteria::LIKE); // WHERE puesto LIKE '%fooValue%'
     * $query->filterByPuesto(['foo', 'bar']); // WHERE puesto IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $puesto The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPuesto($puesto = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($puesto)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpleadoTableMap::COL_PUESTO, $puesto, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Oficina object
     *
     * @param \App\Oficina|ObjectCollection $oficina The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOficina($oficina, ?string $comparison = null)
    {
        if ($oficina instanceof \App\Oficina) {
            return $this
                ->addUsingAlias(EmpleadoTableMap::COL_CODIGO_OFICINA, $oficina->getCodigoOficina(), $comparison);
        } elseif ($oficina instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmpleadoTableMap::COL_CODIGO_OFICINA, $oficina->toKeyValue('PrimaryKey', 'CodigoOficina'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOficina() only accepts arguments of type \App\Oficina or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Oficina relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOficina(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Oficina');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Oficina');
        }

        return $this;
    }

    /**
     * Use the Oficina relation Oficina object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\OficinaQuery A secondary query class using the current class as primary query
     */
    public function useOficinaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOficina($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Oficina', '\App\OficinaQuery');
    }

    /**
     * Use the Oficina relation Oficina object
     *
     * @param callable(\App\OficinaQuery):\App\OficinaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOficinaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOficinaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Oficina table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\OficinaQuery The inner query object of the EXISTS statement
     */
    public function useOficinaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\OficinaQuery */
        $q = $this->useExistsQuery('Oficina', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Oficina table for a NOT EXISTS query.
     *
     * @see useOficinaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\OficinaQuery The inner query object of the NOT EXISTS statement
     */
    public function useOficinaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\OficinaQuery */
        $q = $this->useExistsQuery('Oficina', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Oficina table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\OficinaQuery The inner query object of the IN statement
     */
    public function useInOficinaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\OficinaQuery */
        $q = $this->useInQuery('Oficina', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Oficina table for a NOT IN query.
     *
     * @see useOficinaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\OficinaQuery The inner query object of the NOT IN statement
     */
    public function useNotInOficinaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\OficinaQuery */
        $q = $this->useInQuery('Oficina', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Empleado object
     *
     * @param \App\Empleado|ObjectCollection $empleado The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpleadoRelatedByCodigoJefe($empleado, ?string $comparison = null)
    {
        if ($empleado instanceof \App\Empleado) {
            return $this
                ->addUsingAlias(EmpleadoTableMap::COL_CODIGO_JEFE, $empleado->getCodigoEmpleado(), $comparison);
        } elseif ($empleado instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmpleadoTableMap::COL_CODIGO_JEFE, $empleado->toKeyValue('PrimaryKey', 'CodigoEmpleado'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmpleadoRelatedByCodigoJefe() only accepts arguments of type \App\Empleado or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmpleadoRelatedByCodigoJefe relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmpleadoRelatedByCodigoJefe(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmpleadoRelatedByCodigoJefe');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EmpleadoRelatedByCodigoJefe');
        }

        return $this;
    }

    /**
     * Use the EmpleadoRelatedByCodigoJefe relation Empleado object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\EmpleadoQuery A secondary query class using the current class as primary query
     */
    public function useEmpleadoRelatedByCodigoJefeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmpleadoRelatedByCodigoJefe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmpleadoRelatedByCodigoJefe', '\App\EmpleadoQuery');
    }

    /**
     * Use the EmpleadoRelatedByCodigoJefe relation Empleado object
     *
     * @param callable(\App\EmpleadoQuery):\App\EmpleadoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmpleadoRelatedByCodigoJefeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmpleadoRelatedByCodigoJefeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmpleadoRelatedByCodigoJefe relation to the Empleado table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\EmpleadoQuery The inner query object of the EXISTS statement
     */
    public function useEmpleadoRelatedByCodigoJefeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useExistsQuery('EmpleadoRelatedByCodigoJefe', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmpleadoRelatedByCodigoJefe relation to the Empleado table for a NOT EXISTS query.
     *
     * @see useEmpleadoRelatedByCodigoJefeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\EmpleadoQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmpleadoRelatedByCodigoJefeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useExistsQuery('EmpleadoRelatedByCodigoJefe', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmpleadoRelatedByCodigoJefe relation to the Empleado table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\EmpleadoQuery The inner query object of the IN statement
     */
    public function useInEmpleadoRelatedByCodigoJefeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useInQuery('EmpleadoRelatedByCodigoJefe', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmpleadoRelatedByCodigoJefe relation to the Empleado table for a NOT IN query.
     *
     * @see useEmpleadoRelatedByCodigoJefeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\EmpleadoQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmpleadoRelatedByCodigoJefeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useInQuery('EmpleadoRelatedByCodigoJefe', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Cliente object
     *
     * @param \App\Cliente|ObjectCollection $cliente the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCliente($cliente, ?string $comparison = null)
    {
        if ($cliente instanceof \App\Cliente) {
            $this
                ->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $cliente->getCodigoEmpleadoRepVentas(), $comparison);

            return $this;
        } elseif ($cliente instanceof ObjectCollection) {
            $this
                ->useClienteQuery()
                ->filterByPrimaryKeys($cliente->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCliente() only accepts arguments of type \App\Cliente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cliente relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCliente(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cliente');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Cliente');
        }

        return $this;
    }

    /**
     * Use the Cliente relation Cliente object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\ClienteQuery A secondary query class using the current class as primary query
     */
    public function useClienteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCliente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cliente', '\App\ClienteQuery');
    }

    /**
     * Use the Cliente relation Cliente object
     *
     * @param callable(\App\ClienteQuery):\App\ClienteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withClienteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useClienteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Cliente table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\ClienteQuery The inner query object of the EXISTS statement
     */
    public function useClienteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useExistsQuery('Cliente', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Cliente table for a NOT EXISTS query.
     *
     * @see useClienteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\ClienteQuery The inner query object of the NOT EXISTS statement
     */
    public function useClienteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useExistsQuery('Cliente', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Cliente table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\ClienteQuery The inner query object of the IN statement
     */
    public function useInClienteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useInQuery('Cliente', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Cliente table for a NOT IN query.
     *
     * @see useClienteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\ClienteQuery The inner query object of the NOT IN statement
     */
    public function useNotInClienteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useInQuery('Cliente', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Empleado object
     *
     * @param \App\Empleado|ObjectCollection $empleado the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpleadoRelatedByCodigoEmpleado($empleado, ?string $comparison = null)
    {
        if ($empleado instanceof \App\Empleado) {
            $this
                ->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $empleado->getCodigoJefe(), $comparison);

            return $this;
        } elseif ($empleado instanceof ObjectCollection) {
            $this
                ->useEmpleadoRelatedByCodigoEmpleadoQuery()
                ->filterByPrimaryKeys($empleado->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmpleadoRelatedByCodigoEmpleado() only accepts arguments of type \App\Empleado or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmpleadoRelatedByCodigoEmpleado relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmpleadoRelatedByCodigoEmpleado(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmpleadoRelatedByCodigoEmpleado');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EmpleadoRelatedByCodigoEmpleado');
        }

        return $this;
    }

    /**
     * Use the EmpleadoRelatedByCodigoEmpleado relation Empleado object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\EmpleadoQuery A secondary query class using the current class as primary query
     */
    public function useEmpleadoRelatedByCodigoEmpleadoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmpleadoRelatedByCodigoEmpleado($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmpleadoRelatedByCodigoEmpleado', '\App\EmpleadoQuery');
    }

    /**
     * Use the EmpleadoRelatedByCodigoEmpleado relation Empleado object
     *
     * @param callable(\App\EmpleadoQuery):\App\EmpleadoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmpleadoRelatedByCodigoEmpleadoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmpleadoRelatedByCodigoEmpleadoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmpleadoRelatedByCodigoEmpleado relation to the Empleado table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\EmpleadoQuery The inner query object of the EXISTS statement
     */
    public function useEmpleadoRelatedByCodigoEmpleadoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useExistsQuery('EmpleadoRelatedByCodigoEmpleado', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmpleadoRelatedByCodigoEmpleado relation to the Empleado table for a NOT EXISTS query.
     *
     * @see useEmpleadoRelatedByCodigoEmpleadoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\EmpleadoQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmpleadoRelatedByCodigoEmpleadoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useExistsQuery('EmpleadoRelatedByCodigoEmpleado', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmpleadoRelatedByCodigoEmpleado relation to the Empleado table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\EmpleadoQuery The inner query object of the IN statement
     */
    public function useInEmpleadoRelatedByCodigoEmpleadoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useInQuery('EmpleadoRelatedByCodigoEmpleado', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmpleadoRelatedByCodigoEmpleado relation to the Empleado table for a NOT IN query.
     *
     * @see useEmpleadoRelatedByCodigoEmpleadoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\EmpleadoQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmpleadoRelatedByCodigoEmpleadoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useInQuery('EmpleadoRelatedByCodigoEmpleado', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmpleado $empleado Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($empleado = null)
    {
        if ($empleado) {
            $this->addUsingAlias(EmpleadoTableMap::COL_CODIGO_EMPLEADO, $empleado->getCodigoEmpleado(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the empleado table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmpleadoTableMap::clearInstancePool();
            EmpleadoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmpleadoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmpleadoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmpleadoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
